<?php
	$today = date("Y/m/d h:i:s");
	$minHours = 1;
	$maxHours = 12;
	$days = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");

	define("DBHOST", "localhost");
	define("DBUSER", "stage");
	define("DBPASS", "-LOgzYrzDIr5!:_");
	define("DBNAME", "schedule_stage");

	$dbconnect = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME) or die("Could not connect to the database");

	$CreateTimes = "CREATE TABLE times (
		ID int(255) NOT NULL auto_increment,
		day varchar(10) NOT NULL,
		title varchar(50) NOT NULL,
		start int(3) NOT NULL,
		duration int(3) NOT NULL,
		Primary Key(ID)
	)";

	$CreateDeletedTimes = "CREATE TABLE deletedTimes (
		ID int(255) NOT NULL,
		day varchar(10) NOT NULL,
		title varchar(50) NOT NULL,
		start int(3) NOT NULL,
		duration int(3) NOT NULL,
		Primary Key(ID)
	)";

	$CreateDone = "CREATE TABLE done (
		ID int(255) NOT NULL,
		finished char(1) NOT NULL,
		date datetime NOT NULL,
		Primary Key(ID)
	)";

	// $SendTimes = mysqli_query($dbconnect, $CreateTimes);
	// $SendDeletedTimes = mysqli_query($dbconnect, $CreateDeletedTimes);
	// $SendDone = mysqli_query($dbconnect, $CreateDone);
?>
