<?php
	if(isset($_GET["add"]))
	{
		$day = $_POST["day"];
		$title = trim(strip_tags($_POST["title"]));
		$start = $_POST["start"];
		$duration = $_POST["duration"];

		if(checkAvailability($day, $start, $duration) == 1)
		{
			$addItem = "INSERT INTO times VALUES (null,'$day','$title','$start','$duration')";
			$queryItem = mysqli_query($dbconnect,$addItem) or die("Could not add item to database");
		}
		else
		{
			travelTo("index.php?error");
		}

		travelTo("index.php");
	}
	else if(isset($_GET["confirmEdit"]))
	{
		$ID=$_GET["confirmEdit"];
		$day=$_POST["day"];
		$title=trim(strip_tags($_POST["title"]));
		$start=$_POST["start"];
		$duration=$_POST["duration"];

		if(checkAvailability($day, $start, $duration, $ID) == 1) {
			$editItem="UPDATE times SET day='$day', title='$title', start='$start', duration='$duration' WHERE ID='$ID'";
			$queryeditItem=mysqli_query($dbconnect,$editItem);
		}
		else
		{
			travelTo("index.php?error");
		}

		travelTo("index.php");
	}
	else if(isset($_GET["delete"]))
	{
		$ID=$_GET["delete"];
		$day=$_POST["day"];
		$title=trim(strip_tags($_POST["title"]));
		$start=$_POST["start"];
		$duration=$_POST["duration"];

		$send="INSERT INTO deletedTimes VALUES ('$ID', '$day', '$title', '$start', '$duration')";
		$querysend=mysqli_query($dbconnect,$send);

		$delete="DELETE FROM times WHERE ID='$ID'";
		$querydelete=mysqli_query($dbconnect,$delete);

		travelTo("index.php");
	}
	else if(isset($_GET["mark"]))
	{
		$ID=$_GET["mark"];

		$search="SELECT finished FROM done WHERE ID='$ID'";
		$querysearch=mysqli_query($dbconnect,$search);
		$resultsearch=mysqli_fetch_assoc($querysearch);

		if(isset($_POST["mark"]))
		{
			$done=$_POST["mark"];
			if($resultsearch["finished"]==NULL)
			{
				$InsertDone="INSERT INTO done VALUES ('$ID', 'Y', '$today')";
				$QueryInsertDone=mysqli_query($dbconnect, $InsertDone);
			}
			else
			{
				$EditDone="UPDATE done SET finished='Y', date='$today' WHERE ID='$ID'";
				$QueryEditDone=mysqli_query($dbconnect,$EditDone);
			}
		}
		else
		{
			if($resultsearch["finished"]==NULL)
			{
				$InsertDone="INSERT INTO done VALUES ('$ID', 'N', '$today')";
				$QueryInsertDone=mysqli_query($dbconnect, $InsertDone);
			}
			else
			{
				$EditDone="UPDATE done SET finished='N', date='$today' WHERE ID='$ID'";
				$QueryEditDone=mysqli_query($dbconnect,$EditDone);
			}
		}

		travelTo("index.php");
	}
	else if(isset($_GET["clear"]))
	{
		$clear="UPDATE done SET finished='N', date='$today'";
		$queryclear=mysqli_query($dbconnect, $clear);

		travelTo("index.php");
	}
	else if(isset($_GET["go"]))
	{
		deleteAll();
	}

	?>

	<?php

	// function that shows a task on the schedule field
	function showSlot($myID, $myTitle, $myStart, $myDuration) {
		global $dbconnect;

		// determine if the task has been accomplished
		$sql = "SELECT finished FROM done WHERE ID = '$myID'";
		$query = mysqli_query($dbconnect, $sql);
		$result = mysqli_fetch_assoc($query);

		$finished = $result["finished"] == NULL ? 'N' : $result["finished"];

		// display task
		echo "<a class='task";
		echo ($finished == 'Y' ? " finished" : "");
		echo " duration" . $myDuration;
		echo " start" . $myStart . "'";
		echo " href='index.php?edit=" . $myID . "'";
		echo " title='" . $myTitle . "'>";
			echo $myTitle;
		echo "</a>";
	}

	// function that works out how length left for this week
	function timeLeft()
	{
		global $dbconnect;
		$timeleft = 0;

		$function = "SELECT ID, duration from times";
		$queryfunction = mysqli_query($dbconnect, $function);

		while($resultfunction = mysqli_fetch_assoc($queryfunction))
		{
			$savedId = $resultfunction["ID"];
			$savedDuration = $resultfunction["duration"];
			$newfunction = "SELECT finished FROM done WHERE ID = '$savedId'";
			$newquery = mysqli_query($dbconnect, $newfunction);

			if($newResult = mysqli_fetch_assoc($newquery))
			{
				if($newResult['finished'] == 'N')
				{
					$timeleft += $savedDuration;
				}
			}
			else
			{
				$timeleft += $savedDuration;
			}
		}

		return $timeleft;
	}

	function checkAvailability($checkDay, $checkTime, $checkDuration, $id = 0)
	{
		global $dbconnect;
		global $maxHours;

		$checkItem = "SELECT start, duration FROM times WHERE day='$checkDay'";
		if($id > 0) $checkItem .= " AND ID!='$id'";

		$queryCheckItem = mysqli_query($dbconnect, $checkItem);

		while($resultCheckItem = mysqli_fetch_assoc($queryCheckItem))
		{
			$taskStart = $resultCheckItem["start"];
			$taskEnd = $taskStart + $resultCheckItem["duration"];

			for($i = 0; $i <= $checkDuration; $i++) {
				$compareTime = $checkTime + $i;

				if($compareTime == $taskStart || $compareTime == $taskEnd || $compareTime > $maxHours) {
					if($taskEnd != $checkTime && $checkTime + $checkDuration != $taskStart)
						return 0;
				}
			}
		}

		return 1;
	}

	function deleteAll()
	{
		global $dbconnect;

		$deleteTimes="DELETE * FROM times";
		$deleteDone="DELETE * FROM done";
		$deleteDeletedTimes="DELETE * FROM deletedtimes";

		mysqli_query($dbconnect,$deleteTimes);
		mysqli_query($dbconnect,$deleteDone);
		mysqli_query($dbconnect,$deleteDeletedTimes);

		travelTo("index.php");
	}

	function travelTo($location) {
		echo "<script type=\"text/javascript\"> document.location=\"$location\" </script>";
	}
?>
