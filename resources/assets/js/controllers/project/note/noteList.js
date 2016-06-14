angular.module('app.controllers')
    .controller('ProjectNoteListController', ['$scope', 'ProjectNote',
        function ($scope, ProjectNote) {
            $scope.notes = ProjectNote.query();
        }]);