<?php
	session_destroy();

	$_SESSION = array();
?>
<div class="logoutMsg"><?php header('Location: index.php?page=login');?></div>
