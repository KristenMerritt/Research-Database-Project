
<!DOCTYPE html>
<html lang="en">
<?php
  include("BUS.php");
  include ("DB.class.php");
  $db = new DB();

  getHeader();
  //var_dump($_SESSION);
  if(isset($_POST['createAccount'])){
//     echo "created account <br/>";
//     echo $_POST['fname'] . "<br>";
//     echo $_POST['lname']. "<br>";
//     echo $_POST['email'];
//     echo $_POST['accountType']. "<br>";
    // $nameExplode = explode(" ", $_POST['createName']);
//     $firstName = $nameExplode[0];
//     $lastName = $nameExplode[1];

    // add a function here that passes the DB object and the variables to the BUS
    // class which then passes the variables to the DB to create the account.
    //createAccount($db, $lastName, $_POST['createEmail'], $_POST['createPassword'], "faculty");
    
    //$db->createAccount($firstName, $lastName, $email, $password, $accountType);
    createAccount($db, $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['password'], "faculty");

	echo "<script language=\"javascript\">";
	echo "alert('Account Created.')";
	echo "</script>";
	$_POST['createAccount'] = null;

  }
?>
<body>
      <?php getNavbar(); ?> <!-- starts container -->

        <div class="login-page">
          <h1 class="openHeader">Create an Account</h1>
          <div class="form">
<!-- 
            <form class="register-form" action="createAccount.php" method="post">
            
              <input type="text" placeholder="email" name="email"/>
              <input type="password" placeholder="password" name="password"/>

              <input type="submit" name="createAccount" value="Create Account"/>
              <p class="message">Already registered? <a href="login.php">Sign In</a></p>
            </form>
 -->
            
            <form class="login-form" action="createAccount.php" method="post">
              <input type="text" placeholder="first name" id="fname" name="fname"/>
              <input type="text" placeholder="last name" id="lname" name="lname"/>
              <input type="text" placeholder="email" id="email" name="email"/>
              <input type="password" placeholder="password" id="password" name="password"/>
              <input type="submit" value="Create Account" id="createAccount" name="createAccount"/>
              <p class="message">Already Registered? <span style="color: blue;"><a href="login.php">Sign in</a></span></p>
            </form>

          </div>
        </div>
    </div> <!-- end container -->
</body>
<?php importScripts(); ?>
</html>
