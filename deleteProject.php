<?php
    include "BUS.php";
    include "DB.class.php";
    include "Project.class.php";
    getHeader();
    $db = new DB();
    $projID= $_GET['projID'];
    $entryID= $_GET['entryID'];

    if(!empty($projID))
    {
      echo "ENTERED PROJECT";
      $db->deleteProject($projID);

    }
    if(!empty($entryID))
    {
      echo "ENTERED entry" . $entryID;
      $db->deleteEntry($entryID);
    }

    header( 'Location: projects.php' ) ;
?>
