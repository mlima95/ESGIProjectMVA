const express = require('express')
const VideoController = require('../controllers/VideoController')
const router = express.Router();

router.post('/add-queue', VideoController.create);
router.get('/status', VideoController.findAllByStatus);

module.exports = router
