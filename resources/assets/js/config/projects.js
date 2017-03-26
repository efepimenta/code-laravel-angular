angular.module('app')
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            .when('/projects', {
                templateUrl: 'build/views/project/list.html',
                controller: 'ProjectListController'
            })
            .when('/project/new', {
                templateUrl: 'build/views/project/new.html',
                controller: 'ProjectNewController'
            })
            .when('/project/:idProject/edit', {
                templateUrl: 'build/views/project/edit.html',
                controller: 'ProjectEditController'
            })
            .when('/project/:idProject/remove', {
                templateUrl: 'build/views/project/remove.html',
                controller: 'ProjectRemoveController'
            });
    }]);