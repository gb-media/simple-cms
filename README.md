# SIMPLE CMS

This experimental project wants to be a simple CMS built with API Platform.

## Installing this project

    $ docker-compose up

This starts the following services:

| Name                 | Description                                                       | Port(s) | Environment(s)
| -------------------- | ----------------------------------------------------------------- | ------- | --------------
| client-symfony-php   | The website with PHP, PHP-FPM 7.2, Composer and sensitive configs | n/a     | all
| php                  | The API with PHP, PHP-FPM 7.2, Composer and sensitive configs     | n/a     | all
| db                   | A PostgreSQL database server                                      | 5432    | all (prefer using a managed service in prod)
| client-symfony       | The HTTP server for the website (Nginx)                           | 80      | all
| client-react         | A development server for the Progressive Web App in ReactJS       | 81      | dev (use a static website hosting service in prod)
| client-angular       | A development server for the Progressive Web App in Angular       | 82      | dev (use a static website hosting service in prod)
| client-vue           | A development server for the Progressive Web App in VueJS         | 83      | dev (use a static website hosting service in prod)
| admin                | A development server for the admin                                | 90      | dev (use a static website hosting service in prod)
| api                  | The HTTP server for the API (Nginx)                               | 8080    | all
| cache-proxy          | A HTTP cache proxy for the API provided by Varnish                | 8081    | all (prefer using a managed service in prod)
| h2-proxy             | A HTTP/2 and HTTPS development proxy for all apps                 | 443 (client-symfony)<br>444 (client-react)<br>445 (client-angular)<br>446 (client-vue)<br>493 (admin)<br>8443 (api)<br>8444 (cache-proxy) | dev (configure properly your web server in prod)
