const mongoose = require('mongoose');
const { v4: uuidv4} = require('uuid');

const schema = new mongoose.Schema({
    videoId: {
        type: String,
        required: true,
        unique: true
    },
    filePath: {
        type: String,
        require: false
    },
    dateOfUpload: {
        type: String,
        required: true
    },
    status: {
        type: Number,
        required: true,
        default: 0
    }
});

const videoData = new mongoose.model('VideoData', schema);

module.exports = videoData;
