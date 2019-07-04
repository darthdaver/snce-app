Open a terminal and move to the directory of the application.

Execute the following commands:

- docker-compose build
- docker-compose up --force-recreate --build

Open another terminal and move on type the following commands:

- docker exec -it snce-app /bin/bash
- ./bin/console doctrine:database:create
- bin/console doctrine:schema:update --force



