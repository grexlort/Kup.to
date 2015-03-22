'use strict';

/**
 * @ngdoc function
 * @name angularApp.controller:PlaceCtrl
 * @description
 * # PlaceCtrl
 * Controller of the angularApp
 */
angular.module('angularApp')
    .controller('PlaceCtrl', function ($scope, $http, PlaceManager) {

//        PlaceManager.getPlaces().then(function(result) {
//            console.log(result);
////            $scope.places = result;
//        });
//        PlaceManager.getPlaces();
//        $scope.places = PlaceManager.placeData;
//        console.log($scope.places);
        $scope.addNew = {
            name: '',
            color: '',
            status: false,
            add: function () {
                $http.post('api/places',
                    {
                        name:this.name,
                        color: this.color
                    }
                ).
                    success(function (data) {
                        //$scope.places = data;
                        console.log(data);
                    }).
                    error(function (data, status, headers, config) {
                        console.log(data);
                    });
            }
        };

        $http.get('api/places').
            success(function (data) {
                $scope.places = data;
                console.log(data);
            }).
            error(function (data, status, headers, config) {
                console.log(data);
            });

    });
