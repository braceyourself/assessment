# Installation

1. Make sure you have docker and docker-compose installed on your system
2. Run ./init.sh - this will install composer dependencies and copy the env file. Check out the file and make chages as necessary
3. (optional) copy the docker-compose.override.yml.example. This includes a simple node server service that will automatically compile your assets (watcher or hmr) (note: this depends on node_modules being preset.)
4. Run 'docker-compose up -d'
   1. Starts the services defined in 'docker-compose.yml' + 'docker-compose.override.yml'
   1. If there are any errors, they're probably related to ports already being used. Change the left-most port in the service in question to use something else.
5. You should be able to access the page at localhost:8000 (or the specified port on the nginx service)
   1. app: http://localhost:8000/
   2. horizon: http://localhost:8000/horizon
   3. mailhog: http://localhost:8025
