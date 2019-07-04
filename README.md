# snce-app
S'nce Group Coding Challenge

Open a terminal and move to the directory of the application (that contains the Dockerfile and the docker-compose.yml file).

Execute the following commands:

- docker-compose up --force-recreate --build

Open another terminal and type the following commands:

- docker exec -it snce-app /bin/bash
- ./bin/console doctrine:database:create
- bin/console doctrine:schema:update --force

Finally, open a browser and go to address:

- localhost:8080
