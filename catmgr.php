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
$catid = addslashes(htmlspecialchars($_GET['catid']));//category id
$cname = addslashes(htmlspecialchars($_GET['cname']));//category name
?>
<body>
	<?php include 'public/nav.php';?>
	<div class=" bg">
	<div class="contain">
		<?php if(empty($_SESSION['username'])){
			header("location: login.php");
		   }
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
			$url = "?page={page}&catid=".$catid."&cname=".$cname; //when url ="?page={page}&q=".$_GET['q']    
			$sql = "SELECT * FROM imgs where category='$catid'";  
			$total = mysql_num_rows(mysql_query($sql)); //total num 
			if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow))  
				$curpage = ceil($total_rows / $showrow); //the last page handle 
			//get data
			$sql .= " LIMIT " . ($curpage - 1) * $showrow . ",$showrow;";  
			$rs = mysql_query($sql);  
			//echo $email; 
			/*create sql query to get the infomation on the username */
			//$sql="select * from imgs";
			//$rs=mysql_query($sql,$con);
		?>
		<!-- start mgr page -->
		<div class="c_title">
			<h2 ><?php echo $cname;?> Image manage Page</h2>
		</div>
		<div class="lists-left">
			<h3>Category Img List</h3>
			<div class="noticecat">
				<?php if($_GET['updateimg']=='true'){
				?>
				Update successfully!
				<?php
				  }else if($_GET['updateimg']=='false'){
				?>
				Update failed!
				<?php
				  }else if($_GET['delimg']=='true'){
				?>
				Delete successfully!
				<?php
				  }else if($_GET['delimg']=='false'){
				?>
				<?php
				  }
				?>
			</div>
			<div class="imglist">
                    <div class="dates">  
                        <?php while ($row = mysql_fetch_array($rs)) { ?> 
							<div class="cell">
								<form action="postupdateimg.php?id=<?php echo $row['id'];?>&catid=<?php echo $catid;?>&cname=<?php echo $cname;?>" method="post">
									<div class="cellimg">
										<!--<img  src="<?php echo "upload/".$row['imgname'].".".$row['imgtype'];?>" />-->
										<a   href="<?php echo "upload/".$row['imgname'].".".$row['imgtype'];?>"  data-lightbox="example-set" data-title="<?php echo $row['texts'] ?>"><img class="example-image" src="<?php echo "upload/".$row['imgname'].".".$row['imgtype'];?>" alt=""/></a>										
									</div>
									<div class="cellab">
										<textarea name="texts2" class="textarea2"><?php echo $row['texts'] ?></textarea>
										<input type="submit" class="buttons" value="Update" />
										<a class="buttons" href="postdelimg.php?id=<?php echo $row['id'];?>&catid=<?php echo $catid;?>&cname=<?php echo $cname;?>&imgname=<?php echo $row['imgname'].".".$row['imgtype'];?>">Delete</a>
									</div>
								</form>
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
		<div class="lists-right">
			<h3>Upload New Image</h3>
			<form action="postaddimg.php?catid=<?php echo $catid;?>&cname=<?php echo $cname;?>" enctype="multipart/form-data" method="post" class="basic-grey" id="catformadd">
				<label>
					<h6>Select :</h6>
					<input type="file" name="upfile" />
				</label>
				<label>
					<h6>description :</h6>
					<input id="texts" type="text" name="texts"  placeholder="description" value="<?php echo $row['cname'];?>" required />
				</label>
				<?php if($_GET['addimg']=='1'){
				?>
				<label>
						<h4 style="color:red"><strong>Image upload successfully!</strong></h4>
				</label>
				<?php
				  }else if($_GET['addimg']=='2'){
				?>
				<label>
					<h4 style="color:red"><strong>Image upload failed!</strong></h4>
				</label>
				<?php
				  }else if($_GET['addimg']=='3'){
				?>
				<label>
					<h4 style="color:red"><strong>Image upload failed!Type must be gif or jpeg</strong></h4>
				</label>
				<?php
				  }
				?>
				<label>
				<span>&nbsp;</span>
					<br>
				<input type="submit" class="button" value="Upload image" />
				</label>
			</form>
			
			
		</div>
	</div>

   </div>
<script>
$("#catformadd").validate();
</script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>
<script src="js/lightbox.js"></script>
</body>
</html>
