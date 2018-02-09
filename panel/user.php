<?php $pagetitle = "User Settings"; include '../core/base.php'; include '../'.$head; check_logged(); check_access(1);





if(isset($_GET['edit_pass']))
	{
	$pagetype = "Edit Password";
	$result = mysql_query("SELECT user_pass FROM user WHERE user_id='".$_SESSION['user_id']."'");
	$row = mysql_fetch_assoc($result);
	$old_user_pass = $row["user_pass"];
	echo '<h1>'.$pagetype.'</h1><hr>';
	$edit_passform = '<form method="post" action="'.$PHP_SELF.'?edit_pass"><input type="hidden" name="treatsCatuser_id" value="'.$_SESSION['user_id'].'">
	<fieldset><legend class="'.(isset($_POST['old_user_pass']) && empty($_POST['old_user_pass']) ? "error" : "").'">Current Password:</legend><ul><li><input name="old_user_pass" type="password" name="old_user_pass" value="'.@$_POST['old_user_pass'].'" /></li></ul></fieldset>			
	<fieldset><legend class="'.(isset($_POST['new_user_pass']) && empty($_POST['new_user_pass']) ? "error" : "").'">New Password:</legend>
	<ul><li><input name="new_user_pass" type="password" name="new_user_pass" value="'.@$_POST['new_user_pass'].'" /></li>
	<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset></form>';
		if (!empty($_POST['old_user_pass']) && !empty($_POST['new_user_pass']) && isset($_POST['submit']))
			{			
			$result = mysql_query("SELECT user_pass FROM user WHERE user_id='".$_SESSION['user_id']."'");
			$row = mysql_fetch_assoc($result);
			$old_user_pass = $row["user_pass"];
				if (md5($_POST['old_user_pass']) == $old_user_pass)
					{
					$result = mysql_query("UPDATE user SET `user_pass`='".md5($_POST['new_user_pass'])."' WHERE user_id='".$_SESSION['user_id']."'");
					echo '<p>Your password was edited successfully! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
					}
				else
					{
					echo '<p class="error">The current password you provided not match your current password. Please try again.</p>';
					echo $edit_passform;
					}
			}
		else
			{
			echo $edit_passform;
			}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	












elseif(isset($_GET['edit']))
	{
	$pagetype = "Edit Profile";
	$edit = $_GET['edit'];
	$result = mysql_query("SELECT * FROM co,co_site WHERE co.user_id='$user_id' AND co.co_id=co_site.co_id AND co_site.site_id='$site_id'");
	echo '<h1>'.$pagetype.'</h1><hr>';
	
	$co_id = $_GET['edit'];
		$result = mysql_query("SELECT * FROM co WHERE co_id='$edit' LIMIT 1");
		$row = mysql_fetch_assoc($result);
		$co_name = $row["co_name"];
		$co_desc = $row["co_desc"];
		$co_address_1 = $row["co_address_1"];
		$co_address_2 = $row["co_address_2"];
		$co_city = $row["co_city"];
		$co_state = $row["co_state"];
		$co_zip = $row["co_zip"];
		$co_phone = $row["co_phone"];
		$co_fax = $row["co_fax"];
		$co_email = $row["co_email"];
		$co_url1 = $row["co_url1"];
		$co_url2 = $row["co_url2"];
		$co_url2_name = $row["co_url2_name"];
		$co_url3 = $row["co_url3"];
		$co_url3_name = $row["co_url3_name"];
		$co_gallery = $row["co_gallery"];
		$co_linkedin = $row["co_linkedin"];
		$co_facebook = $row["co_facebook"];
		$co_google = $row["co_google"];
		$co_twitter = $row["co_twitter"];
		$co_youtube = $row["co_youtube"];
		$co_desc = $row["co_desc"];
		$co_contact_name = $row["co_contact_name"];
		$co_contact_email = $row["co_contact_email"];
		$co_contact_phone = $row["co_contact_phone"];
		$co_seo_desc = $row["co_seo_desc"];
		$co_seo_keywords = $row["co_seo_keywords"];
		
		if (empty($_GET['edit_profile']))
			{ echo '<p>No workie... But I still love ya!</p>'; }
		else
			{
			if (!empty($_POST['co_name']) && isset($_POST['submit']))
				{
				$co_name = htmlentities(($_POST['co_name']), ENT_QUOTES, 'ISO-8859-1');
				$co_desc = htmlentities(($_POST['co_desc']), ENT_QUOTES, 'ISO-8859-1');
				$co_address_1 = htmlentities(($_POST['co_address_1']), ENT_QUOTES, 'ISO-8859-1');
				$co_address_2 = htmlentities(($_POST['co_address_2']), ENT_QUOTES, 'ISO-8859-1');
				$co_city = htmlentities(($_POST['co_city']), ENT_QUOTES, 'ISO-8859-1');
				$co_state = $_POST['co_state'];
				$co_zip = htmlentities(($_POST['co_zip']), ENT_QUOTES, 'ISO-8859-1');
				$co_phone = htmlentities(($_POST['co_phone']), ENT_QUOTES, 'ISO-8859-1');
				$co_fax = htmlentities(($_POST['co_fax']), ENT_QUOTES, 'ISO-8859-1');
				$co_email = htmlentities(($_POST['co_email']), ENT_QUOTES, 'ISO-8859-1');
				$co_url1 = htmlentities(($_POST['co_url1']), ENT_QUOTES, 'ISO-8859-1');
				$co_url2 = htmlentities(($_POST['co_url2']), ENT_QUOTES, 'ISO-8859-1');
				$co_url2_name = htmlentities(($_POST['co_url2_name']), ENT_QUOTES, 'ISO-8859-1');
				$co_url3 = htmlentities(($_POST['co_url3']), ENT_QUOTES, 'ISO-8859-1');
				$co_url3_name = htmlentities(($_POST['co_url3_name']), ENT_QUOTES, 'ISO-8859-1');
				$co_gallery = htmlentities(($_POST['co_gallery']), ENT_QUOTES, 'ISO-8859-1');
				$co_linkedin = htmlentities(($_POST['co_linkedin']), ENT_QUOTES, 'ISO-8859-1');
				$co_facebook = htmlentities(($_POST['co_facebook']), ENT_QUOTES, 'ISO-8859-1');
				$co_google = htmlentities(($_POST['co_google']), ENT_QUOTES, 'ISO-8859-1');
				$co_twitter = htmlentities(($_POST['co_twitter']), ENT_QUOTES, 'ISO-8859-1');
				$co_youtube = htmlentities(($_POST['co_youtube']), ENT_QUOTES, 'ISO-8859-1');
				$co_desc = htmlentities(($_POST['co_desc']), ENT_QUOTES, 'ISO-8859-1');
				$co_contact_name = htmlentities(($_POST['co_contact_name']), ENT_QUOTES, 'ISO-8859-1');
				$co_contact_email = htmlentities(($_POST['co_contact_email']), ENT_QUOTES, 'ISO-8859-1');
				$co_contact_phone = htmlentities(($_POST['co_contact_phone']), ENT_QUOTES, 'ISO-8859-1');
				$co_seo_desc = htmlentities(($_POST['co_seo_desc']), ENT_QUOTES, 'ISO-8859-1');
				$co_seo_keywords = htmlentities(($_POST['co_seo_keywords']), ENT_QUOTES, 'ISO-8859-1');
				
				$result = mysql_query("UPDATE co SET co_name='$co_name', co_desc='$co_desc', co_address_1='$co_address_1', co_address_2='$co_address_2', co_city='$co_city', co_state='$co_state', co_zip='$co_zip', co_phone='$co_phone', co_fax='$co_fax', co_email='$co_email', co_url1='$co_url1', co_url2='$co_url2', co_url2_name='$co_url2_name', co_url3='$co_url3', co_url3_name='$co_url3_name', co_gallery='$co_gallery', co_linkedin='$co_linkedin', co_facebook='$co_facebook', co_google='$co_google', co_twitter='$co_twitter', co_youtube='$co_youtube', co_desc='$co_desc', co_contact_name='$co_contact_name', co_contact_email='$co_contact_email', co_contact_phone='$co_contact_phone', co_seo_desc='$co_seo_desc', co_seo_keywords='$co_seo_keywords' WHERE co_id='$co_id' ");
				echo '<h1>'.$pagetitle.'</h1><hr><p>'.$co_name.' was edited successfully! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
				}
			else
				{ ?>
				<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>
				<h1><?php echo $pagetype; ?></h1><hr>
				<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $co_id; ?>"><input type="hidden" name="co_id" value="<? echo $row['co_id']?>">
					
				<fieldset><legend class="<?= (isset($_POST['co_name']) && empty($_POST['co_name']) ? 'error' : '') ?>">Name:</legend>
				<ul><li><input name="co_name" type="text" value="<?php echo $co_name; ?>"></li></ul></fieldset>
				
				<fieldset><legend>Address Line 1:</legend>
				<ul><li><input name="co_address_1" type="text" value="<?php echo $co_address_1; ?>"></li></ul></fieldset>
				
				<fieldset><legend>Address Line 2:</legend>
				<ul><li><input name="co_address_2" type="text" value="<?php echo $co_address_2; ?>"></li></ul></fieldset>
				
				<fieldset><legend>City:</legend>
				<ul><li><input name="co_city" type="text" value="<?php echo $co_city; ?>"></li></ul></fieldset>
				
				<fieldset><legend>State:</legend>
				<ul><li><select name="co_state">
				<option value="">&nbsp;</option><?php
				$result = mysql_query("SELECT state_id, state_name, state_desc FROM state ORDER BY state_name ASC") or die(mysql_error());
				while($row = mysql_fetch_array($result))
					{
					$state_id = $row['state_id']; $state_name = $row['state_name']; $state_desc = $row['state_desc'];
					echo '<option value="'.$state_id.'"';
					if($co_state==$state_id){echo ' selected';}	else{}
					echo '>'.$state_name.': '.$state_desc.'</option>';
					} 
				?></select></li></ul></fieldset>
				
				<fieldset><legend>Zip:</legend>
				<ul><li><input name="co_zip" type="text" value="<?php echo $co_zip; ?>"></li></ul></fieldset>
				
				<fieldset><legend>Phone:</legend>
				<ul><li><input name="co_phone" type="text" value="<?php echo $co_phone; ?>"></li></ul></fieldset>
				
				<fieldset><legend>Fax:</legend>
				<ul><li><input name="co_fax" type="text" value="<?php echo $co_fax; ?>"></li></ul></fieldset>
				
				<fieldset><legend>Email:</legend>
				<ul><li><input name="co_email" type="text" value="<?php echo $co_email; ?>"></li></ul></fieldset>
				
				<fieldset><legend>URL #1:</legend>
				<ul><li><input name="co_url1" type="text" value="<?php echo $co_url1; ?>"></li></ul></fieldset>
				
				<fieldset><legend>Photo Gallery:</legend>
				<ul><li><input name="co_gallery" type="text" value="<?php echo $co_gallery; ?>"></li></ul></fieldset>
				
				<fieldset><legend>Linked In:</legend>
				<ul><li><input name="co_linkedin" type="text" value="<?php echo $co_linkedin; ?>"></li></ul></fieldset>
				
				<fieldset><legend>Facebook:</legend>
				<ul><li><input name="co_facebook" type="text" value="<?php echo $co_facebook; ?>"></li></ul></fieldset>
				
				<fieldset><legend>Google+:</legend>
				<ul><li><input name="co_google" type="text" value="<?php echo $co_google; ?>"></li></ul></fieldset>
				
				<fieldset><legend>Twitter:</legend>
				<ul><li><input name="co_twitter" type="text" value="<?php echo $co_twitter; ?>"></li></ul></fieldset>
				
				<fieldset><legend>YouTube:</legend>
				<ul><li><input name="co_youtube" type="text" value="<?php echo $co_youtube; ?>"></li></ul></fieldset>
				
				<fieldset><legend>Additional URL #1 Name:</legend>
				<ul><li><input name="co_url2_name" type="text" value="<?php echo $co_url2_name; ?>"></li></ul></fieldset>
				
				<fieldset><legend>Additional URL #1:</legend>
				<ul><li><input name="co_url2" type="text" value="<?php echo $co_url2; ?>"></li></ul></fieldset>
				
				<fieldset><legend>Additional URL #2 Name:</legend>
				<ul><li><input name="co_url3_name" type="text" value="<?php echo $co_url3_name; ?>"></li></ul></fieldset>
				
				<fieldset><legend>Additional URL #2:</legend>
				<ul><li><input name="co_url3" type="text" value="<?php echo $co_url3; ?>"></li></ul></fieldset>
							
				<fieldset><legend>Description:</legend>
				<ul><li><textarea name="co_desc" rows="7"><?php echo $co_desc; ?></textarea></li></ul></fieldset>
				
				<hr>
				
				<fieldset><legend>SEO Description:</legend>
				<ul><li><textarea name="co_seo_desc" rows="7"><?php echo $co_seo_desc; ?></textarea></li></ul></fieldset>
							
				<fieldset><legend>SEO Keywords:</legend>
				<ul><li><textarea name="co_seo_keywords" rows="7"><?php echo $co_seo_keywords; ?></textarea></li></ul></fieldset>
				
				<hr>
				
				<fieldset><legend>Primary Contact's Name:</legend>
				<ul><li><input name="co_contact_name" type="text" value="<?php echo $co_contact_name; ?>"></li></ul></fieldset>
				
				<fieldset><legend>Primary Contact's Email:</legend>
				<ul><li><input name="co_contact_email" type="text" value="<?php echo $co_contact_email; ?>"></li></ul></fieldset>
				
				<fieldset><legend>Primary Contact's Phone:</legend>
				<ul><li><input name="co_contact_phone" type="text" value="<?php echo $co_contact_phone; ?>"></li>
				<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
				
				</form>
	<?php		}
			}
		}	



	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	


elseif(isset($_GET['edit_login']))
	{
	$pagetype = "Edit Username";
	$result = mysql_query("SELECT user_pass, user_login FROM user WHERE user_id='".$_SESSION['user_id']."'");
	$row = mysql_fetch_assoc($result);
	$old_user_pass = $row["user_pass"];
	echo '<h1>'.$pagetype.'</h1><hr>';
	$edit_loginform = '<form method="post" action="'.$PHP_SELF.'?edit_login"><input type="hidden" value="'.$_SESSION['user_id'].'">
	<fieldset><legend class="'.(isset($_POST['old_user_pass']) && empty($_POST['old_user_pass']) ? "error" : "").'">Current Password:</legend><ul><li><input name="old_user_pass" type="text" name="old_user_pass" value="'.@$_POST['old_user_pass'].'" /></li></ul></fieldset>			
	<fieldset><legend class="'.(isset($_POST['new_user_login']) && empty($_POST['new_user_login']) ? "error" : "").'">New User Name:</legend>
	<ul><li><input name="new_user_login" type="text" name="new_user_login" value="'.@$_POST['new_user_login'].'" /></li>
	<li><button type="button" onclick="history.go(-1);return false;">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="submit">Save</button></li></ul></fieldset></form>';
		if (!empty($_POST['old_user_pass']) && !empty($_POST['new_user_login']) && isset($_POST['submit']))
			{			
			$result = mysql_query("SELECT user_pass, user_login FROM user WHERE user_id='".$_SESSION['user_id']."'");
			$row = mysql_fetch_assoc($result);
			$old_user_pass = $row["user_pass"];
				if (md5($_POST['old_user_pass']) == $old_user_pass)
					{
					$result = mysql_query("UPDATE user SET `user_login`='".$_POST['new_user_login']."' WHERE user_id='".$_SESSION['user_id']."'");
					echo '<p>Your username was edited successfully! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
					}
				else
					{
					echo '<p class="error">The password you provided did not match your current password. Please try again.</p>';
					echo $edit_loginform;
					}
			}
		else
			{
			echo $edit_loginform;
			}
	}
		
else
	{
?>
	<h1><?php echo $pagetitle; ?></h1>
	<hr>
	<h4><a href="<?php echo $PHP_SELF; ?>?edit_pass">Edit Your Password</a></h4>
	<!--
	<hr>
	<h4><a href="<?php echo $PHP_SELF; ?>?edit_login">Edit Your Username</a></h4>-->
<?php
	}





include '../'.$foot; ?>