angular.module('app.controllers')
    .controller('ClientEditController', ['$scope', '$routeParams', '$location', 'Client',
        function ($scope, $routeParams, $location, Client) {
            $scope.client = Client.show({id: $routeParams.id});
            $scope.save = function () {
                if ($scope.form.$valid) {
                    Client.update({id: $scope.client[0].id}, $scope.client[0], function () {
                        $location.path('/clients');
                    });
                }
            }
        }]);