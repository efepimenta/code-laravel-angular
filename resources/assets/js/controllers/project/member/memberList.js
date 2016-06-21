angular.module('app.controllers')
    .controller('ProjectMemberListController', ['$scope', '$routeParams', 'ProjectMember',
        function ($scope, $routeParams, ProjectMember) {
            $scope.Members = ProjectMember.query({idProject: $routeParams.idProject});
        }]);