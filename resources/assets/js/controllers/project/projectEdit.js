angular.module('app.controllers')
    .controller('ProjectEditController',
        ['$scope', 'appConfig', '$routeParams', '$location', '$cookies', '$filter', 'Project', 'Client',
            function ($scope, appConfig, $routeParams, $location, $cookies, $filter, Project, Client) {
                $scope.project = Project.show({idProject: $routeParams.idProject});
                $scope.clients = Client.query();
                $scope.status = appConfig.project.status;
                $scope.save = function () {
                    if ($scope.form.$valid) {
                        var arr_data = $scope.project.due_date.split('/');
                        $scope.project.due_date = $filter('date')(new Date(arr_data[2], arr_data[1] - 1, arr_data[0]), 'yyyy-MM-dd');
                        // $scope.project.owner_id = $cookies.getObject('user').id;
                        Project.update({idProject: $routeParams.idProject}, $scope.project, function (response) {
                            if (response.error === true) {
                                $scope.project.resp = response;
                            } else {
                                $location.path('/projects');
                            }
                        });
                    }
                };
                $scope.back = function () {
                    $scope.project.resp.error = false;
                };
            }]);