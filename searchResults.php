<!DOCTYPE html>
<html lang="en">
<?php 
    include "BUS.php";
    include "DB.class.php";
    include "Project.class.php";
    include "Account.class.php";

    getHeader(); 
    $db = new DB();

?>
<body>
    <?php getNavBar(); ?> 
    <?php getSearchBar(); ?>
    
    <?php
    if (isset($_POST['searchBtn']) && isset($_POST['choice'])) {
    	echo "<p class=\"searched\"><strong>Search Results for: </strong>".$_POST['searchBox']."<p>";

    	echo "<h2> Accounts </h2>";
    	searchAccounts($db, $_POST['searchBox']);
    	
    	echo "<h2> Projects </h2>";
        searchProjects($db, $_POST['searchBox'], $_POST['choice']);
    } 
    ?>
            
</body>

<?php importScripts(); ?>
</html>