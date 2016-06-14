angular.module('app.controllers')
    .controller('ProjectNoteRemoveController', ['$scope', '$routeParams', '$location', 'ProjectNote',
        function ($scope, $routeParams, $location, ProjectNote) {
            // $scope.note = ProjectNote.show({idProject: $routeParams.idProject, idNote: $routeParams.idNote});
            $scope.delete = function () {
                ProjectNote.delete({
                    idProject: $routeParams.idProject,
                    idNote: $routeParams.idNote
                }).then(function (response) {
                    alert('nada');
                    if (response.error === true) {
                        $scope.note.resp = response;
                    } else {
                        $location.path('/project/1/notes');
                    }
                })
            }
        }]);