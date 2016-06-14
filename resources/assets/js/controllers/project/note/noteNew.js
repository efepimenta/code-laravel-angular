angular.module('app.controllers')
    .controller('ProjectNoteNewController', ['$scope', '$location', 'ProjectNote',
        function ($scope, $location, ProjectNote) {
            $scope.note = new ProjectNote();
            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.note.$save().then(function () {
                        $location.path('/project/1/notes');
                    });
                }
            }
        }]);