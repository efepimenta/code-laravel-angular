angular.module('app.services')
    .service('oauthFixInterceptor', ['$q', '$rootScope', 'OAuthToken',
        function oauthInterceptor($q, $rootScope, OAuthToken) {
            return {
                responseError: function(rejection) {
                    // Catch `invalid_token` and `unauthorized` errors.
                    // The token isn't removed here so it can be refreshed when the `invalid_token` error occurs.
                    if (401 === rejection.status &&
                        (rejection.data && 'access_denied' === rejection.data.error) ||
                        (rejection.headers('www-authenticate') && 0 === rejection.headers('www-authenticate').indexOf('Bearer'))
                    ) {
                        $rootScope.$emit('oauth:error', rejection);
                    }

                    return $q.reject(rejection);
                }
            };
        }
    ]);