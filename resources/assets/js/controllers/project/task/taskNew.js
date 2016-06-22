angular.module('app.controllers')
    .controller('ProjectTaskNewController', ['$scope', '$location', '$routeParams', 'ProjectTask',
        function ($scope, $location, $routeParams, ProjectTask) {
            $scope.note = new ProjectTask({idTask: $routeParams.idTask, idProject: $routeParams.idProject});
            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.task.$save().then(function (response) {
                        if (response.error === true){
                            $scope.task.resp = response;
                        } else {
                            $location.path('/project/' + $routeParams.idProject + '/tasks');
                        }
                    });
                }
            };
        }]);