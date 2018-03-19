node_install:
	sudo apt-get install nodejs npm && sudo npm i -g npm && cd app/sass/ && sudo npm install
sass:
	cd app/sass/ && npm run watch
start:
	docker-compose -f docker/compose/docker-compose.yml up --build
daemon:
	docker-compose -f docker/compose/docker-compose.yml up -d --build
stop:
	docker-compose -f docker/compose/docker-compose.yml down
logs:
	docker logs -f apache_projet_annuel
dump:
	mysqldump -uroot -p app > data/backup.sql && cat data/backup.sql | mysql -uroot -p app
restore:
	cat data/backup.sql | mysql -uroot -p app
r_apache:
	docker exec apache_projet_annuel service apache2 restart
pull:
	git pull && cp ../config/conf.inc.php app/conf.inc.php && cp ../config/Makefile .
