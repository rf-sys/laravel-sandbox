static-check:
	./vendor/bin/psalm

php-cs-fix-dry-run:
	./vendor/bin/php-cs-fixer fix --verbose --dry-run --diff app

php-cs-fix:
	./vendor/bin/php-cs-fixer fix --verbose --diff app
