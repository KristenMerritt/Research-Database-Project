<!DOCTYPE html>
<html lang="en">
<?php
    include "BUS.php";
    include "DB.class.php";
    include "Account.class.php";
    //session_start();
    getHeader();
    $db = new DB();
?>
<body>
    <?php getNavBar(); ?>
    <?php getSearchBar(); ?>
    <?php professorPage($db); ?>
</body>

<?php importScripts(); ?>
</html>
