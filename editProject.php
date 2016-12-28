<!DOCTYPE html>
<html lang="en">
<?php 
    include "BUS.php";
    include "DB.class.php";
    include "Project.class.php";
    getHeader(); 
    $db = new DB();
    $id= $_GET['id'];
    if (isset($_POST['editProject'])) {
        editProject($db, $_POST['id'], $_POST['name'], $_POST['abstract']);
        echo "<script language=\"javascript\">";
        echo "alert('Project updated.')";
        echo "</script>";
        $_POST['editProject'] = null;
    } 
?>
<body>
    <?php getNavBar(); ?> <!-- start container -->

<div class="container">
        <h1> Edit Project </h1>
        <br>
        <hr/>
        <br>
        <div id="editProduct"> <!--  Add product section -->
           <form action="editProject.php" method="post"> <!--  Form used to submit a new product -->
                <div class="form-group">
                    <input class="form-control" id="id" name="id" placeholder="<?php echo $id; ?>" value="<?php echo $id; ?>" type="hidden">
                </div>

                <div class="form-group">
                    <label for="name">Project Name</label>
                    <input class="form-control" id="name" name="name" placeholder="<?php echo getProjectName($db, $id); ?>" value="<?php echo getProjectName($db, $id); ?>">
                </div>

                <div class="form-group">
                    <label for="desc">Abstract</label>
                    <textarea class="form-control" id="abstract" name="abstract"><?php echo getProjectAbstract($db, $id); ?></textarea>
                </div>
                <input class="btn btn-default nameButton" type="reset" value="Reset Form">
                <input class="btn btn-default nameButton" type="submit" name="editProject" value="Edit Project">
            </form>
            <br>
            <br>
        </div>
    </div>

    </div> <!-- End of Container -->
        
</body>

<?php importScripts(); ?>
</html>