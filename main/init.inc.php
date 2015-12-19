<?php
	//error_reporting(-1);
	$servername = "localhost";
	$username = "root";
	$password = "";
	// $userName = $_POST['userName'];
	// $userPassword = $_POST['userPassword'];
	$main_path = dirname(__FILE__);

	//var_dump($_POST);
	
	//file_exists("{$main_path}/pages/{$_GET['page']}.page.inc.php");

	if(empty($_GET['page']) || in_array("{$_GET['page']}.page.inc.php", scandir("{$main_path}/pages/"))==false)
	{
		header('HTTP/1.1 404 Not Found');
		header('Location: index.php?page=inbox');

		die();
	}

	session_start();

	$conn = mysql_connect($servername, $username, $password);
	mysql_select_db('cheapomail');

	include("{$main_path}/inc/user.inc.php");
	include("{$main_path}/inc/membersMsg.inc.php");

	if(isset($_POST['userName'], $_POST['userPassword']))
	{	
		if(($userID = loginCheak($_POST['userName'], $_POST['userPassword'])) !== false)
		{

			$_SESSION['userID'] = $userID;
			header('Location: index.php?page=inbox');

			die();
		}
	}
	


	if(empty($_SESSION['userID']) && $_GET['page'] !== 'login')
	{
		header('HTTP/1.1 403 Forbidden');
		header('Location: index.php?page=login');

		die();
	}
	$include_file = "{$main_path}/pages/{$_GET['page']}.page.inc.php";
?>