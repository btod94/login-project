<?php
 session_start();
 require 'dbconfig/config.php'
?>

 <!DOCTYPE html>
<html>
<head>
<title>Homepage</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">
 
 <div id="main-wrapper">
<center>
 <h2>Home page</h2>
<h3>Dobrodosli  <?php
$indeks= $_SESSION['indeks'];
$query="select ime,prezime from student where indeks='$indeks';"; 
$result=mysqli_query($con,$query);

while ($result1=mysqli_fetch_array($result)){
	echo $result1['ime'];
	echo " ";
	echo $result1['prezime'];
}



  ?></h3>
</center>


 

 
<?php 
    $indeks= $_SESSION['indeks'];

	
	$query="SELECT projekat,ocena,opis from projekat join student on projekat.indeks= student.indeks where projekat.indeks='$indeks' ";
	$result=mysqli_query($con,$query);
	echo "<table border='1' id='tabela'>
			<tr>
			<th>Projekat</th>
			<th>Opis</th>
			<th>Ocena</th>
			</tr>";

	while($record=mysqli_fetch_array($result)){
		echo "<tr>";
		echo  "<td>" . $record['projekat'] . "</td>";
		echo  "<td>" . $record['opis'] . "</td>";
		echo  "<td>" . $record['ocena'] . "</td>";
		echo "</tr>";
	}
	
?> 

<form class="myform" action="homepage.php" method="post">
 <input name="logout" type="submit" id="logout_btn" value="Log Out"/><br> </form>

 <?php
 if(isset($_POST['logout']))
 {
 session_destroy();
 header('location:index.php');
 }
 ?>
 </div>
</body>
</html>
