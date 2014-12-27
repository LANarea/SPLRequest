<?php
return [
	'server_ip' => '0.0.0.0', // Domain name or IP address of SPL Studio server
	'server_port' => 0, // Port# assigned in SPL Studio to listen for commands
	
	// The script should work using the defaults below, but they may be edited.
	'name_field' => 1, // Request listener name: 0=no, 1=yes, 2=required
	'location_field' => 1, // Request location: 0=no, 1=yes, 2=required
	'expire' => 0, // Request location: 0=no, 1=yes, 2=required
	'requestsperhour' => 150, // Max number of requests allowed per hour for each listener
	'requestsperday' => 1000, // Max number of requests allowed per day for each listener
	'rebuild_interval' => 0, // Hours between local library rebuilds. 0=disabled/manual
	'use_database' => 0, // Use the database, or files. 0=disabled (files, see 'libdir'), 1=enabled (database, see 'database_credentials')
	'database_credentials' => [
		'db_host' => 'localhost',
		'db_username' => 'username',
		'db_password' => 'password',
		'db_database' => 'radiostationx',
		'db_table' => 'songs'
	],
	'libdir' => "library", // Directory containing library files. Empty string "" to disable.
	'banfile' => "ipban.list", // Name of ban file (optional). One IP per line.
];