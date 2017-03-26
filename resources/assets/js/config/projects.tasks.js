angular.module('app')
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            .when('/project/:idProject/tasks', {
                templateUrl: 'build/views/project/task/list.html',
                controller: 'ProjectTaskListController'
            })
            .when('/project/:idProject/task/new', {
                templateUrl: 'build/views/project/task/new.html',
                controller: 'ProjectTaskNewController'
            })
            .when('/project/:idProject/task/:idTask/edit', {
                templateUrl: 'build/views/project/task/edit.html',
                controller: 'ProjectTaskEditController'
            })
            .when('/project/:idProject/task/:idTask/remove', {
                templateUrl: 'build/views/project/task/remove.html',
                controller: 'ProjectTaskRemoveController'
            });
    }]);