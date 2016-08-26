angular.module('app.controllers')
    .controller('ProjectListController', ['$scope', '$routeParams', 'Project',
        function ($scope, $routeParams, Project) {
            var ret = Project.query();
            ret.$promise.then(function (data) {
                if (data[0].error) {
                    $scope.error = data[0].error;
                    $scope.message = data[0].message;
                    $scope.projects = [];
                    return;
                }
                $scope.projects = data;
            });

        }]);