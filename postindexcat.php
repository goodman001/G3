<?php
	/*index imgs sort*/
	$catid = addslashes(htmlspecialchars($_POST['catid']));
	header("location: index.php?catid=".$catid);
?>