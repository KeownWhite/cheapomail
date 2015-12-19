<?php
	// $for=$_POST['for'];
	// $subject = $_POST['subject'];
	// $msgbody = $_POST['msgbody'];
	
	if(isset($_POST['for'],$_POST['subject'],$_POST['msgbody']))
	{
		$errors = array();
		
		if(empty($_POST['for']))
		{
			$errors[] = "You need one recipient";
		}else if(preg_match('#^[a-z,]+$#i', $_POST['for'])===0)
		{
			$errors[] = 'List of names is invalid';
		}else{
			$userNames = explode(',', $_POST['for']);
			
			foreach ($userNames as &$name){
				$name = trim($name);
			}
			$userIDS = getIDS($userNames);
			if(count($userIDS) !== count($userNames)){
				$errors[] = 'The following user could not be located:' .implode(', ', array_diff($userNames, array_keys($userIDS)));
			}

		}


		if(empty($_POST['subject']))
		{
			$errors[] = 'You need a subject';
		}


		if(empty($_POST['msgbody']))
		{
			$errors[] = 'body cannot be empty';
		}
		if(empty($errors))
		{
			newConvo(array_unique($userIDS), $_POST['subject'], $_POST['msgbody']);

		}		
	}
	if(isset($errors))
	{
		if(empty($errors))
		{
			echo '<div class = "msgSuccess">Message Sent! <a href="index.php?page=inbox">Return to your Inbox</a></div>';	

		}else{
			foreach ($errors as $error) 
			{
				echo '<div class="msgError">', $error, '</div>';
			}
		}
	}
?>


<form action="" method="post" name = "createConvo">
	<table>
		<tr>
				<td>For:</td>
				<td><input type="text" name="for" id="for" value = "<?php if(isset($_POST['for'])) echo htmlentities($_POST['for']); ?> "/></td>
		</tr>
		<tr>
				<td>Subject:</td>
				<td><input type="text" name="subject" id="subject" value="<?php if(isset($_POST['subject'])) echo htmlentities($_POST['subject']);?>"/></td>
		</tr>
		<tr>
				<td>Message:</td>
				<td><textarea name="msgbody"><?php if(isset($_POST['msgbody'])) echo htmlentities($_POST['msgbody']); ?> </textarea></td>
		</tr>
		<tr>
				<td><input type="submit" value="send"/></td>	
		</tr>
	</table>
</form>