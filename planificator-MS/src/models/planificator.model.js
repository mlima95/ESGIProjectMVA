const {Model} = require("sequelize");

module.exports = (sequelize, Datatypes) => {
    class Planificator extends Model {}

    Planificator.init({
        youtubeSlug: Datatypes.STRING,
        dateOfUpload: Datatypes.DATE,
        userId: Datatypes.UUID,
    }, {
        sequelize,
        modelName: 'planificator',

    });

    return Planificator;
};