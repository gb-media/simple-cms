#!/bin/sh
set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

if [ "$1" = 'php-fpm' ] || [ "$1" = 'php' ] || [ "$1" = 'bin/console' ]; then
	PHP_INI_RECOMMENDED="$PHP_INI_DIR/php.ini-production"
	if [ "$APP_ENV" != 'prod' ]; then
		PHP_INI_RECOMMENDED="$PHP_INI_DIR/php.ini-development"
	fi
	ln -sf "$PHP_INI_RECOMMENDED" "$PHP_INI_DIR/php.ini"

	mkdir -p var/cache var/log

	if [ "$APP_ENV" != 'prod' ]; then
		setfacl -R -m u:www-data:rwX -m u:"$(whoami)":rwX var
		setfacl -dR -m u:www-data:rwX -m u:"$(whoami)":rwX var

		composer install --prefer-dist --no-progress --no-suggest --no-interaction
	else
		setfacl -R -m u:www-data:rwX -m u:"$(whoami)":rwX var/cache var/log
		setfacl -dR -m u:www-data:rwX -m u:"$(whoami)":rwX var/cache var/log

		bin/console cache:clear
	fi
fi

exec docker-php-entrypoint "$@"
