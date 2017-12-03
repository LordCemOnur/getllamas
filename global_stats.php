<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Description" CONTENT="Llama trade network for DeviantART. Our goal to create easy and practical way to exchange llamas.">
    <title>GetLlamas Global Stats</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <meta name="robots" content="noindex,nofollow">
    <meta name="language" content="English" />
    <meta http-equiv="Content-language" content="EN" />
    <meta http-equiv="Author" content="Cem Onur Erbay" />
    <meta http-equiv="Copyright" content="© 2015 LrdStudios" />
    <meta name="keywords" content="DeviantART, Llama, llamas, GetLlamas, internet, art, trade" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/animate.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-25680577-7', 'auto');
        ga('send', 'pageview');
    </script>

</head>

<body class="cms-page-view cms-global-stats" style="background-color: #D4DFD0;">

    <?php
require 'serverlogin.php';
include_once("analyticstracking.php") ?>


        <?php
// We are in a Session, proceeding
if(!empty($_SESSION['TheUser']) && isset($_COOKIE['llama_cookie']))
{
	
$username = $_SESSION['TheUser'];
?>

            <div class="main">



                <div class="container-fluid site-container">
                    <div class="content-header">
                        <h1 class="theme-color" style="padding: 20px 0 0px 20px;">Global Stats</h1>
                    </div>

                    <div class="stat-window">
                        <h3>Llamas Sent</h3>
                        <?php
    $search1 = "SELECT * FROM userbase ORDER BY current_credits DESC";
	$results1 = mysqli_query($conn, $search1);
	$counter = 0;
	while(($row1 = mysqli_fetch_assoc($results1)) && ($counter<5) ) {
		//$counter<5
		$counter++;
		$future_counter = $counter+1;        

?>
                            <a href="<?php echo " http:// " . $row1["username "] . ".deviantart.com "; ?>" target="External">
                                 
			
				<img class="media-object img-circle" src="<?php echo $row1["icon_link"]; ?>" alt="">
			   <h4 class="media-heading"><?php echo $row1["username"] ?></h4>
			
				
				<!--<span>Sent <?php echo $row1["spent_credits"]+$row1["current_credits"]-$row1["gift_credits"]-$row1["purchased_credits"] ?> llamas.</span>-->
			
		</a>
                            <?php        
	}
?>
                    </div>

    <div class="stat-window">
        <h3>Referral Earnings</h3>
<?php
    $search1 = "SELECT * FROM userbase ORDER BY ref_credits DESC";
	$results1 = mysqli_query($conn, $search1);
	$counter = 0;
	while(($row1 = mysqli_fetch_assoc($results1)) && ($counter<5) ) {
		$counter++;
		$future_counter = $counter+1;        
?>
        <a href="<?php echo " http:// " . $row1["username "] . ".deviantart.com "; ?>" target="External">
        <img class="media-object img-circle" src="<?php echo $row1["icon_link"]; ?>" alt="">
        <h4 class="media-heading"><?php echo $row1["username"] ?></h4>
        </a>
<?php   }   ?>
                    </div>


<!--
                    <div class="stat-window">
                        This months most active members
                    </div>
-->

                    <div class="stat-window">
                          <h3>Total llamas sent to our users so far</h3>
<?php
$search3  = "SELECT * FROM userbase";
$results3 = mysqli_query($conn, $search3);
$toplam   = 0;
    while($row3 = mysqli_fetch_assoc($results3)) {
    $toplam = $toplam+$row3["spent_credits"]+$row3["current_credits"]-$row3["gift_credits"]-$row3["purchased_credits"];
    }
?>
                        <h4 class="media-heading"><?php echo $toplam ?> Llamas</h4>
<?php 
?>
                    </div>

                    <div class="stat-window">
                        <h3>Total llamas gifted to our users so far</h3>
<?php
$search3  = "SELECT * FROM userbase";
$results3 = mysqli_query($conn, $search3);
$toplamgift   = 100025;
    while($row3 = mysqli_fetch_assoc($results3)) {
    $toplamgift = $toplamgift+$row3["gift_credits"];
    }
?>
                        <h4 class="media-heading"><?php echo $toplamgift ?> Llamas</h4>
<?php 
?>
                    </div>

                </div>
            </div>
            <!-- .main end -->

            <!--
	<script src="js/bootstrap.js"></script>
	<script src="js/bootstrap-dialog.js"></script>
-->


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

                    <script src="js/bootstrap.js"></script>
                    <!--script src="js/jquery.mobile-1.4.5.min.js"></script-->
                    <script src="js/bootstrap-dialog.js"></script>


</body>

</html>