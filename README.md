# SIMPLE CMS

[![CircleCI](https://circleci.com/gh/toofff/simple-cms.svg?style=svg)](https://circleci.com/gh/toofff/simple-cms)

This experimental project wants to be a simple CMS built with API Platform.

## Installing this project

    $ docker-compose up

This starts the following services:

| Name                 | Description                                                       | Port(s)                       | Environment(s)
| -------------------- | ----------------------------------------------------------------- | ----------------------------- | --------------
| api                  | The HTTP server for the API (Nginx)                               | [8080](http://localhost:8080) | all
| api-php              | The API with PHP, PHP-FPM 7.2, Composer and sensitive configs     | n/a                           | all
| cache-proxy          | A HTTP cache proxy for the API provided by Varnish                | [8081](http://localhost:8081) | all (prefer using a managed service in prod)
| db                   | A PostgreSQL database server                                      | 5432                          | all (prefer using a managed service in prod)
| client-symfony       | The HTTP server for the website (Nginx)                           | [80](http://localhost:80)     | dev
| client-symfony-php   | The website with PHP, PHP-FPM 7.2, Composer and sensitive configs | n/a                           | all
| client-react         | A development server for the Progressive Web App in ReactJS       | [81](http://localhost:81)     | dev
| client-angular       | A development server for the Progressive Web App in Angular       | [82](http://localhost:82)     | dev
| client-vue           | A development server for the Progressive Web App in VueJS         | [83](http://localhost:83)     | dev
| admin                | A development server for the admin                                | [9080](http://localhost:9080) | dev
| h2-proxy             | A HTTP/2 and HTTPS development proxy for all apps                 | [443 (client-symfony)](https://localhost:443)<br>[444 (client-react)](https://localhost:444)<br>[445 (client-angular)](https://localhost:445)<br>[446 (client-vue)](https://localhost:446)<br>[8443 (api)](https://localhost:8443)<br>[8444 (cache-proxy)](https://localhost:8444)<br>[9443 (admin)](https://localhost:9443) | dev (configure properly your web server in prod)
