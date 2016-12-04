<?php
   /*
   * postlog.php is used to check whether the loging pass or not
   */
   /*
   * logging
   *  flag: whether login success 1: success 0:fail
   */
   session_start(); //start session to check login state
   /*get post value, filter special character*/
   $username = addslashes(htmlspecialchars($_POST['username']));
   $pwd = addslashes(htmlspecialchars($_POST['pwd']));
   $type = $_POST['usertype'];
   //echo $type;
   /*connect mysql*/
   include 'public/config.php';
   //$con = mysql_connect("localhost", "root", "mysql");//("localhost", "yourID", "yourPass");
   // check to see if connection was successful
   if(!$con)
   {
      echo "Error: Could not connect to database.  Please try again later.";
      exit;
   }
   /*get logging para*/
   $ip =  $_SERVER["REMOTE_ADDR"];//host ip
   $host = $_SERVER['HTTP_HOST'];//http host
   $date_time = date('Y-m-d H:i:s');//get date and time
   $useragent = $_SERVER['HTTP_USER_AGENT'];//get useragent	  
   /*create sql query to check if the username if in the dababase*/
   if($type == 0 ){//set table name
      $tablename = "admin";//super admin
      $sql="select count(username) as num from ".$tablename." where username='$username' and pwd='$pwd'"; 
      $result=mysql_query($sql); 
      $count =mysql_result($result,0,"num");
      if($count)// if the count is 1, we can login successfully
      {
		$flag= 1;
		$sqllog="insert into Logging(REMOTE_ADDR,HTTP_HOST,	Date_Time,UserID,HTTP_USER_AGENT,LoginSuccess) values('$ip','$host','$date_time','$username','$useragent','$flag')";
	    mysql_query($sqllog,$con);//insert the new record into the table
        $_SESSION['username'] = $username;//set session
        $_SESSION['type'] = $type;
        header("location: adminmgr.php");
      }else
      {
		//echo $ip;
		//echo $host;
		//echo $date_time;
		//echo $useragent;
		$flag= 0;
		$sqllog="insert into Logging(REMOTE_ADDR,HTTP_HOST,	Date_Time,UserID,HTTP_USER_AGENT,LoginSuccess) values('$ip','$host','$date_time','$username','$useragent','$flag')";
	    mysql_query($sqllog,$con);//insert the new record into the table
        session_unset();
        session_destroy();//clear the session
        header("location: login.php?failure=wrong");
      }
   }else
   {
	  $tablename = "cuser";//categoryadmin
      $sql="select category from ".$tablename." where username='$username' and pwd='$pwd'"; 
      $result=mysql_query($sql); 
      $res = mysql_fetch_row($result);
      if($res)// if the res is not null, we can login successfully
      {
		$catid = $res[0];
		$sql1="select * from category where id='$catid'"; 
		$result1=mysql_query($sql1); 
        $res1 = mysql_fetch_row($result1);
		print_r($res1); 
		if($res1)
		{
			$flag= 1;
		    $sqllog="insert into Logging(REMOTE_ADDR,HTTP_HOST,	Date_Time,UserID,HTTP_USER_AGENT,LoginSuccess) values('$ip','$host','$date_time','$username','$useragent','$flag')";
	        mysql_query($sqllog,$con);//insert the new record into the table
			$cname = $res1[1];
        	$_SESSION['username'] = $username;//set session
        	$_SESSION['type'] = $type;
			$_SESSION['catid'] = $catid;
        	$_SESSION['cname'] = $cname;
        	header("location: catmgr.php?catid=".$catid."&cname=".$cname);
		}else
		{
			$flag= 0;
		    $sqllog="insert into Logging(REMOTE_ADDR,HTTP_HOST,	Date_Time,UserID,HTTP_USER_AGENT,LoginSuccess) values('$ip','$host','$date_time','$username','$useragent','$flag')";
	        mysql_query($sqllog,$con);//insert the new record into the table
			session_unset();
        	session_destroy();//clear the session
        	header("location: login.php?failure=wrong");
		}
      }else
      {
		$flag= 0;
		$sqllog="insert into Logging(REMOTE_ADDR,HTTP_HOST,	Date_Time,UserID,HTTP_USER_AGENT,LoginSuccess) values('$ip','$host','$date_time','$username','$useragent','$flag')";
	    mysql_query($sqllog,$con);//insert the new record into the table
        session_unset();
        session_destroy();//clear the session
        header("location: login.php?failure=wrong");
      } 
   }
   
   
   
?>
