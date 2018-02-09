<?php $pagetitle = "User Settings"; include '../core/base.php'; include '../'.$head; check_logged(); check_access(5);





echo '<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>';
if(isset($_GET['edit_user']))
	{
	$pagetype = "Edit User";
	$edit_user = $_GET['edit_user'];
	$result = mysql_query("SELECT * FROM user WHERE user_id='$edit_user' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$user_login = $row["user_login"];
	$user_name_f = $row["user_name_f"];
	$user_name_l = $row["user_name_l"];
	$userlevel_no = $row["userlevel_no"];
	$user_credit = $row["user_credit"];
	if (empty($_GET['edit_user']))
		{ echo '<p>'.$pagetitle.' must be selected to be edited. You will be redirected to <a href="'.$PHP_SELF.'?view_users">User Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'?view_users>'; }
	else
		{
		echo '<h1>Edit '.$user_login.'</h1><hr>';
		if ($userlevel_no < 5)
			{
			if (isset($_POST['submit']))
				{
				$userlevel_no = $_POST['userlevel_no'];
				$user_credit = $_POST['user_credit'];
				$result = mysql_query("UPDATE user SET userlevel_no='$userlevel_no', user_credit='$user_credit', user_credit_site_id='$site_id' WHERE user_id='$edit_user' ");
				echo '<p>Edited successfully! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
				}
			else
				{ ?>
				<form method="post" action="<?php echo $PHP_SELF; ?>?edit_user=<?php echo $edit_user; ?>">			
				<fieldset><legend>User Level:</legend>
				<ul><li><select name="userlevel_no"><?php
				$result = mysql_query("SELECT userlevel_no, userlevel_name FROM userlevel ORDER BY userlevel_no DESC") or die(mysql_error());
				while($row = mysql_fetch_array($result))
					{
					echo '<option value="' . $row['userlevel_no'] . '"';
					if($row['userlevel_no']==$userlevel_no)
						{ echo ' selected'; }		
					echo '>' . $row['userlevel_name'] . '</option>';
					} ?></select></li></ul></fieldset>
				<fieldset><legend>User Credit:</legend>
				<ul><li><select name="user_credit">
				<?php
				echo '<option value=""';
				if(''==$user_credit)
					{ echo ' selected'; }		
				echo '>None</option>';
				$result = mysql_query("SELECT cart_type, cart_products_name FROM cart_products ORDER BY cart_type DESC") or die(mysql_error());
				while($row = mysql_fetch_array($result))
					{
					echo '<option value="' . $row['cart_type'] . '"';
					if($row['cart_type']==$user_credit)
						{ echo ' selected'; }		
					echo '>' . $row['cart_products_name'] . '</option>';
					} ?></select></li>
				<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
				</form>
	<?php		}
			}
		else
			{
			echo '<p>Sorry, you cannot edit this user. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
			}
		}
	}
	
elseif(isset($_GET['del_user']))
	{
	$pagetype = "Delete User";
	$del_user = $_GET['del_user'];
	$result = mysql_query("SELECT * FROM user WHERE user_id='$del_user' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$user_login = $row["user_login"];
	$user_name_f = $row["user_name_f"];
	$user_name_l = $row["user_name_l"];
	$userlevel_no = $row["userlevel_no"];
	if (empty($_GET['del_user']))
		{ echo '<p>'.$pagetitle.' must be selected to be edited. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
	else
		{
		echo '<h1>Delete '.$user_login.'</h1><hr>';
		if ($userlevel_no < 5)
			{
			if (isset($_POST['delete']))
				{
				mysql_query("UPDATE user SET supportartseducation_status='1' WHERE user_id ='$del_user'");
				mysql_query("UPDATE co SET supportartseducation_status='1' WHERE user_id ='$del_user'");
				echo '<p>Deleted! You will be redirected to <a href="'.$PHP_SELF.'?view_users">User Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'?view_users>';
				}
				else
				{ ?>
				<form method="post" action="<?php echo $PHP_SELF; ?>?del_user=<?php echo $del_user; ?>">	<fieldset><legend>Are you sure you want to delete this user?</legend><br />
						<ul><li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="delete" name="delete">Delete</button></li></ul></fieldset>
						</form>
			<?php	}
			}
		else
			{
			echo '<p>Sorry, you cannot delete this user. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
			}
		}
	}







elseif(isset($_GET['username']))
	{
	$pagetype = "User Admin";
	echo '<h1>'.$pagetype.'</h1>';
	$getcount = mysql_query ("SELECT COUNT(*) FROM user, userlevel, user_site_list WHERE user_site_list.site_id='$site_id' AND user_site_list.user_id=user.user_id AND user.userlevel_no=userlevel.userlevel_no");
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
		else {$limstring = "LIMIT 0,$limit";}
	if($postnum > $limit)
		{
		echo ' <div class="useradmin"><div class="pages">';
		$m = $pg + 2; $n = $pg + 1; $p = $pg - 1; $q = $pg - 2;
		if($pg > 1){echo '<a href="?pg=1">&laquo;</a> <a href="?pg='.$p.'">&lsaquo;</a> ';} else{}
		if($q > 0) {echo '<a href="?pg='.$q.'">'.$q.'</a> ';} else {}
		if($p > 0) {echo '<a href="?pg='.$p.'">'.$p.'</a> ';} else {}
		echo "<span>$pg</span> ";
		if($n <= $num_pages) {echo '<a href="?pg='.$n.'">'.$n.'</a> ';} else {}
		if($m <= $num_pages) {echo '<a href="?pg='.$m.'">'.$m.'</a> ';} else {}
		if($pg < $num_pages){echo '<a href="?pg='.$n.'">&rsaquo;</a> <a href="?pg='.$num_pages.'">&raquo;</a>';}
		echo '</div><p class="count">';
		$firstnum = $startpos + 1;
		$lastnum = $startpos + $limit;
		$totalnum = $postnum + 1;
		echo $firstnum;
		if($totalnum < $lastnum) {} else {echo '-'.$lastnum;}
		echo ' of '.$postnum;
		echo '</p><p class="sortby"><a href="/panel/users">Sort By Date</a> &middot; Sort By User Name &middot; <a href="/panel/users/?level">Sort By Level</a></p></div>';
		}
	$result = mysql_query("SELECT DISTINCT user.user_id, user.user_login, user.user_name_f, user.user_name_l, user.userlevel_no, userlevel.userlevel_name FROM user, userlevel, user_site_list WHERE user_site_list.site_id='$site_id' AND user_site_list.user_id=user.user_id AND user.userlevel_no=userlevel.userlevel_no ORDER BY user.user_login ASC $limstring") or die(mysql_error());
	while($row = mysql_fetch_array($result))
		{
		$user_id=$row['user_id']; $user_login=$row['user_login']; $userlevel_no=$row['userlevel_no']; $user_name_f=$row['user_name_f']; $user_name_l=$row['user_name_l']; $userlevel_name=$row['userlevel_name'];
			echo '<hr/><p><strong>'.$user_login.'</strong> &middot; <em>'.$userlevel_name.'</em><br>';
			if(!empty($user_name_f) or !empty($user_name_l))
				{
				if(!empty($user_name_f)) {echo $user_name_f;} else {}
				echo ' ';
				if(!empty($user_name_l)) {echo $user_name_l;} else {}
				echo '<br>';
				} else {}
			if($userlevel_no < 5) {echo '<small><em><a href="'.$PHP_SELF.'?edit_user='.$user_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del_user='.$user_id.'">Delete</a></em></small>';} else {}
			echo '</p>';
		}
	}
	
elseif(isset($_GET['level']))
	{
	$pagetype = "User Admin";
	echo '<h1>'.$pagetype.'</h1>';
	$getcount = mysql_query ("SELECT COUNT(*) FROM user, userlevel, user_site_list WHERE user_site_list.site_id='$site_id' AND user_site_list.user_id=user.user_id AND user.userlevel_no=userlevel.userlevel_no");
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
		else {$limstring = "LIMIT 0,$limit";}
	if($postnum > $limit)
		{
		echo ' <div class="useradmin"><div class="pages">';
		$m = $pg + 2; $n = $pg + 1; $p = $pg - 1; $q = $pg - 2;
		if($pg > 1){echo '<a href="?pg=1">&laquo;</a> <a href="?pg='.$p.'">&lsaquo;</a> ';} else{}
		if($q > 0) {echo '<a href="?pg='.$q.'">'.$q.'</a> ';} else {}
		if($p > 0) {echo '<a href="?pg='.$p.'">'.$p.'</a> ';} else {}
		echo "<span>$pg</span> ";
		if($n <= $num_pages) {echo '<a href="?pg='.$n.'">'.$n.'</a> ';} else {}
		if($m <= $num_pages) {echo '<a href="?pg='.$m.'">'.$m.'</a> ';} else {}
		if($pg < $num_pages){echo '<a href="?pg='.$n.'">&rsaquo;</a> <a href="?pg='.$num_pages.'">&raquo;</a>';}
		echo '</div><p class="count">';
		$firstnum = $startpos + 1;
		$lastnum = $startpos + $limit;
		$totalnum = $postnum + 1;
		echo $firstnum;
		if($totalnum < $lastnum) {} else {echo '-'.$lastnum;}
		echo ' of '.$postnum;
		echo '</p><p class="sortby"><a href="/panel/users">Sort By Date</a> &middot; <a href="/panel/users/?username">Sort By User Name</a> &middot; Sort By Level</p></div>';
		}
	$result = mysql_query("SELECT DISTINCT user.user_id, user.user_login, user.user_name_f, user.user_name_l, user.userlevel_no, userlevel.userlevel_name FROM user, userlevel, user_site_list WHERE user_site_list.site_id='$site_id' AND user_site_list.user_id=user.user_id AND user.userlevel_no=userlevel.userlevel_no ORDER BY userlevel.userlevel_no DESC $limstring") or die(mysql_error());
	while($row = mysql_fetch_array($result))
		{
		$user_id=$row['user_id']; $user_login=$row['user_login']; $userlevel_no=$row['userlevel_no']; $user_name_f=$row['user_name_f']; $user_name_l=$row['user_name_l']; $userlevel_name=$row['userlevel_name'];
			echo '<hr/><p><strong>'.$user_login.'</strong> &middot; <em>'.$userlevel_name.'</em><br>';
			if(!empty($user_name_f) or !empty($user_name_l))
				{
				if(!empty($user_name_f)) {echo $user_name_f;} else {}
				echo ' ';
				if(!empty($user_name_l)) {echo $user_name_l;} else {}
				echo '<br>';
				} else {}
			if($userlevel_no < 5) {echo '<small><em><a href="'.$PHP_SELF.'?edit_user='.$user_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del_user='.$user_id.'">Delete</a></em></small>';} else {}
			echo '</p>';
		}
	}


else
	{
	$pagetype = "User Admin";
	echo '<h1>'.$pagetype.'</h1>';
	$getcount = mysql_query ("SELECT COUNT(*) FROM user, userlevel, user_site_list WHERE user_site_list.site_id='$site_id' AND user_site_list.user_id=user.user_id AND user.userlevel_no=userlevel.userlevel_no");
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
		else {$limstring = "LIMIT 0,$limit";}
	if($postnum > $limit)
		{
		echo ' <div class="useradmin"><div class="pages">';
		$m = $pg + 2; $n = $pg + 1; $p = $pg - 1; $q = $pg - 2;
		if($pg > 1){echo '<a href="?pg=1">&laquo;</a> <a href="?pg='.$p.'">&lsaquo;</a> ';} else{}
		if($q > 0) {echo '<a href="?pg='.$q.'">'.$q.'</a> ';} else {}
		if($p > 0) {echo '<a href="?pg='.$p.'">'.$p.'</a> ';} else {}
		echo "<span>$pg</span> ";
		if($n <= $num_pages) {echo '<a href="?pg='.$n.'">'.$n.'</a> ';} else {}
		if($m <= $num_pages) {echo '<a href="?pg='.$m.'">'.$m.'</a> ';} else {}
		if($pg < $num_pages){echo '<a href="?pg='.$n.'">&rsaquo;</a> <a href="?pg='.$num_pages.'">&raquo;</a>';}
		echo '</div><p class="count">';
		$firstnum = $startpos + 1;
		$lastnum = $startpos + $limit;
		$totalnum = $postnum + 1;
		echo $firstnum;
		if($totalnum < $lastnum) {} else {echo '-'.$lastnum;}
		echo ' of '.$postnum;
		echo '</p><p class="sortby">Sort By Date &middot; <a href="/panel/users/?username">Sort By User Name</a> &middot; <a href="/panel/users/?level">Sort By Level</a></p></div>';
		}
	$result = mysql_query("SELECT DISTINCT user.user_id, user.user_login, user.user_name_f, user.user_name_l, user.userlevel_no, userlevel.userlevel_name FROM user, userlevel, user_site_list WHERE user_site_list.site_id='$site_id' AND user_site_list.user_id=user.user_id AND user.userlevel_no=userlevel.userlevel_no ORDER BY user.user_id DESC $limstring") or die(mysql_error());
	while($row = mysql_fetch_array($result))
		{
		$user_id=$row['user_id']; $user_login=$row['user_login']; $userlevel_no=$row['userlevel_no']; $user_name_f=$row['user_name_f']; $user_name_l=$row['user_name_l']; $userlevel_name=$row['userlevel_name'];
			echo '<hr/><p><strong>'.$user_login.'</strong> &middot; <em>'.$userlevel_name.'</em><br>';
			if(!empty($user_name_f) or !empty($user_name_l))
				{
				if(!empty($user_name_f)) {echo $user_name_f;} else {}
				echo ' ';
				if(!empty($user_name_l)) {echo $user_name_l;} else {}
				echo '<br>';
				} else {}
			if($userlevel_no < 5) {echo '<small><em><a href="'.$PHP_SELF.'?edit_user='.$user_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del_user='.$user_id.'">Delete</a></em></small>';} else {}
			echo '</p>';
		}
	}





include '../'.$foot; ?>