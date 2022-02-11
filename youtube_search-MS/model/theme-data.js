const mongoose = require('mongoose');
const { v4: uuidv4} = require('uuid');

const schema = new mongoose.Schema({
    themeId: {
        type: String,
        required: true,
        unique: true
    },
    keyword: {
        type: String,
        require: true
    },
    statusId: {
        type: String,
        required: true,
        default: 0
    },
    youtubeLinkId: {
        type: Array,
        default: ''
    },
    authorId: {
        type: Number,
        required: true,
        default: 0
    },
    validatorId: {
        type: Number,
        required: true,
        default: 0
    }
});

const themeData = new mongoose.model('ThemeData', schema);

module.exports = themeData;
