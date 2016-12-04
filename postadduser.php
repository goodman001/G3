<?php
   /*
   * me is used to create a new record into cuser
   */
   session_start();
   //check if session is alive
   if(empty($_SESSION['username'])|| $_SESSION['type'] != "0")
   {
      header("location: login.php");
      exit;
   }
   /*get post value, filter special character*/
   $username = addslashes(htmlspecialchars($_POST['cname']));
   $password = addslashes(htmlspecialchars($_POST['cpwd']));
   $category = addslashes(htmlspecialchars($_POST['ccid']));
   /*connect mysql*/
   include 'public/config.php';
   // check to see if connection was successful
   if(!$con)
   {
      echo "Error: Could not connect to database.  Please try again later.";
      exit;
   }
   /*create sql query to check if the username in the dababase*/
   $sql="select count(*) as num from cuser where username='$username'"; 
   $result=mysql_query($sql); 
   $count =mysql_result($result,0,"num");
   echo $count;
   if(!$count)// if the count is 0, we can insert the new userinfo into the db
   {
      $sql="insert into cuser(username,pwd,category) values('$username','$password','$category')";
      mysql_query($sql,$con);//insert the new record into the table
      header("location: adminmgr.php?adduser=true");
   }else
   {
      header("location: adminmgr.php?adduser=false");
      exit;
   }
?>