angular.module('app.controllers').controller('LoginController', ['$scope', '$location', 'OAuth',
    function ($scope, $location, OAuth) {
        $scope.user = {
            username: 'fabio@email.com',
            password: '123456',
        };
        $scope.error = {
            error : false,
            message : ''
        }
        $scope.login = function () {
            if ($scope.form.$valid) {
                OAuth.getAccessToken($scope.user).then(function () {
                    $location.path('home');
                }, function (data) {
                    $scope.error.message = data.data.error_description;
                    $scope.error.error = true;
                });
            }
        };
    }]);