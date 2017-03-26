angular.module('app')
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            .when('/project/:idProject/notes', {
                templateUrl: 'build/views/project/note/list.html',
                controller: 'ProjectNoteListController'
            })
            .when('/project/:idProject/notes/new', {
                templateUrl: 'build/views/project/note/new.html',
                controller: 'ProjectNoteNewController'
            })
            .when('/project/:idProject/notes/:idNote/edit', {
                templateUrl: 'build/views/project/note/edit.html',
                controller: 'ProjectNoteEditController'
            })
            .when('/project/:idProject/notes/:idNote/remove', {
                templateUrl: 'build/views/project/note/remove.html',
                controller: 'ProjectNoteRemoveController'
            });
    }]);