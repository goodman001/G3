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
   $username = addslashes(htmlspecialchars($_POST['uname']));
   $pwd = addslashes(htmlspecialchars($_POST['upwd']));
   $category = addslashes(htmlspecialchars($_POST['ucid']));
   /*connect mysql*/
   include 'public/config.php';
   // check to see if connection was successful
   if(!$con)
   {
      echo "Error: Could not connect to database.  Please try again later.";
      exit;
   }
   /*create sql to update cuser info*/
   $sql="update cuser set username='$username',pwd='$pwd',category='$category' where id='$id'";
   $result=mysql_query($sql);
   if($result)//  update successfully
   {
      header("location: adminmgr.php?updateuser=true");
   }else
   {
      header("location: adminmgr.php?updateuser=false");
      exit;
   }
?>