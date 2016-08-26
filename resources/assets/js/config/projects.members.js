angular.module('app')
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            .when('/project/:idProject/members', {
                templateUrl: 'build/views/project/member/list.html',
                controller: 'ProjectMemberListController'
            })
            .when('/project/:idProject/member/new', {
                templateUrl: 'build/views/project/member/new.html',
                controller: 'ProjectMemberNewController'
            })
            .when('/project/:idProject/member/:idMember/remove', {
                templateUrl: 'build/views/project/member/remove.html',
                controller: 'ProjectMemberRemoveController'
            });
    }]);