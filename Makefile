lint:
	./vendor/bin/phpcs src --standard=PSR2

test:
	./vendor/bin/phpunit tests

check: lint test
