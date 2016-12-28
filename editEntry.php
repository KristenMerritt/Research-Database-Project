<!DOCTYPE html>
<html lang="en">
<?php 
    include "BUS.php";
    include "DB.class.php";
    include "Entry.class.php";
    getHeader(); 
    $db = new DB();
    $id= $_GET['id'];
    if (isset($_POST['editEntry'])) {
        editEntry($db, $_POST['id'], $_POST['description'], $_POST['duedate']);
        echo "<script language=\"javascript\">";
        echo "alert('Entry updated.')";
        echo "</script>";
        $_POST['editEntry'] = null;
    } 
?>
<body>
    <?php getNavBar(); ?> <!-- start container -->

<div class="container">
        <h1> Edit Entry </h1>
        <br>
        <hr/>
        <br>
        <div id="editProduct"> <!--  Add product section -->
           <form action="editEntry.php" method="post"> <!--  Form used to submit a new product -->
                <div class="form-group">
                    <input class="form-control" id="id" name="id" placeholder="<?php echo $id; ?>" value="<?php echo $id; ?>" type="hidden">
                </div>

                <div class="form-group">
                    <label for="name">Entry Description</label>
                    <input class="form-control" id="description" name="description" placeholder="<?php echo getEntryDescription($db, $id); ?>" value="<?php echo getEntryDescription($db, $id); ?>">
                </div>

                <div class="form-group">
                    <label for="desc">Due Date</label>
                    <input type="date" class="form-control" id="duedate" name="duedate" value="<?php echo getEntryDueDate($db, $id); ?>">
                </div>
                <input class="btn btn-default nameButton" type="reset" value="Reset Form">
                <input class="btn btn-default nameButton" type="submit" name="editEntry" value="Edit Entry">
            </form>
            <br>
            <br>
        </div>
    </div>

    </div> <!-- End of Container -->
        
</body>

<?php importScripts(); ?>
</html>