<?php
session_start();
define( "USERNAME", "raymondlwhuang" );
define( "PASSWORD", "bf820460b2badaed9dcd79e4853edca1" );

if ( isset( $_POST["login"] ) ) {
  login();
} elseif ( isset( $_GET["action"] ) and $_GET["action"] == "logout" ) {
  logout();
} elseif ( isset( $_SESSION["username"] ) ) {
  displayPage();
} else {
  displayLoginForm();
}

function login() {
  if ( isset( $_POST["username"] ) and isset( $_POST["password"] ) ) {
    if ( $_POST["username"] == USERNAME and MD5($_POST["password"]) == PASSWORD ) {
      $_SESSION["username"] = USERNAME;
	  $_SESSION["private"] = "yes";
      session_write_close();
      header( "Location: login.php" );
    } else {
      displayLoginForm( "Sorry, that username/password could not be found. Please try again." );
    }
  }
}

function logout() {
  unset( $_SESSION["username"] );
  unset( $_SESSION["private"] );
  session_write_close();
  header( "Location: login.php" );
}

function displayPage() {
//  displayPageHeader();
  header( "Location: ResultDisp.php" );
?>	
<!--
    <p>Welcome, <strong><?php //echo $_SESSION["username"] ?></strong>! You are currently logged in.</p>
	<p><a href="ResultDisp.php">Go to My Important Resource</a></p>
    <p><a href="login.php?action=logout">Logout</a></p>
  </body>
</html>
-->
<?php
}

function displayLoginForm( $message="" ) {
  displayPageHeader();
?>
    <?php if ( $message ) echo '<p class="error">' . $message . '</p>' ?>

    <form action="login.php" method="post">
      <div style="width: 30em;">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="" AUTOCOMPLETE=OFF />
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="" AUTOCOMPLETE=OFF />
        <div style="clear: both;">
          <input type="submit" name="login" value="Login" />
        </div>
      </div>
    </form>
  </body>
</html>
<?php
}

function displayPageHeader() {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>System Login</title>
    <link rel="stylesheet" type="text/css" href="common.css" />
    <style type="text/css">
      .error { background: #d33; color: white; padding: 0.2em; }
    </style>
  </head>
  <body>
    <h1>System Login</h1>
<?php
}
?>
