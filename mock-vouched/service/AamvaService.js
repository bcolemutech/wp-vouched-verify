'use strict';


/**
 * Submit Aamva Job
 * Creates a standalone aamva job based on provided user details. License Number, country, state are mandatory fields. The result of the job will be posted to the endpoint specified by `callbackURL`. The schema of the post data to the `callbackURL` can be viewed [AAMVA request](/#operation/submitAamva)
 *
 * body Body_1  (optional)
 * returns inline_response_200_1
 **/
exports.submitAamva = function(body) {
  return new Promise(function(resolve, reject) {
    var examples = {};
    examples['application/json'] = {
  "result" : {
    "job_type" : "id-aamva",
    "job_status" : "active",
    "aamva_status" : "Pending"
  },
  "request" : {
    "country" : "country",
    "lastName" : "lastName",
    "idType" : "idType",
    "dob" : "09/18/1992",
    "licenseNumber" : "licenseNumber",
    "callbackURL" : "callbackURL",
    "state" : "state",
    "issueDate" : "issueDate",
    "expirationDate" : "expirationDate"
  },
  "id" : "id"
};
    if (Object.keys(examples).length > 0) {
      resolve(examples[Object.keys(examples)[0]]);
    } else {
      resolve();
    }
  });
}

