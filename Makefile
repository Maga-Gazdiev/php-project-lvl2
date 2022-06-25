install:
	     composer install
genDiff:
	     ./bin/gendiff 
validate:
	     composer validate 
lint:
		composer exec --verbose phpcs -- --standard=PSR12 src bin
fix:
		 phpcbf -p -s -v -n . --extensions=php
test:
		vendor/bin/phpstan analyse -l 9 src