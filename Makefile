
#!/usr/bin/make
# Makefile readme (ru): <http://linux.yaroslavl.ru/docs/prog/gnu_make_3-79_russian_manual.html>
# Makefile readme (en): <https://www.gnu.org/software/make/manual/html_node/index.html#SEC_Contents>

SHELL = /bin/bash

.PHONY : help install shell init test test-cover up down restart clean
.DEFAULT_GOAL : help

# This will output the help for each task. thanks to https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
help: ## Show this help
	@printf "\033[33m%s:\033[0m\n" 'Available commands'
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z0-9_-]+:.*?## / {printf "  \033[32m%-18s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

shell: ## Start shell into app container
	./vendor/bin/sail shell

init: ## Make full application initialization
	./vendor/bin/sail artisan migrate --force --seed

up: ## Create and start containers
	./vendor/bin/sail up -d
	@printf "\n   \e[30;42m %s \033[0m\n\n" 'Navigate your browser to ⇒ http://localhost';

front-install:
	./vendor/bin/sail npm install

front-build:
	./vendor/bin/sail npm run prod

down: ## Stop containers
	./vendor/bin/sail down

restart: down up ## Restart all containers
