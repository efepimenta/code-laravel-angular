angular.module('app.services')
    .service('ProjectTask', ['$resource', '$filter', '$httpParamSerializer', 'appConfig',
        function ($resource, $filter, $httpParamSerializer, appConfig) {

            function dateToBr(data, headers) {
                var o = appConfig.utils.transformResponse(data, headers);
                if (angular.isObject(o)) {
                    var arr_data = {};
                    if (o.hasOwnProperty('due_date')) {
                        arr_data = o.due_date.split('-');
                        o.due_date = $filter('date')(new Date(arr_data[0], arr_data[1] - 1, arr_data[2]), 'dd/MM/yyyy');
                    }
                    if (o.hasOwnProperty('start_date')) {
                        arr_data = o.start_date.split('-');
                        o.start_date = $filter('date')(new Date(arr_data[0], arr_data[1] - 1, arr_data[2]), 'dd/MM/yyyy');
                    }
                }
                return o;
            }

            return $resource(appConfig.baseUrl + '/project/:idProject/task/:idTask', {
                idProject: '@idProject',
                idTask: '@idTask'
            }, {
                query: {
                    method: 'GET',
                    isArray: true
                },
                show: {
                    method: 'GET',
                    isArray: false,
                    transformResponse: dateToBr
                },
                update: {
                    method: 'PUT'
                },
                delete_task: {
                    method: 'DELETE'
                }
            });
        }
    ]);