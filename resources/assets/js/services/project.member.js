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
                save: {
                    method: 'POST'
                    // transformResponse: dateToEn
                },
                show: {
                    method: 'GET',
                    isArray: true
                },
                delete_member: {
                    method: 'DELETE'
                }
            });
        }
    ]);