#!/bin/sh

php -S [::1]:1081 -d error_reporting=E_ALL -d display_errors=1 -t www/
