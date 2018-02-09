<?php include 'core/base.php';


//vip
if(isset($_GET['vip']))
	{
	$vip = $_GET['vip'];
	$vip_id = mysql_escape_string($vip);
	if (!empty($vip_id))
		{
		$result = mysql_query("SELECT * FROM vip WHERE vip_url='$vip_id' AND site_id='$site_id'");
		if (mysql_num_rows($result) > 0)
			{
			while($row = mysql_fetch_assoc($result))
				{
				$vip_id=$row['vip_id'];
				$vip_name=$row['vip_name'];
				$vip_sponsors=$row['sponsors'];
				$vip_headline=$row['vip_headline'];
				$vip_full=strip_tags(html_entity_decode($row['vip_full'], ENT_QUOTES, 'utf-8'),$allowed_html);
				$vip_video=strip_tags(html_entity_decode($row['vip_video'], ENT_QUOTES, 'utf-8'),$allowed_html);
				$vip_url=$row['vip_url'];
				$sponsors_toggle=$row['sponsors_toggle'];
				$vip_date=convert_date($row['vip_date']);
				$viptitle = $vip_headline;
				$vip_sponsors_title=$row['sponsors_title'];
				include $head;
				echo '<div class="vip">';
				if($userlevel_no == '5')
					{
					echo '<a href="/panel/vip.php?edit='.$vip_id.'" class="edit">Edit this VIP Page</a>';
					} else {}
				echo '<h1>'.$viptitle.'</h1><div class="clear">&nbsp;</div><hr>';
				if(!empty($vip_video))
					{
					echo str_replace('class="BrightcoveExperience"', 'class="BrightcoveExperience"><param name="wmode" value="opaque"', $vip_video);
					} else {}	
				if(!empty($vip_full))
					{
					echo $vip_full;
						} else {}
				if(empty($sponsors_toggle)){
					echo '<div class="clear"></div></div>';
					$sponsors = explode(',', $vip_sponsors);
					
					// DEBUGS
					// echo $vip_sponsors . "<br />";
					// echo $sponsors . "<br />";
					// echo count($sponsors) . "<br />";
					// END DEBUGS
					
					echo "";
					if(!empty($vip_sponsors_title)){
						echo "<div class='deck'><h2 align='center'>".$vip_sponsors_title."</h2>";
					}else{
						echo "<div class='deck'><h2 align='center'>".$vip_name." Sponsors</h2>";
					}
					// Build a proper in clause so we can pull sponsors in order of sponsor level and id.
					$inClause = '(';
					foreach ($sponsors as $sponsor) {
						if ($sponsor != '') {
							$inClause .= $sponsor . ',';
						}
					}
					// Close the in clause. Remove last ',' first.
					$inClause = substr($inClause, 0, strlen($inClause) - 1);
					$inClause .= ')';
					
					$ordered_results = mysql_query("select `card_id` from `card` where card_id in " . $inClause . " order by spons_lvl, card_id");
					//echo $inClause . "<br />";
					while($orderedRow = mysql_fetch_assoc($ordered_results)){
						$sponsor = $orderedRow['card_id'];
						$sponsor_img = mysql_query("SELECT * FROM `card` WHERE card_id = '$sponsor'");
						while($rows = mysql_fetch_array($sponsor_img)){
							echo '<p class="spot"><a href="http://www.boernespotlights.com/company/'.$rows['co_id'].'" target="_blank"><img src="http://www.boernespotlights.com/assets/img/spotlights/tn-'.$rows['card_front'].'"></a></p>';
						}
					}
				}
				echo "</div><br clear='all'>";
				}
			}
		else
			{
			$home_url = 'http://'.$site_url.'';
			header("Location: $home_url");
			exit;
			}
		}
	}
	
else
	{
	$home_url = 'http://'.$site_url.'';
	header("Location: $home_url");
	exit;
	}





include $foot; ?>