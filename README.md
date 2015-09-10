# fuel-monga
A FuelPHP Wrapper to Monga

# Monaga
Monga is a an abstraction layer for MongoDB communication.

You will have to include Monga in your composers require section

```javascript
"require": {
	...
	"league/monga": "1.1.0",
	...
}
```

## Usage
To include the wrapper in your composer file add the repo directory into your repositories section in the composer file and add the name of the module into the require section of the composer file.

```javascript
"repositories": {
	...
	{ 
	  "type": "vcs", 
	  "url": "https://github.com/beachfront/fuel-monga.git"
	}
	...
}

...

"require": {
	...
	"beachfront/fuelmonga": "dev-master"
	...
}
```



To properly use the Monga wrapper import/alias with the use operator and simply forge FuelMonga.


```php
<?php

use \FuelMonga\FuelMonga;

// Get a connection
$connection = FuelMonga::forge();

// Get the database
$database = $connection->database('db_name');

// Get a collection ...

``` 

If you want to go and change your dsn or option values for your connection you can simply reforge with those values.

```php
...

$connection = FuelMonga::forge(array(
		'dsn' => 'mongodb://mongo1.example.com:27017',
		"options" => array(
			"connectTimeoutMS" => 5000,
			"replicaSet" => "rs",
			"readPreference" => \MongoClient::RP_SECONDARY_PREFERRED
		)));

```

In the app/config folder of FuelPHP create a db.php file that contains your DSN and all of your options for your Monga Connection.

```php
<?php

return array(
	'monga' => array(
		'dsn' => 'mongodb://mongo1.example.com:27017',
		"options" => array(
			"connectTimeoutMS" => 5000,
			"replicaSet" => "rs",
			"readPreference" => \MongoClient::RP_SECONDARY_PREFERRED
		)
	)
);
```

## Credits
Monga was originaly developed by [thephpleague ](https://thephpleague.com/).

For more information about Monga and its usage checkout the [Github page](https://github.com/thephpleague/monga).
