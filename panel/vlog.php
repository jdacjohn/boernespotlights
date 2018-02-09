<?php $pagetitle = "Spotlight Admin"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(5);




		
if(isset($_GET['add_video']))
	{
	$pagetype = "Add Video";
	$add_video = $_GET['add_video'];
	if (empty($_GET['add_video']))
		{ echo ' <p>VideoMarketingSpotlights&trade; must be selected to be edited. You will be redirected to <a href="'.$PHP_SELF.'?view_users">User Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'?view_users>'; }
	else
		{
		echo '<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>';
		echo '<h1>Add Video</h1><hr>';
		$result = mysql_query("SELECT card_id, user_id FROM card WHERE card_id='$add_video' LIMIT 1");
		if(mysql_num_rows($result)==0)
			{
			echo '<p>'.$pagetitle.' must be selected to be edited. You will be redirected to <a href="'.$PHP_SELF.'">VideoMarketingSpotlights&trade; Request Log</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'>';;
			}
		else
			{
			while($row = mysql_fetch_array($result))
				{
				$user_id = $row['user_id'];
				if (isset($_POST['submit']))
					{
					$card_video = htmlentities(($_POST['card_video']), ENT_QUOTES, 'utf-8');
					$subresult1 = mysql_query("UPDATE card SET card_approve='1', card_video='$card_video' WHERE card_id='$add_video'") or die(mysql_error());
					$subresult2 = mysql_query("UPDATE user SET user_credit='' WHERE $user_id=user_id") or die(mysql_error());
					echo '<p>Approved! You will be redirected to <a href="'.$PHP_SELF.'">Spotlight Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'>';
					}
				else
					{ ?>
					<form method="post" action="<?php echo $PHP_SELF; ?>?add_video=<?php echo $add_video; ?>">			
					<fieldset><legend>Video:</legend>
					<ul><li><textarea name="card_video" rows="15"><?= @$_POST['card_video']?></textarea></li>
					<li><button type="submit" value="Update" name="submit">Add</button></li></ul></fieldset></form>
		<?php		}
				}
			}
		}
	}

	
else
	{
	$pagetype = "VideoMarketingSpotlights&trade; Request Log";
	echo '<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>';
	echo '<h1>'.$pagetype.'</h1><hr>';
	$result = mysql_query("SELECT DISTINCT card.card_id, card.co_id, card.user_id, user.user_login, co.co_name,  co.co_contact_name, co.co_contact_email, co.co_contact_phone FROM card, co, user WHERE card.card_approve='0b' AND card.co_id=co.co_id AND card.user_id=user.user_id ORDER BY card_date ASC") or die(mysql_error());
	
	if(mysql_num_rows($result)==0)
		{
		echo ' <p>There are no VideoMarketingSpotlights&trade; to schedule.</p>';
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{ $view_user_id=$row['user_id']; $view_user_login=$row['user_login']; $view_card_id=$row['card_id']; $view_co_name=$row['co_name']; $view_co_contact_name=$row['co_contact_name']; $view_co_contact_email=$row['co_contact_email']; $view_co_contact_phone=$row['co_contact_phone'];
			echo '<hr>';
			
			echo '<p><strong>'.$view_co_name.'</strong><br><a href="/panel/profile/'.$view_user_login.'">';
			if(!empty($view_co_contact_name))
				{
				echo $view_co_contact_name;
				echo '</a><br>';
				} else {echo $view_user_login.'</a><br>';}
			if(!empty($view_co_contact_email))
				{
				echo 'Email: <a href="mailto:'.$view_co_contact_email.'">'.$view_co_contact_email.'</a><br>';
				} else {}
			if(!empty($view_co_contact_phone))
				{
				echo 'Phone: '.$view_co_contact_phone.'<br>';
				} else {}
			echo '<small><em><a href="?add_video='.$view_card_id.'">Add Video Code</a></em></small>';
			}
		}
	}





include '../'.$foot; ?>