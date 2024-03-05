<?php
// Database connection parameters
$host = 'mysql-db';   // MySQL server hostname within the same Docker network
$user = 'db_user';    // MySQL username
$pass = 'password';   // MySQL password
$db = 'test_database'; // MySQL database name

// Create a new MySQLi object to establish a database connection
$conn = new mysqli($host, $user, $pass, $db);

// Check if the connection was successful
if ($conn->connect_error) {
    // Display an error message and terminate the script if the connection fails
    die("Connection failed: " . $conn->connect_error);
}

//Variables
if (isset($_POST['txtNom'])) {$txtNom = $_POST["txtNom"];}
if (isset($_POST['txtPrenom'])){$txtPrenom = $_POST["txtPrenom"];}
if (isset($_POST['action'])){$action = $_POST["action"];}
$text = "";
$recherche = 0;

if (($_POST['txtNom'] != "") && ($_POST['txtPrenom'] != "")){

	switch ($action){
		case "Ajouter": //section pour rajouter
			$sql = "INSERT INTO test (nom, prenom) VALUES ('$txtNom', '$txtPrenom')";
			if ($conn->query($sql) === TRUE) {
  				$text =  "Ajout de $txtNom $txtPrenom effectué";
			} else {
  				$text = "Error: " . $sql . "<br>" . $conn->error;
			}
			break;
		case "Rechercher": //section pour rechercher
			$recherche = 1;
			$sql = "SELECT * FROM test WHERE nom LIKE '$txtNom' AND prenom LIKE '$txtPrenom'";
			break;
		case "Supprimer": //section pour supprimer
			$sql = "DELETE FROM test WHERE (`nom` LIKE '$txtNom') AND (`prenom` LIKE '$txtPrenom')";
			if ($conn->query($sql) === TRUE) {
                                $text = "Suppression de $txtNom $txtPrenom effectué";
                        } else {
                                $text = "Error: " . $sql . "<br>" . $conn->error;
                        }

			break;
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Page 1</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<style>
		table, th {
  			border: 1px solid black;
  			border-collapse: collapse;
		}
		table.center{
			margin-left: auto;
			margin-right: auto;
		}
		td.border{
                        border: 1px solid black;
                        border-collapse: collapse;
		}
		</style>
	</head>
	<body>
                <?php
                echo "<table class=center><td>PHP Connected to MySQL successfully</td></table>"; //Nous dit si la connexion à la BD est un succès
                ?>

		<table style="margin-left:auto;margin-right:auto;">
			<form method="post" action="index.php" >
				<tr>
					<td>Votre nom :</td>
					<td><input type="text" name="txtNom" value=""></td>
				</tr>
				<tr>
					<td>Votre prénom :</td>
					<td><input type="text" name="txtPrenom" value=""></td>

				</tr>
				<tr>
					<td><input type='submit' name="action" value='Ajouter'></td>
                                        <td><input type='submit' name="action" value='Rechercher'></td>
                                        <td><input type='submit' name="action" value='Supprimer'></td>
				</tr>
		</table>
		<table class=center>
			<?php if($text != ""){echo "<td style='color:red;'> $text </td>";} ?>
		</table>
		<table class=center>
			<tr>
				<th>Nom:</th>
				<th>Prénom:</th>
			</tr>
			<!-- <tr>
				<td class=border>Desbiens</td>
				<td class=border>Samuel</td>
			</tr> -->
			<?php
				if($recherche == 1){
					$result = $conn->query($sql);
					if ($result->num_rows > 0){
                                        	while ($row = $result->fetch_assoc()) {
                                                	echo "<tr><td class=border>". $row["nom"] ."</td>";
                                                	echo "<td class=border>". $row["prenom"] ."</td></tr>";
                                        	}
                                	}
				}
				if($recherche == 0){
                                	$sql2 = "SELECT * FROM test";
                                	$result = $conn->query($sql2);
                                	if ($result->num_rows > 0){
                                        	while ($row = $result->fetch_assoc()) {
                                                	echo "<tr><td class=border>". $row["nom"] ."</td>";
                                                	echo "<td class=border>". $row["prenom"] ."</td></tr>";
                                        	}
                                	}
				}
                        ?>
		</table>
	</body>
</html>
<?php
$conn->close();
?>
