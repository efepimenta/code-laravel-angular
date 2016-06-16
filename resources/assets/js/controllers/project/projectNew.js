angular.module('app.controllers')
    .controller('ProjectNewController',
        ['$scope', '$location', '$routeParams', '$cookies', '$filter', 'Project', 'Client', 'appConfig',
            function ($scope, $location, $routeParams, $cookies, $filter, Project, Client, appConfig) {
                $scope.project = new Project({idProject: $routeParams.idProject});
                $scope.clients = Client.query();
                $scope.status = appConfig.project.status;
                $scope.save = function () {
                    if ($scope.form.$valid) {
                        $scope.project.owner_id = $cookies.getObject('user').id;
                        var arr_data = $scope.project.due_date.split('/');
                        $scope.project.due_date = $filter('date')(new Date(arr_data[2], arr_data[1] - 1, arr_data[0]), 'yyyy-MM-dd');
                        $scope.project.$save().then(function (response) {
                            if (response.error === true) {
                                $scope.project.resp = response;
                            } else {
                                $location.path('/projects');
                            }
                        });
                    }
                };
            }]);