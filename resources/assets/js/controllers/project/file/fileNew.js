angular.module('app.controllers')
    .controller('ProjectFileNewController', ['$scope', '$location', '$routeParams', 'ProjectFile', 'Upload', 'Url', 'appConfig',
        function ($scope, $location, $routeParams, ProjectFile, Upload, Url, appConfig) {
            $scope.projectFile = new ProjectFile({idFile: $routeParams.idFile, idProject: $routeParams.idProject});
            $scope.save = function () {
                if ($scope.form.$valid) {
                    Upload.upload({
                        url: appConfig.baseUrl + Url.getUrlFromUrlSymbol(appConfig.urls.projectFile, {
                            idProject: $routeParams.idProject,
                            idFile: ''
                        }),
                        data: {
                            id: $routeParams.idFile,
                            name: $scope.projectFile.name,
                            description: $scope.projectFile.description,
                            file: $scope.projectFile.file
                        }
                    }).then(function (resp) {
                        if (resp.data.error === true) {
                            $scope.projectFile.resp = resp.data;
                        } else {
                            $location.path('/project/'+$routeParams.idProject+'/files');
                        }
                        }
                    );
                }
            };
            $scope.back = function () {
                $scope.projectFile.resp.error = false;
            };
        }]);