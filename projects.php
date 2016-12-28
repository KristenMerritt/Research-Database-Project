<!DOCTYPE html>
<html lang="en">
<?php 
    include "BUS.php";
    include "DB.class.php";
    include "Project.class.php";
    getHeader(); 
    $db = new DB();
?>
<body>
    <?php getNavBar(); ?> 
    <?php getSearchBar(); ?>
    <?php projectPage($db); ?>
                
</body>

<?php importScripts(); ?>
</html>