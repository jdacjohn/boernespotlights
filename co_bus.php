<?php include 'core/base.php';




//business
if(isset($_GET['bus']))
	{
	$short = mysql_escape_string($_GET['bus']);
	if(empty($_GET['bus']))
		{
		header("Location: /$site_index");
		exit;
		}
	else
		{
		$query = "SELECT co_bus.co_bus_name, co_bus.co_bus_desc, card.city_code FROM card, co, co_bus, co_bus_list WHERE '$short'=co_bus.co_bus_id AND co_bus.co_bus_id=co_bus_list.co_bus_id AND card.city_code='1' AND co_bus_list.co_id=co.co_id AND '$site_id'=card.site_id AND card.co_id=co.co_id AND card.card_approve='1' AND card.card_video='' LIMIT 1";
		$result = mysql_query($query) or die(mysql_error());
		if(mysql_num_rows($result)==0)
			{
			$pagetitle = '';
			$result = mysql_query("SELECT page_pass FROM page WHERE page_url='business' AND '$site_id'=site_id");
			while($row = mysql_fetch_assoc($result))
				{
				$page_pass=$row['page_pass'];
				if($page_pass == '1'){check_logged();}
				}
			include $head;
			echo '<h1>Sorry</h1><hr>';
			echo '<p>There are no BizCard Spotlights&trade; for this Category.</p>';
			}
		else
			{
			while($row = mysql_fetch_array($result))
				{
				$co_bus_name = $row["co_bus_name"];
				$co_bus_desc = html_entity_decode($row["co_bus_desc"]);
				$pagetitle = $co_bus_name;
				$result = mysql_query("SELECT page_pass FROM page WHERE page_url='business' AND '$site_id'=site_id");
				while($row = mysql_fetch_assoc($result))
					{
					$page_pass=$row['page_pass'];
					if($page_pass == '1'){;}
					}
				include $head;
				echo '<h1>'.$pagetitle.'</h1><hr>';
				if(!empty($co_bus_desc))
					{
					echo '<p>'.$co_bus_desc.'</p><hr>';
					} else {}
				$page_link = '/business/'.$short.'/';
				$query = "SELECT COUNT(*) FROM card, co_bus_list WHERE '$site_id'=card.site_id AND '$short'=co_bus_list.co_bus_id AND co_bus_list.co_id=card.co_id AND card.card_approve='1' AND card.city_code='1' AND card.card_video=''";
				$limit = '9999';
				echo '<div class="pages" id="top">'; echo pagination($query,$page_link,$limit); echo '</div>'; $limstring = paginationCount($query,$limit);
				echo '<div class="deck">';
				$query2 = "SELECT card.card_id, card.card_front, co.co_id, co.co_name, card.city_code FROM card, co, co_bus_list WHERE '$short'=co_bus_list.co_bus_id AND co_bus_list.co_id=co.co_id AND '$site_id'=site_id AND card.co_id=co.co_id AND card.city_code='1' AND card.card_approve='1' AND card.card_video='' ORDER BY card.card_id DESC $limstring";
				$result = mysql_query($query2) or die(mysql_error());
				while($row = mysql_fetch_array($result))
					{
					$card_front=$row['card_front'];
					$co_id = $row["co_id"];
					$co_name = $row["co_name"];
					echo '<p class="spot"><a href="/company/'.$co_id.'"><img src="/assets/img/spotlights/tn-'.$card_front.'" alt="'.$co_name.'">';
					$subresult = mysql_query("SELECT card.card_id, card.city_code FROM card, co, co_bus_list WHERE '$short'=co_bus_list.co_bus_id AND co_bus_list.co_id=co.co_id AND '$site_id'=site_id AND card.city_code='1' AND '$co_id'=card.co_id AND card.card_approve='1' AND card.card_video!='' LIMIT 1") or die(mysql_error());
					if(mysql_num_rows($subresult)==0)
						{
						echo '<br><span class="space">&nbsp;</span>';
						}
					else
						{
						while($row = mysql_fetch_array($subresult))
							{
							echo '<br><span class="play">Video</span><span class="ultra">ultra</span>';					
							}
						}
					echo '</a></p>';
					}
				echo '<div class="clear">&nbsp</div></div>'; echo '<div class="pages">'; echo pagination($query,$page_link,$limit); echo '</div>';
				}
			}
		}
		$currentpage = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$social_network = '<hr><span style="position:relative;top:4px;margin-right:-1px;margin-top:0px;margin-bottom:0px;padding-bottom:-10px;padding-top:10px;"><a title="'.$co_bus_name.'" href="http://www.facebook.com/sharer.php?s=100&p[url]='.$currentpage.'&p[images][0]=http://boernespotlights.com/assets/img/logo.png&p[title]='.$co_bus_name.'&p[summary]='.$row["co_bus_desc"].'" target="_blank" style=""><img src="http://boernespotlights.com/assets/img/facebook-icon.png" alt="Share on Facebook" style="margin-top:0px;" /></a></span>
		<span class="st_linkedin"></span><span class="st_twitter" ></span><span class="st_email"></span><a href="javascript:window.print()" class="print">Print</a>';
		
	echo $social_network;
	include $foot;
	}
else
	{
	header("Location: /$site_index");
	exit;
	}




?>