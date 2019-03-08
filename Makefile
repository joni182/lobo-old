.PHONY: help test tests codecept fastcs fast cs phpcs doc docs \
	api guia guide install psql

help:      ## Muestra este mensaje de ayuda
	@echo "Uso: make [\033[36mcomando\033[0m]\n\nComandos:\n"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-10s\033[0m %s\n", $$1, $$2}'

test:      ## Ejecuta todos los tests y pasa CodeSniffer
tests:     ## Ídem
test tests: codecept phpcs

codecept:  ## Ejecuta los tests unitarios, funcionales y de aceptación
codecept:
	tests/run-acceptance.sh
	vendor/bin/codecept run || true
	tests/run-acceptance.sh -d

fastcs:    ## Ejecuta los tests unitarios y funcionales y pasa CodeSniffer
fastcs: fast cs

fast:      ## Ejecuta los tests unitarios y funcionales
fast:
	vendor/bin/codecept run unit,functional

cs:        ## Pasa CodeSniffer
phpcs:     ## Ídem
cs phpcs:
	vendor/bin/phpcs

doc:       ## Genera toda la documentación (guía + API)
docs:      ## Ídem
doc docs:
	guia/publish-docs.sh

api:       ## Genera sólo el API del proyecto
	guia/publish-docs.sh -a

guia:      ## Genera sólo la guía del proyecto
guide:     ## Ídem
guia guide:
	guia/publish-docs.sh -g

serve:     ## Arranca el servidor web integrado
	./yii serve

install:   ## Ejecuta la post-instalación
	composer install
	composer run-script post-create-project-cmd

psql:      ## Arranca una consola SQL en la BD principal
	db/psql.sh

psql_test: ## Arranca una consola SQL en la BD de pruebas
	db/psql.sh test
