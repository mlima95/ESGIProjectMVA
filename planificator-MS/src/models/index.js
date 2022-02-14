const Sequelize = require("sequelize");

console.log(process.env);
const sequelize = new Sequelize(
    process.env.DATABASE,
    process.env.USERNAME,
    process.env.PASSWORD, {
        host: process.env.HOST,
        port: process.env.PORTPG,
        dialect: process.env.DIALECT
    });

const db = {}

db.Sequelize = Sequelize;
db.sequelize = sequelize;

db.planificators = require("../models/planificator.model.js")(sequelize, Sequelize)
db.status = require("../models/status.model")(sequelize, Sequelize)

db.status.hasMany(db.planificators,{
    foreignKey: "statusId",
    as: "planificators"
})

module.exports = db;