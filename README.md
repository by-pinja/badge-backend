# What is this?

Badge JSON API which is build on top of [Silex](http://silex.sensiolabs.org/) framework.

## Main points
* This is just an API, nothing else

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

## Contributing
Please see the [CONTRIBUTING.md](CONTRIBUTING.md) file for guidelines.

## Author
[Tarmo Leppänen](https://github.com/tarlepp)

## LICENSE

[The MIT License (MIT)](LICENSE)

Copyright (c) 2016 Protacon Solutions
