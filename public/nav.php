<div class="navbg" >
	<div class="navbar">
	<div class="navleft">
		<ul id="nav"> 
			<li><a href="index.php">Buildings Images Library</a></li> 
		</ul>
	</div>
	<div class="navright">
		<ul id="nav2"> 
			<?php if(empty($_SESSION['username'])){?>
			<li style="margin-left:40%;"><a class="enter" href="login.php">Login</a></li> 
			<?php }else if($_SESSION['type']== 0){?>
			<li style="color:white;font-size:16px;">Dear SuperAdmin <?php echo $_SESSION['username'];?>,<a class="enter" href="adminmgr.php">Enter manager page</a></li>
			<li><a class="enter" href="logoff.php">Logout</a></li>
			<?php }else{ $catid = $_SESSION['catid'];$cname = $_SESSION['cname'];?>
			<li style="color:white;font-size:16px;">Dear CategoryAdmin <?php echo $_SESSION['username'];?>,<a class="enter" href="<?php echo 'catmgr.php?catid='.$catid.'&cname='.$cname; ?>">visit my account</a></li>
			<li><a class="enter" href="logoff.php">Logout</a></li>
			<?php }?>
		</ul>
		
	</div>
	</div>
</div> 