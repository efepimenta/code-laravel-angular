angular.module('app.directives')
    .directive('fileDownload',
        ['appConfig', 'ProjectFile', function (appConfig, ProjectFile) {
            return {
                restrict: 'AE',
                templateUrl: appConfig.baseUrl + '/build/views/template/file-download.html',
                link : function (scope, element, attrs) {
                    
                },
                controller: ['$scope', '$element', '$attrs', function ($scope, $element, $attrs) {
                    $scope.downloadFile = function () {
                        var anchor = $element.children()[0];
                        $(anchor).addClass('disabled');
                        $(anchor).text('Loading');
                        ProjectFile.download({
                            id: null,
                            idFile: $attrs.idFile
                        }, function (data) {
                            
                        })
                    }
                }]
            };
        }

    ]);