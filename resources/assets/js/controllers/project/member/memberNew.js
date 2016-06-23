angular.module('app.controllers')
    .controller('ProjectMemberNewController', ['$scope', '$location', '$routeParams', 'ProjectMember',
        function ($scope, $location, $routeParams, ProjectMember) {
            $scope.Member = new ProjectMember({idMember: $routeParams.idMember, idProject: $routeParams.idProject});
            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.Member.$save().then(function (response) {
                        if (response.error === true) {
                            $scope.Member.resp = response;
                        } else {
                            $location.path('/project/' + $routeParams.idProject + '/members');
                        }
                    });
                }
            };
        }]
    );