<?php
require_once 'header.php';
  $error = $user = $pass = "";

  if (isset($_POST['user']))
  {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if ($user == "" || $pass == "")
        $error = "Not all fields were entered<br>";
    else
    //"Software Engineering"
    {
      $result = queryMySQL("SELECT username,password FROM Credentials
        WHERE username='$user' AND password='$pass'");

      if ($result->num_rows == 0)
      {
        $error = "<span class='error'>Username/Password
                  invalid</span><br><br>";
      }
      else
      {
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        die("You are now logged in. Please <a href='home.php?view=$user'>" .
            "click here</a> to continue.<br><br>");
      }
    }
  }

echo <<<_END
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Courseware™</title>
    <!-- Bootstrap -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/moveme.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
    <body>
<div class="container outerlogin">
	<h1>User login <span class='glyphicon glyphicon-education' aria-hidden='true'></span></h1>
	<hr/>
    <div class="row">
        <div class="col-sm-4 col-offset-8 login">
    <form method="post" action="index.php">$error
    	<div class="form-group">
    		<label for="user">Username</label>
			<input type="type" class="form-control" name="user" value="$user" placeholder="Enter username" required>
    	</div>

    	<div class="form-group">
    		<label for="passwordField">Password</label>
			<input type="password" class="form-control" name="pass" value="$pass" placeholder="Enter password" required>
    	</div>

    	<button type="submit" class="btn btn-success" value="Login">Login</button>
    </form>
    </div>
    </div>
</div>

</body>
</html>
_END;
?>
