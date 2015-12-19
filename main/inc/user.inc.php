<?php
	function loginCheak($userName, $userPassword)
	{
		$userName = mysql_real_escape_string($userName);
		$userPassword = sha1($userPassword);
		
		$result = mysql_query("SELECT `userID` FROM `users` WHERE `userName` = '{$userName}' AND `userPassword` = '{$userPassword}'");
		if(mysql_num_rows($result) != 1)
		{
			return false;
		}
		return mysql_result($result, 0);

	}
	function getIDS($userNames)
	{
		foreach ($userNames as &$name) 
		{ 
			$namesList =  mysql_real_escape_string($name);
		}
		$result = mysql_query("SELECT `userID`, `userName` FROM `users` WHERE `userName` IN ('".implode("', '", $userNames)."')");
		
		$names = array();


		while (($row = mysql_fetch_array($result)) !== false) 
		{
			$names[$row['userName']] = $row['userID'];
		}
		return $names;
	}
?>