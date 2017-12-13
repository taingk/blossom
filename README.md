# Projet Annuel

<br>

### Développeurs

<br>

- Enzo HUYNH <br>
@EnzoHuynh

<br>

- Lavan PREPANANTHA <br>
@lavan350

<br>

- Amandine RIPOLL <br>
@amandineripoll

<br>

- Kévin TAING <br>
@taingk

<br>

### Développement d'un CMS from scratch

<br>

Planification des tâches et objectifs grâce à [Trello](https://trello.com/b/ernITlk9/projet-annuel)

<br>

# Application

<br>

### Architecture du projet

<br>

- Volume sur container php:apache, c'est notre dossier <strong>racine</strong> pour notre projet.

<br>

```
~/app
```

<br>

- Contient notre database mysql sous forme de dump.

<br>

```
~/data
```

<br>

- Contient notre docker-compose.yml et dockerfile.

<br>

```
~/docker
```


<br>

- Script qui pull le projet à chaque webhooks.

<br>

```
~/github/pull.php
```


<br>

- Alias pour nos commandes.

<br>

```
~/Makefile
```

<br>

- Ce même fichier que vous lisez, documentation.

<br>

```
~/README.md
```

<br>

### Lancer notre projet

<br>

- Clone

<br>

```
git clone https://github.com/taingk/annuel.git && cd annuel
```

<br>

- Installer nodejs et npm

<br>

```
make nodejs
```

<br>

- Installer dépendances (comme node-sass)

<br>

```
make sass_install
```

<br>

- Compiler sass avec watch

<br>

```
make watch_sass
```

<br>

- Lancer le projet

<br>

```
make start
```

<br>

- Lancer en daemon

<br>

```
make daemon
```

<br>

- Arreter le projet (utile seulement si vous lancez en daemon)

<br>

```
make stop
```

<br>

- Logs php

<br>

```
make logs
```

<br>

- Dump MySQL dans ~/data

<br>

```
make dump
```

<br>

- Restore la bdd depuis ~/data/backup.sql dans le container mysql\_projet_annuel

<br>

```
make restore
```

<br>

- Restart apache

<br>

```
make r_apache
```

<br>

### En local une fois docker lancé

<br>

- Serveur apache

<br>

```
http://localhost:5000/
```

<br>

- Phpmyadmin

<br>

```
http://localhost:5001/
```

<br>

- Logs des requêtes MySQL

<br>

1. On rentre dans le container MySQL
```
docker exec -ti mysql_projet_annuel mysql -u root --password=root
```
2. On regarde ou sont stockés les données de log et on copie l'url dans la colonne general\_log_file
```
SHOW VARIABLES LIKE "general_log%";
[copier url de la colonne general_log_file]
```
3. On active les logs et on quitte le container MySQL
```
SET GLOBAL general_log = 'ON';
[quitter mysql avec ctrl + d]
```
4. Affichage des logs en temps réel
```
docker exec -ti mysql_projet_annuel tail -f [url copié]
```

<br>

### MySQL connexion

<br>

```
host   : mysql_projet_annuel
user   : root
pass   : root
dbname : app
```
