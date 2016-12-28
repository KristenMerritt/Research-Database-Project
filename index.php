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
	<?php
	if (isset($_POST['searchBtn']) && isset($_POST['choice']) ) {
        searchProjects($db, $_POST['searchBox'], $_POST['choice']);
    } 
    ?>
	
        
</body>

<?php importScripts(); ?>
</html>