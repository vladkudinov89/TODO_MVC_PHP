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
docker exec app-frontend yarn install
docker exec app-frontend yarn run watch
```
## Usage

To start your containers you have only type next command:
```
make docker-up