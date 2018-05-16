EXEC?=docker-compose exec server

.DEFAULT_GOAL := help

help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'


start: up vendor db-install																																										## Install and start the project

stop:                                                                                                  				## Remove docker containers
	docker-compose down --rmi all

reset: stop start																																															##Restart te project


clean:                                                                                         								## Clear and remove dependencies
	rm -rf vendor

db-install:																																																		## (Re)Install the data model
	$(EXEC) php setup/db-schema.php

load-fixtures:																																																## Load data fixtures
	$(EXEC) php setup/db-fixtures.php


tty:                                                                                                   				## Run app container in interactive mode
	$(RUN) /bin/bash


vendor:
	$(EXEC) composer install

up:
	docker-compose up -d --remove-orphans

db:
	$(EXEC) php setup/db-schema.php

fixtures:
	$(EXEC) php setup/db-fixtures.php
