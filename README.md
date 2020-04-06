##TODO-APP-PHP

## Getting started

Install the following packages prior to standing up your development environment:

- [Git](https://git-scm.com/)
- [docker](https://docs.docker.com/engine/installation/)
- [docker-compose](https://docs.docker.com/compose/install/)

Set your .env vars and then type:
```
git clone <this_repo>
cp .env.example .env
docker-compose up -d
docker-compose exec php-cli composer install
docker-compose exec php-fpm php vendor/bin/phinx migrate
docker exec app-frontend yarn install
docker exec app-frontend yarn run watch
docker-compose exec php-fpm php vendor/bin/phinx seed:run
```
## Usage

To start your containers you have only type next command:
```
make docker-up
```
Make sure that upload directory have permission.
```
sudo chmod -R 777 upload
```
Before login in project. Route `http://localhost:8080/user/login`:
`login`: admin@email.com
`password`: password

To stop your containers you have only type next command:
```
make docker-down
```
