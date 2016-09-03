#!/bin/bash
php -S 0.0.0.0:8000 -t public &
PHP=`pgrep -f "php -S"`
gulp watch-dev
kill -9 <<< echo $PHP