'use strict';

/**
 * @ngdoc service
 * @name angularApp.PlaceManager
 * @description
 * # PlaceManager
 * Factory in the angularApp.
 */
angular.module('angularApp')
    .factory('PlaceManager', function ($http, $q) {
        return {
            getPlaces: function () {
                var deffered = $q.defer();
                var _this = this;

                $http.get('app.php/api/places').
                    success(function (data) {
                        console.log(data);
                        deffered.resolve(data);
                    }).
                    error(function (data, status, headers, config) {
                        console.log(data);
                        deffered.reject();
                    });

                return deffered.promise;
            }//,
//            getDatesWithRange: function (startDate, endDate) {
//                var deffered = $q.defer();
//                var _this = this;
//
//                $http.get('app.php/api/dates', {
//                    params: {
//                        startDate: startDate,
//                        endDate: endDate
//                    }
//                }).
//                    success(function (data) {
//                        deffered.resolve(data);
//                    }).
//                    error(function (data, status, headers, config) {
//                        console.log(data);
//                        deffered.reject();
//                    });
//
//                return deffered.promise;
//            },
//            toTimeStamp: function(date){
//                return new Date(date.getTime()) / 1000;
//            }
        };
    });
