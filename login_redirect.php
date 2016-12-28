<?php

include "DB.class.php";
session_start();
$db = new DB();
if (isset($_POST['submit']))
   {     
   		$passcheck = $db->checkPassword($_POST['username'],$_POST['password']);
   		if($passcheck == true)
   		{
    		$_SESSION["loginID"] = $_POST['username'];
        $accountIdArray = $db->getAccountIDbyLogin($_SESSION['loginID']);
        $_SESSION['accountID'] = $accountIdArray[0][0];
        	//var_dump($_SESSION);
        	echo "You will be redirected to the homepage.";
    		header('Location: index.php');
    	}else{
   //  		echo '<script language="javascript">';
			// echo 'alert("Incorrect Password, Retry")';
			// echo '</script>';
			header('Location: login.php');
    	}
    }
?>