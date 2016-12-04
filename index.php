<?xml version="1.0" encoding="UTF-8" ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Buildings Images Library</title>
    <meta http-equiv="Content-Type" content="text/html; UTF-8" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/form.css" type="text/css" />
	<link rel="stylesheet" href="css/lightbox.css">
	
</head>
<?php session_start();
$catid = addslashes(htmlspecialchars($_GET['catid']));
if(empty($catid))
{
	$catid=-1;//show all pictures
}
?>
<body>
	<?php include 'public/nav.php';?>
	<div class=" bg">
	<div class="contain">
		<?php 
			/*connect mysql*/
			include 'public/config.php';
			// check to see if connection was successful
			if(!$con)
			{
				  echo "Error: Could not connect to database.  Please try again later.";
				  exit;
			}
		    require_once('public/page.class.php'); //page class 
			$showrow = 8; //the number of images of one page 
			$curpage = empty($_GET['page']) ? 1 : $_GET['page']; //when page is undefine  
			$url = "?page={page}&catid=".$catid; //when url ="?page={page}&q=".$_GET['q'] 
		    if($catid == -1)
			{
				$sql = "SELECT * FROM imgs";  
			}else
			{
				$sql = "SELECT * FROM imgs where category='$catid'";  
			}			
			$total = mysql_num_rows(mysql_query($sql)); //total num 
			if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow))  
				$curpage = ceil($total_rows / $showrow); //the last page handle 
			//get data
			$sql .= " LIMIT " . ($curpage - 1) * $showrow . ",$showrow;";  
			$rs = mysql_query($sql); 
		    //print_r($rs);
			//echo $email; 
			/*create sql query to get the infomation on the username */
			//$sql="select * from imgs";
			//$rs=mysql_query($sql,$con);
		?>
		<!-- start mgr page -->
		<div class="c_title">
			<h2 >Images Library</h2>
		</div>
		<div>
			<h3>Images List</h3>
			<form action="postindexcat.php" method="post">
				<select name="catid">
				<?php
					$sql="select * from category";//get category items
					$cats=mysql_query($sql,$con);
					while($rowcat = mysql_fetch_array($cats, MYSQL_ASSOC))
					{
				?>
					<option value="<?php echo $rowcat['id'];?>" >Sort by <?php echo $rowcat['cname'];?></option>
				<?php } ?>
					<option value="-1" >Sort by all</option>
				</select>
				<input type="submit" class="buttons" value="Submit" />
			</form>
			<div class="noticecat">
				
			</div>
			<div class="imglist">
                    <div class="dates">  
                        <?php while ($row = mysql_fetch_array($rs)) { ?> 
							<div class="cell">
									<div class="cellimg">
										<!--<img  src="<?php echo "upload/".$row['imgname'].".".$row['imgtype'];?>" />-->
										<a   href="<?php echo "upload/".$row['imgname'].".".$row['imgtype'];?>"  data-lightbox="example-set" data-title="<?php echo $row['texts'] ?>"><img class="example-image" src="<?php echo "upload/".$row['imgname'].".".$row['imgtype'];?>" alt=""/></a>										
									</div>
									<div class="cellab">
										<div><?php echo $row['texts'] ?></div>
										<a class="buttons" href="<?php echo 'upload/'.$row['imgname'].".".$row['imgtype'];?>" download="<?php echo $row['imgname'].".".$row['imgtype'];?>">Download</a>
									</div>
						    </div> 
                        <?php } ?>  
                    </div>                  
			</div>
			<div style="clear:both"></div>
			<div class="showPage">  
                    <?php  
                    if ($total > $showrow) {//handl last page 
                        $page = new page($total, $showrow, $curpage, $url, 2);  
                        echo $page->myde_write();  
                    }  
                    ?>  
                </div>  
		</div>
	</div>

   </div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>
<script src="js/lightbox.js"></script>
</body>
</html>
