var app = angular.module('app', ['ngRoute', 'angular-oauth2', 'app.services', 'app.controllers', 'app.filters']);

angular.module('app.controllers', ['angular-oauth2', 'ngMessages']);
angular.module('app.services', ['ngResource']);
angular.module('app.filters', []);

app.provider('appConfig', function () {
    var config = {
        baseUrl: 'http://localhost:8000'
    };
    return {
        config: config,
        $get: function () {
            return config;
        }
    };
});

app.config(['$routeProvider', '$httpProvider', 'OAuthProvider', 'OAuthTokenProvider', 'appConfigProvider',
    function ($routeProvider, $httpProvider, OAuthProvider, OAuthTokenProvider, appConfigProvider) {
        $httpProvider.defaults.transformResponse = function (data, headers) {
            var header = headers();
            if (header['content-type'] === 'application/json' || header['content-type'] === 'text/json') {
                var dataJson = angular.fromJson(data);
                if (dataJson.hasOwnProperty('data')) {
                    dataJson = dataJson.data;
                }
                return dataJson;
            }
            return data;
        };
        OAuthProvider.configure({
            baseUrl: appConfigProvider.config.baseUrl,
            clientId: 'appid1',
            clientSecret: 'secret',
            grantPath: '/oauth/access_token',
            revokePath: '/oauth/access_token'
        });
        OAuthTokenProvider.configure({
            name: 'token',
            options: {
                secure: false
            }
        });
        $routeProvider.otherwise({redirectTo: '/home'});
    }]);

app.run(['$rootScope', '$window', 'OAuth', function ($rootScope, $window, OAuth) {
    $rootScope.$on('oauth:error', function (event, rejection) {
        // Ignore `invalid_grant` error - should be catched on `LoginController`.
        if ('invalid_grant' === rejection.data.error) {
            return;
        }

        // Refresh token when a `invalid_token` error occurs.
        if ('invalid_token' === rejection.data.error) {
            return OAuth.getRefreshToken();
        }

        // Redirect to `/login` with the `error_reason`.
        var error_address = $window.location.href = '/login?error_reason=' + rejection.data.error;
        return error_address;
    });
}]);