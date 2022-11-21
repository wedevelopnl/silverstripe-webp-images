.PHONY: *

docker := $(shell if [ `pwd` != "/app" ]; then echo 'docker compose exec php'; fi;)

fix-cs: ##@develop Fix code styling
	${docker} ./vendor/bin/php-cs-fixer fix

test: ##@develop Run tests
	${docker} ./vendor/bin/php-cs-fixer fix --diff --dry-run

sh: ##@develop Open shell in container
	${docker} sh
