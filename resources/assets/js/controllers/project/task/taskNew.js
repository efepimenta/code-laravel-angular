angular.module('app.controllers')
    .controller('ProjectTaskNewController', ['$scope', '$location', '$routeParams', '$filter', 'ProjectTask',
        function ($scope, $location, $routeParams, $filter, ProjectTask) {
            $scope.task = new ProjectTask({idTask: $routeParams.idTask, idProject: $routeParams.idProject});
            $scope.format = 'dd/MM/yyyy';
            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.task.start_date = $filter('date')($scope.task.start_date, 'yyyy-MM-dd');
                    $scope.task.due_date = $filter('date')($scope.task.due_date, 'yyyy-MM-dd');
                    ProjectTask.save({
                        idTask: $scope.task.id,
                        idProject: $routeParams.idProject
                    }, $scope.task, function () {
                        $location.path('/project/' + $routeParams.idProject + '/tasks');
                    });
                }
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
        }
    ]);