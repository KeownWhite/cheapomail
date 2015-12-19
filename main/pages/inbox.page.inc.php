<?php
	

	
	$caughtErrors=array();
	if(isset($_GET['deleteConvo']))
	{
		if(checkIDS($_GET['deleteConvo']) === false)
		{
			$errors[] = 'invalid Convo ID';
		}
		if(empty($caughtErrors))
		{
			deleteConvo($_GET['deleteConvo']);
		}
	}
	$getConvo = getConvos();
	print_r($getConvo);
	if(empty($getConvo)===false)
	{
		foreach($caughtErrors as $errorscaught)
		{
			echo '<div class="error">', $errorscaught, '</div>';
		}
	}
?>
<div class = "inboxOptions">
	<a href="index.php?page=createConvo">Create Convo</a>
	<a href="index.php?page=logout">Logout</a>
</div>
<div class = convos>
		<?php
			foreach($getConvo as $convosGotten)
			{
				?>
					<div class = "convos <?php if($convosGotten['unread']) echo 'Unread Messages'; ?>">
						<h2>
							<a href = "index.php?page=inbox&amp;deleteConvo=<?php echo $convosGotten['id']; ?> ">[X]</a>
							<a href = "index.php?page=viewConvo&amp;convoID=<?php echo $convosGotten['id']; ?>"><?php echo $convosGotten['sub']; ?></a>
						</h2>
						<p>
							Last Reply: <?php echo date("m/d/Y H:i:s", strtotime($convosGotten['last'])); ?>
						</p>
					</div>
				<?php
			}
		?>
</div>