angular.module('app.controllers')
    .controller('ProjectFileRemoveController', ['$scope', '$routeParams', '$location', 'ProjectFile',
        function ($scope, $routeParams, $location, ProjectFile) {
            $scope.projectFile = ProjectFile.get({idProject: $routeParams.idProject, idFile: $routeParams.idFile});
            $scope.delete = function () {
                ProjectFile.delete_file({
                    idProject: $routeParams.idProject,
                    idFile: $routeParams.idFile
                }, $scope.projectFile, function (response) {
                    if (response.error === true) {
                        $scope.projectFile.resp = response;
                    } else {
                        $location.path('/project/'+$routeParams.idProject+'/files');
                    }
                });
            };
        }]);