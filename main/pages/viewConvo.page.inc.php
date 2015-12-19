<?php
	$caughtErrors = array();
	$isValid = (isset($_GET['convoID']) && checkIDS($_GET['convoID']));

	if($isValid === false)
	{
		$caughtErrors[] = 'Invalid Conversation ID';
	}
	if(empty($caughtErrors)===false)
	{
		foreach($caughtErrors as $errorscaught)
		{
			echo '<div class="error">', $errorscaught, '</div>';
			echo($isValid);
		}
	}

	if($isValid)
	{
		$msgs= fetchConvo($_GET['convoID']);
		print_r($msgs);
	}

?>

	<div class = "action">
		<a href = "index.php?page=inbox">Inbox</a>
		<a href = "index.php?page=logout">Logout</a> 
	<div>
	<div class= "txt">
		<?php

		?>
	</div>
<?php