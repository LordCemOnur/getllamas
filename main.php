<?php
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); 
require 'serverlogin.php';
?>

	<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="Description" CONTENT="Llama trade network for DeviantART. Our goal to create easy and practical way to exchange llamas.">
		<title>GetLlamas - Llama Exchange</title>
		<link rel="shortcut icon" href="favicon.ico" />
		<meta name="robots" content="noindex,nofollow">
		<meta name="language" content="English" />
		<meta http-equiv="Content-language" content="EN" />
		<meta http-equiv="Author" content="Cem Onur Erbay" />
		<meta http-equiv="Copyright" content="© 2015 LrdStudios" />
		<meta name="keywords" content="DeviantART, Llama, llamas, GetLlamas, internet, art, trade" />
		<link rel="stylesheet" href="css/font-awesome.css" type="text/css">
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<link rel="stylesheet" href="css/animate.css" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="js/notify.min.js"></script>
		<!--<script src="js/jquery.xdomainajax.js"></script>-->
		<script>
			// Counter Animation //
			function counterIncrease() {
				$("#current_llama_count").toggleClass("flipOutX").delay(400).queue(function (next) {
					var llincrease = parseInt($("#current_llama_count").text(), 10) + 1;
					$(this).text(llincrease).toggleClass("flipOutX");
					//$("#current_llama_count").text(llincrease);
					next();
				});
			}

			function counterDecrease() {
				$("#current_llama_count").toggleClass("flipOutX").delay(400).queue(function (next) {
					var llincrease = parseInt($("#current_llama_count").text(), 10) - 1;
					$(this).text(llincrease).toggleClass("flipOutX");
					//$("#current_llama_count").text(llincrease);
					next();
				});
			}
		</script>
	</head>

	<body>
		<?php include_once("analyticstracking.php") ?>
			<div class="hiddenmessage"></div>
			<?php
// We are in a Session, proceeding
if(!empty($_SESSION['TheUser']) || isset($_COOKIE['llama_cookie']))

{
    
	if(empty($_SESSION['TheUser'])) {
        $username = $_COOKIE['llama_cookie'];
        $_SESSION['TheUser'] = $username;
    }
	if(!isset($_COOKIE['llama_cookie'])) {$username = $_SESSION['TheUser'];}
    $username = $_SESSION['TheUser'];
    
    $sql = "SELECT * FROM userbase WHERE username='$username'";
	$results = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($results);
     ?>
				<section>
					<div class="leftpanel">
						<div class="leftpanelinner">
							<!-- ################## LEFT PANEL PROFILE ################## -->
							<div class="leftpanel-userinfo" id="loguserinfo">
								<!--
							<h5 class="sidebar-title">Address</h5>
							<address>
          4975 Cambridge Road
          Miami Gardens, FL 33056
        </address>
-->
								<!--							<h5 class="sidebar-title">Contact</h5>-->
								<ul class="list-group">
									<li class="list-group-item">
										<label class="pull-left">Llamas you will receive:
											<!--Llamas on the way:-->
										</label>
										<span id="current_llama_count" class="pull-right flipInX animated"><?php echo $row["current_credits"] ?></span>
									</li>
								</ul>
							</div>
							<!-- leftpanel-userinfo -->
							<div class="media leftpanel-profile">
								<div class="media-left">
									<a href="#">
									<img src="<?php echo $row["icon_link"] ?>" alt="" class="media-object img-circle">
								</a>
								</div>
								<div class="media-body">
									<h4 class="media-heading"><?php echo $row["username"] ?></h4>
									<!--								<span>Software Engineer</span>-->
								</div>
							</div>
							<!-- leftpanel-profile -->



							<ul class="nav nav-tabs nav-justified nav-sidebar">
								<li data-original-title="Main Menu" class="tooltips active" data-toggle="tooltip" title="">
									<a data-toggle="tab" data-target="#mainmenu">
										<i title="" data-original-title="" class="tooltips fa fa-ellipsis-h"></i></a>
								</li>
								<li data-original-title="Received Llamas" class="tooltips" data-toggle="tooltip" title="">
									<a data-toggle="tab" data-target="#emailmenu">
										<i title="" data-original-title="" class="tooltips fa fa-arrow-circle-down"></i></a>
								</li>
								<li data-original-title="Sent Llamas" class="tooltips sentllama" data-toggle="tooltip" title="">
									<a data-toggle="tab" data-target="#contactmenu">
										<i class="fa fa-arrow-circle-up"></i></a>
								</li>
								<li data-original-title="Settings" class="tooltips" data-toggle="tooltip" title="">
									<a data-toggle="tab" data-target="#settings">
										<i class="fa fa-cog"></i></a>
								</li>
								<li data-original-title="Log Out" class="tooltips last" data-toggle="tooltip" title="">
									<a href="logout.php">
										<i class="fa fa-sign-out"></i></a>
								</li>
							</ul>

							<div class="tab-content">

								<!-- ######################## MAIN MENU ######################## -->
								<div class="tab-pane active" id="mainmenu">
									<?php //include('menu_main.php'); ?>

										<!--
<h5 class="sidebar-title">Favorites</h5>
          <ul class="nav nav-pills nav-stacked nav-quirk">
            <li class="active"><a href="index.html"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
            <li><a href="widgets.html"><span class="badge pull-right">10+</span><i class="fa fa-cube"></i> <span>Widgets</span></a></li>
            <li><a href="maps.html"><i class="fa fa-map-marker"></i> <span>Maps</span></a></li>
          </ul>
-->

										<h5 class="sidebar-title">Main Menu</h5>
										<ul class="nav nav-pills nav-stacked nav-quirk">

											<li class="nav-parent"><a href=""><i class="fa fa-line-chart"></i> <span>My Stats</span></a>
												<ul style="" class="children">
													<li><a>Llamas sent so far:<span class="pull-right numeric"> <?php echo $row["spent_credits"]+$row["current_credits"]-$row["gift_credits"]-$row["purchased_credits"] ?></span></a></li>
													<li><a>Llamas received:<span class="pull-right numeric"> <?php echo $row["spent_credits"] ?></span></a></li>
													<li><a>Gift llamas:<span class="pull-right numeric"> <?php echo $row["gift_credits"] ?></span></a></li>
													<li><a>Earned by referrals:<span class="pull-right numeric"> <?php echo $row["ref_credits"] ?></span></a></li>
													<!--	<li><a>Llamas bought:<span class="pull-right numeric"> <?php echo $row["purchased_credits"] ?></span></a></li>-->

												</ul>
											</li>

											<li><a target="External" href="global_stats.php"><i class="fa fa-bar-chart"></i> <span>Global Stats</span></a></li>

											<li class="nav-parent"><a href=""><i class="fa fa-group"></i> <span>My Referrals</span></a>
												<ul style="" class="children">

													<?php
         echo "<script>console.log('Cookie: " . $_COOKIE['llama_cookie'] . "')</script>";
	$searchy = "SELECT * FROM userbase WHERE refferal='$username'";
	$resulty = mysqli_query($conn, $searchy);

	if (mysqli_num_rows($resulty) > 0) {
		 echo "<li style=\"margin-top: 10px; padding-left: 18px; margin-bottom: 5px;\">Your referrals earned following amounts of llamas for you:</li>";
    while($rowy = mysqli_fetch_assoc($resulty)) {
		$numbero = $rowy["spent_credits"]+$rowy["current_credits"]-$rowy["gift_credits"]-$rowy["purchased_credits"]-$rowy["ref_credits"];
		$refllamalari = (int)($numbero/10);
       echo "<li><a>" . $rowy["username"] . ":<span class=\"pull-right numeric\">" . $refllamalari . " Llamas</span></a></li>";
    }
} else {
    echo "<div style=\"padding:10px; text-transform: none;\">You can invite people with this link and earn a llama for each 10 they send: <code><input name=\"cody\" class=\"cody\" type=\"text\" value=\"www.getllamas.com/?invitation=" . $_SESSION['TheUser'] . "\"></input></code></div>";
}
?>
												</ul>
											</li>


											<li><a target="External" href="faq.php"><i class="fa fa-question-circle"></i> <span>FAQ</span></a></li>


											<div style="height:185px;">
												<p>
													<a id="NextLLamaPls" class="a-btn" href="javascript:void(0);">

														<span class="no1"></span>
														<span class="no2">GET <span class="another">another</span> LLAMA!</span>
														<span class="no3"></span></a>
												</p>
											</div>
											
<!--
											<div class="small reklam-container">
												small
											</div>
											
											<div class="medium reklam-container">
												medium
											</div>
											
											<div class="large reklam-container">
												large
											</div>
-->
											
											<div class="reklam-container">

												<div id="adblock-placeholder">
												<span class="first-word">So</span> <span style="font-size: 15.5px;">normally</span> <span style="line-height:19px;">there would</span> be an ad in this spot. But you’re using an ad-blocker like a boss. <span style="font-size: 23px; line-height: 24px;">That's cool,</span> except that GetLLamas is supported only with <span style="font-size: 20px; line-height: 17px;">ads &amp; we need</span> money to run our servers. Would you like to donate us $5 instead so we can keep the site running?<span style="text-align:center;">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</span></div>
												<div id="reklam">
													<?php include('reklam_adaptive.php'); ?>
												</div>
											</div>

											<div class="hiddenll" style="display:none; height:50px; width:100px; overflow: scroll; background-color:#CEE"></div>
											<!--								<div class="hiddennextll" style="height:50px; width:100px; overflow: scroll; background-color:#ECE"></div>-->


										</ul>
								</div>
								<!-- ######################## LLAMAS RECEIVED MENU ############# -->
								<div class="tab-pane" id="emailmenu">
									<?php //include('menu_llamas_received.php'); ?>
								</div>
								<!-- ######################## LLAMAS SENT MENU ################# -->
								<div class="tab-pane" id="contactmenu">
									<?php //include('menu_llamas_sent.php'); ?>
								</div>
								<!-- ######################## SETTINGS ######################### -->
								<div class="tab-pane" id="settings">
									<?php //include('menu_settings.php'); ?>
								</div>
							</div>
							<!-- tab-content -->
						</div>
						<!-- leftpanelinner -->
					</div>



					<div id="main" class="mainpanel">
						<iframe id="External" name="External" frameBorder="0" seamless="seamless" src="welcome.php"></iframe>


						<!-- ###########	Click function here		########### -->
						<script>
							$(document).ready(function () {
								var buttstate;
								buttstate = 1;
								console.log("buttstate = ready;")
								$(".another").hide();
								$(".cody").click(function () {
									$(".cody").select();
								});

								$("#NextLLamaPls").click(function () {
									if (buttstate == 1) {
										buttstate = 0;
										console.log("buttstate = processing;")
										counterIncrease();
										$('#External').attr('src', 'loading.html');
										$(".another").show();
										$('#reklam').load('reklam_adaptive.php')


										//////////  Llama Check  //////////
										var previousll = $("#Curll").text();
										if (previousll != "") {
											console.log("Previous Llama Check for: " + previousll);
											$.ajax({
													method: "POST",
													url: "nexttarget.php",
													cache: false,
													data: {
														llama_given_to: previousll
													}
												})
												.done(function (result) {
													$(".hiddenll").html(result);
													var currentll = $("#BadgeAdress").text();
													$('#External').attr('src', 'http://' + currentll);
													buttstate = 1;
												});

										} else {

											//////////  Getting First Next Target  //////////
											console.log("Getting First Next Target");
											$.ajax({
													method: "POST",
													url: "nexttarget.php",
													cache: false
														//                                    data: { llama_given_to: previousll }
												})
												.done(function (result) {
													$(".hiddenll").html(result);
													var currentll = $("#BadgeAdress").text();
													$('#External').attr('src', 'http://' + currentll);
													buttstate = 1;
												});
										}


										return false; //true??
									} else {
										$.notify("Page is loading, please wait.", {
											position: "left top",
											className: "info"
										});
									}
								});

								//							$('.fa-ellipsis-h').parent().click(function(){
								//        					$('#mainmenu').load('menu_main.php');
								//    						});

								$('.fa-arrow-circle-down').parent().click(function () {
									$("#emailmenu").addClass("loading");
									$('#emailmenu').load('menu_llamas_received.php', function () {
										$("#emailmenu").removeClass("loading");
									});
								});

								$('.fa-arrow-circle-up').parent().click(function () {
									$("#contactmenu").addClass("loading");
									$('#contactmenu').load('menu_llamas_sent.php', function () {
										$("#contactmenu").removeClass("loading");
									});
								});

								$('.fa-cog').parent().click(function () {
									$("#settings").addClass("loading");
									$('#settings').load('menu_settings.php', function () {
										$("#settings").removeClass("loading");
									});
								});

							});
						</script>



					</div>

				</section>

				<script src="js/bootstrap.js"></script>
				<script src="js/toggles.js"></script>
				<script src="js/quirk.js"></script>

				<!--<script src="http://themepixels.com/demo/webpage/quirk/lib/jquery-ui/jquery-ui.js"></script>
			<script src="http://themepixels.com/demo/webpage/quirk/lib/morrisjs/morris.js"></script>
			<script src="http://themepixels.com/demo/webpage/quirk/lib/raphael/raphael.js"></script>
			<script src="http://themepixels.com/demo/webpage/quirk/lib/flot/jquery.flot.js"></script>
			<script src="http://themepixels.com/demo/webpage/quirk/lib/flot/jquery.flot.resize.js"></script>
			<script src="http://themepixels.com/demo/webpage/quirk/lib/flot-spline/jquery.flot.spline.js"></script>
			<script src="http://themepixels.com/demo/webpage/quirk/lib/jquery-knob/jquery.knob.js"></script>
			<script src="http://themepixels.com/demo/webpage/quirk/js/dashboard.js"></script>-->


				<?php 
}
// User logging in - redirect
elseif(!empty($_POST['username']))
{
	
	    echo "<p>We got only username variable, so session expired. - We are now redirecting you to the member area.</p>";
        echo "<meta http-equiv='refresh' content='=0;URL=http://www.getllamas.com' />";	//redirect
		echo "<script>top.window.location = 'http://www.getllamas.com';</script>";			//redirect-ie
	}
// Entry page without no session - redirect
else
{
	    echo "<p>We got no variables, session expired. - We are now redirecting you to the member area.</p>";
        echo "<meta http-equiv='refresh' content='=0;URL=http://www.getllamas.com' />";	//redirect
		echo "<script>top.window.location = 'http://www.getllamas.com';</script>";			//redirect-ie
	}
?>

	</body>

	</html>