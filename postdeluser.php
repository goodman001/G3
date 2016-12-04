<?php
   /*
   * me is used to delete user record in cuser
   */
   session_start();
   //check if session is alive
   if(empty($_SESSION['username'])|| $_SESSION['type'] != "0")
   {
      header("location: login.php");
      exit;
   }
   /*get post value, filter special character*/
   $id = addslashes(htmlspecialchars($_GET['id']));
   /*connect mysql*/
   include 'public/config.php';
   // check to see if connection was successful
   if(!$con)
   {
      echo "Error: Could not connect to database.  Please try again later.";
      exit;
   }
   /*create sql query to delete user*/
   $sql="delete from cuser where id='$id'";
   $result=mysql_query($sql);
   if($result)// delete successfully
   {
      header("location: adminmgr.php?deluser=true");
   }else
   {
      header("location: adminmgr.php?deluser=false");
      exit;
   }
?>