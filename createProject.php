<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    //var_dump($_SESSION);

    include "BUS.php";
    include "DB.class.php";
    include "Project.class.php";
    getHeader(); 
    $db = new DB();

    if (isset($_POST['addProject'])) {
        createProject($db, $_POST['name'], $_POST['abstract'], $_SESSION["accountID"]);
        echo "<script language=\"javascript\">";
        echo "alert('Project created.')";
        echo "</script>";
        $_POST['addProject'] = null;
    } 
    // 
?>
<body>
    <?php getNavBar(); ?> <!-- start container -->

<div class="container">
        <?php echo $message ?> <!--  Gets alert -->
        <h1> Create a New Project </h1>
        <br>
        <hr/>
        <br>
        <div id="addProduct"> <!--  Add product section -->
           <form action="createProject.php" method="post"> <!--  Form used to submit a new product -->
                <div class="form-group">
                    <label for="name">Project Name</label>
                    <input class="form-control" id="name" name="name" placeholder="Name of Project" value="">
                </div>

                <div class="form-group">
                    <label for="desc">Abstract</label>
                    <textarea class="form-control" id="abstract" name="abstract" placeholder="Project Abstract" value=""> </textarea>
                </div>
                <input class="btn btn-default nameButton" type="reset" value="Reset Form">
                <input class="btn btn-default nameButton" type="submit" name="addProject" value="Add Project">
            </form>
            <br>
            <br>
        </div>
    </div>

    </div> <!-- End of Container -->
        
</body>

<?php importScripts(); ?>
</html>