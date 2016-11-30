<?php
if($_SERVER['HTTP_HOST']=="yogs")
{
	$DBSERVER = "localhost";
	$DATABASENAME = "karma";
	$USERNAME = "root";
	$PASSWORD = "";
	$SITE_NAME="Karma - Game of Destiny";
	$SITE_TITLE="Welcome to Karma-Game of Destiny";
	$SITE_URL = "http://yogs/karma";
	$SITE_URL_MAIL = "http://yogs/karma/";
	$SECURE_URL = "https://yogs/karma";
}
else
{
	$DBSERVER = "localhost";
	$DATABASENAME = "karmathe_databox_karma";
	$USERNAME = "karmathe_KarmaAI";
	$PASSWORD = "Reality2012";
	$SITE_NAME="Karma - Game of Destiny";
	$SITE_TITLE="Welcome to Karma-Game of Destiny";
	$SITE_URL = "http://www.karmathegame.org/karmathegame/";
	$SITE_URL_MAIL = "http://www.karmathegame.org/karmathegame/";
	$SECURE_URL = "http://www.karmathegame.org/karmathegame/";
}	
?>