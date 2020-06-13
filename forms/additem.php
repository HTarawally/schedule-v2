<?php
	if(isset($_GET["edit"])) {
		require_once("../includes/config.php");
		require_once("../includes/functions.php");
	}
?>

<form action="index.php?add=1" method="post" class="col col3of12">
    <fieldset>
        <legend>Add New Item</legend>

        <div class="container seperated">
            <label for="day" class="col col4of12">Day:</label>

            <div class="col col8of12">
                <select name="day" id="day">
                    <?php
                        foreach($days as $dayOfWeek) {
                            echo "<option value='$dayOfWeek'>" . ucfirst($dayOfWeek) . "</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="container seperated">
            <label for="title" class="col col4of12">Title:</label>
            <div class="col col8of12"><input type="text" name="title" id="title" /></div>
        </div>

        <div class="container seperated">
            <label for="start" class="col col4of12">Start Time:</label>

            <div class="col col8of12">
                <select name="start" id="start">
                    <?php for($n=1; $n<=11; $n++) echo "<option value='$n'> $n </option>\n" ?>
                </select> pm
            </div>
        </div>

        <div class="container seperated">
            <label for="duration" class="col col4of12">Duration:</label>

            <div class="col col8of12">
                <select name="duration" id="duration">
                    <?php for($n=1; $n<=3; $n++) echo "<option value=\"$n\"> $n </option>\n" ?>
                </select> hour(s)
            </div>
        </div>

        <input type="submit" value="Add Item" />
    </fieldset>
</form>
