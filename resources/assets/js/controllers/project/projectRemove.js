angular.module('app.controllers')
    .controller('ProjectRemoveController', ['$scope', '$routeParams', '$location', 'Project',
        function ($scope, $routeParams, $location, Project) {
            $scope.project = Project.show({idProject: $routeParams.idProject});
            $scope.delete = function () {
                Project.delete_project({
                    idProject: $routeParams.idProject
                }, $scope.project, function (response) {
                    if (response.error === true) {
                        $scope.project.resp = response;
                    } else {
                        $location.path('/projects');
                    }
                })
            }
        }]);