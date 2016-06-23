angular.module('app.services')
    .service('ProjectMember', ['$resource', 'appConfig',
        function ($resource, appConfig) {
            return $resource(appConfig.baseUrl + '/project/:idProject/member/:idMember', {
                idProject: '@idProject',
                idMember: '@idMember'
            }, {
                query: {
                    method: 'GET',
                    isArray: true,
                    url: appConfig.baseUrl + '/project/:idProject/members/:idMember'
                },
                show: {
                    method: 'GET',
                    isArray: false
                },
                update: {
                    method: 'PUT'
                },
                delete_member: {
                    method: 'DELETE'
                }
            });
        }
    ]);