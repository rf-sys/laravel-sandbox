php-cs-fix-dry-run:
	./vendor/bin/php-cs-fixer fix --verbose --dry-run --diff app

php-cs-fix:
	./vendor/bin/php-cs-fixer fix --verbose --diff app

ide-helper-meta:
	php artisan ide-helper:meta

ide-helper-models:
	php artisan ide-helper:models --write

ide-helper-facades:
	php artisan ide-helper:generate

static-check:
	./vendor/bin/phpstan analyse
