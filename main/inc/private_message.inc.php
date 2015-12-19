<?php
	function newConvo($userIDS, $subject, $msgbody){
		$subject = mysql_real_escape_string(htmlentities($subject));
		$subject = mysql_real_escape_string(htmlentities($msgbody));

		mysql_query("INSERT INTO `convo` (`convoSub`) VALUES ('{$subject}')");
		$convoID = mysql_insert_id();

		$sql = "INSERT INTO `convomsg`(`msgID`, `convoID`, `userID`, `date`, `msgTXT`) VALUES (NULL, {$convoID},{$_SESSION['userID']}, NOW(), '{$msgbody}')";

		mysql_query($sql);

		$results = array();
		$userIDS[] = $_SESSION['userID'];

		foreach($userIDS as $userID)
		{
			$userID = (int) $userID;
			$results[] = "({$convoID}, {$userID}, 0, 0)";
		}

		$sql = "INSERT INTO `convomembers`(`convoID`, `userID`, `lastView`, `deleted`) VALUES " .implode(", ", $results);
		mysql_query($sql);
	}
?>