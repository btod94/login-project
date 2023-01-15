<?php

require 'dbconfig/config.php';
 session_start();
	@$indeks="";
	@$ime="";
	@$prezime="";
	@$projekat="";
	@$ocena="";
	@$opis="";
?>
<!DOCTYPE html>
<html>
<head>
<title>Adminpage</title>
<link rel="stylesheet" href="css/style2.css">
</head>
<body style="background-color:#bdc3c7">

	<div id="main-wrapper">
		<center><h2>Administratorska stranica</h2></center>
		<div class="inner_container">
		
			<?php
				if(isset($_POST['fetch_btn'])){
					
						$indeks= $_POST['indeks'];
						$query = "SELECT * FROM student WHERE indeks='$indeks'";
						$result = mysqli_query($con,$query);
						$resultCheck=mysqli_num_rows($result);
				
							if($resultCheck>0)
							{
								$row = mysqli_fetch_array($result);
								@$indeks=$row['indeks'];
								@$ime=$row['ime'];
								@$prezime=$row['prezime'];
							}
							else{
								echo '<script type="text/javascript">alert("Pogresan broj indeksa")</script>';
							}
						
					}
			?>
			
			<form action="adminpage.php" method="post">
				<label><b>Broj indeksa</b> </label> <br>
				<input type="text" placeholder="Unesi broj indeksa" name="indeks" value="<?php echo @$_POST['indeks'];?>" ><br>
				<label><b>Ime</b></label><br>
				<input type="text" placeholder="Unesi ime studenta" name="ime" value="<?php echo $ime; ?>"><br>
				<label><b>Prezime</b></label><br>
				<input type="text" placeholder="Unesi prezime" name="prezime" value="<?php echo $prezime; ?>"><br>
				<label><b>Projekat</b></label><br>
				<input type="text" placeholder="Ime projekta" name="projekat"value="<?php echo $projekat; ?>" ><br>
				<label><b>Ocena</b></label><br>
				<input type="text"  name="ocena" value="<?php echo $ocena; ?>"></br>
				<label><b>Opis projekta</b></label><br>
				<input type="text"  name="opis" value="<?php echo $opis; ?>"></br>
				<button id="btn_go" name="fetch_btn" type="submit">OK</button>
				<button id="btn_update" name="update_btn" type="submit">Izmeni</button>
				<button id="btn_delete" name="delete_btn" type="submit">Obrisi</button></br>
				<input name="logout" type="submit" id="logout_btn" value="Odjavi se"/><br>
		
			</form>
			
			<?php
			
				if(isset($_POST['update_btn']))
				{
						if($_POST['indeks']==""){
						echo '<script type="text/javascript">alert("Unesi broj indeksa studenta koga zelis da izmenis..")</script>';
						}
						else{
						@$indeks=$_POST['indeks'];
						@$ime=$_POST['ime'];
						@$prezime=$_POST['prezime'];
						@$projekat=$_POST['projekat'];
						@$ocena=$_POST['ocena'];
						@$opis=$_POST['opis'];
						
						$query = "Insert into Projekat (indeks,projekat,ocena,opis) VALUES ('$indeks','$projekat','$ocena','$opis')";
							
						$query_run = mysqli_query($con,$query);
				
							if($query_run)
							{
								echo '<script type="text/javascript">alert("Student uspesno izmenjen")</script>';
							}
							else{
								echo '<script type="text/javascript">alert("Error")</script>';
							}
						
					}

				}
				
				if(isset($_POST['delete_btn'])){
						if($_POST['indeks']==""){
						echo '<script type="text/javascript">alert("Unesi broj indeksa studenta koga zelis da obrises..")</script>';
						}
						else{
						$indeks = $_POST['indeks'];
						$projekat = $_POST['projekat'];
						$query = "DELETE FROM projekat WHERE projekat='$projekat' and indeks='$indeks'";
						$query_run = mysqli_query($con,$query);
						if($query_run)
						{
							echo '<script type="text/javascript">alert("Student skinut sa projekta")</script>';

						}
						else
						{
							echo '<script type="text/javascript">alert("Error in query")</script>';
						}
					}
				
				}
			?>
		</div>
		
		<div class="inner_container_2">
		<p>Tabela podataka</p>	
	<?php 
	
	$query="SELECT * FROM student join projekat on projekat.indeks = student.indeks; ";
	$result=mysqli_query($con,$query);
	echo "<table border='1' id='tabela'>
			<tr>
			<th>Indeks</th>
			<th>Ime</th>
			<th>Prezime</th>
			<th>Projekat</th>
			<th>Ocena</th>
			<th>opis</th>
			</tr>";

	while($record=mysqli_fetch_array($result)){
		echo "<tr>";
		echo  "<td>" . $record['indeks'] . "</td>";
		echo  "<td>" . $record['ime'] . "</td>";
		echo  "<td>" . $record['prezime'] . "</td>";
		echo  "<td>" . $record['projekat'] . "</td>";
		echo  "<td>" . $record['ocena'] . "</td>";
		echo  "<td>" . $record['opis'] . "</td>";
		echo "</tr>";
	}

	echo "</table>";
?>
		</div>
	</div>

	 <?php
 if(isset($_POST['logout']))
 {
 session_destroy();
 header('location:index.php');
 }
 ?>
</body>
</html>