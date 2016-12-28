<!DOCTYPE html>
<html lang="en">
<?php 
    include "DB.class.php";
    include "Account.class.php";
    include "Project.class.php";
    include "Entry.class.php";
    $db = new DB();
    //getHeader();
?>
<body>
    <h1> Testing DB Class </h1>

    <h2> Return all projects </h2>
    <?php  var_dump($db->getAllProjects()); ?>
    
    <h2> Return all accounts </h2>
    <?php  var_dump($db->getAllAccounts()); ?>
    
    <h2> Return all accounts associated with a projectID </h2>
    <?php  var_dump($db->getProjectContributers(1)); ?>
    
    <h2> Return all projects associated with an account ID </h2>
    <?php  var_dump($db->getAccountProjects(1));   ?>
    
    <h2> Return all entries based on projectID </h2>
    <?php  var_dump($db->getProjectEntries(1));        ?>
    
    <h2> Return name associated with accountID </h2>
    <?php  var_dump($db->getAccountName(1));       ?>
    
    <h2> Return project name associated with projectID </h2>
    <?php  var_dump($db->getProjectName(1));        ?>
    
    <h2> Sort all projects by prof </h2>
    <?php  var_dump($db->sortByProf());        ?>
    
    <h2> Sort all projects alpha</h2>
    <?php  var_dump($db->sortAlpha());        ?>
    
    <h2> Sort all project by date </h2>
    <?php  var_dump($db->sortByDate());        ?>
    
    <h2> Check password for account </h2>
    <?php   var_dump($db->checkPassword("km2029@rit.edu", "KristenPassword")); ?>
    
</body>
</html>