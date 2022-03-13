# Installation

1. run ./init.sh - this will install composer dependencies and copy the env file. This script will also be run as a service under the next command.
2. run docker-compose up -d <- starts the services defined in 'docker-compose.yml'
3. run: docker-compose run --rm node npm install