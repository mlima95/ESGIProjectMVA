const {Model} = require("sequelize");

module.exports = (sequelize, Datatypes) => {
    class Status extends Model {}

    Status.init({
        status: Datatypes.STRING,
    }, {
        sequelize,
        modelName: 'statu',
    });

    return Status;
};