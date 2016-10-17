<?php
// die Konstanten auslagern in eigene Datei
// die dann per require_once ('dbsettings.php'); 
// geladen wird.
 
// Damit alle Fehler angezeigt werden
error_reporting(E_ALL);
 
// Zum Aufbau der Verbindung zur Datenbank

define ( 'MYSQL_HOST', 'localhost' );
 

define ( 'MYSQL_USER',  'admin_bubbles' );
define ( 'MYSQL_PASS',  '12345' );

define ( 'MYSQL_DB', 'bubbles' );

define ('MYSQL_PREFIX', 'cms_');


$dbprefix = "bubbles_";

$dbhost = "localhost";

$dbpassword = "12345";

$dbuser = "admin_bubbles";

$db = "bubbles";


?>