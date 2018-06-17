<form action="index.php?delete=<?php echo $ID; ?>" method="post" class="col col3of12">
    <fieldset>
        <legend>Delete Item #<?php echo $ID; ?></legend>
        
        <input type="hidden" name="day" value="<?php echo $resultfindItem['day']; ?>" />
        <input type="hidden" name="title" value="<?php echo $resultfindItem['title']; ?>" />
        <input type="hidden" name="start" value="<?php echo $resultfindItem['start']; ?>" />
        <input type="hidden" name="duration" value="<?php echo $resultfindItem['duration']; ?>" />
        
        <input type="submit" value="Delete This!!" />
    </fieldset>
</form>