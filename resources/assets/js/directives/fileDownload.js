angular.module('app.directives')
    .directive('fileDownload',
        ['appConfig', 'ProjectFile', '$timeout', function (appConfig, ProjectFile, $timeout) {
            return {
                restrict: 'E',
                templateUrl: appConfig.baseUrl + '/build/views/template/file-download.html',
                link: function (scope, element, attrs) {
                    scope.$on('salvar-arquivo', function (event, data) {
                        var anchor = element.children()[0];
                        $(anchor).removeClass('disabled');
                        $(anchor).text('Save File');
                        $(anchor).attr({
                            href: 'data:application-octet-stream;base64,' + data.file,
                            download: data.name
                        });
                        $timeout(function () {
                            scope.downloadFile = function () {
                            };
                            $(anchor)[0].click();
                        }, 10);
                    });
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
                            $scope.$emit('salvar-arquivo', data);
                        });
                    };
                }]
            };
        }

        ]);