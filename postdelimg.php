<?php
/*
* me is used to delete record from imgs
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
$imgname = addslashes(htmlspecialchars($_GET['imgname']));
/*connect mysql*/
include 'public/config.php';
// check to see if connection was successful
if(!$con)
{
  echo "Error: Could not connect to database.  Please try again later.";
  exit;
}
/*create sql query to delete img*/
$sql="delete from imgs where id='$id'";
$result=mysql_query($sql);
if($result)// delete successfully
{
  unlink( 'upload/'.$imgname );
  header("location: catmgr.php?delimg=true&catid=".$catid."&cname=".$cname );
}else
{
  header("location: catmgr.php?delimg=false&catid=".$catid."&cname=".$cname );
  exit;
}

?>