<!DOCTYPE html>
<html lang="en">
<?php 
    include "BUS.php";
    include "DB.class.php";
    include "Entry.class.php";
    getHeader(); 
    $db = new DB();

    if (isset($_POST['createEntry'])) {
        createEntry($db, $_POST['projectID'], $_SESSION['accountID'], $_POST['content'], $_POST['duedate']);
        echo "<script language=\"javascript\">";
        echo "alert('Entry created.')";
        echo "</script>";
        $_POST['createEntry'] = null;
    } 
    //var_dump($_SESSION);
?>
<body>
    <?php getNavBar(); ?> <!-- start container -->

<div class="container">
        <h1> Create a New Entry </h1>
        <br>
        <hr/>
        <br>
        <div id="addProduct"> <!--  Add product section -->
           <form action="createEntry.php" method="post"> <!--  Form used to submit a new product -->
                 <div class="form-group">
                    <input class="form-control" id="projectID" name="projectID" value="<?php echo $_GET['projID']; ?>" type="hidden">
                </div>

                <div class="form-group">
                    <label for="name">Project Entry Content</label>
                    <input class="form-control" id="content" name="content" placeholder="Content of entry" value="">
                </div>

                <div class="form-group">
                    <label for="desc">Due Date</label>
                    <input type="date" class="form-control" id="duedate" name="duedate" value=""> 
                </div>
                <input class="btn btn-default nameButton" type="reset" value="Reset Form">
                <input class="btn btn-default nameButton" type="submit" name="createEntry" value="Add Entry">
            </form>
            <br>
            <br>
        </div>
    </div>

    </div> <!-- End of Container -->
        
</body>

<?php importScripts(); ?>
</html>