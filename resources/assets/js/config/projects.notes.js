angular.module('app')
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            .when('/project/:id/notes', {
                templateUrl: 'build/views/client/list.html',
                controller: 'ClientListController'
            })
            .when('/project/:id/notes/:idNote', {
                templateUrl: 'build/views/client/new.html',
                controller: 'ClientNewController'
            })
            .when('/project/:id/notes/new', {
                templateUrl: 'build/views/client/edit.html',
                controller: 'ClientEditController'
            })
            .when('/project/:id/notes/:idNote/edit', {
                templateUrl: 'build/views/client/remove.html',
                controller: 'ClientRemoveController'
            })
            .when('/project/:id/notes/:idNote/remove', {
                templateUrl: 'build/views/client/remove.html',
                controller: 'ClientRemoveController'
            });
    }]);