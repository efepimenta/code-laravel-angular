angular.module('app.services')
    .service('ProjectFile', ['$resource', 'appConfig', 'Url',
        function ($resource, appConfig, Url) {
            return $resource(appConfig.baseUrl + Url.getUrlResource(appConfig.urls.projectFile), {
                idProject: '@idProject',
                idFile: '@idFile'
            }, {
                query: {
                    method: 'GET',
                    isArray: true,
                    url: appConfig.baseUrl + '/project/:idProject/files/:idFile'
                },
                show: {
                    method: 'GET',
                    isArray: false
                },
                update: {
                    method: 'PUT'
                },
                delete_file: {
                    method: 'DELETE'
                },
                download: {
                    method: 'GET',
                    url: appConfig.baseUrl + '/project/:idProject/file/:idFile/download'
                }
            });
        }
    ]);