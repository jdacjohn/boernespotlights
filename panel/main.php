<?php $pagetitle = "Control Panel"; include '../core/base.php'; include '../'.$head; check_logged();





$result = mysql_query("SELECT * FROM page WHERE page_url='panel' AND site_id='$site_id'");
if (mysql_num_rows($result) > 0)
	{
	while($row = mysql_fetch_assoc($result))
		{
		$page_id=$row['page_id'];
		$page_pass=$row['page_pass'];
		$page_headline=$row['page_headline'];
		$page_full=strip_tags(html_entity_decode($row['page_full'], ENT_QUOTES, 'utf-8'),$allowed_html);
		$page_video=strip_tags(html_entity_decode($row['page_video'], ENT_QUOTES, 'utf-8'),$allowed_html);
		$pagetitle = $page_headline;
		echo '<div class="welcome">';
		if($userlevel_no == '5'){echo '<a href="/panel/page.php?edit='.$page_id.'" class="edit">Edit this Page</a>';}
		echo '<h1>'.$pagetitle.'</h1><div class="clear">&nbsp;</div><hr>';
		if(!empty($page_video))
			{
			echo str_replace('class="BrightcoveExperience"', 'class="BrightcoveExperience"><param name="wmode" value="opaque"', $page_video);
			} else {}
		if(!empty($page_full)){echo $page_full.'<hr>';}
		echo '</div>';
		}
	}
	
echo '<div class="admin">';
echo '<h1>User Settings</h1><div class="clear">&nbsp;</div>
<ul>
<li><a href="/panel/user/?edit_pass">Edit Your Password</a></li>
';
$query = "SELECT card.card_id FROM card, co WHERE card.co_id=co.co_id AND card.user_id='$user_id' AND card.site_id='$site_id' LIMIT 1";
$result = mysql_query($query) or die(mysql_error()); 
if(mysql_num_rows($result)!=0)
	{
	echo '<li><a href="/panel/profile">Edit Your Profile!</a></li>';
	} else {}
echo '</ul>';


echo '<h1>Shopping Cart</h1><div class="clear">&nbsp;</div>';
echo '<ul>';
if(!empty($user_credit) && ($user_credit_site_id==$site_id))
	{
	echo '<li><a href="/panel/redeem">Redeem Your Spotlight!</a></li>';
	}
elseif(!empty($user_credit) && ($user_credit_site_id!=$site_id))
	{
	$result = mysql_query("SELECT * FROM site WHERE site_id='$user_credit_site_id' LIMIT 1") or die(mysql_error());
	while($row = mysql_fetch_array($result))
		{ $site_name=$row['site_name']; $site_desc=$row['site_desc']; $site_url=$row['site_url'];
			echo '
			<li><a href="http://'.$site_url.'/panel" target="_blank">Go to '.$site_name.' to Redeem Your Spotlight</a></li>';					
		}
	}
else
	{
	$nav_query  = "SELECT page_headline FROM page WHERE '$site_id'=site_id AND page_url='shopbizcard' LIMIT 1";
	$nav_result = mysql_query($nav_query);
	while($nav_row = mysql_fetch_array($nav_result))
		{
		$nav_page_headline = $nav_row['page_headline'];
		echo '<li class="top"><a href="/shop/bizcard">'.$nav_page_headline.'</a></li>';
		}
	$query = "SELECT card.card_id FROM card, co WHERE card.co_id=co.co_id AND card.user_id='$user_id' AND card.site_id='$site_id' LIMIT 1";
	$result = mysql_query($query) or die(mysql_error()); 
	if(mysql_num_rows($result)!=0)
		{
		$nav_query  = "SELECT page_headline FROM page WHERE '$site_id'=site_id AND page_url='shopvideo' LIMIT 1";
		$nav_result = mysql_query($nav_query);
		while($nav_row = mysql_fetch_array($nav_result))
			{
			$nav_page_headline = $nav_row['page_headline'];
			echo '<li class="top"><a href="/shop/video">'.$nav_page_headline.'</a></li>';
			}
		}
	$nav_query  = "SELECT page_headline FROM page WHERE '$site_id'=site_id AND page_url='shopsponsor' LIMIT 1";
	$nav_result = mysql_query($nav_query);
	while($nav_row = mysql_fetch_array($nav_result))
		{
		$nav_page_headline = $nav_row['page_headline'];
		echo '<li class="top"><a href="/shop/sponsor">'.$nav_page_headline.'</a></li>';
		}
	}
	echo '</ul>';
	?>
	

<?php
if($userlevel_no == '2')
	{
	echo '<h1>Your Spotlights</h1><div class="clear">&nbsp;</div>';
	//echo ' <div class="pages" id="top"><a href="/panel/admin" id="more">More...</a></div>';
	echo '<form  method="post" action="/panel/search/?go">
	<span>Search For Company:</span>
	<input  type="text" name="name">
	<input  type="submit" name="submit" id="button" value="Search">
	</form>';
	$query = "SELECT co.co_id, co.co_name, co.co_address_1, co.co_address_2, co.co_city, co.co_state, co.co_zip, co.co_phone, co.co_fax, co.co_email, co.co_url1, co.co_desc, co.co_contact_email FROM co, co_site_list WHERE co.co_id=co_site_list.co_id AND co.co_contact_email = '$user_email' AND '$site_id'=co_site_list.site_id ORDER BY co_name ASC ";
	$result = mysql_query($query) or die(mysql_error()); $co_name = '';
	while($row = mysql_fetch_array($result))
		{
		if($co_name!=$row['co_name'])
			{
			$co_id=$row['co_id'];
			$co_name=$row['co_name'];
			$co_address_1=$row["co_address_1"];
			$co_address_2=$row["co_address_2"];
			$co_city=$row["co_city"];
			$co_state=$row["co_state"];
			$co_zip=$row["co_zip"];
			$co_phone=$row["co_phone"];
			$co_fax=$row["co_fax"];
			$co_email=$row["co_email"];
			$co_url1=$row["co_url1"];
			$co_desc=$row["co_desc"];
			echo '<h3><a href="/panel/co/?co='.$co_id.'">'.$co_name.'</a></h3>';
			$sub1query = "SELECT co_feat_list_id FROM co_feat_list WHERE '$site_id'=co_feat_list.site_id AND '$co_id'=co_id LIMIT 1";
			$sub1result = mysql_query($sub1query) or die(mysql_error()); echo '<div class="details" id="a"><p><strong>Featured:</strong><br>';
			if(mysql_num_rows($sub1result)==0)
				{
				echo '<img src="/assets/img/icon-x.gif"></p></div>';
				}
			else
				{
				echo '<img src="/assets/img/icon-check.gif"></p></div>';
				}
			$sub2query = "SELECT co_spons_list_id FROM co_spons_list WHERE '$site_id'=co_spons_list.site_id AND '$co_id'=co_id LIMIT 1";
			$sub2result = mysql_query($sub2query) or die(mysql_error()); echo '<div class="details" id="b"><p><strong>Sponsor:</strong><br>';
			if(mysql_num_rows($sub2result)==0)
				{
				echo '<img src="/assets/img/icon-x.gif"></p></div>';
				}
			else
				{
				echo '<img src="/assets/img/icon-check.gif"></p></div>';
				}
			}
		echo '<div class="details" id="c"><p><strong>Destinations:</strong><br>';
		$sub1query = "SELECT co_dest.co_dest_id, co_dest.co_dest_name, co_dest_list.co_dest_list_id FROM co, co_dest_list, co_dest WHERE '$co_id'=co_dest_list.co_id AND co_dest.co_dest_id=co_dest_list.co_dest_id AND co_dest_list.co_id=co.co_id ORDER BY co.co_name, co_dest.co_dest_name ASC";
		$sub1result = mysql_query($sub1query) or die(mysql_error()); $num_rows = mysql_num_rows($sub1result); echo $num_rows.'</p></div>';		
		echo '<div class="details" id="d"><p><strong>Spotlights:</strong><br>';
		$sub3query = "SELECT card_id, card_front FROM card WHERE $co_id=co_id ORDER BY card_front DESC";
		$sub3result = mysql_query($sub3query) or die(mysql_error()); $num_rows = mysql_num_rows($sub3result); echo $num_rows.'</p></div>';
		echo '<div class="details" id="e"><p><strong>Details:</strong><br><a href="/panel/co/?co='.$co_id.'">View</a></p></div><div class="clear">&nbsp;</div>';
		}
	}


if($userlevel_no == '5')
	{
	echo '<h1>Admin Panel</h1><div class="clear">&nbsp;</div>';
	echo ' <div class="pages" id="top"><a href="/panel/admin" id="more">More...</a></div>';
	echo '<form  method="post" action="/panel/search/?go">
	<span>Search For Company:</span>
	<input  type="text" name="name">
	<input  type="submit" name="submit" id="button" value="Search">
	</form>';
	$query = "SELECT co.co_id, co.co_name, co.co_address_1, co.co_address_2, co.co_city, co.co_state, co.co_zip, co.co_phone, co.co_fax, co.co_email, co.co_url1, co.co_desc FROM co, co_site_list WHERE co.co_id=co_site_list.co_id AND '$site_id'=co_site_list.site_id ORDER BY co_name ASC LIMIT 5";
	$result = mysql_query($query) or die(mysql_error()); $co_name = '';
	while($row = mysql_fetch_array($result))
		{
		if($co_name!=$row['co_name'])
			{
			$co_id=$row['co_id'];
			$co_name=$row['co_name'];
			$co_address_1=$row["co_address_1"];
			$co_address_2=$row["co_address_2"];
			$co_city=$row["co_city"];
			$co_state=$row["co_state"];
			$co_zip=$row["co_zip"];
			$co_phone=$row["co_phone"];
			$co_fax=$row["co_fax"];
			$co_email=$row["co_email"];
			$co_url1=$row["co_url1"];
			$co_desc=$row["co_desc"];
			echo '<h3><a href="/panel/co/?co='.$co_id.'">'.$co_name.'</a></h3>';
			$sub1query = "SELECT co_feat_list_id FROM co_feat_list WHERE '$site_id'=co_feat_list.site_id AND '$co_id'=co_id LIMIT 1";
			$sub1result = mysql_query($sub1query) or die(mysql_error()); echo '<div class="details" id="a"><p><strong>Featured:</strong><br>';
			if(mysql_num_rows($sub1result)==0)
				{
				echo '<img src="/assets/img/icon-x.gif"></p></div>';
				}
			else
				{
				echo '<img src="/assets/img/icon-check.gif"></p></div>';
				}
			$sub2query = "SELECT co_spons_list_id FROM co_spons_list WHERE '$site_id'=co_spons_list.site_id AND '$co_id'=co_id LIMIT 1";
			$sub2result = mysql_query($sub2query) or die(mysql_error()); echo '<div class="details" id="b"><p><strong>Sponsor:</strong><br>';
			if(mysql_num_rows($sub2result)==0)
				{
				echo '<img src="/assets/img/icon-x.gif"></p></div>';
				}
			else
				{
				echo '<img src="/assets/img/icon-check.gif"></p></div>';
				}
			}
		echo '<div class="details" id="c"><p><strong>Destinations:</strong><br>';
		$sub1query = "SELECT co_dest.co_dest_id, co_dest.co_dest_name, co_dest_list.co_dest_list_id FROM co, co_dest_list, co_dest WHERE '$co_id'=co_dest_list.co_id AND co_dest.co_dest_id=co_dest_list.co_dest_id AND co_dest_list.co_id=co.co_id ORDER BY co.co_name, co_dest.co_dest_name ASC";
		$sub1result = mysql_query($sub1query) or die(mysql_error()); $num_rows = mysql_num_rows($sub1result); echo $num_rows.'</p></div>';		
		echo '<div class="details" id="d"><p><strong>Spotlights:</strong><br>';
		$sub3query = "SELECT card_id, card_front FROM card WHERE $co_id=co_id ORDER BY card_front DESC";
		$sub3result = mysql_query($sub3query) or die(mysql_error()); $num_rows = mysql_num_rows($sub3result); echo $num_rows.'</p></div>';
		echo '<div class="details" id="e"><p><strong>Details:</strong><br><a href="/panel/co/?co='.$co_id.'">View</a></p></div><div class="clear">&nbsp;</div>';
		}
	echo '<p class="nav">Spotlight Directory: <a href="/panel/co_art">Arts</a> &middot; <a href="/panel/co_bus">Business</a> &middot; <a href="/panel/co_cat">Categories</a> &middot; <a href="/panel/co_com">Community</a> &middot; <a href="/panel/co_dest">Destinations</a><br><a href="/panel/co?add">+Company</a> &middot; <a href="/panel/site">Site Editor</a> &middot; <a href="/panel/log">BizCardSpotlight&trade; Log</a>';
	$getcount = mysql_query ("SELECT DISTINCT COUNT(*) FROM card, co, user WHERE card.card_approve='0' AND card.co_id=co.co_id AND card.user_id=user.user_id AND '$site_id'=card.site_id");
	$lognum = mysql_result($getcount,0);
	if(!empty($lognum)) { echo ' <span>'.$lognum.'</span>'; } else {}
	echo ' &middot; <a href="/panel/vlog">VideoMarketingSpotlight&trade; Log</a>';
	$getcount = mysql_query ("SELECT DISTINCT COUNT(*) FROM card, co, user WHERE card.card_approve='0b' AND card.co_id=co.co_id AND card.user_id=user.user_id AND '$site_id'=user.user_credit_site_id");
	$lognum = mysql_result($getcount,0);
	if(!empty($lognum)) { echo ' <span>'.$lognum.'</span>'; } else {}
	echo ' &middot; <a href="/panel/users">Users</a></p>';
	}
	
echo '</div>';





include '../'.$foot; ?>