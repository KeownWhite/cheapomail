<?php
	function getConvos()
	{
		$sql = "SELECT `convos`.`convoID`, `convos`.`convoSub`, MAX(`convomsg`.`date`) AS `lastReply`, MAX(`convomsg`.`date`) > `convomembers`.`lastView` as `notRead`FROM `convos` 
				LEFT JOIN `convomsg` ON `convos`.`convoID` = `convomsg`.`convoID` INNER JOIN `convomembers` ON `convos`.`convoID` = `convomsg`.`convoID` 
				WHERE `convomembers`.`userID`= {$_SESSION['userID']} AND `convomembers`.`deleted` = 0 GROUP BY `convos`.`convoID` ORDER BY `lastReply` DESC";


		$result= mysql_query($sql);
		//die(mysql_error());

		$convo = array();

		while(($row = mysql_fetch_array($result)) !== false)
		{
			$convo[] = array(
				'id'	=>  $row['convoID'],
				'sub'	=>	$row['convoSub'],
				'last'	=> 	$row['lastReply'],
				'unread'=>	($row['notRead'] == 1),
				);
			
		}
		return $convo;
	}
	function fetchConvo($convoID)
	{
		$convoID = (int)$convoID;
		$sql = "SELECT 
						`convomsg`.`date`
						`convomsg`.`msgTXT`
						`users`.`userName`
				FROM `convomsg`
				INNER JOIN `users` ON `convomsg`.`userID` = `users`.`userName`
				WHERE `convomsg`.`convoID`={$convoID}
				ORDER BY `convomsg`.`date` DESC";

		$result = mysql_query($sql);

		$list_msg = array();

		while (($row = mysql_fetch_assoc($result)) !== false)
		{
			$list_msg[] = array(
				'date' 		=> $row['date'],
				'text'		=> $row['msgTXT'],
				'username'	=> $row['userName']

			);	
		}
		return $list_msg;

	}
	function newConvo($userIDS, $subject, $msgbody)
	{
		$subject = mysql_real_escape_string(htmlentities($subject));
		$subject = mysql_real_escape_string(htmlentities($msgbody));

		mysql_query("INSERT INTO `convos` (`convoSub`) VALUES ('{$subject}')");
		$convoID = mysql_insert_id();

		$sql = "INSERT INTO `convomsg`(`msgID`, `convoID`, `userID`, `date`, `msgTXT`) VALUES (NULL, {$convoID},{$_SESSION['userID']}, NOW(), '{$msgbody}')";

		mysql_query($sql);

		$results = array("({$convoID}, {$_SESSION['userID']}, NOW(), 0)");


		foreach($userIDS as $userID)
		{
			$userID = (int) $userID;
			$results[] = "({$convoID}, {$userID}, 0, 0)";
		}

		$sql = "INSERT INTO `convomembers`(`convoID`, `userID`, `lastView`, `deleted`) VALUES " .implode(", ", $results);
		mysql_query($sql);
	}
	function checkIDS($convoID)
	{
		$convoID = (int)$convoID;

		$sql = "SELECT COUNT(1) FROM `convomembers` WHERE `convoID` = {$convoID} AND  `userID` = {$_SESSION['userID']} AND `deleted` = 0 ";
		
		$result = mysql_query($sql);

		return (mysql_result($result, 0) == 1);

	}
	function deleteConvo($convoID)
	{		
		$convoID = (int)$convoID;

		$sql = "SELECT DISTINCT `deleted` FROM `convomembers` WHERE `userID` != {$_SESSION['userID']} AND `convoID` = {$convoID}";
		$result = mysql_query($sql);

		if(mysql_num_rows($result) === 1 && mysql_result($result, 0) == 1)
		{
			mysql_query("DELETE FROM `convos` WHERE `convoID` = {$convoID}");
			mysql_query("DELETE FROM `convomembers` WHERE `convoID` = {$convoID}");
			mysql_query("DELETE FROM `convomsg` WHERE `convoID` = {$convoID}");

		}else{
			$sql = "UPDATE `convomembers` SET `deleted` = 1 WHERE `convoID` = {$convoID} AND `userID`= {$_SESSION['userID']}";
			mysql_query($sql);
		}

	}
?>