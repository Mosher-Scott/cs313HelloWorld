// Need to create these
var express = require('express');
var router = express.Router();

/* Base route */
router.get('/', function (req, res) {
    res.render('index', { title: 'My Test Route'});
});

module.exports = router;    