<?php
require 'serverlogin.php';
?>
<?php include_once("analyticstracking.php") ?>

<h5 class="sidebar-title">Recently Received Llamas</h5>
<ul class="media-list media-list-contacts">
			
			
<?php
// We are in a Session, proceeding
if(!empty($_SESSION['TheUser']) && isset($_COOKIE['llama_cookie']))
{
	
$username = $_SESSION['TheUser'];
	

//<!-- ###########	Display next target user in line	########### -->
	$search = "SELECT llamaed_by FROM userbase WHERE username='$username'";
	$results = mysqli_query($conn, $search);
	//$userlist = explode(',',mysqli_fetch_array($results));
	$row = mysqli_fetch_assoc($results);
	$userlist = array_reverse(explode("|", $row["llamaed_by"]));
	
	
	
	
$counter = 0;
	while($counter<20) {

		
	$counter++;
	$future_counter = $counter+1;
		if (isset($userlist[$future_counter])) {
	
	$thisuser = $userlist[$counter];
	$search2 = "SELECT * FROM userbase WHERE username='$thisuser'";
	$results2 = mysqli_query($conn, $search2);
	$row2 = mysqli_fetch_assoc($results2);	
			
	?>
	
	<li class="media">
		<a href="<?php echo "http://" . $thisuser . ".deviantart.com"; ?>" target="External">
			<div class="media-left">
				<img class="media-object img-circle" src="<?php echo $row2["icon_link"]; ?>" alt="">
			</div>
			<div class="media-body">
				<h4 class="media-heading"><?php echo $thisuser ?></h4>
				<span>Llamas sent so far: <?php echo $row2["spent_credits"]+$row2["current_credits"]-$row2["gift_credits"]-$row2["purchased_credits"] ?></span>
			</div>
		</a>
	</li>
	
	<?php
		}
		else {	
			break;	
		}
	}
?>

</ul>

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