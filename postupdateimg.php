<?php
   /*
   * me is used to update record into imgs
   */
   session_start();
   //check if session is alive
   if(empty($_SESSION['username']))
   {
      header("location: login.php");
      exit;
   }
   /*get post value, filter special character*/
   $id = addslashes(htmlspecialchars($_GET['id']));
   $catid = addslashes(htmlspecialchars($_GET['catid']));
   $texts = addslashes(htmlspecialchars($_POST['texts2']));
   $cname = addslashes(htmlspecialchars($_GET['cname']));
   /*connect mysql*/
   include 'public/config.php';
   // check to see if connection was successful
   if(!$con)
   {
      echo "Error: Could not connect to database.  Please try again later.";
      exit;
   }
   /*create sql query to check if the update img infomation in the dababase*/
   $sql="update imgs set texts='$texts' where id='$id'";
   echo $id;
   $result=mysql_query($sql);
   if($result)//  update successfully
   {
      header("location: catmgr.php?updateimg=true&catid=".$catid."&cname=".$cname );
   }else
   {
      header("location: catmgr.php?updateimg=false&catid=".$catid."&cname=".$cname );
      exit;
   }
   
?>