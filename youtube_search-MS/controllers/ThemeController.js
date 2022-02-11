const ThemeDataModel = require('../model/theme-data')
const fetch = require('node-fetch');

const {
    BASE_URL,
} = process.env;

// Create and Save a new videoData
exports.createKeyWord = async (req, res) => {

    if (!req.body.keyword || !req.body.themeId) {
        res.status(400).send({ message: "Content can not be empty!" });
        return;
    }

    const videoData = new ThemeDataModel({
        themeId: req.body.themeId,
        keyword: req.body.keyword,
        authorId: req.body.authorId,
        validatorId: req.body.validatorId
    });
    await videoData.save().then(() => res.send(200)).catch(err => {
        res.status(500).send({
            message: err.message || "Some error occurred while creating videoData"
        });
    });

    res.sendStatus(200);
    res.end();
};

// Retrieve all videoData from the database.
exports.findVideoId = async (req, res) => {
    try {
        const themeData = await ThemeDataModel.findOne({ 'keyword': req.body.keyword });
        const respond = themeData.keyword;
        
        const response = await fetch(BASE_URL + '&q=' + respond);
        const data = await response.json();

        let array = [];
        for(const item of data.items){
            array.push(item.id.videoId)
        }

        themeData.youtubeLinkId = array;
        themeData.save().then(() => res.send(200)).catch(err => {
            res.status(500).send({
                message: err.message || "Some error occurred while creating videoData"
            });
        })

        res.status(200).json(themeData);

        res.status(200).json(array);

        //res.status(200).json(data.items);

    } catch(error) {
        res.status(404).json({message: error.message});
    }
};