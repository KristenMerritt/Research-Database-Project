<!DOCTYPE html>
<html lang="en">
<?php 
    include "BUS.php";
    include "DB.class.php";
    include "Account.class.php";
    include "Project.class.php";
    include "Entry.class.php";
    $db = new DB();
    $entryID = $_GET['id'];
    getHeader();
?>
<body>
    <?php 
        getNavBar(); 
        if($entryID < 0 || $entryID == null){
            echo "<h1 style=\"text-align: center;\">Entry Unavailable </h1>";
        } else {
            getEntryProfile($db, $entryID);
        }
        
    ?> <!-- start container -->
        
            
    </div> <!-- End of Container -->
        
</body>
<?php importScripts(); ?>
</html>