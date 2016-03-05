# What is this?
[![License](http://img.shields.io/:license-mit-blue.svg)](LICENSE)
[![GitHub version](https://badge.fury.io/gh/ProtaconSolutions%2Fbadge-backend.svg)](https://badge.fury.io/gh/ProtaconSolutions%2Fbadge-backend)
[![Dependency Status](https://www.versioneye.com/user/projects/56d4b8330a4ec127393b476f/badge.svg?style=flat)](https://www.versioneye.com/user/projects/56d4b8330a4ec127393b476f)

Badge JSON API which is build on top of [Silex](http://silex.sensiolabs.org/) framework.

## Main points
- [x] Configuration for each environment and/or developer
- [x] Authentication via JWT
- [x] "Automatic" API doc generation
- [x] Database connection (Doctrine dbal + orm)
- [x] Console tools (dbal, migrations, orm)
- [ ] Basic API for badges
- [ ] Basic API for badge groups
- [ ] Basic API for images
- [ ] And all the rest...

## Requirements
* PHP 5.5.x
* Apache / nginx / IIS / Lighttpd see configuration information [here](http://silex.sensiolabs.org/doc/web_servers.html) 

## Development
* Use your favorite IDE and get checkout from git
* Open terminal, go to folder where you make that checkout and run following commands

```bash
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install
```

## Installation
* Open terminal and clone this repository to your server
* Create web-server configuration which points to ```web``` folder

### Configuration
Add your ```local.yml``` configuration file to some (or all) following directories:
 * ```resources/config/common```
 * ```resources/config/dev```
 * ```resources/config/prod```

Within this file you can override any environment or common configuration value as you like. Basically first thing to
do is define _your_ database settings - without these you can't basically do anything...

### Database initialization
This can be done with following command:
```
./bin/console migrations:migrate
```

### Possible "failures"
* Missing ```var``` directory? Create it and check that it has proper write access in other words just do ```chmod 777 var``` 

## Nice to know things
```GET http://yoururl/_dump```
* generates pimple.json for autocomplete 
* See [this](https://github.com/Sorien/silex-pimple-dumper) for more info

```./bin/console orm:convert:mapping --from-database --namespace="App\\Entities\\" annotation ./src``` 
* Generate Doctrine entities from database

## Docker
This project has also [Docker](https://www.docker.com/) container that you can use. Actual [Dockerfile](Dockerfile) uses [php:5.5-cli](https://github.com/docker-library/php/blob/8943e1e6a930768994fbc29f4df89d0a3fd65e12/5.5/Dockerfile) as the base image.

You can easily build your own docker image with following command
```
docker build -t yourimage .
```

And after that run that docker image by following command
```
docker run -t -i yourimage
```

With this docker image you can set following ENV variables to specify your database connection:
```
DATABASE_DB_OPTIONS_DRIVER  
DATABASE_DB_OPTIONS_HOST    
DATABASE_DB_OPTIONS_DBNAME  
DATABASE_DB_OPTIONS_USER    
DATABASE_DB_OPTIONS_PASSWORD
DATABASE_DB_OPTIONS_CHARSET
```

## Contributing
Please see the [CONTRIBUTING.md](CONTRIBUTING.md) file for guidelines.

## Author
[Tarmo Leppänen](https://github.com/tarlepp)

## LICENSE

[The MIT License (MIT)](LICENSE)

Copyright (c) 2016 Protacon Solutions
