<?php
	require_once("../includes/config.php");
	require_once("../includes/functions.php");

	// find information about selected item
	$ID = $_GET["edit"];
	$findItem = "SELECT day, title, start, duration FROM times WHERE ID='$ID'";
	$queryfindItem = mysqli_query($dbconnect, $findItem);
	$resultfindItem = mysqli_fetch_assoc($queryfindItem);

	// include edit item form
	require_once("edititem.php");

	// include delete item form
	require_once("deleteitem.php");

	// include mark as finished form
	require_once("markitem.php");
?>
