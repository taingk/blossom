nodejs:
	sudo apt-get install nodejs npm
sass_install:
	cd app/sass/ && npm install
watch_sass:
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
	docker exec mysql_projet_annuel /usr/bin/mysqldump -u root --password=root app > data/backup.sql && cat data/backup.sql | docker exec -i mysql_projet_annuel /usr/bin/mysql -u root --password=root app
restore:
	cat data/backup.sql | docker exec -i mysql_projet_annuel /usr/bin/mysql -u root --password=root app
r_apache:
	docker exec apache_projet_annuel service apache2 restart
