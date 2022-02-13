const express = require('express')
const VideoController = require('../controllers/ThemeController')
const router = express.Router();

router.post('/createKeyWord', VideoController.createKeyWord);
router.get('/findVideoId', VideoController.findVideoId);

module.exports = router