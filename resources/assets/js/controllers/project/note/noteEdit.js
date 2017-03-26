angular.module('app.controllers')
    .controller('ProjectNoteEditController', ['$scope', '$routeParams', '$location', 'ProjectNote',
        function ($scope, $routeParams, $location, ProjectNote) {
            $scope.note = ProjectNote.show({idNote: $routeParams.idNote, idProject: $routeParams.idProject});
            $scope.save = function () {
                if ($scope.form.$valid) {
                    ProjectNote.update({idNote: $scope.note.id, idProject: $routeParams.idProject}, $scope.note, function () {
                        $location.path('/project/'+$routeParams.idProject+'/notes');
                    });
                }
            };
        }]);