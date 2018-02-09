<?php $pagetitle = "Control Panel"; include '../core/base.php'; include '../'.$head; check_logged(); check_access(2);





echo '<div class="admin"><h1>Admin Panel</h1>';
$getcount = mysql_query ("SELECT DISTINCT COUNT(*) FROM co, co_site_list WHERE co.co_id=co_site_list.co_id AND '$site_id'=co_site_list.site_id ORDER BY co_name ASC");
$postnum = mysql_result($getcount,0);
$limit = 10;
if($postnum > $limit)
	{
	$tagend = round($postnum % $limit,0); $splits = round(($postnum - $tagend)/$limit,0);
	if($tagend == 0){$num_pages = $splits;} else{$num_pages = $splits + 1;}
	if(isset($_GET['pg'])){$pg = $_GET['pg'];} else{$pg = '1';}
	$startpos = ($pg*$limit)-$limit;
	$limstring = "LIMIT $startpos,$limit";
	}
else
	{
	$limstring = "LIMIT 0,$limit";
	}
if($postnum > $limit)
	{
	echo '<div class="pages" id="top">'; $m = $pg + 2; $n = $pg + 1; $p = $pg - 1; $q = $pg - 2;
	if($pg > 1){echo "<a href=\"?pg=1\">&laquo;</a> <a href=\"?pg=$p\">&lsaquo;</a> ";} else{}
	if($q > 0) {echo "<a href=\"?pg=$q\">$q</a> ";} else {}
	if($p > 0) {echo "<a href=\"?pg=$p\">$p</a> ";} else {}
	echo "<span>$pg</span> ";
	if($n <= $num_pages) {echo "<a href=\"?pg=$n\">$n</a> ";} else {}
	if($m <= $num_pages) {echo "<a href=\"?pg=$m\">$m</a> ";} else {}
	if($pg < $num_pages){echo " <a href=\"?pg=$n\">&rsaquo;</a> <a href=\"?pg=$num_pages\">&raquo;</a>";} else {}
	echo '</div>';
	}
else
	{
	}
echo '<div class="clear">&nbsp;</div><form  method="post" action="/panel/search/?go">
<span>Search For Company:</span>
<input  type="text" name="name">
<input  type="submit" name="submit" id="button" value="Search">
</form>';
$query = "SELECT co.co_id, co.co_name, co.co_address_1, co.co_address_2, co.co_city, co.co_state, co.co_zip, co.co_phone, co.co_fax, co.co_email, co.co_url1, co.co_desc FROM co, co_site_list WHERE co.co_id=co_site_list.co_id AND '$site_id'=co_site_list.site_id ORDER BY co_name ASC $limstring";
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
	$sub3query = "SELECT card_id, card_front FROM card WHERE '$co_id'=co_id ORDER BY card_front DESC";
	$sub3result = mysql_query($sub3query) or die(mysql_error()); $num_rows = mysql_num_rows($sub3result); echo $num_rows.'</p></div>';
	echo '<div class="details" id="e"><p><strong>Details:</strong><br><a href="/panel/co/?co='.$co_id.'">View</a></p></div><div class="clear">&nbsp;</div>';
	}
echo '<p class="nav">Spotlight Directory: <a href="/panel/co_art">Arts</a> &middot; <a href="/panel/co_bus">Business</a> &middot; <a href="/panel/co_cat">Categories</a> &middot; <a href="/panel/co_com">Community</a> &middot; <a href="/panel/co_dest">Destinations</a><br><a href="/panel/co?add">+Company</a> &middot; <a href="/panel/site">Site Editor</a> &middot; <a href="/panel/log">BizCardSpotlight&trade; Log</a>';
$getcount = mysql_query ("SELECT DISTINCT COUNT(*) FROM card, co, user WHERE card.card_approve='0' AND card.co_id=co.co_id AND card.user_id=user.user_id AND '$site_id'=user.user_credit_site_id");
$lognum = mysql_result($getcount,0);
if(!empty($lognum)) { echo ' <span>'.$lognum.'</span>'; } else {}
echo ' &middot; <a href="/panel/vlog">VideoMarketingSpotlight&trade; Log</a>';
$getcount = mysql_query ("SELECT DISTINCT COUNT(*) FROM card, co, user WHERE card.card_approve='0b' AND card.co_id=co.co_id AND card.user_id=user.user_id AND '$site_id'=user.user_credit_site_id");
$lognum = mysql_result($getcount,0);
if(!empty($lognum)) { echo ' <span>'.$lognum.'</span>'; } else {}
echo ' &middot; <a href="/panel/users">Users</a></p>';
if($postnum > $limit)
	{
	echo '<div class="pages">'; $m = $pg + 2; $n = $pg + 1; $p = $pg - 1; $q = $pg - 2;
	if($pg > 1){echo "<a href=\"?pg=1\">&laquo;</a> <a href=\"?pg=$p\">&lsaquo;</a> ";} else{}
	if($q > 0) {echo "<a href=\"?pg=$q\">$q</a> ";} else {}
	if($p > 0) {echo "<a href=\"?pg=$p\">$p</a> ";} else {}
	echo "<span>$pg</span> ";
	if($n <= $num_pages) {echo "<a href=\"?pg=$n\">$n</a> ";} else {}
	if($m <= $num_pages) {echo "<a href=\"?pg=$m\">$m</a> ";} else {}
	if($pg < $num_pages){echo " <a href=\"?pg=$n\">&rsaquo;</a> <a href=\"?pg=$num_pages\">&raquo;</a>";} else {}
	echo '</div>';
	}
else
	{
	}
echo '</div>';





include '../'.$foot; ?>