angular.module('app.controllers')
    .controller('ProjectMemberEditController', ['$scope', '$routeParams', '$location', 'ProjectMember',
        function ($scope, $routeParams, $location, ProjectMember) {
            $scope.Member = ProjectMember.show({idMember: $routeParams.idMember, idProject: $routeParams.idProject});
            $scope.save = function () {
                if ($scope.form.$valid) {
                    ProjectMember.update({
                        idMember: $scope.Member.id,
                        idProject: $routeParams.idProject
                    }, $scope.Member, function () {
                        $location.path('/project/' + $routeParams.idProject + '/members');
                    });
                }
            };
        }]
    );