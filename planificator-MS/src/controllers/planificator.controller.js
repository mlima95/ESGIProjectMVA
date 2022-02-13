const db = require("../models");
const Planificators = db.planificators;


exports.createPlanning = (req, res) => {
    if(!req.body.youtubeSlug && !req.body.dateOfUpload && !req.body.userId) {
        res.status(400).send({
            message: "Content can not be empty!"
        });
        return;
    }

    const planificator = {
        youtubeSlug: req.body.youtubeSlug,
        status: req.body.status,
        dateOfUpload: req.body.dateOfUpload,
        userId: req.body.userId
    };

    Planificators.create(planificator)
        .then(data => {
            res.send(data)
        })
        .catch(err => {
            res.status(500).send({
                message:
                    err.message || 'Some error occurred while creating planning.'
            });
        });
};

exports.findAllPlannings = (req, res) => {

    Planificators.findAll({
        attributes: [
            'youtubeSlug', 'status', 'dateOfUpload', 'userId'
        ]
    }).then(data => {
        res.set('Access-Control-Expose-Headers', 'X-Total-Count')
        res.set('X-Total-Count', data.length)
        res.send(data);
    })
        .catch(err => {
            res.status(500).send({
                message:
                    err.message || 'Some error occurred while creating planning.'
            });
        });
}