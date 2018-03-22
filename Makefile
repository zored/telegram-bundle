FIX_CODE_STYLE := vendor/bin/php-cs-fixer fix --config=.php_cs.dist --allow-risky=yes
COMPOSER := composer --no-interaction

# Development:
test:
	vendor/bin/phpunit $A
open-coverage:
	open build/coverage/html/index.html
fix-code-style:
	$(FIX_CODE_STYLE) $A
check-code-style:
	$(FIX_CODE_STYLE) --diff --dry-run --verbose $A

# Travis:
ci-install:
	$(COMPOSER) update
	$(COMPOSER) info --direct | sort
ci-test: \
 test \
 check-code-style
ci-coverage:
	vendor/bin/php-coveralls --verbose
