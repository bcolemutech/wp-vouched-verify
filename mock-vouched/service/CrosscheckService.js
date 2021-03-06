'use strict';


/**
 * Submit Identity CrossCheck
 * Provides a crosscheck of matching identities based on provided name, email, phone number, address, and IP address. The crosscheck is performed across a network of enriched data sources.
 *
 * body Crosscheck_request  (optional)
 * returns identity_crosscheck-2
 **/
exports.crossCheck = function(body) {
  return new Promise(function(resolve, reject) {
    var examples = {};
    examples['application/json'] = {
  "result" : {
    "address" : {
      "ageRange" : {
        "from" : 5,
        "to" : 2
      },
      "warnings" : [ null, null ],
      "isValid" : true,
      "isCommercial" : true,
      "name" : "name",
      "type" : "incomplete-address",
      "isMatch" : true,
      "errors" : [ {
        "warnings" : true,
        "suggestion" : "John Smith",
        "type" : "type",
        "message" : "message"
      }, {
        "warnings" : true,
        "suggestion" : "John Smith",
        "type" : "type",
        "message" : "message"
      } ],
      "isForwarder" : true
    },
    "darkWeb" : {
      "criminalMaxScore" : 2,
      "criminalCount" : 2,
      "criminalLastSeen" : "criminalLastSeen"
    },
    "phone" : {
      "carrier" : "carrier",
      "isPrepaid" : true,
      "isDisposable" : true,
      "warnings" : [ null, null ],
      "isValid" : true,
      "isCommercial" : true,
      "name" : "name",
      "type" : "fixed-voip",
      "isMatch" : true,
      "errors" : [ null, null ]
    },
    "confidences" : {
      "activity" : 1,
      "identity" : 0
    },
    "ipAddress" : {
      "country" : "country",
      "isAnonymous" : true,
      "city" : "city",
      "postalCode" : "postalCode",
      "isp" : "isp",
      "organization" : "organization",
      "isAnonymousHosting" : true,
      "isAnonymousVpn" : true,
      "location" : {
        "latitude" : 9,
        "longitude" : 3
      },
      "state" : "state",
      "userType" : "business - the IP address belongs to a business ISP or a corporation."
    },
    "email" : {
      "isDisposable" : true,
      "warnings" : [ null, null ],
      "isValid" : true,
      "daysFirstSeen" : 7,
      "name" : "name",
      "isMatch" : true,
      "isAutoGenerated" : true,
      "errors" : [ null, null ]
    }
  },
  "request" : {
    "firstName" : "firstName",
    "lastName" : "lastName",
    "darkWeb" : true,
    "address" : {
      "country" : "country",
      "unit" : "unit",
      "streetAddress" : "streetAddress",
      "city" : "city",
      "postalCode" : "postalCode",
      "state" : "state"
    },
    "phone" : "000-111-2222",
    "ipAddress" : "ipAddress",
    "email" : "email"
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

