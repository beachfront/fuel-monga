<?php
	Autoloader::add_core_namespace('Snappy');
	Autoloader::add_core_namespace('Knp\Snappy');
	Autoloader::add_classes(array(
		'Monga'								=> __DIR__.'/classes/Monga.php',
		'League\\Monga'						=> __DIR__.'/classes/Monga/src/League/Monga.php',
		'League\\Monga\\Collection'			=> __DIR__.'/classes/Monga/src/League/Monga/Collection.php',
		'League\\Monga\\Connection'			=> __DIR__.'/classes/Monga/src/League/Monga/Connection.php',
		'League\\Monga\\Cursor'				=> __DIR__.'/classes/Monga/src/League/Monga/Cursor.php',
		'League\\Monga\\Database'			=> __DIR__.'/classes/Monga/src/League/Monga/Database.php',
		'League\\Monga\\Filesystem'			=> __DIR__.'/classes/Monga/src/League/Monga/Filesystem.php',
		'League\\Monga\\Cursor'				=> __DIR__.'/classes/Monga/src/League/Monga/Cursor.php',
		'League\\Monga\\Query\\Aggregation'	=> __DIR__.'/classes/Monga/src/League/Monga/Query/Aggregation.php',
		'League\\Monga\\Query\\Builder'		=> __DIR__.'/classes/Monga/src/League/Monga/Query/Builder.php',
		'League\\Monga\\Query\\Computer'	=> __DIR__.'/classes/Monga/src/League/Monga/Query/Computer.php',
		'League\\Monga\\Query\\Find'		=> __DIR__.'/classes/Monga/src/League/Monga/Query/Find.php',
		'League\\Monga\\Query\\Group'		=> __DIR__.'/classes/Monga/src/League/Monga/Query/Group.php',
		'League\\Monga\\Query\\Indexes'		=> __DIR__.'/classes/Monga/src/League/Monga/Query/Indexes.php',
		'League\\Monga\\Query\\Projection'	=> __DIR__.'/classes/Monga/src/League/Monga/Query/Projection.php',
		'League\\Monga\\Query\\Remove'		=> __DIR__.'/classes/Monga/src/League/Monga/Query/Remove.php',
		'League\\Monga\\Query\\Update'		=> __DIR__.'/classes/Monga/src/League/Monga/Query/Update.php',
		'League\\Monga\\Query\\Where'		=> __DIR__.'/classes/Monga/src/League/Monga/Query/Where.php',
	));