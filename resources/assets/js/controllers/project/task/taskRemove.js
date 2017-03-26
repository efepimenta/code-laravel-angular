angular.module('app.controllers')
    .controller('ProjectTaskRemoveController', ['$scope', '$routeParams', '$location', 'ProjectTask',
        function ($scope, $routeParams, $location, ProjectTask) {
            $scope.task = ProjectTask.show({idProject: $routeParams.idProject, idTask: $routeParams.idTask});
            $scope.delete = function () {
                ProjectTask.delete_task({
                    idProject: $routeParams.idProject,
                    idTask: $routeParams.idTask
                }, $scope.task, function (response) {
                    if (response.error === true) {
                        $scope.task.resp = response;
                    } else {
                        $location.path('/project/1/tasks');
                    }
                });
            };
        }]);