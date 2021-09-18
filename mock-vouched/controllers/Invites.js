'use strict';

var utils = require('../utils/writer.js');
var Invites = require('../service/InvitesService');

module.exports.listInvites = function listInvites (req, res, next, id, page, pageSize) {
  Invites.listInvites(id, page, pageSize)
    .then(function (response) {
      utils.writeJson(res, response);
    })
    .catch(function (response) {
      utils.writeJson(res, response);
    });
};

module.exports.resendInvites = function resendInvites (req, res, next, id) {
  Invites.resendInvites(id)
    .then(function (response) {
      utils.writeJson(res, response);
    })
    .catch(function (response) {
      utils.writeJson(res, response);
    });
};

module.exports.sendInvites = function sendInvites (req, res, next, body) {
  Invites.sendInvites(body)
    .then(function (response) {
      utils.writeJson(res, response);
    })
    .catch(function (response) {
      utils.writeJson(res, response);
    });
};
