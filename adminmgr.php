<?xml version="1.0" encoding="UTF-8" ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Buildings Images Library</title>
    <meta http-equiv="Content-Type" content="text/html; UTF-8" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/form.css" type="text/css" />
	<script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/additional-methods.min.js"></script>
</head>
<?php session_start(); ?>
<body>
	<?php include 'public/nav.php';?>
	<div class=" bg">
	<div class="contain">
		<?php if(empty($_SESSION['username']) || $_SESSION['type'] != "0"){
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
			//echo $email; 
			/*create sql query to get the infomation from category */
			$sql="select * from category";
			$rs=mysql_query($sql,$con);
		?>
		<div class="bigtitle">Super admin manage Page</div>
		<!-- start category mgr page -->
		
		<div class="mgr">
			<div class="c_title">
				<h2 >Category manage</h2>
			</div>
			<div class="lists-left">
				<h3>Category List</h3>
				<div class="noticecat">
					<?php if($_GET['updatecat']=='true'){
					?>
					Update successfully!
					<?php
					  }else if($_GET['updatecat']=='false'){
					?>
					Update failed!
					<?php
					  }else if($_GET['delcat']=='true'){
					?>
					Delete successfully!
					<?php
					  }else if($_GET['delcat']=='false'){
					?>
                    Delete failed!
					<?php
					  }
					?>
				</div>
				<!--HEADER-->
				<div class="rows">
					<div class="cell1"><strong>ID</strong></div>
					<div class="cell2"><strong> Category Name</strong></div>
					<div class="cell3"><strong> OPTION</strong></div>
				</div>
				<div class="cell4"><hr class="hrlist"></div>
				<!-- CONTENT LIST -->
				<?php
                /*get all category*/
                $ca = array();
                $cells= array();
				while($row = mysql_fetch_array($rs, MYSQL_ASSOC))
				{
                    $cells['catid']= $row['id'];
                    $cells['cname']= $row['cname'];
                    array_push($ca,$cells);
				   //echo $row['AddressID'];
				?>
				<form action="postupdatecat.php?id=<?php echo $row['id'];?>" method="post">
					<div class="rows">
						<div class="cell1"><?php echo $row['id'];?></div>
						<div class="cell2"><input id="name" type="text" name="name"  placeholder="category name" value="<?php echo $row['cname'];?>" required /></div>
						<div class="cell3">
							<input type="submit" class="buttons" value="Update" />
							<a class="buttons" href="postdelcat.php?id=<?php echo $row['id'];?>">Delete</a>
							<a class="buttons" href="catmgr.php?catid=<?php echo $row['id'];?>&cname=<?php echo $row['cname'];?>">Enter</a>	
						</div>
					</div>
					<div class="cell4"><hr class="hrlist"></div>

				</form>
				<?php
				 }
				 ?>

			</div>
			<div class="lists-right">
				<h3>Creat New Category</h3>
				<form action="postaddcat.php" method="post" class="basic-grey" id="catformadd">
					<label>
					<span>category :</span>
					<input id="name" type="text" name="name"  placeholder="category name"  required />
					</label>
					<?php if($_GET['addcat']=='true'){
					?>
					<label>
							<h4 style="color:red"><strong>Category add successfully!</strong></h4>
					</label>
					<?php
					  }else if($_GET['addcat']=='false'){
					?>
					<label>
						<h4 style="color:red"><strong>Category add failed!Category name has exited!</strong></h4>
					</label>
					<?php
					  }
					?>

					<label>
					<span>&nbsp;</span>
					<input type="submit" class="button" value="ADD" />
					</label>
				</form>


			</div>
		</div>
		<!-- start user mgr  -->
		<div style="clear:both"></div>
		<div class="mgr">
			<?php 
				$sql="select * from cuser";
				$rs1=mysql_query($sql,$con);
			?>
			<div class="c_title">
				<h2 > CategoryAdmins manage</h2>
			</div>
			<div class="lists-left">
				<h3>Category List</h3>
				<div class="noticecat">
					<?php if($_GET['updateuser']=='true'){
					?>
					Update successfully!
					<?php
					  }else if($_GET['updateuser']=='false'){
					?>
					Update failed!
					<?php
					  }else if($_GET['deluser']=='true'){
					?>
					Delete user successfully!
					<?php
					  }else if($_GET['deluser']=='false'){
					?>
                    Delete user failed!
					<?php
					  }
					?>
				</div>
				<!--HEADER-->
				<div class="rows">
					<div class="ucell1"><strong>ID</strong></div>
					<div class="ucell2"><strong> Username</strong></div>
					<div class="ucell3"><strong> Password</strong></div>
					<div class="ucell4"><strong> Assign Category</strong></div>
					<div class="ucell5"><strong> OPTION</strong></div>
				</div>
				<div class="ucell6"><hr class="hrlist"></div>
				<!-- CONTENT LIST -->
				<?php
                $flag1=-1;
                $flag2 = "undefine";
				while($row1 = mysql_fetch_array($rs1, MYSQL_ASSOC))
				{
                    //print_r($ca);
				   //echo $row['AddressID'];
				?>
				<form action="postupdateuser.php?id=<?php echo $row1['id'];?>" method="post">
					<div class="rows">
						<div class="ucell1"><?php echo $row1['id'];?></div>
						<div class="ucell2"><input  type="text" name="uname"  placeholder="username" value="<?php echo $row1['username'];?>" required /></div>
						<div class="ucell3"><input  type="password" name="upwd"  placeholder="password" value="<?php echo $row1['pwd'];?>" required /></div>
						<div class="ucell4">
                            <select id="test_select" name="ucid">
                                <?php foreach ($ca as $v) {
                                    if($v['catid']==$row1['category'])//get default category
                                    {
                                        $flag1 = $v['catid'];
                                        $flag2 = $v['cname'];
                                    }else
                                    {
                                ?>
                                <option value="<?php echo $v['catid'];?>" ><?php echo $v['cname'];?></option>
                                <?php }} 
                                ?>
                                <option value="<?php echo $flag1;?>" selected="true"><?php echo $flag2;?></option>
                            </select>
                        </div>
						<div class="ucell5">
							<input type="submit" class="buttons" value="Update" />
							<a class="buttons" href="postdeluser.php?id=<?php echo $row1['id'];?>">Delete</a>							
						</div>
					</div>
					<div class="ucell6"><hr class="hrlist"></div>

				</form>
				<?php
				 }
				 ?>

			</div>
			<div class="lists-right">
				<h3>Creat New CategoryAdmin</h3>
				<form action="postadduser.php" method="post" class="basic-grey" id="catformadd">
					<label>
					<span>Username :</span>
					<input type="text" name="cname"  placeholder="username"  required />
					</label>
                    <label>
					<span>Password :</span>
					<input type="password" name="cpwd"  placeholder="password"  required />
					</label>
                    <label>
					    <span>Category :</span>
                        <select id="test_select" name="ccid">
                            <?php foreach ($ca as $v) {?>
                            <option value="<?php echo $v['catid'];?>" selected="<?php if($v['catid']==$row1['category']){echo 'true';}else{echo 'false';}?>"><?php echo $v['cname'];?></option>
                            <?php } ?>
                        </select>
					</label>
					<?php if($_GET['adduser']=='true'){
					?>
					<label>
							<h4 style="color:red"><strong>User add successfully!</strong></h4>
					</label>
					<?php
					  }else if($_GET['adduser']=='false'){
					?>
					<label>
						<h4 style="color:red"><strong>User add failed!Category name has exited!</strong></h4>
					</label>
					<?php
					  }
					?>

					<label>
					<span>&nbsp;</span>
					<input type="submit" class="button" value="Create" />
					</label>
				</form>


			</div>
		</div>
		
		
	</div>

   </div>
<script>
$("#catformadd").validate();
</script>
</body>
</html>
