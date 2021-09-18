'use strict';


/**
 * List Invites
 * List of Vouched Now invites.
 *
 * id String The invite id. (optional)
 * page Integer Paginate list by page. (optional)
 * pageSize Integer The number of items for a page. (optional)
 * returns inline_response_200_3
 **/
exports.listInvites = function(id,page,pageSize) {
  return new Promise(function(resolve, reject) {
    var examples = {};
    examples['application/json'] = {
  "total" : 5,
  "totalPages" : 0,
  "pageSize" : 6,
  "invite" : [ {
    "lastName" : "lastName",
    "url" : "url",
    "jobId" : "jobId",
    "firstName" : "firstName",
    "createdAt" : "2019-09-07T15:50-04:00",
    "qrCode" : "qrCode",
    "phone" : "000-111-2222",
    "contact" : "contact",
    "callbackURL" : "callbackURL",
    "id" : "id",
    "send" : true,
    "email" : "email",
    "updatedAt" : "2019-09-07T15:50-04:00",
    "status" : "accepted"
  }, {
    "lastName" : "lastName",
    "url" : "url",
    "jobId" : "jobId",
    "firstName" : "firstName",
    "createdAt" : "2019-09-07T15:50-04:00",
    "qrCode" : "qrCode",
    "phone" : "000-111-2222",
    "contact" : "contact",
    "callbackURL" : "callbackURL",
    "id" : "id",
    "send" : true,
    "email" : "email",
    "updatedAt" : "2019-09-07T15:50-04:00",
    "status" : "accepted"
  } ],
  "page" : 1
};
    if (Object.keys(examples).length > 0) {
      resolve(examples[Object.keys(examples)[0]]);
    } else {
      resolve();
    }
  });
}


/**
 * Resend Invite
 * Resend Vouched Now invite.
 *
 * id String The invite id.
 * returns inline_response_200_2
 **/
exports.resendInvites = function(id) {
  return new Promise(function(resolve, reject) {
    var examples = {};
    examples['application/json'] = {
  "invite" : {
    "lastName" : "lastName",
    "url" : "url",
    "jobId" : "jobId",
    "firstName" : "firstName",
    "createdAt" : "2019-09-07T15:50-04:00",
    "qrCode" : "qrCode",
    "phone" : "000-111-2222",
    "contact" : "contact",
    "callbackURL" : "callbackURL",
    "id" : "id",
    "send" : true,
    "email" : "email",
    "updatedAt" : "2019-09-07T15:50-04:00",
    "status" : "accepted"
  }
};
    if (Object.keys(examples).length > 0) {
      resolve(examples[Object.keys(examples)[0]]);
    } else {
      resolve();
    }
  });
}


/**
 * Send Invite
 * Send Vouched Now invite.
 *
 * body Body_2  (optional)
 * returns inline_response_200_2
 **/
exports.sendInvites = function(body) {
  return new Promise(function(resolve, reject) {
    var examples = {};
    examples['application/json'] = {
  "invite" : {
    "lastName" : "lastName",
    "url" : "url",
    "jobId" : "jobId",
    "firstName" : "firstName",
    "createdAt" : "2019-09-07T15:50-04:00",
    "qrCode" : "qrCode",
    "phone" : "000-111-2222",
    "contact" : "contact",
    "callbackURL" : "callbackURL",
    "id" : "id",
    "send" : true,
    "email" : "email",
    "updatedAt" : "2019-09-07T15:50-04:00",
    "status" : "accepted"
  }
};
    if (Object.keys(examples).length > 0) {
      resolve(examples[Object.keys(examples)[0]]);
    } else {
      resolve();
    }
  });
}

