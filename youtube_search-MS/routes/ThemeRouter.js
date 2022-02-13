const express = require('express')
const VideoController = require('../controllers/ThemeController')
const router = express.Router();

router.post('/createKeyWord', VideoController.createKeyWord);
router.patch('/updateKeyWord/:id', VideoController.updateKeyword);
router.get('/findVideoId', VideoController.findVideoId);
router.get('/', VideoController.findKeywords);

module.exports = router
