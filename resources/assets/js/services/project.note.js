angular.module('app.services')
    .service('ProjectNote', ['$resource', 'appConfig',
        function ($resource, appConfig) {
            return $resource(appConfig.baseUrl + '/project/:idProject/note/:idNote', {
                idProject: '@idProject',
                idNote: '@idNote'
            }, {
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
                delete_note: {
                    method: 'DELETE'
                }
            });
        }
    ]);