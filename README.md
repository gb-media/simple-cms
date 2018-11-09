# SIMPLE CMS

This experimental project wants to be a simple CMS built with API Platform.

## Installing this project

    $ docker-compose up

This starts the following services:

| Name          | Description                                                   | Port(s) | Environment(s)
| ------------- | ------------------------------------------------------------- | ------- | --------------
| php           | The API with PHP, PHP-FPM 7.2, Composer and sensitive configs | n/a     | all
| db            | A PostgreSQL database server                                  | 5432    | all (prefer using a managed service in prod)
| client-react  | A development server for the Progressive Web App in ReactJS   | 80      | dev (use a static website hosting service in prod)
| admin         | A development server for the admin                            | 81      | dev (use a static website hosting service in prod)
| api           | The HTTP server for the API (Nginx)                           | 8080    | all
| cache-proxy   | A HTTP cache proxy for the API provided by Varnish            | 8081    | all (prefer using a managed service in prod)
| h2-proxy      | A HTTP/2 and HTTPS development proxy for all apps             | 443 (client-react)<br>444 (admin)<br>8443 (api)<br>8444 (cache-proxy) | dev (configure properly your web server in prod)
