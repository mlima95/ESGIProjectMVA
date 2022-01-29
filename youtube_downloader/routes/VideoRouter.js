const express = require('express')
const VideoController = require('../controllers/VideoController')
const router = express.Router();

router.post('/add-queue', VideoController.create);
router.get('/failed', VideoController.findAllFailed);
router.get('/downloaded', VideoController.findAllDownloaded);
router.get('/pending', VideoController.findAllPending);

module.exports = router
