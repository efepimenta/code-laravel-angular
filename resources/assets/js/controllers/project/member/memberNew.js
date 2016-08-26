angular.module('app.controllers')
    .controller('ProjectMemberNewController', ['$scope', '$location', '$routeParams', 'ProjectMember', 'Client',
        function ($scope, $location, $routeParams, ProjectMember, Client) {
            $scope.member = new ProjectMember({
                idMember: $routeParams.idMember,
                idProject: $routeParams.idProject
            });
            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.member.$save().then(function (response) {
                        if (response.error === true) {
                            $scope.member.resp = response;
                        } else {
                            $location.path('/project/' + $routeParams.idProject + '/members');
                        }
                    });
                }
            };
            $scope.getClients = function (name) {
                return Client.query({
                    search : name,
                    searchFields: 'name:like'
                }).$promise;
            };
            $scope.selectClient = function (item) {
                $scope.member.idMember = item.id;
            };
            $scope.formatName = function (model) {
                if (model) {
                    return model.name;
                }
                return '';
            };
        }]
    );