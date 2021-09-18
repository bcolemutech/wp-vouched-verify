'use strict';

var utils = require('../utils/writer.js');
var Jobs = require('../service/JobsService');

module.exports.authenticateJob = function authenticateJob (req, res, next, body) {
  Jobs.authenticateJob(body)
    .then(function (response) {
      utils.writeJson(res, response);
    })
    .catch(function (response) {
      utils.writeJson(res, response);
    });
};

module.exports.deleteJob = function deleteJob (req, res, next, id) {
  Jobs.deleteJob(id)
    .then(function (response) {
      utils.writeJson(res, response);
    })
    .catch(function (response) {
      utils.writeJson(res, response);
    });
};

module.exports.downloadJobPDF = function downloadJobPDF (req, res, next, id, confidences) {
  Jobs.downloadJobPDF(id, confidences)
    .then(function (response) {
      utils.writeJson(res, response);
    })
    .catch(function (response) {
      utils.writeJson(res, response);
    });
};

module.exports.findJobs = function findJobs (req, res, next, id, type, ids, token, page, pageSize, sortBy, sortOrder, status, from, to, toFrom, withPhotos, withPhotoUrls) {
  Jobs.findJobs(id, type, ids, token, page, pageSize, sortBy, sortOrder, status, from, to, toFrom, withPhotos, withPhotoUrls)
    .then(function (response) {
      utils.writeJson(res, response);
    })
    .catch(function (response) {
      utils.writeJson(res, response);
    });
};

module.exports.getDocs = function getDocs (req, res, next) {
  Jobs.getDocs()
    .then(function (response) {
      utils.writeJson(res, response);
    })
    .catch(function (response) {
      utils.writeJson(res, response);
    });
};

module.exports.submitJob = function submitJob (req, res, next, body) {
  Jobs.submitJob(body)
    .then(function (response) {
      utils.writeJson(res, response);
    })
    .catch(function (response) {
      utils.writeJson(res, response);
    });
};

module.exports.updateJob = function updateJob (req, res, next, body, id) {
  Jobs.updateJob(body, id)
    .then(function (response) {
      utils.writeJson(res, response);
    })
    .catch(function (response) {
      utils.writeJson(res, response);
    });
};
