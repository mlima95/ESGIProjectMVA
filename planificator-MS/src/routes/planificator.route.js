const planificators = require("../controllers/planificator.controller");
module.exports = app => {
    const planificators = require("../controllers/planificator.controller");
    var router = require("express").Router();

    router.post("/", planificators.createPlanning);
    router.patch("/:youtubeSlug", planificators.updatePlanificatorByStatus);
    router.get("/", planificators.findAllPlannings);

    app.use('/planning', router);
}