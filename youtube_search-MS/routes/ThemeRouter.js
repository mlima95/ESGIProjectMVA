const express = require('express')
const VideoController = require('../controllers/ThemeController')
const router = express.Router();

router.post('/createKeyWord', VideoController.createKeyWord);
router.post('/findVideoId', VideoController.findVideoId);

module.exports = router