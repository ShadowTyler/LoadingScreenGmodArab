<?php

##################################
#                                #
#          BinScripts            #
#    -----------------------     #
#	 Quality before Quantity     #
#                                #
##################################

# Author:  Bin4ry
# Version: 1.1
# Website: BinScripts.com

// MySQL Database Connection

$file = file_get_contents('settings/darkrp.json');

$data = json_decode($file, true);

$CONFIG = array(
	'ENABLED'    => $data['enabled'], // Determines if the Database Connection is activated or not
	'DB_HOST'    => $data['dbhost'],  // Database Hostname
	'DB_USER'    => $data['dbuser'],  // Database Username
	'DB_PASS'    => $data['dbpass'],  // Database Password
	'DB_DBNAME'  => $data['dbname'],  // Database Name
	'DB_CHARSET' => $data['charset']  // Database Charset
);


$file2 = file_get_contents('settings/general.json');

$data2 = json_decode($file2, true);


// General Server Settings
$SETTINGS = array(
	'API_KEY'     => $data2['api_key'],    // SteamAPI Key can be found here: http://steamcommunity.com/dev/apikey
	'SERVER_NAME' => $data2['server_name'] // Set your Server Name here
);



// Set Rules for your server here
$RULES = array(
	1 => $data2['rule1'],
	2 => $data2['rule2'],
	3 => $data2['rule3'],
	4 => $data2['rule4'],
	5 => $data2['rule5'],
	6 => $data2['rule6']
);

?>