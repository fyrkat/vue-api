.PHONY: dev

dev: vendor etc/vue-api.toml
	php -S '[::1]:1080' www/http.php -d error_reporting=E_ALL -d display_errors=1

vendor: composer.phar composer.json composer.lock
	php composer.phar self-update
	php composer.phar validate
	php composer.phar install

composer.phar:
	curl -O https://getcomposer.org/composer.phar

etc/vue-api.toml:
	cp etc/vue-api.dist.toml etc/vue-api.toml
