<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login">
			<h1>Registrieren</h1>
			<form action="register.php" method="post">
					<label for="username">
						<i class="fas fa-user"></i>
					</label>
					<input type="text" name="UseMail" placeholder="E-Mail" id="usermail" required>
					<label for="username">
						<i class="fas fa-user"></i>
					</label>
					<input type="text" name="UseUserName" placeholder="Benutzername" id="username" required>
					<label for="password">
						<i class="fas fa-lock"></i>
					</label>
					<input type="password" name="UsePassword" placeholder="Passwort" id="password" required>
					<label for="password">
						<i class="fas fa-lock"></i>
					</label>
					<input type="password" name="UsePassword" placeholder="Passwort bestätigen" id="password" required>
					<input type="submit" value="Registrieren">
			</form>
		</div>
	</body>
</html>
