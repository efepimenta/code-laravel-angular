angular.module('app.services')
    .service('ProjectNote', ['$resource', 'appConfig',
        function ($resource, appConfig) {
            return $resource(appConfig.baseUrl + '/project/:idProject/notes/:idNote', {
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
                    method: 'PUT',
                    params: {idProject: '@idProject', idNote: '@idNote'}
                },
                delete_note: {
                    method: 'DELETE',
                    params: {idProject: '@idProject', idNote: '@idNote'}
                }
            });
        }
    ]);