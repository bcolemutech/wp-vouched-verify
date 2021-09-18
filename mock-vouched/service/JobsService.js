'use strict';


/**
 * Authenticate Job
 * Authenticate by performing face match between a verified selfie and a new selfie.
 *
 * body Authenticate_inputs  (optional)
 * returns inline_response_200_5
 **/
exports.authenticateJob = function(body) {
  return new Promise(function(resolve, reject) {
    var examples = {};
    examples['application/json'] = {
  "match" : 0
};
    if (Object.keys(examples).length > 0) {
      resolve(examples[Object.keys(examples)[0]]);
    } else {
      resolve();
    }
  });
}


/**
 * Remove job
 * Delete a job.
 *
 * id String The job ID.
 * returns response_1-2
 **/
exports.deleteJob = function(id) {
  return new Promise(function(resolve, reject) {
    var examples = {};
    examples['application/json'] = {
  "request" : {
    "callbackURL" : "callbackURL",
    "requestInfo" : {
      "ipaddress" : "ipaddress",
      "referer" : "referer",
      "useragent" : "useragent"
    },
    "type" : "drivers-license",
    "parameters" : {
      "lastName" : "lastName",
      "userPhoto" : "userPhoto",
      "backIdPhoto" : "backIdPhoto",
      "userPhotoUrl" : "userPhotoUrl",
      "userPhotoDetect" : "userPhotoDetect",
      "firstName" : "firstName",
      "phone" : "000-111-2222",
      "backIdPhotoUrl" : "backIdPhotoUrl",
      "dob" : "08/23/1991",
      "idPhotoUrl" : "idPhotoUrl",
      "idPhotoDetectUrl" : "idPhotoDetectUrl",
      "userPhotoDetectUrl" : "userPhotoDetectUrl",
      "idPhoto" : "idPhoto",
      "idPhotoDetectDimensions" : {
        "width" : 6,
        "height" : 1
      },
      "idPhotoDetect" : "idPhotoDetect",
      "email" : "email"
    }
  },
  "surveyMessage" : "surveyMessage",
  "reviewAt" : "2019-09-07T15:50-04:00",
  "completed" : true,
  "surveyPoll" : 1,
  "result" : {
    "idFields" : [ {
      "name" : "name"
    }, {
      "name" : "name"
    } ],
    "country" : "country",
    "ipFraudCheck" : {
      "ipFraud" : true,
      "jobIdList" : [ "jobIdList", "jobIdList" ],
      "count" : 5
    },
    "lastName" : "lastName",
    "gender" : {
      "genderDistribution" : "genderDistribution",
      "gender" : "man"
    },
    "type" : "type",
    "idAddress" : {
      "country" : "country",
      "unit" : "unit",
      "streetNumber" : "streetNumber",
      "city" : "city",
      "street" : "street",
      "postalCode" : "postalCode",
      "state" : "state",
      "postalCodeSuffix" : "postalCodeSuffix"
    },
    "motorcycle" : "motorcycle",
    "idWatchlist" : {
      "data" : [ {
        "attributes" : {
          "score" : "score",
          "country_territory_name" : "country_territory_name",
          "gender" : "gender",
          "date_of_birth" : [ {
            "month" : "month",
            "year" : "year",
            "day" : "day"
          }, {
            "month" : "month",
            "year" : "year",
            "day" : "day"
          } ],
          "primary_name" : "primary_name",
          "icon_hints" : [ "icon_hints", "icon_hints" ],
          "type" : "type",
          "title" : "title",
          "countries_territories" : [ {
            "iso_alpha2" : "iso_alpha2",
            "code" : "code",
            "iso_alpha3" : "iso_alpha3",
            "type" : "type"
          }, {
            "iso_alpha2" : "iso_alpha2",
            "code" : "code",
            "iso_alpha3" : "iso_alpha3",
            "type" : "type"
          } ],
          "country_territory_code" : "country_territory_code",
          "is_subsidiary" : true
        },
        "id" : "id",
        "type" : "type"
      }, {
        "attributes" : {
          "score" : "score",
          "country_territory_name" : "country_territory_name",
          "gender" : "gender",
          "date_of_birth" : [ {
            "month" : "month",
            "year" : "year",
            "day" : "day"
          }, {
            "month" : "month",
            "year" : "year",
            "day" : "day"
          } ],
          "primary_name" : "primary_name",
          "icon_hints" : [ "icon_hints", "icon_hints" ],
          "type" : "type",
          "title" : "title",
          "countries_territories" : [ {
            "iso_alpha2" : "iso_alpha2",
            "code" : "code",
            "iso_alpha3" : "iso_alpha3",
            "type" : "type"
          }, {
            "iso_alpha2" : "iso_alpha2",
            "code" : "code",
            "iso_alpha3" : "iso_alpha3",
            "type" : "type"
          } ],
          "country_territory_code" : "country_territory_code",
          "is_subsidiary" : true
        },
        "id" : "id",
        "type" : "type"
      } ],
      "confidence" : {
        "normalized" : true
      }
    },
    "confidences" : {
      "selfieSunglasses" : 0,
      "idQuality" : 0,
      "birthDateMatch" : 0,
      "selfie" : 0,
      "idMatch" : 0,
      "idGlareQuality" : 0,
      "selfieEyeglasses" : 0,
      "id" : 0,
      "faceMatch" : 0,
      "idExpired" : 0,
      "nameMatch" : 0
    },
    "crosscheck" : {
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
    "expireDate" : "expireDate",
    "state" : "state",
    "id" : "id",
    "issueDate" : "issueDate",
    "class" : "class",
    "unverifiedIdAddress" : [ "unverifiedIdAddress", "unverifiedIdAddress" ],
    "idType" : "idType",
    "warnings" : true,
    "birthDate" : "birthDate",
    "firstName" : "firstName",
    "success" : true,
    "endorsements" : "endorsements",
    "middleName" : "middleName",
    "aamva" : {
      "createdAt" : "createdAt",
      "completedAt" : "completedAt",
      "hasErrors" : true,
      "hasWarnings" : true,
      "enabled" : true,
      "statusMessage" : "statusMessage",
      "updatedAt" : "updatedAt",
      "status" : "Pending"
    }
  },
  "submitted" : "2019-09-07T15:50-04:00",
  "signals" : [ {
    "property" : "private",
    "category" : "faceMatch",
    "message" : "message",
    "type" : "quality",
    "fields" : ""
  }, {
    "property" : "private",
    "category" : "faceMatch",
    "message" : "message",
    "type" : "quality",
    "fields" : ""
  } ],
  "review" : { },
  "reviewSuccess" : true,
  "surveyAt" : "2019-09-07T15:50-04:00",
  "id" : "id",
  "errors" : [ {
    "suggestion" : "John Smith",
    "warning" : true,
    "type" : "InvalidRequestError",
    "message" : "message"
  }, {
    "suggestion" : "John Smith",
    "warning" : true,
    "type" : "InvalidRequestError",
    "message" : "message"
  } ],
  "status" : "active",
  "updatedAt" : "2019-09-07T15:50-04:00"
};
    if (Object.keys(examples).length > 0) {
      resolve(examples[Object.keys(examples)[0]]);
    } else {
      resolve();
    }
  });
}


/**
 * Download Job PDF
 * Download a pdf representation of the job.
 *
 * id String The job ID.
 * confidences Boolean Include Confidence Scores in the PDF. (optional)
 * returns inline_response_200
 **/
exports.downloadJobPDF = function(id,confidences) {
  return new Promise(function(resolve, reject) {
    var examples = {};
    examples['application/json'] = {
  "pdf" : "pdf",
  "confidences" : true,
  "id" : "id"
};
    if (Object.keys(examples).length > 0) {
      resolve(examples[Object.keys(examples)[0]]);
    } else {
      resolve();
    }
  });
}


/**
 * Find jobs
 * Return paginated jobs
 *
 * id String Filter by job ID. (optional)
 * type String Type of job. (optional)
 * ids String Filter by a list of job IDs. (optional)
 * token String The time limited session token from the web client. (optional)
 * page Integer Paginate list by page. (optional)
 * pageSize Integer The number of items for a page. (optional)
 * sortBy String Selection to sort list from. (optional)
 * sortOrder String Order the sort. (optional)
 * status String Filter by status. (optional)
 * from String Filter by submitted/updatedAt from the [ISO8601 date](https://en.wikipedia.org/wiki/ISO_8601). (optional)
 * to String Filter by submitted/updatedAt to the [ISO8601 date](https://en.wikipedia.org/wiki/ISO_8601). (optional)
 * toFrom String Filter to and from. (optional)
 * withPhotos Boolean Job will contain idPhoto and userPhoto photos. (optional)
 * withPhotoUrls Boolean Job will contain idPhotoUrl and userPhotoUrl signed. (optional)
 * returns result_jobs
 **/
exports.findJobs = function(id,type,ids,token,page,pageSize,sortBy,sortOrder,status,from,to,toFrom,withPhotos,withPhotoUrls) {
  return new Promise(function(resolve, reject) {
    var examples = {};
    examples['application/json'] = {
  "total" : 0,
  "totalPages" : 0,
  "pageSize" : 1,
  "page" : 1,
  "items" : [ {
    "request" : {
      "callbackURL" : "callbackURL",
      "requestInfo" : {
        "ipaddress" : "ipaddress",
        "referer" : "referer",
        "useragent" : "useragent"
      },
      "type" : "drivers-license",
      "parameters" : {
        "lastName" : "lastName",
        "userPhoto" : "userPhoto",
        "backIdPhoto" : "backIdPhoto",
        "userPhotoUrl" : "userPhotoUrl",
        "userPhotoDetect" : "userPhotoDetect",
        "firstName" : "firstName",
        "phone" : "000-111-2222",
        "backIdPhotoUrl" : "backIdPhotoUrl",
        "dob" : "08/23/1991",
        "idPhotoUrl" : "idPhotoUrl",
        "idPhotoDetectUrl" : "idPhotoDetectUrl",
        "userPhotoDetectUrl" : "userPhotoDetectUrl",
        "idPhoto" : "idPhoto",
        "idPhotoDetectDimensions" : {
          "width" : 6,
          "height" : 1
        },
        "idPhotoDetect" : "idPhotoDetect",
        "email" : "email"
      }
    },
    "surveyMessage" : "surveyMessage",
    "reviewAt" : "2019-09-07T15:50-04:00",
    "completed" : true,
    "surveyPoll" : 1,
    "result" : {
      "idFields" : [ {
        "name" : "name"
      }, {
        "name" : "name"
      } ],
      "country" : "country",
      "ipFraudCheck" : {
        "ipFraud" : true,
        "jobIdList" : [ "jobIdList", "jobIdList" ],
        "count" : 5
      },
      "lastName" : "lastName",
      "gender" : {
        "genderDistribution" : "genderDistribution",
        "gender" : "man"
      },
      "type" : "type",
      "idAddress" : {
        "country" : "country",
        "unit" : "unit",
        "streetNumber" : "streetNumber",
        "city" : "city",
        "street" : "street",
        "postalCode" : "postalCode",
        "state" : "state",
        "postalCodeSuffix" : "postalCodeSuffix"
      },
      "motorcycle" : "motorcycle",
      "idWatchlist" : {
        "data" : [ {
          "attributes" : {
            "score" : "score",
            "country_territory_name" : "country_territory_name",
            "gender" : "gender",
            "date_of_birth" : [ {
              "month" : "month",
              "year" : "year",
              "day" : "day"
            }, {
              "month" : "month",
              "year" : "year",
              "day" : "day"
            } ],
            "primary_name" : "primary_name",
            "icon_hints" : [ "icon_hints", "icon_hints" ],
            "type" : "type",
            "title" : "title",
            "countries_territories" : [ {
              "iso_alpha2" : "iso_alpha2",
              "code" : "code",
              "iso_alpha3" : "iso_alpha3",
              "type" : "type"
            }, {
              "iso_alpha2" : "iso_alpha2",
              "code" : "code",
              "iso_alpha3" : "iso_alpha3",
              "type" : "type"
            } ],
            "country_territory_code" : "country_territory_code",
            "is_subsidiary" : true
          },
          "id" : "id",
          "type" : "type"
        }, {
          "attributes" : {
            "score" : "score",
            "country_territory_name" : "country_territory_name",
            "gender" : "gender",
            "date_of_birth" : [ {
              "month" : "month",
              "year" : "year",
              "day" : "day"
            }, {
              "month" : "month",
              "year" : "year",
              "day" : "day"
            } ],
            "primary_name" : "primary_name",
            "icon_hints" : [ "icon_hints", "icon_hints" ],
            "type" : "type",
            "title" : "title",
            "countries_territories" : [ {
              "iso_alpha2" : "iso_alpha2",
              "code" : "code",
              "iso_alpha3" : "iso_alpha3",
              "type" : "type"
            }, {
              "iso_alpha2" : "iso_alpha2",
              "code" : "code",
              "iso_alpha3" : "iso_alpha3",
              "type" : "type"
            } ],
            "country_territory_code" : "country_territory_code",
            "is_subsidiary" : true
          },
          "id" : "id",
          "type" : "type"
        } ],
        "confidence" : {
          "normalized" : true
        }
      },
      "confidences" : {
        "selfieSunglasses" : 0,
        "idQuality" : 0,
        "birthDateMatch" : 0,
        "selfie" : 0,
        "idMatch" : 0,
        "idGlareQuality" : 0,
        "selfieEyeglasses" : 0,
        "id" : 0,
        "faceMatch" : 0,
        "idExpired" : 0,
        "nameMatch" : 0
      },
      "crosscheck" : {
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
      "expireDate" : "expireDate",
      "state" : "state",
      "id" : "id",
      "issueDate" : "issueDate",
      "class" : "class",
      "unverifiedIdAddress" : [ "unverifiedIdAddress", "unverifiedIdAddress" ],
      "idType" : "idType",
      "warnings" : true,
      "birthDate" : "birthDate",
      "firstName" : "firstName",
      "success" : true,
      "endorsements" : "endorsements",
      "middleName" : "middleName",
      "aamva" : {
        "createdAt" : "createdAt",
        "completedAt" : "completedAt",
        "hasErrors" : true,
        "hasWarnings" : true,
        "enabled" : true,
        "statusMessage" : "statusMessage",
        "updatedAt" : "updatedAt",
        "status" : "Pending"
      }
    },
    "submitted" : "2019-09-07T15:50-04:00",
    "signals" : [ {
      "property" : "private",
      "category" : "faceMatch",
      "message" : "message",
      "type" : "quality",
      "fields" : ""
    }, {
      "property" : "private",
      "category" : "faceMatch",
      "message" : "message",
      "type" : "quality",
      "fields" : ""
    } ],
    "review" : { },
    "reviewSuccess" : true,
    "surveyAt" : "2019-09-07T15:50-04:00",
    "id" : "id",
    "errors" : [ {
      "suggestion" : "John Smith",
      "warning" : true,
      "type" : "InvalidRequestError",
      "message" : "message"
    }, {
      "suggestion" : "John Smith",
      "warning" : true,
      "type" : "InvalidRequestError",
      "message" : "message"
    } ],
    "status" : "active",
    "updatedAt" : "2019-09-07T15:50-04:00"
  }, {
    "request" : {
      "callbackURL" : "callbackURL",
      "requestInfo" : {
        "ipaddress" : "ipaddress",
        "referer" : "referer",
        "useragent" : "useragent"
      },
      "type" : "drivers-license",
      "parameters" : {
        "lastName" : "lastName",
        "userPhoto" : "userPhoto",
        "backIdPhoto" : "backIdPhoto",
        "userPhotoUrl" : "userPhotoUrl",
        "userPhotoDetect" : "userPhotoDetect",
        "firstName" : "firstName",
        "phone" : "000-111-2222",
        "backIdPhotoUrl" : "backIdPhotoUrl",
        "dob" : "08/23/1991",
        "idPhotoUrl" : "idPhotoUrl",
        "idPhotoDetectUrl" : "idPhotoDetectUrl",
        "userPhotoDetectUrl" : "userPhotoDetectUrl",
        "idPhoto" : "idPhoto",
        "idPhotoDetectDimensions" : {
          "width" : 6,
          "height" : 1
        },
        "idPhotoDetect" : "idPhotoDetect",
        "email" : "email"
      }
    },
    "surveyMessage" : "surveyMessage",
    "reviewAt" : "2019-09-07T15:50-04:00",
    "completed" : true,
    "surveyPoll" : 1,
    "result" : {
      "idFields" : [ {
        "name" : "name"
      }, {
        "name" : "name"
      } ],
      "country" : "country",
      "ipFraudCheck" : {
        "ipFraud" : true,
        "jobIdList" : [ "jobIdList", "jobIdList" ],
        "count" : 5
      },
      "lastName" : "lastName",
      "gender" : {
        "genderDistribution" : "genderDistribution",
        "gender" : "man"
      },
      "type" : "type",
      "idAddress" : {
        "country" : "country",
        "unit" : "unit",
        "streetNumber" : "streetNumber",
        "city" : "city",
        "street" : "street",
        "postalCode" : "postalCode",
        "state" : "state",
        "postalCodeSuffix" : "postalCodeSuffix"
      },
      "motorcycle" : "motorcycle",
      "idWatchlist" : {
        "data" : [ {
          "attributes" : {
            "score" : "score",
            "country_territory_name" : "country_territory_name",
            "gender" : "gender",
            "date_of_birth" : [ {
              "month" : "month",
              "year" : "year",
              "day" : "day"
            }, {
              "month" : "month",
              "year" : "year",
              "day" : "day"
            } ],
            "primary_name" : "primary_name",
            "icon_hints" : [ "icon_hints", "icon_hints" ],
            "type" : "type",
            "title" : "title",
            "countries_territories" : [ {
              "iso_alpha2" : "iso_alpha2",
              "code" : "code",
              "iso_alpha3" : "iso_alpha3",
              "type" : "type"
            }, {
              "iso_alpha2" : "iso_alpha2",
              "code" : "code",
              "iso_alpha3" : "iso_alpha3",
              "type" : "type"
            } ],
            "country_territory_code" : "country_territory_code",
            "is_subsidiary" : true
          },
          "id" : "id",
          "type" : "type"
        }, {
          "attributes" : {
            "score" : "score",
            "country_territory_name" : "country_territory_name",
            "gender" : "gender",
            "date_of_birth" : [ {
              "month" : "month",
              "year" : "year",
              "day" : "day"
            }, {
              "month" : "month",
              "year" : "year",
              "day" : "day"
            } ],
            "primary_name" : "primary_name",
            "icon_hints" : [ "icon_hints", "icon_hints" ],
            "type" : "type",
            "title" : "title",
            "countries_territories" : [ {
              "iso_alpha2" : "iso_alpha2",
              "code" : "code",
              "iso_alpha3" : "iso_alpha3",
              "type" : "type"
            }, {
              "iso_alpha2" : "iso_alpha2",
              "code" : "code",
              "iso_alpha3" : "iso_alpha3",
              "type" : "type"
            } ],
            "country_territory_code" : "country_territory_code",
            "is_subsidiary" : true
          },
          "id" : "id",
          "type" : "type"
        } ],
        "confidence" : {
          "normalized" : true
        }
      },
      "confidences" : {
        "selfieSunglasses" : 0,
        "idQuality" : 0,
        "birthDateMatch" : 0,
        "selfie" : 0,
        "idMatch" : 0,
        "idGlareQuality" : 0,
        "selfieEyeglasses" : 0,
        "id" : 0,
        "faceMatch" : 0,
        "idExpired" : 0,
        "nameMatch" : 0
      },
      "crosscheck" : {
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
      "expireDate" : "expireDate",
      "state" : "state",
      "id" : "id",
      "issueDate" : "issueDate",
      "class" : "class",
      "unverifiedIdAddress" : [ "unverifiedIdAddress", "unverifiedIdAddress" ],
      "idType" : "idType",
      "warnings" : true,
      "birthDate" : "birthDate",
      "firstName" : "firstName",
      "success" : true,
      "endorsements" : "endorsements",
      "middleName" : "middleName",
      "aamva" : {
        "createdAt" : "createdAt",
        "completedAt" : "completedAt",
        "hasErrors" : true,
        "hasWarnings" : true,
        "enabled" : true,
        "statusMessage" : "statusMessage",
        "updatedAt" : "updatedAt",
        "status" : "Pending"
      }
    },
    "submitted" : "2019-09-07T15:50-04:00",
    "signals" : [ {
      "property" : "private",
      "category" : "faceMatch",
      "message" : "message",
      "type" : "quality",
      "fields" : ""
    }, {
      "property" : "private",
      "category" : "faceMatch",
      "message" : "message",
      "type" : "quality",
      "fields" : ""
    } ],
    "review" : { },
    "reviewSuccess" : true,
    "surveyAt" : "2019-09-07T15:50-04:00",
    "id" : "id",
    "errors" : [ {
      "suggestion" : "John Smith",
      "warning" : true,
      "type" : "InvalidRequestError",
      "message" : "message"
    }, {
      "suggestion" : "John Smith",
      "warning" : true,
      "type" : "InvalidRequestError",
      "message" : "message"
    } ],
    "status" : "active",
    "updatedAt" : "2019-09-07T15:50-04:00"
  } ]
};
    if (Object.keys(examples).length > 0) {
      resolve(examples[Object.keys(examples)[0]]);
    } else {
      resolve();
    }
  });
}


/**
 * Get Supported ID Documents
 * Get a list of supported id documents.
 *
 * returns inline_response_200_4
 **/
exports.getDocs = function() {
  return new Promise(function(resolve, reject) {
    var examples = {};
    examples['application/json'] = {
  "documents" : {
    "country" : "country",
    "state" : "state",
    "type" : "type",
    "properties" : ""
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
 * Submit job
 * Submit a verification job.
 *
 * body Body_4  (optional)
 * returns response_1-2
 **/
exports.submitJob = function(body) {
  return new Promise(function(resolve, reject) {
    var examples = {};
    examples['application/json'] = {
  "request" : {
    "callbackURL" : "callbackURL",
    "requestInfo" : {
      "ipaddress" : "ipaddress",
      "referer" : "referer",
      "useragent" : "useragent"
    },
    "type" : "drivers-license",
    "parameters" : {
      "lastName" : "lastName",
      "userPhoto" : "userPhoto",
      "backIdPhoto" : "backIdPhoto",
      "userPhotoUrl" : "userPhotoUrl",
      "userPhotoDetect" : "userPhotoDetect",
      "firstName" : "firstName",
      "phone" : "000-111-2222",
      "backIdPhotoUrl" : "backIdPhotoUrl",
      "dob" : "08/23/1991",
      "idPhotoUrl" : "idPhotoUrl",
      "idPhotoDetectUrl" : "idPhotoDetectUrl",
      "userPhotoDetectUrl" : "userPhotoDetectUrl",
      "idPhoto" : "idPhoto",
      "idPhotoDetectDimensions" : {
        "width" : 6,
        "height" : 1
      },
      "idPhotoDetect" : "idPhotoDetect",
      "email" : "email"
    }
  },
  "surveyMessage" : "surveyMessage",
  "reviewAt" : "2019-09-07T15:50-04:00",
  "completed" : true,
  "surveyPoll" : 1,
  "result" : {
    "idFields" : [ {
      "name" : "name"
    }, {
      "name" : "name"
    } ],
    "country" : "country",
    "ipFraudCheck" : {
      "ipFraud" : true,
      "jobIdList" : [ "jobIdList", "jobIdList" ],
      "count" : 5
    },
    "lastName" : "lastName",
    "gender" : {
      "genderDistribution" : "genderDistribution",
      "gender" : "man"
    },
    "type" : "type",
    "idAddress" : {
      "country" : "country",
      "unit" : "unit",
      "streetNumber" : "streetNumber",
      "city" : "city",
      "street" : "street",
      "postalCode" : "postalCode",
      "state" : "state",
      "postalCodeSuffix" : "postalCodeSuffix"
    },
    "motorcycle" : "motorcycle",
    "idWatchlist" : {
      "data" : [ {
        "attributes" : {
          "score" : "score",
          "country_territory_name" : "country_territory_name",
          "gender" : "gender",
          "date_of_birth" : [ {
            "month" : "month",
            "year" : "year",
            "day" : "day"
          }, {
            "month" : "month",
            "year" : "year",
            "day" : "day"
          } ],
          "primary_name" : "primary_name",
          "icon_hints" : [ "icon_hints", "icon_hints" ],
          "type" : "type",
          "title" : "title",
          "countries_territories" : [ {
            "iso_alpha2" : "iso_alpha2",
            "code" : "code",
            "iso_alpha3" : "iso_alpha3",
            "type" : "type"
          }, {
            "iso_alpha2" : "iso_alpha2",
            "code" : "code",
            "iso_alpha3" : "iso_alpha3",
            "type" : "type"
          } ],
          "country_territory_code" : "country_territory_code",
          "is_subsidiary" : true
        },
        "id" : "id",
        "type" : "type"
      }, {
        "attributes" : {
          "score" : "score",
          "country_territory_name" : "country_territory_name",
          "gender" : "gender",
          "date_of_birth" : [ {
            "month" : "month",
            "year" : "year",
            "day" : "day"
          }, {
            "month" : "month",
            "year" : "year",
            "day" : "day"
          } ],
          "primary_name" : "primary_name",
          "icon_hints" : [ "icon_hints", "icon_hints" ],
          "type" : "type",
          "title" : "title",
          "countries_territories" : [ {
            "iso_alpha2" : "iso_alpha2",
            "code" : "code",
            "iso_alpha3" : "iso_alpha3",
            "type" : "type"
          }, {
            "iso_alpha2" : "iso_alpha2",
            "code" : "code",
            "iso_alpha3" : "iso_alpha3",
            "type" : "type"
          } ],
          "country_territory_code" : "country_territory_code",
          "is_subsidiary" : true
        },
        "id" : "id",
        "type" : "type"
      } ],
      "confidence" : {
        "normalized" : true
      }
    },
    "confidences" : {
      "selfieSunglasses" : 0,
      "idQuality" : 0,
      "birthDateMatch" : 0,
      "selfie" : 0,
      "idMatch" : 0,
      "idGlareQuality" : 0,
      "selfieEyeglasses" : 0,
      "id" : 0,
      "faceMatch" : 0,
      "idExpired" : 0,
      "nameMatch" : 0
    },
    "crosscheck" : {
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
    "expireDate" : "expireDate",
    "state" : "state",
    "id" : "id",
    "issueDate" : "issueDate",
    "class" : "class",
    "unverifiedIdAddress" : [ "unverifiedIdAddress", "unverifiedIdAddress" ],
    "idType" : "idType",
    "warnings" : true,
    "birthDate" : "birthDate",
    "firstName" : "firstName",
    "success" : true,
    "endorsements" : "endorsements",
    "middleName" : "middleName",
    "aamva" : {
      "createdAt" : "createdAt",
      "completedAt" : "completedAt",
      "hasErrors" : true,
      "hasWarnings" : true,
      "enabled" : true,
      "statusMessage" : "statusMessage",
      "updatedAt" : "updatedAt",
      "status" : "Pending"
    }
  },
  "submitted" : "2019-09-07T15:50-04:00",
  "signals" : [ {
    "property" : "private",
    "category" : "faceMatch",
    "message" : "message",
    "type" : "quality",
    "fields" : ""
  }, {
    "property" : "private",
    "category" : "faceMatch",
    "message" : "message",
    "type" : "quality",
    "fields" : ""
  } ],
  "review" : { },
  "reviewSuccess" : true,
  "surveyAt" : "2019-09-07T15:50-04:00",
  "id" : "id",
  "errors" : [ {
    "suggestion" : "John Smith",
    "warning" : true,
    "type" : "InvalidRequestError",
    "message" : "message"
  }, {
    "suggestion" : "John Smith",
    "warning" : true,
    "type" : "InvalidRequestError",
    "message" : "message"
  } ],
  "status" : "active",
  "updatedAt" : "2019-09-07T15:50-04:00"
};
    if (Object.keys(examples).length > 0) {
      resolve(examples[Object.keys(examples)[0]]);
    } else {
      resolve();
    }
  });
}


/**
 * Update Review
 * Update Job with Verified Results
 *
 * body Updatejob_inputs  (optional)
 * id String The job ID.
 * returns response_1-2
 **/
exports.updateJob = function(body,id) {
  return new Promise(function(resolve, reject) {
    var examples = {};
    examples['application/json'] = {
  "request" : {
    "callbackURL" : "callbackURL",
    "requestInfo" : {
      "ipaddress" : "ipaddress",
      "referer" : "referer",
      "useragent" : "useragent"
    },
    "type" : "drivers-license",
    "parameters" : {
      "lastName" : "lastName",
      "userPhoto" : "userPhoto",
      "backIdPhoto" : "backIdPhoto",
      "userPhotoUrl" : "userPhotoUrl",
      "userPhotoDetect" : "userPhotoDetect",
      "firstName" : "firstName",
      "phone" : "000-111-2222",
      "backIdPhotoUrl" : "backIdPhotoUrl",
      "dob" : "08/23/1991",
      "idPhotoUrl" : "idPhotoUrl",
      "idPhotoDetectUrl" : "idPhotoDetectUrl",
      "userPhotoDetectUrl" : "userPhotoDetectUrl",
      "idPhoto" : "idPhoto",
      "idPhotoDetectDimensions" : {
        "width" : 6,
        "height" : 1
      },
      "idPhotoDetect" : "idPhotoDetect",
      "email" : "email"
    }
  },
  "surveyMessage" : "surveyMessage",
  "reviewAt" : "2019-09-07T15:50-04:00",
  "completed" : true,
  "surveyPoll" : 1,
  "result" : {
    "idFields" : [ {
      "name" : "name"
    }, {
      "name" : "name"
    } ],
    "country" : "country",
    "ipFraudCheck" : {
      "ipFraud" : true,
      "jobIdList" : [ "jobIdList", "jobIdList" ],
      "count" : 5
    },
    "lastName" : "lastName",
    "gender" : {
      "genderDistribution" : "genderDistribution",
      "gender" : "man"
    },
    "type" : "type",
    "idAddress" : {
      "country" : "country",
      "unit" : "unit",
      "streetNumber" : "streetNumber",
      "city" : "city",
      "street" : "street",
      "postalCode" : "postalCode",
      "state" : "state",
      "postalCodeSuffix" : "postalCodeSuffix"
    },
    "motorcycle" : "motorcycle",
    "idWatchlist" : {
      "data" : [ {
        "attributes" : {
          "score" : "score",
          "country_territory_name" : "country_territory_name",
          "gender" : "gender",
          "date_of_birth" : [ {
            "month" : "month",
            "year" : "year",
            "day" : "day"
          }, {
            "month" : "month",
            "year" : "year",
            "day" : "day"
          } ],
          "primary_name" : "primary_name",
          "icon_hints" : [ "icon_hints", "icon_hints" ],
          "type" : "type",
          "title" : "title",
          "countries_territories" : [ {
            "iso_alpha2" : "iso_alpha2",
            "code" : "code",
            "iso_alpha3" : "iso_alpha3",
            "type" : "type"
          }, {
            "iso_alpha2" : "iso_alpha2",
            "code" : "code",
            "iso_alpha3" : "iso_alpha3",
            "type" : "type"
          } ],
          "country_territory_code" : "country_territory_code",
          "is_subsidiary" : true
        },
        "id" : "id",
        "type" : "type"
      }, {
        "attributes" : {
          "score" : "score",
          "country_territory_name" : "country_territory_name",
          "gender" : "gender",
          "date_of_birth" : [ {
            "month" : "month",
            "year" : "year",
            "day" : "day"
          }, {
            "month" : "month",
            "year" : "year",
            "day" : "day"
          } ],
          "primary_name" : "primary_name",
          "icon_hints" : [ "icon_hints", "icon_hints" ],
          "type" : "type",
          "title" : "title",
          "countries_territories" : [ {
            "iso_alpha2" : "iso_alpha2",
            "code" : "code",
            "iso_alpha3" : "iso_alpha3",
            "type" : "type"
          }, {
            "iso_alpha2" : "iso_alpha2",
            "code" : "code",
            "iso_alpha3" : "iso_alpha3",
            "type" : "type"
          } ],
          "country_territory_code" : "country_territory_code",
          "is_subsidiary" : true
        },
        "id" : "id",
        "type" : "type"
      } ],
      "confidence" : {
        "normalized" : true
      }
    },
    "confidences" : {
      "selfieSunglasses" : 0,
      "idQuality" : 0,
      "birthDateMatch" : 0,
      "selfie" : 0,
      "idMatch" : 0,
      "idGlareQuality" : 0,
      "selfieEyeglasses" : 0,
      "id" : 0,
      "faceMatch" : 0,
      "idExpired" : 0,
      "nameMatch" : 0
    },
    "crosscheck" : {
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
    "expireDate" : "expireDate",
    "state" : "state",
    "id" : "id",
    "issueDate" : "issueDate",
    "class" : "class",
    "unverifiedIdAddress" : [ "unverifiedIdAddress", "unverifiedIdAddress" ],
    "idType" : "idType",
    "warnings" : true,
    "birthDate" : "birthDate",
    "firstName" : "firstName",
    "success" : true,
    "endorsements" : "endorsements",
    "middleName" : "middleName",
    "aamva" : {
      "createdAt" : "createdAt",
      "completedAt" : "completedAt",
      "hasErrors" : true,
      "hasWarnings" : true,
      "enabled" : true,
      "statusMessage" : "statusMessage",
      "updatedAt" : "updatedAt",
      "status" : "Pending"
    }
  },
  "submitted" : "2019-09-07T15:50-04:00",
  "signals" : [ {
    "property" : "private",
    "category" : "faceMatch",
    "message" : "message",
    "type" : "quality",
    "fields" : ""
  }, {
    "property" : "private",
    "category" : "faceMatch",
    "message" : "message",
    "type" : "quality",
    "fields" : ""
  } ],
  "review" : { },
  "reviewSuccess" : true,
  "surveyAt" : "2019-09-07T15:50-04:00",
  "id" : "id",
  "errors" : [ {
    "suggestion" : "John Smith",
    "warning" : true,
    "type" : "InvalidRequestError",
    "message" : "message"
  }, {
    "suggestion" : "John Smith",
    "warning" : true,
    "type" : "InvalidRequestError",
    "message" : "message"
  } ],
  "status" : "active",
  "updatedAt" : "2019-09-07T15:50-04:00"
};
    if (Object.keys(examples).length > 0) {
      resolve(examples[Object.keys(examples)[0]]);
    } else {
      resolve();
    }
  });
}

