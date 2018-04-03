.PHONY: help

# self-documented makefile, thanks to the Marmelab team
# see http://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

# environments configuration, thanks to Julien Bianchi
# see https://speakerdeck.com/jubianchi/make-is-an-actual-task-runner
ISF_DB ?= isf

docker-up: ## start docker containers
	@docker-compose up -d

docker-stop: ## stop docker containers
	@docker-compose stop

docker-php: ## login to the docker's php container
	@docker exec -u www-data -ti isf_fpm bash

docker-psql: ## logs into the docker's database container and connects to postegresql
	@docker exec -ti isf_database psql -U $(ISF_DB) $(ISF_DB)

docker-pgdump: ## dump your database into sdtout (binary)
	@docker exec -i isf_database pg_dump -U $(ISF_DB) -Fc $(ISF_DB)

docker-pgrestore: ## load data form sdtin
	@docker exec -i isf_database pg_restore -U $(ISF_DB) -d $(ISF_DB) --clean -v

schema-create: ## create database schema
	@cat var/sql/schema.sql|docker exec -i isf_database psql -U $(ISF_DB) -d $(ISF_DB)

fixtures: schema-create ## create some fixtures
	@cat var/sql/fixtures.sql|docker exec -i isf_database psql -U $(ISF_DB) -d $(ISF_DB)
