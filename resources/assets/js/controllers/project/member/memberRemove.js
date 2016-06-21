angular.module('app.controllers')
    .controller('ProjectMemberRemoveController', ['$scope', '$routeParams', '$location', 'ProjectMember',
        function ($scope, $routeParams, $location, ProjectMember) {
            $scope.Member = ProjectMember.show({idProject: $routeParams.idProject, idMember: $routeParams.idMember});
            $scope.delete = function () {
                ProjectMember.delete_Member({
                    idProject: $routeParams.idProject,
                    idMember: $routeParams.idMember
                }, $scope.Member, function (response) {
                    if (response.error === true) {
                        $scope.Member.resp = response;
                    } else {
                        $location.path('/project/1/Members');
                    }
                });
            };
        }]);