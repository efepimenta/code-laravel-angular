angular.module('app')
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            .when('/project/:idProject/files', {
                templateUrl: 'build/views/project/file/list.html',
                controller: 'ProjectFileListController'
            })
            .when('/project/:idProject/file/new', {
                templateUrl: 'build/views/project/file/new.html',
                controller: 'ProjectFileNewController'
            })
            .when('/project/:idProject/file/:idFile/edit', {
                templateUrl: 'build/views/project/file/edit.html',
                controller: 'ProjectFileEditController'
            })
            .when('/project/:idProject/file/:idFile/remove', {
                templateUrl: 'build/views/project/note/remove.html',
                controller: 'ProjectFileRemoveController'
            });
    }]);