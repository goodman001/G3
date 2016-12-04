<?php
   /*
   * me is used to create a new record into category
   */
   session_start();
   //check if session is alive
   if(empty($_SESSION['username'])|| $_SESSION['type'] != "0")
   {
      header("location: login.php");
      exit;
   }
   /*get post value, filter special character*/
   $name = addslashes(htmlspecialchars($_POST['name']));
   /*connect mysql*/
   include 'public/config.php';
   // check to see if connection was successful
   if(!$con)
   {
      echo "Error: Could not connect to database.  Please try again later.";
      exit;
   }
   /*create sql query to check if the category is in the dababase*/
   $sql="select count(*) as num from category where cname='$name'"; 
   $result=mysql_query($sql); 
   $count =mysql_result($result,0,"num");
   echo $count;
   if(!$count)// if the count is 0, we can insert the new record into the db
   {
      $sql="insert into category(cname) values('$name')";
      mysql_query($sql,$con);//insert the new record into the table
      header("location: adminmgr.php?addcat=true");
   }else
   {
      header("location: adminmgr.php?addcat=false");
      exit;
   }
?>