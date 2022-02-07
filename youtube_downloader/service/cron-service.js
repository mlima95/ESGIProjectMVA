var cron = require('node-cron');
const {cronDetails} = require('../config/cron.config.js');
const downloadService = require('./downloader-service.js')

exports.start = async () => {
    console.log("Starting CRON...")
    cron.schedule(cronDetails, async () => {
        await downloadService.checkDateForDownload()
    });
}
