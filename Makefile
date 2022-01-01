SHELL=/bin/bash

args = `arg="$(filter-out $@,$(MAKECMDGOALS))" && echo $${arg:-${1}}`

php-container=dennis-ivy-backend_php_1


phinx-rollback:
	docker exec ${php-container} sh ./phinx rollback 

phinx-create:
	docker exec ${php-container} sh ./phinx create	$(call args, defaultstring)

phinx-migrate:
	docker exec ${php-container} sh ./phinx migrate

phinx-seed-create:
	docker exec ${php-container} sh ./phinx seed:create	$(call args, defaultstring)

phinx-seed-run:
	docker exec ${php-container} sh ./phinx seed:run 

slim-cli:
	docker exec ${php-container} php slim-cli $(call args, defaultstring)

serve:
	docker-compose up -d server

run:
	docker-compose run --rm $(call args, defaultstring)

down:
	docker-compose down 