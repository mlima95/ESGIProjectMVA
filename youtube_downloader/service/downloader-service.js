const fs = require('fs');
const ytdl = require('ytdl-core');
const a = require('./downloader-service.js');
const BetterQueue = require('better-queue');
const path = require('path');
const sanitize = require("sanitize-filename");
const VideoDataModel = require('../model/video-data');

const infoQueue = new BetterQueue(async (videoData) => {
    await getInfo(videoData);
});

const downloadQueue = new BetterQueue(async (data) => {
    const details = {
        videoDetails: data.info.videoDetails,
        sanitizedName: sanitize(data.info.videoDetails.title) + ".mp4",
        dateOfUpload: data.videoData.dateOfUpload,
        mongoData: data.videoData.mongoData
    };
    await download(details);
});

const savingPostDownloadQueue = new BetterQueue(async ({data, output}) => {

    // Mettre à jour mongodb avec les data (le path notemment)
    await VideoDataModel.findByIdAndUpdate(data.mongoData._id,
        {
            status: 1, // OK
            filePath: output
        },
        {useFindAndModify: false}
    );
});

const failedDownloadQueue = new BetterQueue(async (data) => {
    // Si ici, le dl à fail, le code est dans data
    // 99 fail dans info
    // 999 fail dans download
    // Mettre à jour mongodb avec les data (le path notemment)
    await VideoDataModel.findByIdAndUpdate(data._id,
        {
            status: data.failStatus,
        },
        {useFindAndModify: false}
    );
});

async function download(data) {
    const output = path.resolve(__dirname + '/../assets/videos', data.sanitizedName);

        // Get audio and video streams
        const dlProcess = ytdl(data.videoDetails.videoId)
            .on('finish', () => {
                savingPostDownloadQueue.push({data, output});
            })
            .on('error', () => {
                failedDownloadQueue.push({_id: data.mongoData._id, failStatus: 999})

            })
            .pipe(fs.createWriteStream(output));


}


async function getInfo(videoData) {
    try {
        return await ytdl.getBasicInfo(videoData.videoId).then((info) => {
            downloadQueue.push({info, videoData});
        });
    } catch (e) {
        // Mettre le status dans la queue des faileds
        failedDownloadQueue.push({_id: videoData._id, failStatus: 99})
    }

}

exports.addToDownloadQueue = async (videoData) => {
    infoQueue.push(videoData);
};
