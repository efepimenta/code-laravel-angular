angular.module('app.controllers')
    .controller('ProjectNoteNewController', ['$scope', '$location', '$routeParams', 'ProjectNote',
        function ($scope, $location, $routeParams, ProjectNote) {
            $scope.note = new ProjectNote({idNote: $routeParams.idNote, idProject: $routeParams.idProject});
            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.note.$save().then(function (response) {
                        if (response.error === true){
                            $scope.note.resp = response;
                        } else {
                            $location.path('/project/' + $routeParams.idProject + '/notes');
                        }
                    });
                }
            }
        }]);