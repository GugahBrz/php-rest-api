# social-media
A demonstration of an API based on Silex Framework to a small social-media application.

## Getting Started
Install Dependencies
```
$ composer install
```
> Create a mysql database for testing, the sample is found at: db / social_app.sql <br>
> Hint: You can configure the connection to the database through src / connect.php

## Basic Usage
Use curl or postman chrome extension to test the API

###### Parameters
* (int) ID_USER - User id reffer;
* (string) DATA - The text of the status update that will be posted;

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
-d '{"user":"ID_USER","post":"DATA"}' \
-i http://localhost/social-media/post
```
## Frameworks
* [Silex](http://silex.sensiolabs.org/ "Silex Framework") a PHP micro-framework based on the Symfony Components.
###### TODO
* Use [Doctrine DBAL](http://www.doctrine-project.org/ "Doctrine DBAL") Database Abstraction Layer (DBAL) to manage the database.

## Author
Gustavo Zanoni - 
[LinkedIn](https://br.linkedin.com/in/gustavo-zanoni-6371a791 "LinkedIn Link")
