<form action="index.php?mark=<?php echo $ID; ?>" method="post" class="col col3of12">
    <fieldset>
        <legend>Mark Item #<?php echo $ID; ?></legend>

        <div><label for="mark">Mark as finished:</label> <input type="checkbox" name="mark" id="mark"/></div>

        <input type="submit" value="Done" />
    </fieldset>
</form>
