angular.module('app.controllers')
    .controller('ProjectEditController', ['$scope', '$routeParams', '$location', 'Project',
        function ($scope, $routeParams, $location, Project) {
            $scope.project = Project.show({idProject: $routeParams.idProject});
            $scope.save = function () {
                if ($scope.form.$valid) {
                    Project.update({idProject: $routeParams.idProject}, $scope.project, function () {
                        $location.path('/projects');
                    });
                }
            };
        }]);