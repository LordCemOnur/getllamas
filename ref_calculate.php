<?php
require 'serverlogin.php';
?>

<?php
$username = $_SESSION['TheUser'];
//$username = "LordCemOnur";
$sql = "SELECT * FROM userbase WHERE refferal='$username'";
$results = mysqli_query($conn, $sql);
//$row = mysqli_fetch_assoc($results);
$oursql = "SELECT * FROM userbase WHERE username='$username'";
$sorgu = mysqli_query($conn, $oursql);
$bizimrow = mysqli_fetch_assoc($sorgu);

$sum = "0";
//sleep(3);
if (mysqli_num_rows($results) > 0) {
    while($row = mysqli_fetch_assoc($results)) {

	//	echo $row["username"] . "<br>";
	$numbr = $row["spent_credits"]+$row["current_credits"]-$row["gift_credits"]-$row["purchased_credits"]-$row["ref_credits"];
	$sum = $sum+$numbr;
    //echo $numbr ."<br>";
	//	echo $sum ." :Sum<br>";
    }
	
	//	$row["spent_credits"]+$row["current_credits"]-$row["gift_credits"]-$row["purchased_credits"] 
	$eskiref = $bizimrow["ref_credits"];
		//echo "Eski Referans:". $eskiref ."<br>";
	$newref = (int)($sum/10);
		//echo "Yeni Referans:". $newref ."<br>";
	$eklenecekllama = $newref-$eskiref;
		//echo "Eklenecek LL Sayısı:". $eklenecekllama ."<br>";

$updaterefs = "UPDATE userbase SET ref_credits='$newref', current_credits = current_credits + '$eklenecekllama' WHERE username='$username'";
	if (mysqli_query($conn, $updaterefs)) {
		echo "<script>$.notify(\"Database refreshed. Your refferals earned you a total number of " . $newref . " llamas so far.\", { position: \"left top\", className: \"info\"});</script>";
    } else {echo "DB Error (Code: 1237) " . mysqli_error($conn);}
	
	
} else {
    //echo "Else?";
}



?>