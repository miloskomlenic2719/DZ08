<?php
	session_start();
	require_once('dbconfig/config.php');

?>
<!DOCTYPE html>
<html>
<head>
<title>Registracija</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2>Registracija</h2></center>
		<form action="register.php" method="post">
			<div class="imgcontainer">
				<img src="imgs/avatar.png" alt="Avatar" class="avatar">
			</div>
			<div class="inner_container">
				<label><b>Korisnicko ime: </b></label>
				<input type="text" placeholder="Unesite korisnicko ime" name="username" required>
				<label><b>Korisnicka lozinka: </b></label>
				<input type="password" placeholder="Unesite lozinku" name="password" required>
				<label><b>Potvrdi lozinku: </b></label>
				<input type="password" placeholder="Potvrdite lozinku" name="cpassword" required>
				<button name="register" class="sign_up_btn" type="submit">Registruj se</button>

				<a href="index.php"><button type="button" class="back_btn"><< Povratak na prijavljivanje</button></a>
			</div>
		</form>

		<?php
			if(isset($_POST['register']))
			{
				@$username=$_POST['username'];
				@$password=$_POST['password'];
				@$cpassword=$_POST['cpassword'];

				if($password==$cpassword)
				{
					$query = "select * from korisnik where username='$username'";

				$query_run = mysqli_query($con,$query);

				if($query_run)
					{
						if(mysqli_num_rows($query_run)>0)
						{
							echo '<script type="text/javascript">alert("Korisnicko ime vec postoji. Pokusajte sa drugim korisnickim imenom!")</script>';
						}
						else
						{
							$query = "insert into korisnik values('$username','$password')";
							$query_run = mysqli_query($con,$query);
							if($query_run)
							{
								echo '<script type="text/javascript">alert("Korisnik je registrovan. Dobrodosli!")</script>';
								$_SESSION['username'] = $username;
								$_SESSION['password'] = $password;
								header( "Location: homepage.php");
							}
							else
							{
								echo '<p class="bg-danger msg-block">Registracija nije uspela. Pokusajte ponovo kasnije!</p>';
							}
						}
					}
					else
					{
						echo '<script type="text/javascript">alert("Greska baze podataka!")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Lozinke se ne podudaraju! Pokusajte opet.")</script>';
				}

			}
			else
			{
			}
		?>
	</div>
</body>
</html>
