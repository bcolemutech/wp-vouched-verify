'use strict';

var utils = require('../utils/writer.js');
var Aamva = require('../service/AamvaService');

module.exports.submitAamva = function submitAamva (req, res, next, body) {
  Aamva.submitAamva(body)
    .then(function (response) {
      utils.writeJson(res, response);
    })
    .catch(function (response) {
      utils.writeJson(res, response);
    });
};
