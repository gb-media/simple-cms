#!/bin/sh
set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- node "$@"
fi

if [ "$1" = 'node' ] || [ "$1" = 'yarn' ]; then
	mkdir -p public/build

	setfacl -R -m u:node:rwX -m u:"$(whoami)":rwX public/build
	setfacl -dR -m u:node:rwX -m u:"$(whoami)":rwX public/build

	if [ "$NODE_ENV" != 'production' ]; then
		yarn install
	fi
fi

exec "$@"
