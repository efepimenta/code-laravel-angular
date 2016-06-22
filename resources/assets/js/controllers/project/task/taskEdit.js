angular.module('app.controllers')
    .controller('ProjectTaskEditController',
        ['$scope', '$routeParams', '$location', '$filter', 'ProjectTask', 'uibDateParser', 'appConfig',
        function ($scope, $routeParams, $location, $filter, ProjectTask, uibDateParser, appConfig) {
            ProjectTask.show({idTask: $routeParams.idTask, idProject: $routeParams.idProject}, function (data) {
                $scope.task = data;
                var date_start = $scope.task.start_date.split('/');
                $scope.task.start_date = new Date(date_start[2] + '-' + date_start[1] + '-' + date_start[0]);
                var date_due = $scope.task.due_date.split('/');
                $scope.task.due_date = new Date(date_due[2] + '-' + date_due[1] + '-' + date_due[0]);
                $scope.format = 'dd/MM/yyyy';
            });
            $scope.status = appConfig.project.status;
            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.task.start_date = $filter('date')($scope.task.start_date, 'yyyy-MM-dd');
                    $scope.task.due_date = $filter('date')($scope.task.due_date, 'yyyy-MM-dd');
                    ProjectTask.update({
                        idTask: $scope.task.id,
                        idProject: $routeParams.idProject
                    }, $scope.task, function () {
                        $location.path('/project/' + $routeParams.idProject + '/tasks');
                    });
                }
            };
            $scope.back = function () {
                $scope.project.resp.error = false;
            };
            $scope.start_date = {
                status: {
                    opened: false
                }
            };
            $scope.due_date = {
                status: {
                    opened: false
                }
            };
            $scope.openStart = function () {
                $scope.start_date.status.opened = true;
            };
            $scope.openDue = function () {
                $scope.due_date.status.opened = true;
            };
        }]);