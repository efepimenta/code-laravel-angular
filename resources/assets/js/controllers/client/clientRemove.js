angular.module('app.controllers')
    .controller('ClientRemoveController', ['$scope', '$routeParams', '$location', 'Client',
        function ($scope, $routeParams, $location, Client) {
            $scope.client = Client.show({id: $routeParams.id});
            $scope.delete = function () {
                $scope.client.$delete().then(function (response) {
                    if (response.error === true){
                        $scope.client.resp = response;
                    } else {
                        $location.path('/clients');
                    }
                });
            };
        }]);