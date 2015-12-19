<h1>Login</h1>
<?php
	if(isset($_POST['userName'], $_POST['userPassword']))
	{
		echo '<div class = "loginError">Login Failed.</div>';
	}
?>
<form action="index.php?page=login" method="post">
	<table>
		<tr>
				<td>Username:</td>
				<td><input type="text" name="userName" id="userName"/></td>
		</tr>
		<tr>
				<td>Password:</td>
				<td><input type="password" name="userPassword" id="userPassword"/></td>
		</tr>
		<tr>
				<td><input type="submit" value="Login"/></td>	
		</tr>
	</table>
</form>