<form action="index.php?confirmEdit=<?php echo $ID; ?>" method="post" class="col col3of12">
    <fieldset>
        <legend>Edit Item #<?php echo $ID ?></legend>

        <div class="container seperated">
            <label for="day" class="col col4of12">Day:</label>

            <div class="col col8of12">
                <select name="day" id="day">
                    <?php
                        foreach($days as $dayOfWeek) {
                            echo "<option value='$dayOfWeek'";
                                if($resultfindItem["day"] == $dayOfWeek) echo " selected";
                            echo ">" . ucfirst($dayOfWeek) . "</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="container seperated">
            <label for="title" class="col col4of12">Title:</label>

            <div class="col col8of12">
                <input type="text" id="title" name="title" value="<?php echo $resultfindItem["title"] ?>" />                                </div>
        </div>

        <div class="container seperated">
            <label for="start" class="col col4of12">Start Time:</label>

            <div class="col col8of12">
                <select name="start" id="start">
                    <?php
                        for($n=1; $n<=11; $n++)
                        {
                            echo "<option value='$n'";
                            if($n == $resultfindItem["start"])
                            {
                                echo " selected";
                            }
                            echo "> $n </option>";
                        }
                    ?>
                </select> pm
            </div>
        </div>

        <div class="container seperated">
            <label for="duration" class="col col4of12">Duration:</label>

            <div class="col col8of12">
                <select name="duration" id="duration">
                    <?php
                        for($n=1; $n<=3; $n++)
                        {
                            echo "<option value='$n'";
                                if($n == $resultfindItem["duration"])
                                {
                                    echo " selected";
                                }
                                echo "> $n </option>";
                        }
                    ?>
                </select> hour(s)
            </div>
        </div>

        <input type="submit" value="Edit Item" />
    </fieldset>
</form>
