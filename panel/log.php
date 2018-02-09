<?php $pagetitle = "BizCardSpotlight&trade; Log"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(5);




		
if(isset($_GET['approve_card']))
	{
	$pagetype = "Approve Spotlight";
	$approve_card = $_GET['approve_card'];
	if (empty($_GET['approve_card']))
		{ echo '<p>'.$pagetitle.' must be selected to be edited. You will be redirected to <a href="'.$PHP_SELF.'?view_users">User Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'?view_users>'; }
	else
		{
		echo '<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>';
		echo '<h1>Approve Spotlight</h1>';
		$result = mysql_query("SELECT card_front, user_id FROM card WHERE card_id='$approve_card' LIMIT 1");
		if(mysql_num_rows($result)==0)
			{
			echo '<p>'.$pagetitle.' must be selected to be edited. You will be redirected to <a href="'.$PHP_SELF.'?view_users">User Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'?view_users>';;
			}
		else
			{
			while($row = mysql_fetch_array($result))
				{
				$approve_card_front = $row["card_front"];
				$approve_user_id = $row["user_id"];
				if (isset($_POST['submit']))
							{
							$subresult1 = mysql_query("UPDATE card SET card_approve='1' WHERE card_id='$approve_card' ");
							$subresult2 = mysql_query("UPDATE user SET user_credit='', user_credit_site_id='' WHERE $approve_user_id=user_id");
							echo '<p>Approved! You will be redirected to <a href="'.$PHP_SELF.'">BizCardSpotlight&trade; Log</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'>';
							}
						else
							{ ?>
							<form method="post" action="<?php echo $PHP_SELF; ?>?approve_card=<?php echo $approve_card; ?>">			
							<fieldset><legend>Spotlight:</legend>
							<ul><li><?php
							
							if(!empty($approve_card_front))
								{
								echo '<img src="/assets/img/spotlights/'.$approve_card_front.'" width="445" height="255">';
								} else {}
							
							?></li>
							<li><button type="submit" value="Update" name="submit">Approve</button></li></ul></fieldset></form>
				<?php		}
				
				
				}
			}
		}
	}

	
elseif(isset($_GET['del_card']))
	{
	$pagetype = "Delete Spotlight";
	$del_card = $_GET['del_card'];
	if (empty($_GET['del_card']))
		{ echo '<p>'.$pagetitle.' must be selected to be edited. You will be redirected to <a href="'.$PHP_SELF.'?view_users">User Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'?view_users>'; }
	else
		{
		echo '<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>';
		echo '<h1>Delete Spotlight</h1>';
		$result = mysql_query("SELECT * FROM card WHERE card_id='$del_card' LIMIT 1");
		$row = mysql_fetch_assoc($result);
		$card_front = $row["card_front"];
		$card_user_id = $row["user_id"];
		if(!empty($card_front))
			{
			$path= '../assets/img/spotlights/'.$card_front.''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/spotlights/new-'.$card_front.''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			} else {}
		$subresult1 = mysql_query("DELETE FROM card WHERE card_id='$del_card' ");
		$subresult2 = mysql_query("UPDATE user SET user_credit='', user_credit_site_id='' WHERE $card_user_id=user_id");
		echo '<p>Deleted! You will be redirected to <a href="'.$PHP_SELF.'">BizCardSpotlight&trade; Log</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'>';
		}
	}	


else
	{
	$pagetype = "BizCardSpotlight&trade; Log";
	echo '<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>';
	echo '<h1>'.$pagetype.'</h1>';
	$result = mysql_query("SELECT DISTINCT card.card_id, card.card_front, card.card_video, card.co_id, card.user_id, user.user_name_f, user.user_name_l, user.user_login, co.co_name FROM card, co, user WHERE card.card_approve='0' AND card.co_id=co.co_id AND card.user_id=user.user_id AND card.site_id='$site_id' ORDER BY card_date ASC") or die(mysql_error());
	
	if(mysql_num_rows($result)==0)
		{
		echo '<p>There are no pending spotlights.</p>';
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{ $view_user_id=$row['user_id']; $view_user_login=$row['user_login']; $view_user_name_f=$row['user_name_f']; $view_user_name_l=$row['user_name_l']; $view_card_id=$row['card_id']; $view_card_front=$row['card_front']; $view_card_video=$row['card_video']; $view_co_name=$row['co_name'];
			echo '<hr>';
			if(!empty($view_card_front))
				{
				echo '<img src="/assets/img/spotlights/new-'.$view_card_front.'" width="445" height="255">';
				}
			else
				{
				echo $view_card_video;
				}
			echo '<p><strong>'.$view_co_name.'</strong><br>';
			if(!empty($view_user_name_f) or !empty($view_user_name_l))
				{
				if(!empty($view_user_name_f)) {echo $view_user_name_f;} else {}
				echo ' ';
				if(!empty($view_user_name_l)) {echo $view_user_name_l;} else {}
				echo '<br>';
				} else {echo $view_user_login.'<br>';}
			echo '<small><em><a href="?approve_card='.$view_card_id.'">Approve</a> &middot; <a href="?del_card='.$view_card_id.'">Delete</a></em></small>';
			}
		}
	}





include '../'.$foot; ?>