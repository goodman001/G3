<?php
   /*
   * me is used to create a new img record into category
   */
   session_start();
   //check if session is alive
   if(empty($_SESSION['username']))
   {
      header("location: login.php");
      exit;
   }
   /*get post value, filter special character*/
   $catid = addslashes(htmlspecialchars($_GET['catid']));
   $cname = addslashes(htmlspecialchars($_GET['cname']));
   $name = addslashes(htmlspecialchars($_POST['name']));
   $texts = addslashes(htmlspecialchars($_POST['texts']));
   if(is_uploaded_file($_FILES['upfile']['tmp_name'])){ 
      $upfile=$_FILES["upfile"]; 
      //get file data
      $name=$upfile["name"];//filename
      $type=$upfile["type"];//filetype
      $size=$upfile["size"];//file size
      $tmp_name=$upfile["tmp_name"];//tmp path
	  switch ($type){  
       case 'image/jpeg':
			  $okType=true; 
			  $tip = "jpg";//file name type
        break; 
       case 'image/gif':
			  $okType=true;
			  $tip = "gif";//file name type
        break; 
	   default:
			$okType=false;   
      } 
   }
   if($okType)//img type check :gif or jpeg
   {
	   $time = time();
	   $name = $cname.$time;//name img
	   //echo $name;
	   move_uploaded_file($tmp_name,'upload/'.$name.".".$tip); 
	   $error=$upfile["error"];
	   if($error == 0)//file upload successfully!
	   {
		   /*connect mysql*/
		   include 'public/config.php';
		   // check to see if connection was successful
		   if(!$con)
		   {
			  echo "Error: Could not connect to database.  Please try again later.";
			  exit;
		   }
		   /*create sql query to insert img infomation into the dababase*/
		   $sql="insert into imgs(imgname,imgtype,texts,category) values('$name','$tip','$texts','$catid')";
		   mysql_query($sql,$con);//insert the new record into the table
		   header("location: catmgr.php?addimg=1&catid=".$catid."&cname=".$cname );
	   }else
	   {
		   header("location: catmgr.php?addimg=2&catid=".$catid."&cname=".$cname);
	   }
   }else
   {
	  header("location: catmgr.php?addimg=3&catid=".$catid."&cname=".$cname);
      exit;
   }
?>