const express = require("express");
const cors = require("cors");
const app = express();
const db = require("./models");

app.use(cors());
app.use(express.json());
app.use(express.urlencoded({extended: true}));

db.sequelize.sync().then(() => {
    console.log('Drop and Resync Db');
});

const PORT = process.env.PORT || 8080;

require("./routes/planificator.route")(app);

app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
