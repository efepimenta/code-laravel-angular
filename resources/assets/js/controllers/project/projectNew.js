angular.module('app.controllers')
    .controller('ProjectNewController',
        ['$scope', '$location', '$routeParams', '$cookies', '$filter', 'Project', 'Client', 'appConfig',
            function ($scope, $location, $routeParams, $cookies, $filter, Project, Client, appConfig) {
                $scope.project = new Project({idProject: $routeParams.idProject});
                $scope.status = appConfig.project.status;
                $scope.save = function () {
                    if ($scope.form.$valid) {
                        $scope.project.owner_id = $cookies.getObject('user').id;
                        console.log($scope.project.due_date);
                        $scope.project.due_date = $filter('date')($scope.project.due_date, 'yyyy-MM-dd');
                        $scope.project.$save().then(function (response) {
                            if (response.error === true) {
                                $scope.project.resp = response;
                            } else {
                                $location.path('/projects');
                            }
                        });
                    }
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