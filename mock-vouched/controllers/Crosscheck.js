'use strict';

var utils = require('../utils/writer.js');
var Crosscheck = require('../service/CrosscheckService');

module.exports.crossCheck = function crossCheck (req, res, next, body) {
  Crosscheck.crossCheck(body)
    .then(function (response) {
      utils.writeJson(res, response);
    })
    .catch(function (response) {
      utils.writeJson(res, response);
    });
};
