#!/bin/bash
##################################################################
# Purpose: Hard enable xdebug in PHP container
# Arguments: none
##################################################################
php_xdebug_on()
{
    [ -f /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini.deactivated ] && mv /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini.deactivated /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
    kill -USR2 1
    printf "${C_MSG}PHP XDEBUG: Enabled${C_NORM}\n"
}
alias xdebug-on=php_xdebug_on

##################################################################
# Purpose: Hard disable xdebug in PHP container
# Arguments: none
##################################################################
php_xdebug_off()
{
    [ -f /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini ] && mv /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini.deactivated
    kill -USR2 1
    printf "${C_MSG}PHP XDEBUG: Disabled${C_NORM}\n"
}
alias xdebug-off=php_xdebug_off

##################################################################
# PHP CLI Xdebug
# Arguments: none
##################################################################
php_with_xdebug()
{
    php -dxdebug.remote_enable=1 -dxdebug.remote_host=host.docker.internal -dxdebug.remote_connect_back=0 -dxdebug.remote_autostart=on -dxdebug.remote_port=9001 -dxdebug.idekey=PHPSTORM "$@"
}
alias xphp=php_with_xdebug

##################################################################
# Any direct command from outside container
# Arguments: $1 will be command to execute
# Usage from within container: xdebug-on or xdebug-off
##################################################################

case $1 in
  "xdebug-on") php_xdebug_on ;;
  "xdebug-off") php_xdebug_off ;;
esac