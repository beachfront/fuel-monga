# fuel-monga
A FuelPHP Wrapper to Monga

# Monaga
Monga is a an abstraction layer for MongoDB communication.

You will have to include Monga in your composers require section

```json

"require": {
	...
    "league/monga": "1.1.0",
	...
}
```

## Usage
To include the wrapper in your composer file add the repo directory into your repositories section in the composer file and add the name of the module into the require section of the composer file.

```json
"repositories": {
	{ 
	  "type": "vcs", 
	  "url": "https://github.com/beachfront/fuel-monga.git"
	}
}

"require": {
	...
    "beachfront/fuelmonga": "dev-master"
	...
}
```



To properly use the MongaWrapper import/alias with the use operator and simply forge 


```php
<?php

use \FuelMonga\MongaWrapper;

$connection = MongaWrapper::forge([
	"server" => new \MongoClient('mongodb://mongodb0.example.com:27017'),
	"options" => array()
]);

``` 


## Credits
Monga was originaly developed by [thephpleague ](https://thephpleague.com/).

For more information about Monga and its usage checkout the [Github page](https://github.com/thephpleague/monga).
