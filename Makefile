all: pull upload install-ssh

pull:
	git pull

upload:
	rsync -avC --exclude=app/config/parameters.yml . tonic@rico:/var/www/tonic-test.de.co.ua

install-ssh:
	ssh tonic@rico "cd /var/www/tonic-test.de.co.ua; make install"

install: composer.phar
	./composer.phar install
	app/console cache:clear --env=prod
	app/console doctrine:migrations:migrate --no-interaction

composer.phar:
	wget http://getcomposer.org/installer -O - | php

report:
	bin/phploc src/
	bin/phpcpd src/
	bin/phpmd src/ text phpmd-rules.xml

cs-fix:
	bin/php-cs-fixer fix src/ --level=psr2

.PHONY: all pull upload install install-ssh report cs-fix
