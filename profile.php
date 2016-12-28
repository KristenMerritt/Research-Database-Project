<!DOCTYPE html>
<html lang="en">
<?php
    include "BUS.php";
    include "DB.class.php";
    include "Account.class.php";
    include "Project.class.php";
    //session_start();
    $db = new DB();

    //echo $accountID;
    getHeader();
    $getaccountID = $db->getAccountIDbyLogin($_SESSION["loginID"]);
    $accountID = $getaccountID[0][0];
?>
<body>
    <?php
        getNavBar();
        if($accountID < 0 || $accountID == null){
            echo "<h1 style=\"text-align: center;\">Profile Unavailable </h1>";
        } else {
            getUserProfile($db, $accountID);
        }

    ?> <!-- start container -->


</body>
<?php importScripts(); ?>
</html>
