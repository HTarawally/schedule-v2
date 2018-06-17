<?php
	require_once("includes/config.php");
	require_once("includes/functions.php");
?>

<!doctype html>
<html>
	<head lang="en">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	    <title>Schedule</title>

	    <link rel="stylesheet" href="css/structure.css" />
	    <link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/media.css" />

	    <script src="jquery-3.1.1.min.js"></script>
	    <script src="script.js"></script>
	</head>

  <body>
  	<div id="wrapper">

			<?php
				if(isset($_GET["error"])) {
					echo "<p id='error'>Could not perform operation. Time slot unavailable.</p>";
				}
			 ?>

	 		<!-- display page header with time at the top -->
	    <header class="container seperated">
				<?php

					for($n=$minHours; $n <= $maxHours; $n++)
					{
						echo "<div class='col col1of12'>$n</div>";
					}

	    	?>
	    </header>

      <!-- entering main content -->
    	<main class="container seperated">
      	<?php
					// display schedule fore each day
					foreach($days as $thisDay) {
						echo "<div class='container seperated'>";
							echo "<h1 class='col'>" . ucfirst($thisDay) . "</h1>";	// show day

							// get schedule info
							$getInfo = "SELECT * FROM times WHERE day = '$thisDay'";
                    		$queryInfo = mysqli_query($dbconnect, $getInfo) or die("Could not get schedule information from database.");

							// show schedule
							echo "<div class='col field'>";
								while($showInfo = mysqli_fetch_assoc($queryInfo)) {
									showSlot($showInfo["ID"], $showInfo["title"], $showInfo["start"], $showInfo["duration"]);
								}
							echo "</div>";
						echo "</div>";
					}
				?>
    	</main>

			<!-- entering forms section -->
			<div id="console" class="seperated container">
	    	<!-- forms section header -->
    		<div id="misc" class="seperated container">
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>">Refresh</a>
            <a href="index.php?clear">Clear All</a>

            <p>Time Left: <?php echo timeLeft() ?> Hours</p>

            <button type="button" onclick="window.location='index.php?go'">Delete All</button>
        </div>

        <hr />

				<div id="formHolder" class="container seperated">
		        <!-- add new item form -->
		        <?php require("forms/additem.php") ?>

		        <!-- if an item is to be modified somehow, display the modifying forms -->
		        <?php
		            if(isset($_GET["edit"])) {
		                require_once("forms/all.php");
		            }
		        ?>
	      </div>
			</div>
			<!-- end forms section -->

		</div>
	</body>
</html>
