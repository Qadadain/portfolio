```bash
docker compose up -d # build containers if never run before and run the project (--build to rebuild)

docker compose exec web npm ci # install node modules
docker compose exec web composer install # install php dependencies

docker compose exec web php bin/console cache:clear # clear symfony's cache
docker compose exec web php bin/console doctrine:migration:migrate --no-interaction # migrate database

docker compose exec web npm run watch # regenerates assets during development (will not release the terminal)
docker compose exec web npm run build # generates assets as done for the production

docker compose exec web vendor/bin/php-cs-fixer fix # fix php code style
```