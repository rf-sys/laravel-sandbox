php-cs-fix-dry-run:
	./vendor/bin/pint --test

php-cs-fix:
	./vendor/bin/pint

ide-helper-meta:
	php artisan ide-helper:meta

ide-helper-models:
	php artisan ide-helper:models --write

ide-helper-facades:
	php artisan ide-helper:generate

static-check:
	./vendor/bin/phpstan analyse
