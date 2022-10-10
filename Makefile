# Code style fixer

php-cs-fix:
	./vendor/bin/pint

# Static analyzer

static-check:
	./vendor/bin/phpstan analyse

# IDE Helper

ide-helper-meta:
	php artisan ide-helper:meta

ide-helper-models:
	php artisan ide-helper:models --write

ide-helper-facades:
	php artisan ide-helper:generate
