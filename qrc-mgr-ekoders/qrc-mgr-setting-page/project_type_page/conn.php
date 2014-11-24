<?php

$conn = @mysql_connect('localhost','root','root');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $conn);
mysql_select_db('osbuilding_db', $conn);

?>