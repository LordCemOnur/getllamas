<?php session_start(); ?>
<?php include_once("analyticstracking.php") ?>
<h5 class="sidebar-title">General Settings</h5>
<ul class="list-group list-group-settings">
	<li class="list-group-item">
		<h5>Referral Link</h5>
		<small>Here is your referral link: <code><input name="cody" class="cody" type="text" value="www.getllamas.com/?invitation=<?php echo $_SESSION['TheUser']; ?>"></input></code>
			<br>You will receive a llama for each 10 llamas sent by deviants you invited.</small>
	</li>

	<li id="refcalcut" class="list-group-item">
		<a href=""><h5>Refresh Llama counts of your Referrals</h5>
		<small>Refresh llama counts of your referrals. Normally it's updated hourly.</small></a>
	</li>

	<li id="avatar" class="list-group-item">
		<a href=""><h5>Refresh Avatar</h5>
		<small>Refresh your avatar on the top-left corner of the screen if it's not showing correctly.</small></a>
	</li>

	<li id="donate" class="list-group-item">
		<a href="#"><h5>Support GetLlamas</h5>
		<small>GetLLamas is supported only with ads &amp; we need money to run our servers. Would you like to donate us $5 so we can keep the site running?</small></a>
		<span style="text-align:center;">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input id="paypalcik" type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</span>
	</li>

</ul>

<script>
	$(document).ready(function () {
		

		$(".cody").click(function () {
			$(".cody").select();
		});

		$("#refcalcut").click(function () {
			$(document).ajaxStart(function() { $("#refcalcut").addClass("loading");   });
     		$(document).ajaxStop(function() { $("#refcalcut").removeClass("loading"); });
			$.ajax({
					method: "POST",
					url: "ref_calculate.php",
				})
				.done(function (result) {
					$(".hiddenmessages").html(result);
					$("#refcalcut").fadeTo( "slow", 1 );
				});
			return false; //true??
		});
        
        $("#avatar").click(function () {
//			$(document).ajaxStart(function() { $("#refcalcut").addClass("loading");   });
//     		$(document).ajaxStop(function() { $("#refcalcut").removeClass("loading"); });
//			$.ajax({
//					method: "POST",
//					url: "ref_calculate.php",
//				})
//				.done(function (result) {
//					$(".hiddenmessages").html(result);
//					$("#refcalcut").fadeTo( "slow", 1 );
//				});
			return false; //true??
		});
		
		 $("#donate").click(function () {
			 
			 $("#paypalcik").trigger("click");
		});
	});
</script>
<div class="hiddenmessages"></div>
<div class="modal"></div>