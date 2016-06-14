angular.module('app.services')
    .service('ProjectNote', ['$resource', 'appConfig',
        function ($resource, appConfig) {
            return $resource(appConfig.baseUrl + '/project/:idProject/notes/:idNote', {idProject: '1', idNote: '@idNote'}, {
                query: {
                    method: 'GET',
                    isArray: true
                },
                show: {
                    method: 'GET',
                    isArray: false
                },
                update: {
                    method: 'PUT'
                },
                delete: {
                    method: 'DELETE'
                }
            });
        }
    ]);