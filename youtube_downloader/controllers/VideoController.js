const VideoDataModel = require('../model/video-data')
const {addToDownloadQueue} = require('../service/downloader-service.js');

// Create and Save a new videoData
exports.create = async (req, res) => {
    if (!req.body.videoId && !req.body.dateOfUpload) {
        res.status(400).send({ message: "Content can not be empty!" });
    }

    const videoData = new VideoDataModel({
        videoId: req.body.videoId,
        dateOfUpload: req.body.dateOfUpload
    });

    await videoData.save().then(data => {
        videoData.mongoData = data
        addToDownloadQueue(videoData)
        res.sendStatus(200);
    }).catch(err => {
        res.status(500).send({
            message: err.message || "Some error occurred while creating videoData"
        });
    });
};

// Retrieve all videoData from the database.
exports.findAllByStatus = async (req, res) => {
    try {
        if (!req.params.idStatus ) {
            res.status(400).send({ message: "Missing params idStatus" });
        }
        const videoData = await VideoDataModel.find({ 'status': req.params.idStatus });
        res.status(200).json(videoData);

    } catch(error) {
        res.status(404).json({message: error.message});
    }
};


// // Retrieve all videoData from the database.
// exports.findAllPending = async (req, res) => {
//     try {
//         const videoData = await VideoDataModel.find({status: 0});
//         res.status(200).json(videoData);
//     } catch(error) {
//         res.status(404).json({message: error.message});
//     }
// };
//
// // Retrieve all videoData from the database.
// exports.findAllDownloaded = async (req, res) => {
//     try {
//         const videoData = await VideoDataModel.find({status: 1});
//         res.status(200).json(videoData);
//     } catch(error) {
//         res.status(404).json({message: error.message});
//     }
// };
/*
// Find a single User with an id
exports.findVideoOne = async (req, res) => {
    try {
        const videoData = await VideoDataModel.find({ 'videoId': req.params.id });
        res.status(200).json(videoData);
    } catch(error) {
        res.status(404).json({ message: error.message});
    }
};

// Update a videoData by the id in the request
exports.update = async (req, res) => {
    if(!req.body) {
        res.status(400).send({
            message: "Data to update can not be empty!"
        });
    }

    const id = req.params.id;

    await VideoDataModel.findOneAndUpdate({'videoId' : id}, req.body, { useFindAndModify: false }).then(data => {
        if (!data) {
            res.status(404).send({
                message: `User not found.`
            });
        }else{
            res.send({ message: "User updated successfully." })
        }
    }).catch(err => {
        res.status(500).send({
            message: err.message
        });
    });
};

// Delete a videoData with the specified id in the request
exports.destroy = async (req, res) => {
    await VideoDataModel.findOneAndRemove({"videoId": req.param.id}).then(data => {
        if (!data) {
            res.status(404).send({
                message: `User not found.`
            });
        } else {
            res.send({
                message: "User deleted successfully!"
            });
        }
    }).catch(err => {
        res.status(500).send({
            message: err.message
        });
    });
};*/
