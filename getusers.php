<?php
	ini_set('display_errors',"1");
    include("./php/config.php");
	//Hier worden de post-request gedeclareerd.
	//De namen zoals deze gedefinieerd staan in $_POST[""] moeten deze naam bevatten.
	//Als er andere namen gebruikt worden, worden deze door het programma niet gebruikt.
	//De volgorde van het vesturen van de variabelen maak niet uit zolang de $_POST maar de correcte naam hebben. 
	//Voor binnenBuiten zijn de waardes 2 en 3 gekozen, omdat bij een True/False constructie de mogelijkheid bestond bij het leeg laten van binnenBuiten de persoon alsnog aanwezig werd gezet door het systeem.
	//$binnenBuiten 2 = De persoon gaat van buiten het pand naar binnen in het pand
	//$binnenBuiten 3 =  De persoon gaat van binnen het pand naar buiten. 
	$pasnummer = $_POST["pasnummer"];
	$binnenBuiten = $_POST["binnenBuiten"];
	// if (isset($_POST["uid"]) && isset($_POST["binnenBuiten"]))
	// {
		// $pasnummer = $_POST["uid"];
		// $binnenBuiten = $_POST["binnenBuiten"];

		//Hier wordt de connenctie aangemaakt met de database AccessSystem.
		//De username en password worden meegestuurd in de post-request.

		//Hieronder wordt het het statement gemaakt voor de database. 
		$sql = "SELECT * FROM pashouders WHERE pasnummer = '$pasnummer'AND deleted_at is NULL";

		//Als de gegevens correct zijn wordt de sql-statement uitgevoerd op de database AccessSystem.
		$result = $conn->query($sql);

		//Als er connectie is en het resultaat van $result 1 rij opgleverd en $binnenBuiten gelijk is aan 2.
		//Dan wordt de persoon door het systeem aanwezig gemeld in de database door middel van een update statement.
		//Het programma stuurt de post-request correct terug naar de verstuurder van de request. 
		//Tevens wordt er ook in de logtabel van de database een rij aangemaakt met de tijd, het pasnummer en binnenBuiten.
		//Na het uitvoeren wordt de verbinding afgesloten.
		if($conn && $result->num_rows > 0 && $binnenBuiten==2 ){

			$conn->multi_query("UPDATE pashouders SET aanwezig = 'Aanwezig' WHERE pasnummer = '$pasnummer';INSERT INTO `logs`(`tijdstip`,`pasnummer`,`binnenofbuiten`)VALUES(CURRENT_TIMESTAMP,'$pasnummer','Aanwezig');");
		        echo "correct";
			$conn->close();
		}
		else
		//Als er connectie is en het resultaat van $result 1 rij opgleverd en $binnenBuiten gelijk is aan 3.
		//Dan wordt de persoon door het systeem afwezig gemeld in de database door middel van een update statement.
		//Tevens wordt er ook in de logtabel van de database een rij aangemaakt met de tijd, het pasnummer en binnenBuiten.
		//Het programma stuurt de post-request correct terug naar de verstuurder van de request. 
		//Na het uitvoeren wordt de verbinding afgesloten.
		if($conn && $result->num_rows == 1 && $binnenBuiten==3 ){

			$conn->multi_query("UPDATE pashouders SET aanwezig = 'Afwezig' WHERE pasnummer = '$pasnummer';INSERT INTO `logs`(`tijdstip`,`pasnummer`,`binnenofbuiten`)VALUES(CURRENT_TIMESTAMP,'$pasnummer','Afwezig');");
		 	echo "correct";
			$conn->close();
		}

		//Mocht 1 of meerdere post-request niet correct zijn of het pasnummer is niet bekend in de database wordt er een post-request fout teruggestuurd naar de verstuurder van de request.
		//Vervolgens wordt de verbinding afgesloten.
		else
		{
			echo "fout";
			printf("Errormessage: %s\n", $conn->error);
			$conn->close();
		}
	// }
	// else
	// {
	// 	echo "nope";
	// }
?>
