<?php
   /*
   * me is used to delete category and imgs
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
   /*delete all images*/
   $sql0 = "select * from imgs where category = '$id'";
   $rs = mysql_query($sql0);
   //print_r($rs);
   //echo "hahah";
   while ($row = mysql_fetch_array($rs))
   {
	   $imgname = $row['imgname'].".".$row['imgtype'];
	   //echo $imgname;
	   unlink( 'upload/'.$imgname );
   }
   /*create sql query to delete category*/
   $sql="delete from category where id='$id'";
   $result=mysql_query($sql);
   if($result)// delete successfully
   {
      header("location: adminmgr.php?delcat=true");
   }else
   {
      header("location: adminmgr.php?delcat=false");
      exit;
   }
?>