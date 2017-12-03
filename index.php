<?php
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); 
require 'serverlogin.php';
?>

	<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="Description" CONTENT="Llama trade network for DeviantART. Our goal to create easy and practical way to exchange llamas.">
		<title>GetLlamas - Welcome to GetLlamas Llama Trade Network</title>
		<link rel="shortcut icon" href="favicon.ico" />
		<meta name="robots" content="noindex,nofollow">
		<meta name="language" content="English" />
		<meta http-equiv="Content-language" content="EN" />
		<meta http-equiv="Author" content="Cem Onur Erbay" />
		<meta http-equiv="Copyright" content="© 2015 LrdStudios" />
		<meta name="keywords" content="DeviantART, Llama, llamas, GetLlamas, internet, art, trade" />
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
		<style>
			@import url(http://fonts.googleapis.com/css?family=Ubuntu:400,700);
			body {
				overflow: hidden;
				height: 100%;
				width: 100%;
				position: fixed;
				background-color: #ECF1EB;
			}
			
			.bgllama {
				position: absolute;
				left: -2%;
				top: -2%;
				right: -2%;
				bottom: -2%;
				width: 104%;
				height: 104%;
				overflow: hidden;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				background-size: cover;
				<?php $randno=rand(1, 5);
				switch($randno) {
					case 1: echo "background: url(\"img/393953.jpg\") no-repeat scroll center top / cover #ECF1EB;";
					break;
					case 2: echo "background: url(\"img/393953.jpg\") no-repeat scroll center top / cover #ECF1EB;";
					break;
					case 3: echo "background: url(\"img/393953.jpg\") no-repeat scroll center top / cover #ECF1EB;";
					break;
					case 4: echo "background: url(\"img/638285.jpg\") no-repeat scroll center top / cover #ECF1EB;";
					break;
					case 5: echo "background: url(\"img/650214.jpg\") no-repeat scroll center top / cover #ECF1EB;";
					break;
				}
				?> transition-duration: 1s;
				-moz-transition-duration: 1s;
				-webkit-transition-duration: 1s;
				animation-duration: 1s;
				-moz-animation-duration: 1s;
				-webkit-animation-duration: 1s;
			}
			
			.container > header h1,
			.container > header h2 {
				color: #fff;
				text-shadow: 0 1px 1px rgba(0, 0, 0, 0.7);
			}
		</style>
	</head>

	<body>
		<?php include_once("analyticstracking.php") ?>
			<div class="bgllama"></div>
			<div id="main">


				<?php
// We are in a Session, proceeding
if(!empty($_SESSION['TheUser']) || isset($_COOKIE['llama_cookie']))

{
    //echo "Cookie Value is: " . $_COOKIE['llama_cookie'];
		
	if(empty($_SESSION['TheUser'])) {$username = $_COOKIE['llama_cookie'];}
	if(!isset($_COOKIE['llama_cookie'])) {$username = $_SESSION['TheUser'];}
        $_SESSION['LoggedIn'] = 1;
		echo "<p>We are now redirecting you to the member area.</p>";
        echo "<meta http-equiv='refresh' content='=0;URL=main.php' />";	//redirect
		echo "<script>top.window.location = 'main.php';</script>";		//redirect-ie
     ?>

					<p>Thanks for logging in! You're supposed to be redirected. We're hoping you're being redirected at this moment.</p>
					<p><a href="logout.php">Log Out</a></p>

					<?php
}
// User logging in
elseif(!empty($_POST['username']))
{
	$username = $_POST['username'];
	$sql = "SELECT id, username FROM userbase WHERE username='$username'";
	$result = mysqli_query($conn, $sql);
// RETURNING USER //
	if (mysqli_num_rows($result)==1) {
		$row = mysqli_fetch_assoc($result);
		 echo "id: " . $row["id"]. " - Name: " . $row["username"]. " <br>";

        $_SESSION['TheUser'] = $username;
        $_SESSION['LoggedIn'] = 1;
        
        echo "<h1>Success</h1>";
        echo "<p>We are now redirecting you to the member area.</p>";
        echo $refferal;
        sleep(10);
        echo "<meta http-equiv='refresh' content='=0;URL=main.php' />";	//redirect
		echo "<script>top.window.location = 'main.php';</script>";			//redirect-ie
		setcookie(llama_cookie, $username, time() + (86400 * 365));
		//print_r($_SESSION);
	}
// NEW USER //
    // TODO: ccheck user case
 else {
	 // NEW USER CREATION //
     echo "<p>User could not be found in our databases. Creating new getllamas account for you, hold on tight.</p>";
     include('simple_html_dom.php');
		$url = "http://".$username.".deviantart.com/badges/";
$userAgent = stream_context_create(array('http' => array('header' => 'User-Agent: Mozilla compatible')));
$response = file_get_contents($url, false, $userAgent);
$iconHTML = str_get_html($response);

foreach($iconHTML->find('div.bubbleview div.catbar div.authorative-avatar a img.avatar') as $element) {
 $link = $element->src;
    echo "<br>" .$link;
}
//foreach($iconHTML->find('div[class=description]') as $element) {
//    $strip = $element->plaintext;
//    if ($strip == 'Llamas are awesome!') {
//	//  echo "<br> Link found";	
//        $thelink = $element->parent()->href;
//			break;
//		} else {
//		if ($counter == 5) {
//			//$llama_check = "false";
//    		echo "Badge page not found!";
//			}
//		}
//}
         
if (isset($_GET["invitation"] )) {
   $refferal = $_GET["invitation"] ;
} else {
   $refferal = "";
}
    $registered = date("Y.m.d");

		$sql = "INSERT INTO userbase (username, gift_credits, current_credits, spent_credits, llamaed_users, llamaed_by, icon_link, badge_link, refferal, registered) VALUES ('$username', '0', '0', '0', '|', '|$username|', '$link', '$thelink', '$refferal', '$registered')";
		if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
		setcookie(llama_cookie, $username, time() + (86400 * 365));
		//print_r($_SESSION);
		$_SESSION['TheUser'] = $username;
        $_SESSION['LoggedIn'] = 1;
		echo "<p>We are now redirecting you to the member area.</p>";
        echo "<meta http-equiv='refresh' content='=0;URL=main.php' />";	//redirect
		echo "<script>top.window.location = 'main.php';</script>";		//redirect-ie
	} else {
    echo "Error Code L3540: " . $sql . "<br>" . $conn->error;
	}
}

}
// Entry page without no session
else
{
 ?>

						<script>
							$(document).ready(function () {
								$("form-3").css("opacity", "0.5");
								$(".bgllama").css("opacity", "1");

								$(".form-3").hover(
									function () {
										$(this).fadeTo(200, 1.0);
										//$ (".bgllama").css( "background-opacity", "0.5");
										$(".bgllama").css("opacity", "0.5");
										$(this).css("filter", "blur(0px)");
										$(this).css("-o-filter", "blur(0px)");
										$(this).css("-ms-filter", "blur(0px)");
										$(this).css("-moz-filter", "blur(0px)");
										$(this).css("-webkit-filter", "blur(0px)");
										$(".bgllama").css("opacity", "0.5");
									},
									function () {
										$(this).fadeTo(200, 0.45);
										$(".bgllama").css("opacity", "1");
										$(this).css("filter", "blur(1px)");
										$(this).css("-o-filter", "blur(1px)");
										$(this).css("-ms-filter", "blur(1px)");
										$(this).css("-moz-filter", "blur(1px)");
										$(this).css("-webkit-filter", "blur(1px)");
									}
								);

								$("#loginform").submit(function (event) {
									$(".form-3").animate({
										top: "-250px"
									}, 500)
								});

							});
						</script>

						<section class="main">
							<form class="form-3 transition" method="post" action="index.php<?php if (isset($_GET[" invitation "] )) {echo "?invitation=" . $_GET[" invitation "];} ?>" name="loginform" id="loginform">
								<h1 style="text-align: center;">Welcome to GetLlamas! (ßeta)</h1>
								<fieldset>

									<p class="clearfix centered">Please enter your current DeviantArt username to login!</p>

									<p class="clearfix">
										<label for="username">Username</label>
										<input type="text" name="username" id="username" placeholder="Username">
										<input type="submit" name="login" id="login" value="Sign in">
									</p>

									
										
									
								</fieldset>
								<h3 style="text-align: center;">This Month's Top Traders</h3>
                                <div class="leaderboard">
                                <?php                              
$thesql = "SELECT * FROM userbase ORDER BY current_credits DESC";
$theresults = mysqli_query($conn, $thesql);
    
$county = 0;
while(($bestofrow = mysqli_fetch_assoc($theresults)) && ($county<3)) {
    $county = $county+1;
        $llamasoftheuser = $bestofrow["spent_credits"]+$bestofrow["current_credits"];
    ?>
                                <a href="<?php echo "http://" . $bestofrow["username"] . ".deviantart.com"; ?>" target="External">
                                    <h4 class="media-heading"><?php echo $bestofrow["username"] ?></h4>
			
				<img class="media-object img-circle" src="<?php echo $bestofrow["icon_link"]; ?>" alt="">
			
			
				
				<!--<span>Sent <?php echo $bestofrow["spent_credits"]+$bestofrow["current_credits"]-$bestofrow["gift_credits"]-$bestofrow["purchased_credits"] ?> llamas.</span>-->
			
		</a>
                                <?php
   
    	}



    ?>
                                    <div>2<sup>nd</sup> Place</div>
		                          <div>1<sup>st</sup> Place</div>
								
								<div>3<sup>rd</sup> Place</div>
                                </div>
                               
							</form>
							
						</section>

						<?php
}
?>

			</div>
	</body>

	</html>