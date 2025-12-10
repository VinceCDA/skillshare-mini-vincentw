#!/usr/bin/env bash
 

php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration
bin/console doc:fix:load --no-interaction
exec "$@"