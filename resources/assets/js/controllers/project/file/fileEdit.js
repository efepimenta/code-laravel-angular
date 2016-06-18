angular.module('app.controllers')
    .controller('ProjectFileEditController', ['$scope', '$routeParams', '$location', 'ProjectFile',
        function ($scope, $routeParams, $location, ProjectFile) {
            $scope.projectFile = ProjectFile.show({idProject: $routeParams.idProject, idFile: $routeParams.idFile});
            $scope.save = function () {
                if ($scope.form.$valid) {
                    ProjectFile.update({idProject: $routeParams.idProject, idFile: $scope.projectFile.id}, $scope.projectFile, function () {
                        $location.path('/project/'+$routeParams.idProject+'/files');
                    });
                }
            };
        }]);