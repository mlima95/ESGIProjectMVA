const fs = require('fs');
const ytdl = require('ytdl-core');
const BetterQueue = require('better-queue');
const path = require('path');
const sanitize = require("sanitize-filename");
const VideoDataModel = require('../model/video-data');
const dayjs = require('dayjs');

const infoQueue = new BetterQueue(async (videoData, continueToDownloadProcess) => {
    const result = [];
    for(const video of videoData){
        result.push(await getInfo(video));
    }
    if(result.length){
        continueToDownloadProcess(result)
    }
});

const downloadQueue = new BetterQueue(async (datas) => {
    const detailsArr = []
    for(const data of datas){
        const details = {
            videoDetails: data.info.videoDetails,
            sanitizedName: sanitize(data.info.videoDetails.title) + ".mp4",
            dateOfUpload: data.video.dateOfUpload,
            mongoData: data.video
        };
        detailsArr.push(details);
    }
    await download(detailsArr, endToPostDownloadProcess);
},  { afterProcessDelay: 1000 });

const savingPostDownloadQueue = new BetterQueue(async (result, saveInMongo) => {
    await saveInMongo(result)
});

const saveInMongo = async ({data, output}) => {

    // Mettre à jour mongodb avec les data (le path notemment)
    await VideoDataModel.findByIdAndUpdate(data.mongoData._id,
        {
            status: 1, // OK
            filePath: output
        },
        {useFindAndModify: false}
    );
}

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

const addToDownloadQueue = (videoData) => {
    infoQueue.push(videoData, continueToDownloadProcess);
};

const continueToDownloadProcess =  (resultInfo) =>{
    downloadQueue.push(resultInfo);
}

const endToPostDownloadProcess = (resultDownload) => {
    savingPostDownloadQueue.push(resultDownload, saveInMongo)
}

const endToErrorManagementProcess = (err) => {
    failedDownloadQueue.push(err);
}

async function getInfo(video) {
    let result;
    try {
        await ytdl.getBasicInfo(video.videoId).then((info) => {
            result = {info, video};
        });
        return result;
    } catch (e) {
        // Mettre le status dans la queue des faileds
        endToErrorManagementProcess({_id: video._id, failStatus: 99});
    }
}
async function download(datas) {
    for(const data of datas) {

        const output = path.resolve(__dirname + '/../assets/videos', data.sanitizedName);
        // Get audio and video streams
        const dlProcess = await ytdl(data.mongoData.videoId)
            .on('end', () => {
                endToPostDownloadProcess({data, output});
            })
            .on('error', () => {
                endToErrorManagementProcess({_id: data.mongoData._id, failStatus: 999});
            })
            .pipe(fs.createWriteStream(output));
    }

}


exports.addToDownloadQueue = addToDownloadQueue;

exports.checkDateForDownload = async () => {
    const today = dayjs().startOf('day').toDate().toISOString();
    const tomorrow = dayjs().add(1, 'day').endOf('day').toDate().toISOString();


    addToDownloadQueue(await VideoDataModel.find({
        "dateOfUpload": {
            "$gte": today,
            "$lte": tomorrow
        },
        "status": 0
    }));
};
