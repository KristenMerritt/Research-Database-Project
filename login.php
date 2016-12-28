
<!DOCTYPE html>
<html lang="en">
<?php
  include("BUS.php");
  include ("DB.class.php");
  $db = new DB();

  getHeader();
  //var_dump($_SESSION);

  if($_SESSION['loginID'])
  {
    session_unset();
    //unset($_SESSION['loginID']);
    //unset($_SESSION['accountID']);
  }
  //var_dump($_SESSION);
//   if(isset($_POST['createAccount'])){
// 
//     // echo "created account <br/>";
//     // echo $_POST['createPassword'] . "<br>";
//     // echo $_POST['createEmail']. "<br>";
//     // echo $_POST['createName']. "<br>";
//     $nameExplode = explode(" ", $_POST['createName']);
//     $firstName = $nameExplode[0];
//     $lastName = $nameExplode[1];
// 
//     // add a function here that passes the DB object and the variables to the BUS
//     // class which then passes the variables to the DB to create the account.
//     createAccount($db, $firstName, $lastName, $_POST['createEmail'], $_POST['createPassword'], "faculty");
// 
//     $_POST['createName'] = null;
//     $_POST['createEmail'] = null;
//     $_POST['createPassword'] = null;
//   }
?>
<body>
      <?php getNavbar(); ?> <!-- starts container -->

        <div class="login-page">
          <h1 class="openHeader">RIT Login</h1>
          <div class="form">
            <form class="register-form" action="login.php" method="post">
              <input type="text" placeholder="name" name="createName"/>
              <input type="password" placeholder="password" name="createPassword"/>
              <input type="text" placeholder="email address" name="createEmail"/>
              <input type="submit" name="createAccount" value="Create Account"/>
              <p class="message">Already registered? <a href="#">Sign In</a></p>
            </form>
            <form class="login-form" action="login_redirect.php" method="post">
              <input type="text" placeholder="username" name="username"/>
              <input type="password" placeholder="password" name="password"/>
              <input type="submit" name="submit" value="Login" />
              <p class="message">Not registered? <span style="color: blue;"><a href="createAccount.php">Create an account</a></span></p>
            </form>

          </div>
        </div>
    </div> <!-- end container -->
</body>
<?php importScripts(); ?>
</html>
