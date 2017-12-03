<?php
require 'serverlogin.php';
?>

	<?php
// We are in a Session, proceeding
if(!empty($_SESSION['TheUser']) || isset($_COOKIE['llama_cookie']))
{
    
	if(empty($_SESSION['TheUser'])) {
        $username = $_COOKIE['llama_cookie'];
        $_SESSION['TheUser'] = $username;
    }
	if(!isset($_COOKIE['llama_cookie'])) {$username = $_SESSION['TheUser'];}
    
include_once('simple_html_dom.php');
$username = $_SESSION['TheUser'];
//$username = "LordCemOnur";
//$_POST['llama_given_to'] = "test";

////////////// Previous LLama Exist, Get Another LLama button clicked //////////////
echo "Previous LLama Exist, Get Another LLama button clicked";
	
if(isset($_POST['llama_given_to'])) { 

        $llama_given_to = strtolower($_POST['llama_given_to']); // TODO: check if post var mi diye
        //$llama_given_to = strtolower('FridafireFox'); // TEST PARAMETER
        $urlcheck = "http://".$username.".deviantart.com/badges/";
        //echo "<br>Url: " . $urlcheck;
        
	////////////// Update DB //////////////
	$activity = date("Y.m.d");

    $updatellamaed = "UPDATE userbase SET llamaed_users = CONCAT(llamaed_users,'$llama_given_to|'), last_activity='$activity' WHERE username='$username'";
	$updatellamaby = "UPDATE userbase SET llamaed_by = CONCAT(llamaed_by,'$username|') WHERE username='$llama_given_to'";
	if (mysqli_query($conn, $updatellamaed)) {//echo "<br> Record updated!";
    } else {echo "DB Error (Code: 1237) " . mysqli_error($conn);}
	if (mysqli_query($conn, $updatellamaby)) {//echo "<br> Record updated!";
    } else {echo "DB Error (Code: 9741) " . mysqli_error($conn);}
			
	//$updateDB = mysqli_query($conn, $query);
	//$updateDB2 = mysqli_query($conn, $query2);
	//TO DO: Multiple mysqli_queries in one call
    
////////////// Check Llama //////////////
	
$userAgent = stream_context_create(array('http' => array('header' => 'User-Agent: Mozilla compatible')));
$checkresponse = file_get_contents($urlcheck, false, $userAgent);
$deviousHTML = str_get_html($checkresponse);
	
$counter = 0;
	foreach($deviousHTML->find('ul#badgelist li span a') as $element) {
		$currentContent = strtolower($element->plaintext);

	//echo "<br>" .$currentContent;
	$counter++;
	//echo $counter;
		if ($currentContent == $llama_given_to) {
			$sql = "UPDATE userbase SET current_credits = current_credits + 1 WHERE username='$username'";
            $sql2 = "UPDATE userbase SET current_credits = current_credits - 1, spent_credits = spent_credits + 1 WHERE username='$llama_given_to'";
			if (mysqli_query($conn, $sql)) {echo "Update successfull";} else {echo "Error updating DB (Code: 4659) " . mysqli_error($conn);}
            if (mysqli_query($conn, $sql2)) {echo "Update successfull";} else {echo "Error updating DB (Code: 4459) " . mysqli_error($conn);}
//            echo "<script>$(\".hiddenmessage\").notify(\"A llama successfully credited to your account\", { position: \"right middle\", className: \"success\"});</script>";
//			$llama_check = "olmus";
//			$_SESSION['LlamaCheck'] = $llama_check;
            echo "Credited!";
			break;
		} else {
		if ($counter == 5) {
//	$llama_check = "olmamis";
//    $_SESSION['LlamaCheck'] = $llama_given_to;
    echo "<script>$(\".hiddenmessage\").notify(\"We couldn\'t verify your last llama, you probably allready sent a llama to that user.\", { position: \"right middle\", className: \"error\"});counterDecrease();</script>";
		}
		}
	}
    
    //<!-- ###########	Display next target user in line	########### -->
	echo "<br>Display next target user in line<br>";
	$search = "SELECT username,badge_link FROM userbase WHERE llamaed_by NOT LIKE '%|$username|%' AND current_credits > 0 ORDER BY current_credits DESC";
	$results1 = mysqli_query($conn, $search);
	$row1 = mysqli_fetch_assoc($results1);
	if (is_null($row1)) {
		echo "NOOOO more deviants in database";
$userAgent = stream_context_create(array('http' => array('header' => 'User-Agent: Mozilla compatible')));
$response = file_get_contents("http://www.deviantart.com/random/deviant", false, $userAgent);
$deviantHTML = str_get_html($response);
		//$deviantHTML = file_get_html("http://www.deviantart.com/random/deviant"); 
		foreach($deviantHTML->find('div.bubbleview div.catbar div.gruserbadge h1 span a') as $element) {
    	$randomUser = $element->plaintext;
    	echo "<br>" .$randomUser;
    	$curll = $randomUser;
    	$BadgeAdress = $randomUser . '.deviantart.com/badges/llama/';
        $Notification = "<script>$.notify(\"You have given a llama to all members of GetLlamas. You will now be shown random deviants.\", { position: \"left top\", className: \"info\"});</script>";
		}
//		$nextll = $randomUser;
//		echo "Next Target: " . $nextll . "<br>";
	}
	else {
		echo "<br>Not NULL<br>";
		$curll = $row1["username"];
        $BadgeAdress = $row1["username"] . '.deviantart.com/badges/llama/';
		echo "Next Target: " . $curll . "<br>";
		//echo "LLama given to: " . $llama_given_to . "<br>";
		echo "LLama given by: " . $username . "<br>";
	}
        
        
    } else {
        
    ////////////// Getting first Lllama //////////////
    
//<!-- ###########	Display next target user in line	########### -->
	echo "Getting First Datacik";
	$search = "SELECT username,badge_link FROM userbase WHERE llamaed_by NOT LIKE '%|$username|%' ORDER BY current_credits DESC";
	$results1 = mysqli_query($conn, $search);
	$row1 = mysqli_fetch_assoc($results1);
	if (is_null($row1)) {
		echo "NOOOO data";
$userAgent = stream_context_create(array('http' => array('header' => 'User-Agent: Mozilla compatible')));
$response = file_get_contents("http://www.deviantart.com/random/deviant", false, $userAgent);
$deviantHTML = str_get_html($response);
		foreach($deviantHTML->find('div.bubbleview div.catbar div.gruserbadge h1 span a') as $element) {
    	$randomUser = $element->plaintext;
    	echo "<br>" .$randomUser;
    	$curll = $randomUser;
    	$BadgeAdress = $randomUser . '.deviantart.com/badges/llama/';
        $Notification = "<script>$.notify(\"You have given a llama to all members of GetLlamas. You will now be shown random deviants.\", { position: \"left top\", className: \"info\"});</script>";
		}
//		$nextll = $randomUser;
//		echo "Next Target: " . $nextll . "<br>";
	}
	else {
		$curll = $row1["username"];
        $BadgeAdress = $row1["username"] . '.deviantart.com/badges/llama/';
		echo "Next Target: " . $curll . "<br>";
		//echo "LLama given to: " . $llama_given_to . "<br>";
		echo "LLama given by: " . $username . "<br>";
	}
    
    }

?>
		<div id="LoadedContent" style="background: #DDD; padding: 20px;">
			<div id="Curll"><?php echo $curll ?></div>
			<br>
			<div id="BadgeAdress"><?php echo $BadgeAdress ?></div>
			<br>
			<div id="Notify"><?php echo $Notification ?></div>
		</div>
		<?php
	
}
// User logging in
elseif(!empty($_POST['username']))
{

}
// Entry page without no session
else
{
?>
			<h1>This Can't be! Error: 645132</h1>
			<?php
}
?>