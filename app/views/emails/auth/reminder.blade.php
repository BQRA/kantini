<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<title>Kantini - Şifre Sıfırla</title>
	</head>
	<body>
		<h2>Şifre Sıfırla</h2>

		<div>
			Şifrenizi sıfırlamak için linke tıklayınız. <br>
			<a href="{{ URL::to('password/reset', array($token)) }}">Şifre Sıfırla</a><br/>
			
			Bu link kendini {{ Config::get('auth.reminder.expire', 30) }} dakika içinde imha edecektir.
		</div>
	</body>
</html>