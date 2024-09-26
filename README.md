# lab-synelia
Ce projet avait pour but de configurer un environnement de développement basé sur Docker, intégrant deux sites web interactifs avec une base de données MariaDB et un reverse proxy Traefik. Les sites permettent la gestion et la visualisation de données via une interface web, avec une gestion simplifiée des DNS grâce aux adresses locales http://mysite1.lan et http://mysite2.lan

Toutes la documentation et le processus de résolution du lab est disponible **[ici](#)**

## Ajouter les DNS dans /etc/hosts
```
sudo echo "127.0.0.1 mysite1.lan" >> /etc/hosts
sudo echo "127.0.0.1 mysite2.lan" >> /etc/hosts
```

## Construire et démarrer les conteneurs en arrière-plan
```
docker-compose up -d
```

## Vérifier que les conteneurs sont bien démarrés
```
docker ps
```

## Arrêter les conteneurs en cours d'exécution
```
docker-compose down
```
