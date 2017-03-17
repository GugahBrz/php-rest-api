# social-media
An API to a social-media

## Getting Started
Install the latest version of dependencys
```
$ composer install
```
Create a mysql database for testing, the sample is found at: db / social_app.sql
>Hint: You can configure the connection to the database through src / connect.php

## Basic Usage
Use curl or postman extension to validate API requests

###### GET Feed
```
$ curl -i http://localhost/social-media/feed/ID_USER
```

###### GET Friends
```
$ curl -i http://localhost/social-media/friends/ID_USER
```

###### POST Status
```
$ curl -X POST -H "Content-Type: application/json" \
-d '{"user":"ID_USER","post":"NEW_STATUS"}' \
-i http://localhost/social-media/post
```
## Frameworks
* [Silex](http://silex.sensiolabs.org/ "Silex Framework") a PHP micro-framework based on the Symfony Components.
###### In Comming...
* [Doctrine DBAL](http://www.doctrine-project.org/ "Doctrine DBAL") Database Abstraction Layer (DBAL).

## Author
Gustavo Zanoni - gutavato@gmail.com -
[LinkedIn](https://br.linkedin.com/in/gustavo-zanoni-6371a791 "LinkedIn Link")
