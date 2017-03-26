angular.module('app.controllers')
    .controller('ProjectNewController', ['$scope', '$location', '$routeParams', '$cookies', 'Project', 'Client',
        function ($scope, $location, $routeParams, $cookies, Project, Client) {
            $scope.project = new Project({idProject: $routeParams.idProject});
            $scope.clients = Client.query();
            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.project.owner_id = $cookies.getObject('user').id;
                    $scope.project.$save().then(function (response) {
                        if (response.error === true){
                            $scope.project.resp = response;
                        } else {
                            $location.path('/projects');
                        }
                    });
                }
            }
        }]);