angular.module('app.controllers')
    .controller('ProjectMemberRemoveController', ['$scope', '$routeParams', '$location', 'ProjectMember',
        function ($scope, $routeParams, $location, ProjectMember) {
            $scope.member = ProjectMember.show({idProject: $routeParams.idProject, idMember: $routeParams.idMember});
            $scope.delete = function () {
                ProjectMember.delete_member({
                    idProject: $routeParams.idProject,
                    idMember: $routeParams.idMember
                }, $scope.member, function (response) {
                    if (response.error === true) {
                        $scope.member.resp = response;
                    } else {
                        $location.path('/project/' + $routeParams.idProject + '/members');
                    }
                });
            };
        }]
    );