<?php
require 'dbconfig/config.php';
?>


<!DOCTYPE HTML>
<html>
<head>
<title>Registruj se</title>
<link rel="stylesheet" href="css/style.css" type="text/css"/>
</head>
<body style="background-color:#bdc3c7">

	<div id="main-wrapper">
		<center><h2>Registruj se</h2>
		<img src="img/login.png" class="avatar" />
		</center>
		<form class="myform" action="register.php" method="post">
			
			<label>Ime</label><br>
			<input name="ime" type="text" class="inputvalues" 
			placeholder="Unesi svoje ime" required><br>

			<label>Prezime</label><br>
			<input name="prezime" type="text" class="inputvalues" 
			placeholder="Unesi svoje prezime" required><br>



			<label>Indeks</label><br>
			<input name="indeks" type="text" class="inputvalues" 
			placeholder="Type your username" required><br>
			
			<label>Lozinka</label><br>
			<input name="password" type="Password" class="inputvalues" placeholder="Type your password" required><br>
			
			<label>Potvrdi Lozinku</label><br>
			<input name="cpassword" type="Password" class="inputvalues" placeholder="Confirm Password" required><br>
			
			<input name="submit_btn" type="submit" id="signup_btn" value="Sign up"><br>
			<a href="index.php"><input type="button" id="back_btn" value="Back"><br></a>

		</form>

 <?php
 if(isset($_POST['submit_btn']))
 {
 //echo '<script type="text/javascript"> alert("Sign Up button clicked") </script>';
 $ime=$_POST['ime'];
 $prezime=$_POST['prezime'];
 $indeks = $_POST['indeks'];
 $password = $_POST['password'];
 $cpassword = $_POST['cpassword'];
 if($password==$cpassword)
 {
 $query= "SELECT * FROM student WHERE indeks='$indeks'";
 $result = mysqli_query($con,$query);
 $resultCheck=mysqli_num_rows($result);
 
 if($resultCheck>0)
 {
 // there is already a user with the same username
 echo '<script type="text/javascript"> alert("Student sa tim brojem indeksa vec postoji, izaberite drugi..") </script>';
 }
 else
 {
 $query= "INSERT INTO student (indeks,password,ime,prezime) values ('$indeks','$password','$ime','$prezime');";
 $result = mysqli_query($con,$query);
 if($result){
 echo '<script type="text/javascript"> alert("Student uspesno registrovan.. !") </script>';
 header('location:index.php');

}
else{
	 echo '<script type="text/javascript"> alert("greska.. !") </script>';
}
}
 
 
 }
 else{
 echo '<script type="text/javascript"> alert("Lozinke se ne podudaraju!") </script>'; 
 }
 }
 ?>

	</div>

</body>
</html>