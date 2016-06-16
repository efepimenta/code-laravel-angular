angular.module('app.services')
    .service('Project',
        ['$resource', '$filter', '$httpParamSerializer', 'appConfig',
            function ($resource, $filter, $httpParamSerializer, appConfig) {

                // function dateToEn(data) {
                //     if (angular.isObject(data) || data.hasOwnProperty('due_date')) {
                //         var o = angular.copy(data);
                //         o.due_date = $filter('date')(o.due_date, 'yyyy-MM-dd');
                //         return transformRequest.config.utils.transformRequest(o);
                //     }
                //     return data;
                // }
                //
                function dateToBr(data, headers) {
                    var o = appConfig.utils.transformResponse(data, headers);
                    if (angular.isObject(o) || o.hasOwnProperty('due_date')) {
                        var arr_data = o.due_date.split('-');
                        o.due_date = $filter('date')(new Date(arr_data[0], arr_data[1] - 1, arr_data[2]), 'dd/MM/yyyy');
                    }
                    return o;
                }

                return $resource(appConfig.baseUrl + '/project/:idProject', {idProject: '@idProject'},
                    {
                        query: {
                            method: 'GET',
                            isArray: true
                        },
                        show: {
                            method: 'GET',
                            isArray: false,
                            transformResponse: dateToBr
                        },
                        save: {
                            method: 'POST'
                            // transformResponse: dateToEn
                        },
                        update: {
                            method: 'PUT'
                            // transformResponse: dateToEn
                        }
                    });
            }
        ])
;