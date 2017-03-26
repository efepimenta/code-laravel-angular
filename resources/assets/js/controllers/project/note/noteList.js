angular.module('app.controllers')
    .controller('ProjectNoteListController', ['$scope', '$routeParams', 'ProjectNote',
        function ($scope, $routeParams, ProjectNote) {
            $scope.notes = ProjectNote.query({idProject: $routeParams.idProject});
        }]);