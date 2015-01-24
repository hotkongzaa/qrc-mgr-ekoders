<?php

$conf = parse_ini_file("../../model-db-connection/configuration.ini");
$conn = @mysql_connect($conf['dataBaseDomain'], $conf['dataBaseUsername'], $conf['dataBasePassword']);
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $conn);
mysql_select_db($conf['dataBaseName'], $conn);
