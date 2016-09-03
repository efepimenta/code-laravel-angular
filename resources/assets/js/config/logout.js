angular.module('app')
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            .when('/logout', {
                resolve: {
                    logout: ['$location', 'OAuthToken', function ($location, OAuthToken) {
                        OAuthToken.removeToken();
                        $location.path('login');
                    }]
                }
            });
    }
    ])
;