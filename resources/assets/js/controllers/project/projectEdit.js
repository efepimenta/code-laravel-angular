angular.module('app.controllers')
    .controller('ProjectEditController',
        ['$scope', 'appConfig', '$routeParams', '$location', '$cookies', '$filter', 'Project', 'Client', 'uibDateParser',
            function ($scope, appConfig, $routeParams, $location, $cookies, $filter, Project, Client, uibDateParser) {
                Project.show({idProject: $routeParams.idProject},function (data) {
                    $scope.project = data;
                    $scope.format = 'dd/MM/yyyy';
                    Client.get({id: data.client_id}, function (data) {
                        $scope.clientSelected = data;
                    });
                });
                $scope.status = appConfig.project.status;
                $scope.save = function () {
                    if ($scope.form.$valid) {
                        $scope.project.due_date = $filter('date')($scope.project.due_date, 'yyyy-MM-dd');
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
                $scope.formatName = function (model) {
                    if (model) {
                        return model.name;
                    }
                    return '';
                };
                $scope.getClients = function (name) {
                    return Client.query({
                        search : name,
                        searchFields: 'name:like'
                    }).$promise;
                };
                $scope.selectClient = function (item) {
                    $scope.project.client_id = item.id;
                };
                $scope.due_date = {
                    status: {
                        opened: false
                    }
                };
                $scope.open = function () {
                    $scope.due_date.status.opened = true;
                };
            }]);