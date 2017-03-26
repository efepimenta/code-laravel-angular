angular.module('app.controllers')
    .controller('ProjectFileListController', ['$scope', '$routeParams', 'ProjectFile',
        function ($scope, $routeParams, ProjectFile) {
            $scope.files = ProjectFile.query({idProject: $routeParams.idProject});
        }]);