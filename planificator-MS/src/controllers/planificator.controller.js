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
        userId: req.body.userId,
        statusId: "1"
    };

    Planificators.create(planificator)
        .then(data => {
            res.status(201).json(data)
        })
        .catch(err => {
            res.status(500).send({
                message:
                    err.message || 'Some error occurred while creating planning.'
            });
        });
};
let tour = 0;
exports.updatePlanificatorByStatus = (req, res) => {
    tour++;
    console.log(tour, req.url);
    if(!req.body) {
        res.status(400).send({
            message: "Content can not be empty!"
        });
        return;
    }
    const youtubeSlug = req.body.youtubeSlug;

    Planificators.update(req.body,{
        where: {youtubeSlug: youtubeSlug}, attributes:["statusId"]
    })
        .then(data => {
            res.sendStatus(204);
        })
        .catch(err => {
            res.status(500).send({
                message:
                    err.message || 'Some error occurred while updating planning.'
            });
        })
};

exports.findAllPlannings = (req, res) => {

    Planificators.findAll({
        attributes: [
            'youtubeSlug', 'dateOfUpload', 'userId', 'statusId'
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
