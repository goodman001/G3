<?xml version="1.0" encoding="UTF-8" ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Buildings Images Library</title>
    <meta http-equiv="Content-Type" content="text/html; UTF-8" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/form.css" type="text/css" />
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/additional-methods.min.js"></script>
</head>
<body>
	<?php include 'public/nav.php';?>
	<div class=" bg">
	<div class="contain">
        <form action="postlog.php" method="post" class="basic-grey" id="formlogin">
            <h1>Login
            </h1>
            <label>
            <span>Username :</span>
            <input id="username" type="text" name="username"  placeholder="Username"  required />
            </label>
            <label>
            <span>Password :</span>
            <input id="pwd" type="password" name="pwd" placeholder="Your password" required />
            </label>
            <label>
            <span>User Type :</span>
            <div>
            <input  type="radio" name="usertype" value="0"  checked="checked" />SuperAdmin
            <input  type="radio" name="usertype" value="1" />CategoryAdmin
            </div>
            </label>
            <?php if($_GET['failure']=='wrong'){
            ?>
            <label>
                    <h3 style="color:red"><strong>Username or password is wrong!</strong></h3>
            </label>
            <?php
              }
            ?>

            <label>
            <span>&nbsp;</span>
            <input type="submit" class="button" value="Login" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </label>
        </form>
                
	</div>

   </div>
<script>
$("#formlogin").validate();
</script>
</body>
</html>
