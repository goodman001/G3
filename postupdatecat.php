<?php
   /*
   * me is used to update record into category
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
   $name = addslashes(htmlspecialchars($_POST['name']));
   /*connect mysql*/
   include 'public/config.php';
   // check to see if connection was successful
   if(!$con)
   {
      echo "Error: Could not connect to database.  Please try again later.";
      exit;
   }
   /*create sql query to check if the cname is in the dababase*/
   $sql="update category set cname='$name' where id='$id'";
   $result=mysql_query($sql);
   if($result)//  update successfully
   {
      header("location: adminmgr.php?updatecat=true");
   }else
   {
      header("location: adminmgr.php?updatecat=false");
      exit;
   }
?>