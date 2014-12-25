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

composer.phar:
	wget http://getcomposer.org/installer -O - | php

report:
	bin/phploc src/
	bin/phpcpd src/
	bin/phpmd src/ text phpmd-rules.xml

.PHONY: all pull upload install install-ssh report
