<?php
	session_start();
	require_once('dbconfig/config.php');

?>

<!DOCTYPE html>
<html>
<head>
<title>Prijavljivanje</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2>Prijava</h2></center>
			<div class="imgcontainer">
				<img src="imgs/avatar.png" alt="Avatar" class="avatar">
			</div>
		<form action="index.php" method="post">

			<div class="inner_container">
				<label><b>Korisnicko ime: </b></label>
				<input type="text" placeholder="Unesite korisnicko ime" name="username" required>
				<label><b>Korisnicka lozinka: </b></label>
				<input type="password" placeholder="Unesite lozinku" name="password" required>
				<button class="login_button" name="login" type="submit">Prijavi se</button>
				<a href="register.php"><button type="button" class="register_btn">Registruj se</button></a>
			</div>
		</form>

		<?php
			if(isset($_POST['login']))
			{
				@$username=$_POST['username'];
				@$password=$_POST['password'];
				$query = "select * from korisnik where username='$username' and password='$password' ";

				$query_run = mysqli_query($con,$query);

				if($query_run)
				{
					if(mysqli_num_rows($query_run)>0)
					{
					$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);

					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;

					header( "Location: homepage.php");
					}
					else
					{
						echo '<script type="text/javascript">alert("Korisnik ne postoji. Pokusajte ponovo!")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Greska baze podataka!")</script>';
				}
			}
			else
			{
			}
		?>

	</div>
</body>
</html>
