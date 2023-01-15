<?php
SESSION_START();
require 'dbconfig/config.php'
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="css/style.css" type="text/css"/>
</head>
<body style="background-color:#bdc3c7">

	<div id="main-wrapper">
		<center><h2>Login Form</h2>
		<img src="img/login.png" class="avatar" />
		</center>
		<form class="myform" action="index.php" method="post">
			<label>Indeks</label><br>
			<input type="text" name="indeks" class="inputvalues" placeholder="Unesi broj indeksa.."><br>
			<label>Password</label><br>
			<input type="Password" name="password" class="inputvalues" placeholder="Unesi svoju lozinku"><br>
			<input type="submit" name="login" id="login_btn" value="Login"><br>
			<a href="register.php"><input type="button" id="register_btn" value="Register"><br></a>
		</form>

	<?php

			if(isset($_POST['login'])){
				
				$indeks=$_POST['indeks'];
				$password=$_POST['password'];
			
				if($indeks=="adm" && $password=="$password"){
					$_SESSION['indeks']=$indeks;
					header('location:adminpage.php');
				}

				else{

				$query="SELECT * FROM student WHERE indeks='$indeks' AND password='$password'";
				$result=mysqli_query($con,$query);
				$resultCheck=mysqli_num_rows($result);
				
				if($resultCheck>0){
				$_SESSION['indeks']=$indeks;
				echo '<script type="text/javascript"> alert("Access granted!") </script>';
				header('location:homepage.php');
				}
				else{

				 echo '<script type="text/javascript"> alert("Nepostojece korisnicko ime/lozinka..!") </script>';
				}
				}

				}
		?>

	</div>

</body>
</html>