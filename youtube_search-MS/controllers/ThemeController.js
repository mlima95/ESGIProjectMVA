const ThemeDataModel = require('../model/theme-data')
const fetch = require('node-fetch');

const {
    BASE_URL,
} = process.env;

// Create and Save a new videoData
exports.createKeyWord = async (req, res) => {

    if (!req.body.keyword || !req.body.statusId) {
        res.status(400).send({ message: "Content can not be empty!" });
        return;
    }

    const videoData = new ThemeDataModel({
        statusId: req.body.statusId,
        keyword: req.body.keyword,
        authorId: req.body.authorId,
        validatorId: req.body.validatorId
    });
    await videoData.save().then((data) => {
        res.status(200).json({id: data._id.toString(), statusId: data.statusId,
            keyword: data.keyword})
    }).catch(err => {
        res.status(500).send({
            message: err.message || "Some error occurred while creating videoData"
        });
    });

};

// Retrieve all videoData from the database.
exports.findVideoId = async (req, res) => {
    try {
        const themeData = await ThemeDataModel.findOne({ 'keyword': req.query.keyword });
        const respond = themeData.keyword;
        
        const response = await fetch(BASE_URL + '&q=' + respond);
        const data = await response.json();

        let array = [];
        for(const item of data.items){
            array.push(item.id.videoId)
        }

        themeData.youtubeLinkId = array;
        themeData.save().then(() => res.status(201).json(array)).catch(err => {
            res.status(500).send({
                message: err.message || "Some error occurred while creating videoData"
            });
        })

    } catch(error) {
        res.status(404).json({message: error.message});
    }
};