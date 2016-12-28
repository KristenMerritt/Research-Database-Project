<!DOCTYPE html>
<html lang="en">
<?php
    include "BUS.php";
    include "DB.class.php";
    include "Account.class.php";
    include "Project.class.php";
    include "Entry.class.php";
    session_start();
    $db = new DB();
    $projectID = $_GET['id'];
    getHeader();
?>
<body>
    <?php
        getNavBar();
        if($projectID < 0 || $projectID == null){
            echo "<h1 style=\"text-align: center;\">Project Unavailable </h1>";
        } else {
            getProjectProfile($db, $projectID);
        }

    ?> <!-- start container -->


    </div> <!-- End of Container -->

</body>
<?php importScripts(); ?>
</html>
