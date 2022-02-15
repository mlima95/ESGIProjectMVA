const mongoose = require('mongoose');
const { v4: uuidv4} = require('uuid');

const schema = new mongoose.Schema({
    keyword: {
        type: String,
        require: true,
    },
    youtubeLinkId: {
        type: Array,
        default: ''
    },
    authorId: {
        type: String,
        required: true,
        default: 0
    },
    validatorId: {
        type: String,
        default: 0
    }
});

const themeData = new mongoose.model('ThemeData', schema);

module.exports = themeData;
