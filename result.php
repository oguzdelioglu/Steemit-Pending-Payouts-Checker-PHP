<?php
$username = $_GET["username"];
$url = 'https://api.steemjs.com/get_discussions_by_blog?query={"tag":"'.$username.'","limit":"100"}';
$json= file_get_contents($url);
$data = json_decode($json,true);
echo '<style>
a {
  text-decoration:none;
}
a:visited {
    color: darkgreen;
}
</style>';

echo '<body link="darkgreen">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
echo '<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">';
echo '<center><a href="index.php">
<img border="0" alt="Steemit" src="logo.png" width="400" height="200">
</a></center>';
echo '<div class="w3-container">';
echo '<table class="w3-table w3-striped w3-border" align="center">';
$total_price = 0;
foreach ($data as $item) {
	try
	{
		if(!($item["pending_payout_value"]=="0.000 SBD"))
		{
			echo "<tr>";
			$post_link = "https://www.steemit.com/@".$item["author"]."/".$item["permlink"];
			$post_title = $item["title"];
			$price = str_replace(" SBD", "", $item["pending_payout_value"]);
			$total_price = $total_price + $price;
			echo '<td><a target="_BLANK" href="'.$post_link.'"/>'.$post_title.'</td> <td>'.$item["pending_payout_value"].'</td>';
			echo "</tr>";
			wait(0.1);
		}
	}
	catch(Exception $e)
	{
	}
}
echo '<center>Total SBD:'.$total_price.'</center>';
echo '</table>';
echo '</div>';
echo '</body>';

function wait($time)
{
	usleep(1000000*$time);
	ob_flush();
	flush();
}
?>