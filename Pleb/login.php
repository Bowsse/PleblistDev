<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="styles/style.css" type="text/css" rel=stylesheet>
</head>

<body>
<?php include_once("includes/nav.html"); ?>

<main class="loginMain">
	<article class="login">
		<h1>Login</h1>
		<form method="get">
			<input class="loginInput" type="text" name="name" placeholder="username"><br>
			<input class="loginInput" type="password" name="password" placeholder="password"><br>
			<button type="submit" name="login">Log in</button>
			<button type="submit" name="signup">Sign up</button>
		</form>
	</article>
</main>
<?php include_once("includes/footer.php"); ?>
</body>
