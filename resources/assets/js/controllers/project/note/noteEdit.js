angular.module('app.controllers')
    .controller('ProjectNoteEditController', ['$scope', '$routeParams', '$location', 'ProjectNote',
        function ($scope, $routeParams, $location, ProjectNote) {
            $scope.note = ProjectNote.show({idNote: $routeParams.idNote});
            $scope.save = function () {
                if ($scope.form.$valid) {
                    ProjectNote.update({idNote: $scope.note.id}, $scope.note, function () {
                        $location.path('/project/1/notes');
                    });
                }
            }
        }]);