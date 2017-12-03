<?php
require 'serverlogin.php';

//$username = $_SESSION['TheUser'];
//$username = "LordCemOnur";

$oursql = "SELECT * FROM userbase";
$sorgu = mysqli_query($conn, $oursql);
	

while ($simdikirow = mysqli_fetch_assoc($sorgu)) {
	
	$username = $simdikirow["username"];
	echo "User: ". $username;
	
	// Daily spent llama //
	if ($simdikirow["current_credits"] > 0) {
		$updatellamas = "UPDATE userbase SET current_credits = current_credits - 1, spent_credits = spent_credits + 1 WHERE username='$username'";
		if (mysqli_query($conn, $updatellamas)) {
			echo " Reducted to: " . $simdikirow["current_credits"] ."<br>";
		} else {echo "DB Error (Code: 997) " . mysqli_error($conn);}
	}
	
	
	// Calculate Refferal points //
	$sql = "SELECT * FROM userbase WHERE refferal='$username'";
	$results = mysqli_query($conn, $sql);
	$sum = "0";
	if (mysqli_num_rows($results) > 0) {
	
		// $row = mysqli_fetch_assoc($results);
    	while($row = mysqli_fetch_assoc($results)) {
			$numbr = $row["spent_credits"]+$row["current_credits"]-$row["gift_credits"]-$row["purchased_credits"]-$row["ref_credits"];
			$sum = $sum+$numbr;
    	}
		
		$eskiref = $simdikirow["ref_credits"];
			echo "Eski Referans:". $eskiref ."<br>";
		$newref = (int)($sum/10);
			echo "Yeni Referans:". $newref ."<br>";
		$eklenecekllama = $newref-$eskiref;
			echo "Eklenecek LL Sayısı:". $eklenecekllama ."<br>";

		$updaterefs = "UPDATE userbase SET ref_credits='$newref', current_credits = current_credits + '$eklenecekllama' WHERE username='$username'";
		if (mysqli_query($conn, $updaterefs)) {
			echo "Record Updated Correctly <br/><br/>" . mysqli_error($conn);
		} else {echo "DB Error (Code: 1237) " . mysqli_error($conn);}

	} else {
		// echo "Else?"; // No Refferal Points //
	}

}

?>