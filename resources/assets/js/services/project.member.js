angular.module('app.services')
    .service('ProjectMember', ['$resource', 'appConfig',
        function ($resource, appConfig) {
            return $resource(appConfig.baseUrl + '/project/:idProject/members/:idMember', {
                idProject: '@idProject',
                idMember: '@idMember'
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
                delete_Member: {
                    method: 'DELETE'
                }
            });
        }
    ]);