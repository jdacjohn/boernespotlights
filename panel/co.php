<?php $pagetitle = "Control Panel"; include '../core/base.php'; include '../'.$head; check_logged(); check_access(2);





if(isset($_GET['add']))
	{
	$pagetype = "Add Company";
	if (!empty($_POST['co_name']) && isset($_POST['submit']))
		{
		$co_name = htmlentities(($_POST['co_name']), ENT_QUOTES, 'ISO-8859-1');
		$co_desc = htmlentities(($_POST['co_desc']), ENT_QUOTES, 'ISO-8859-1');
		$co_address_1 = htmlentities(($_POST['co_address_1']), ENT_QUOTES, 'ISO-8859-1');
		$co_address_2 = htmlentities(($_POST['co_address_2']), ENT_QUOTES, 'ISO-8859-1');
		$co_city = htmlentities(($_POST['co_city']), ENT_QUOTES, 'ISO-8859-1');
		$co_state = htmlentities(($_POST['co_state']), ENT_QUOTES, 'ISO-8859-1');
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
		$result = mysql_query("INSERT INTO co (co_name, co_address_1, co_address_2, co_city, co_state, co_zip, co_phone, co_fax, co_email, co_url1, co_url2_name, co_url2, co_url3_name, co_url3, co_gallery, co_linkedin, co_facebook, co_google, co_twitter, co_youtube, co_desc, co_contact_name, co_contact_email, co_contact_phone, co_seo_desc, co_seo_keywords) VALUES ('$co_name','$co_address_1','$co_address_2','$co_city','$co_state','$co_zip','$co_phone','$co_fax','$co_email','$co_url1','$co_url2_name','$co_url2','$co_url3_name','$co_url3','$co_gallery','$co_linkedin','$co_facebook','$co_google','$co_twitter','$co_youtube','$co_desc','$co_contact_name','$co_contact_email','$co_contact_phone','$co_seo_desc','$co_seo_keywords')") or die(mysql_error());
		echo '<h1>'.$pagetitle.'</h1>';
		$co_site_listresult = mysql_query("SELECT co_id FROM co ORDER BY co_id DESC LIMIT 1") or die(mysql_error());
		while($co_site_listrow = mysql_fetch_array($co_site_listresult))
			{
			$co_id = $co_site_listrow["co_id"];
			$subresult = mysql_query("INSERT INTO co_site_list (co_id, site_id) VALUES ('$co_id','$site_id')") or die(mysql_error());
			}
		echo '<hr><p>'.$co_name.' was added successfully! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
		}
	else
		{ ?>
		<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>
		<h1><?php echo $pagetype; ?></h1><hr>
		<form method="post" action="<?php echo $PHP_SELF; ?>?add" enctype="multipart/form-data">
		
		<fieldset><legend class="<?= (isset($_POST['co_name']) && empty($_POST['co_name']) ? 'error' : '') ?>">Name:</legend>
		<ul><li><input name="co_name" type="text" value="<?= @$_POST['co_name']?>"></li></ul></fieldset>
		
		<fieldset><legend>Address Line 1:</legend>
		<ul><li><input name="co_address_1" type="text" value="<?= @$_POST['co_address_1']?>"></li></ul></fieldset>
		
		<fieldset><legend>Address Line 2:</legend>
		<ul><li><input name="co_address_2" type="text" value="<?= @$_POST['co_address_2']?>"></li></ul></fieldset>
		
		<fieldset><legend>City:</legend>
		<ul><li><input name="co_city" type="text" value="<?php echo $site_city; ?>"></li></ul></fieldset>
		
		<fieldset><legend>State:</legend>
		<ul><li><select name="co_state">
		<option value="">&nbsp;</option>
		<?php
		$result = mysql_query("SELECT state_id, state_name, state_desc FROM state ORDER BY state_name ASC") or die(mysql_error());
		while($row = mysql_fetch_array($result))
			{
			$state_id = $row['state_id']; $state_name = $row['state_name']; $state_desc = $row['state_desc'];
			echo '<option value="'.$state_id.'"';
			if($state_name==$site_state)
				{
				echo ' selected';
				}
			echo '>'.$state_name.': '.$state_desc.'</option>';
			} 
		?></select></li></ul></fieldset>
		
		<fieldset><legend>Zip:</legend>
		<ul><li><input name="co_zip" type="text" value="<?= @$_POST['co_zip']?>"></li></ul></fieldset>
		
		<fieldset><legend>Phone:</legend>
		<ul><li><input name="co_phone" type="text" value="<?= @$_POST['co_phone']?>"></li></ul></fieldset>
		
		<fieldset><legend>Fax:</legend>
		<ul><li><input name="co_fax" type="text" value="<?= @$_POST['co_fax']?>"></li></ul></fieldset>
		
		<fieldset><legend>Email:</legend>
		<ul><li><input name="co_email" type="text" value="<?= @$_POST['co_email']?>"></li></ul></fieldset>
		
		<fieldset><legend>URL #1:</legend>
		<ul><li><input name="co_url1" type="text" value="<?= @$_POST['co_url1']?>"></li></ul></fieldset>
		
		<fieldset><legend>Photo Gallery:</legend>
		<ul><li><input name="co_gallery" type="text" value="<?= @$_POST['co_gallery']?>"></li></ul></fieldset>
		
		<fieldset><legend>Linked In:</legend>
		<ul><li><input name="co_linkedin" type="text" value="<?= @$_POST['co_linkedin']?>"></li></ul></fieldset>
		
		<fieldset><legend>Facebook:</legend>
		<ul><li><input name="co_facebook" type="text" value="<?= @$_POST['co_facebook']?>"></li></ul></fieldset>
		
		<fieldset><legend>Google+:</legend>
		<ul><li><input name="co_google" type="text" value="<?= @$_POST['co_google']?>"></li></ul></fieldset>
		
		<fieldset><legend>Twitter:</legend>
		<ul><li><input name="co_twitter" type="text" value="<?= @$_POST['co_twitter']?>"></li></ul></fieldset>
		
		<fieldset><legend>YouTube:</legend>
		<ul><li><input name="co_youtube" type="text" value="<?= @$_POST['co_youtube']?>"></li></ul></fieldset>
		
		<fieldset><legend>Additional URL #1 Name:</legend>
		<ul><li><input name="co_url2_name" type="text" value="<?= @$_POST['co_url2_name']?>"></li></ul></fieldset>
		
		<fieldset><legend>Additional URL #1:</legend>
		<ul><li><input name="co_url2" type="text" value="<?= @$_POST['co_url2']?>"></li></ul></fieldset>
		
		<fieldset><legend>Additional URL #2 Name:</legend>
		<ul><li><input name="co_url3_name" type="text" value="<?= @$_POST['co_url3_name']?>"></li></ul></fieldset>
		
		<fieldset><legend>Additional URL #2:</legend>
		<ul><li><input name="co_url3" type="text" value="<?= @$_POST['co_url3']?>"></li></ul></fieldset>
		
		<fieldset><legend>Description:</legend>
		<ul><li><textarea name="co_desc" class="widgEditor" rows="7"><?= @$_POST['co_desc']?></textarea></li></ul></fieldset>
		
		<hr>
		
		<fieldset><legend>SEO Description:</legend>
		<ul><li><textarea name="co_seo_desc" class="widgEditor" rows="7"><?= @$_POST['co_seo_desc']?></textarea></li></ul></fieldset>
					
		<fieldset><legend>SEO Keywords:</legend>
		<ul><li><textarea name="co_seo_keywords" rows="7"><?= @$_POST['co_seo_keywords']?></textarea></li></ul></fieldset>
		
		<hr>
		
		<fieldset><legend>Primary Contact's Name:</legend>
		<ul><li><input name="co_contact_name" type="text" value="<?= @$_POST['co_contact_name']?>"></li></ul></fieldset>
		
		<fieldset><legend>Primary Contact's Email:</legend>
		<ul><li><input name="co_contact_email" type="text" value="<?= @$_POST['co_contact_email']?>"></li></ul></fieldset>
		
		<fieldset><legend>Primary Contact's Phone:</legend>
		<ul><li><input name="co_contact_phone" type="text" value="<?= @$_POST['co_contact_phone']?>"></li>
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
		
		</form>
<?php	}
	}
		
elseif(isset($_GET['edit']))
	{
	$pagetype = "Edit Company";
	$co_id = $_GET['edit'];
	$result = mysql_query("SELECT * FROM co WHERE co_id='$co_id' LIMIT 1");
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
	
	if (empty($_GET['edit']))
		{ echo '<p>Company must be selected to be edited. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
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
			<ul><li><textarea name="co_desc" class="widgEditor" rows="7"><?php echo $co_desc; ?></textarea></li></ul></fieldset>
			
			<hr>
			
			<fieldset><legend>SEO Description:</legend>
			<ul><li><textarea name="co_seo_desc" class="widgEditor" rows="7"><?php echo $co_seo_desc; ?></textarea></li></ul></fieldset>
						
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

elseif(isset($_GET['del']))
	{
	$pagetype = "Delete";
	$co_id = $_GET['del'];	
	$del = mysql_query("SELECT * FROM co WHERE '$co_id'=co_id");
	if (empty($_GET['del']))
		{ echo '<p>'.$pagetitle.' must be selected to be deleted. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
	else
		{
		echo '<h1>'.$pagetitle.'</h1><hr>';
		$result = mysql_query("DELETE FROM co_site_list WHERE '$co_id'=co_id");
		$delpic = mysql_query("SELECT card_front FROM card WHERE card_front!='' AND '$co_id'=co_i");
		while($row = mysql_fetch_array($delpic))
			{
			$file_name = $row['card_front'];
			if(!empty($file_name))
				{
				$path= '../assets/img/spotlights/'. $file_name .'';
				if(@unlink($path)){/* echo "Deleted file "; */}
				$path2= '../assets/img/spotlights/new-'. $file_name .'';
				if(@unlink($path2)){/* echo "Deleted file "; */}
				$path3= '../assets/img/spotlights/tn-'. $file_name .'';
				if(@unlink($path3)){/* echo "Deleted file "; */}
				}
			}
		$result = mysql_query("DELETE FROM card WHERE '$co_id'=co_id");
		$result = mysql_query("DELETE FROM co_art WHERE '$co_id'=co_id");
		$result = mysql_query("DELETE FROM co_bus WHERE '$co_id'=co_id");
		$result = mysql_query("DELETE FROM co_cat WHERE '$co_id'=co_id");
		$result = mysql_query("DELETE FROM co_com WHERE '$co_id'=co_id");
		$result = mysql_query("DELETE FROM co_dest WHERE '$co_id'=co_id");
		$result = mysql_query("DELETE FROM co WHERE '$co_id'=co_id");
		echo '<p>Deleted! You will be redirected to the <a href="'.$PHP_SELF.'">'.$pagetitle.'</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'>';
		}
	}

elseif(isset($_GET['addtoprofile'])){
?>
<form method="post" action="<?php echo $PHP_SELF; ?>?add_co" enctype="multipart/form-data">

<fieldset><legend class="">Name:</legend>
<ul><li><input name="co_name" type="text" value=""></li></ul></fieldset>

<fieldset><legend>Address Line 1:</legend>
<ul><li><input name="co_address_1" type="text" value=""></li></ul></fieldset>

<fieldset><legend>Address Line 2:</legend>
<ul><li><input name="co_address_2" type="text" value=""></li></ul></fieldset>

<fieldset><legend>City:</legend>
<ul><li><input name="co_city" type="text" value=""></li></ul></fieldset>

<fieldset><legend>State:</legend>
<ul><li><select name="co_state">
<option value="">&nbsp;</option>
<?php
$result = mysql_query("SELECT state_id, state_name, state_desc FROM state ORDER BY state_name ASC") or die(mysql_error());
while($row = mysql_fetch_array($result))
	{
	$state_id = $row['state_id']; $state_name = $row['state_name']; $state_desc = $row['state_desc'];
	echo '<option value="'.$state_id.'"';
	if($state_name==$site_state)
		{
		echo ' selected';
		}
	echo '>'.$state_name.': '.$state_desc.'</option>';
	} 
?></select></li></ul></fieldset>

<fieldset><legend>Zip:</legend>
<ul><li><input name="co_zip" type="text" value=""></li></ul></fieldset>

<fieldset><legend>Phone:</legend>
<ul><li><input name="co_phone" type="text" value=""></li></ul></fieldset>

<fieldset><legend>Fax:</legend>
<ul><li><input name="co_fax" type="text" value=""></li></ul></fieldset>

<fieldset><legend>Email:</legend>
<ul><li><input name="co_email" type="text" value=""></li></ul></fieldset>

<fieldset><legend>URL #1:</legend>
<ul><li><input name="co_url1" type="text" value=""></li></ul></fieldset>

<fieldset><legend>Photo Gallery:</legend>
<ul><li><input name="co_gallery" type="text" value=""></li></ul></fieldset>

<fieldset><legend>Linked In:</legend>
<ul><li><input name="co_linkedin" type="text" value=""></li></ul></fieldset>

<fieldset><legend>Facebook:</legend>
<ul><li><input name="co_facebook" type="text" value=""></li></ul></fieldset>

<fieldset><legend>Google+:</legend>
<ul><li><input name="co_google" type="text" value=""></li></ul></fieldset>

<fieldset><legend>Twitter:</legend>
<ul><li><input name="co_twitter" type="text" value=""></li></ul></fieldset>

<fieldset><legend>YouTube:</legend>
<ul><li><input name="co_youtube" type="text" value=""></li></ul></fieldset>

<fieldset><legend>Additional URL #1 Name:</legend>
<ul><li><input name="co_url2_name" type="text" value=""></li></ul></fieldset>

<fieldset><legend>Additional URL #1:</legend>
<ul><li><input name="co_url2" type="text" value=""></li></ul></fieldset>

<fieldset><legend>Additional URL #2 Name:</legend>
<ul><li><input name="co_url3_name" type="text" value=""></li></ul></fieldset>

<fieldset><legend>Additional URL #2:</legend>
<ul><li><input name="co_url3" type="text" value=""></li></ul></fieldset>

<fieldset><legend>Description:</legend>
<ul><li><textarea name="co_desc" rows="10" class="widgEditor"></textarea></li></ul></fieldset>

<hr>

<fieldset><legend>Primary Contact's Name:</legend>
<ul><li><input name="co_contact_name" type="text" value=""></li></ul></fieldset>

<input name="co_contact_email" type="hidden" value="<?php echo $_GET['addemail']; ?>">
<input name="co_id" type="hidden" value="<?php echo $_GET['addtoprofile']; ?>">

<fieldset><legend>Primary Contact's Phone:</legend>
<ul><li><input name="co_contact_phone" type="text" value="<?= @$_POST['co_contact_phone']?>"></li>
<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="addthis">Save</button></li></ul></fieldset>

</form>
<?php
}elseif (isset($_POST['addthis'])){
	$co_id = $_POST['co_id'];
	$co_name = htmlentities(($_POST['co_name']), ENT_QUOTES, 'ISO-8859-1');
	$co_desc = htmlentities(($_POST['co_desc']), ENT_QUOTES, 'ISO-8859-1');
	$co_address_1 = htmlentities(($_POST['co_address_1']), ENT_QUOTES, 'ISO-8859-1');
	$co_address_2 = htmlentities(($_POST['co_address_2']), ENT_QUOTES, 'ISO-8859-1');
	$co_city = htmlentities(($_POST['co_city']), ENT_QUOTES, 'ISO-8859-1');
	$co_state = htmlentities(($_POST['co_state']), ENT_QUOTES, 'ISO-8859-1');
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
	mysql_query("INSERT INTO co (co_name, co_address_1, co_address_2, co_city, co_state, co_zip, co_phone, co_fax, co_email, co_url1, co_url2_name, co_url2, co_url3_name, co_url3, co_gallery, co_linkedin, co_facebook, co_google, co_twitter, co_youtube, co_desc, co_contact_name, co_contact_email, co_contact_phone, user_id) VALUES ('$co_name','$co_address_1','$co_address_2','$co_city','$co_state','$co_zip','$co_phone','$co_fax','$co_email','$co_url1','$co_url2_name','$co_url2','$co_url3_name','$co_url3','$co_gallery','$co_linkedin','$co_facebook','$co_google','$co_twitter','$co_youtube','$co_desc','$co_contact_name','$co_contact_email','$co_contact_phone','$user_id')") or die(mysql_error());
	$last_sql="SELECT * FROM `co` ORDER BY  co_id DESC LIMIT 1";
	$last_result = mysql_query($last_sql) or die(mysql_error());
	while($last = mysql_fetch_array($last_result)){
		$co_last=$last['co_id'];
	}	
	mysql_query("INSERT INTO co_site_list (co_id, site_id) VALUES ('$co_last','1')") or die(mysql_error());
	?>
	<script type="text/javascript">
	<!--
	window.location = "http://www.boernespotlights.com/panel/co/?co=<?php echo $co_id; ?>"
	//-->
	</script>
	<?php	

}elseif(isset($_GET['co']))
	{
	$co_id = $_GET['co'];
	if (empty($_GET['co']))
		{ echo '<p>'.$pagetitle.' must be selected to be edited. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
	else
		{
		$query = "SELECT DISTINCT co.co_id, co.user_id, co.co_contact_email, co.co_name, co.co_email, co.co_address_1, co.co_address_2, co.co_city, co.co_state, co.co_zip, co.co_phone, co.co_fax, co.co_email, co.co_url1, co.co_linkedin, co.co_facebook, co.co_google, co.co_twitter, co.co_linkedin, co.co_facebook, co.co_google, co.co_twitter, co.co_desc FROM card, co, co_site_list WHERE $co_id=co.co_id ORDER BY co_name ASC";
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
				$co_linkedin = $row["co_linkedin"];
				$co_facebook = $row["co_facebook"];
				$co_google = $row["co_google"];
				$co_twitter = $row["co_twitter"];
				$co_desc=$row["co_desc"];
				$user_id = $row['user_id'];
				$co_contact_email = $row['co_contact_email'];
				$count_company = "SELECT * FROM `co` WHERE co_contact_email= '$co_contact_email'";
				$count_results = mysql_query($count_company) or die(mysql_error());
				$num_rows = mysql_num_rows($count_results);				
				echo '<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>';
				echo '<h1>'.$co_name.'</h1><h3><a href="/company/'.$co_id.'">View Profile</a></h3><div class="clear">&nbsp;</div><hr><h2>'.$co_contact_email.'</h2><p><strong>Companies under this Email: </strong> '.$num_rows.'<br />';
				while($show=mysql_fetch_array($count_results)){
					$co_ids = $show['co_id'];
					$co_name = $show['co_name'];
					echo '<a href="'.$PHP_SELF.'?co='.$co_ids.'">'.$co_name.'</a><br />';
				}				
				if($userlevel_no == '5'){
					echo '<br /><a href="'.$PHP_SELF.'?addtoprofile='.$co_id.'&addemail='.$co_contact_email.'">Add more?</a>';
				}
				echo '<hr><h2>BizCard <a href="'.$PHP_SELF.'?photo='.$co_id.'">Edit</a></h2>';
				//echo "SELECT DISTINCT card.card_id, card.card_front, card.card_video, card.co_id, card.user_id, user.user_name_f, user.user_name_l, user.user_login, co.co_name FROM card, co, user WHERE card.card_approve='1' AND card.card_id='$co_id' AND card.user_id=user.user_id ORDER BY card_date ASC";
				//$result_biz = mysql_query("SELECT card.card_id, card.card_front, card.card_video, card.co_id, card.user_id, user.user_name_f, user.user_name_l, user.user_login, co.co_name FROM card, co, user WHERE card.card_approve='1' AND card.co_id='309' AND card.user_id=user.user_id ORDER BY card_date ASC") or die(mysql_error());
				$result_biz = mysql_query("SELECT DISTINCT card.card_id, card.card_front, card.card_video, card.co_id, card.user_id, card.card_approve, user.user_name_f, user.user_name_l, user.user_login, co.co_name FROM card, co, user WHERE card.co_id='$co_id' AND card.user_id=user.user_id ORDER BY card_date ASC LIMIT 1") or die(mysql_error());
				
				if(mysql_num_rows($result_biz)==0)
					{
					echo '<p>No BizCard for this Company</p>';
					}
				else
					{
					while($row = mysql_fetch_array($result_biz))
						{ $view_user_id=$row['user_id']; $view_user_login=$row['user_login']; $view_user_name_f=$row['user_name_f']; $view_user_name_l=$row['user_name_l']; $view_card_id=$row['card_id']; $view_card_front=$row['card_front']; $view_card_video=$row['card_video']; $view_co_name=$row['co_name'];
						  $card_approve=$row['card_approve']; 
						if(!empty($view_card_front))
							{
							echo '<img src="/assets/img/spotlights/new-'.$view_card_front.'" width="445" height="255">';
							}
						else
							{
							//echo $view_card_video;
							}
						if($card_approve == 0){
							echo "<br /><small>Your BizCard is pending approval</small>";
						}
						//echo '<p><strong>'.$view_co_name.'</strong><br>';
						if(!empty($view_user_name_f) or !empty($view_user_name_l))
							{
							if(!empty($view_user_name_f)) {/*echo $view_user_name_f;*/} else {}
							echo ' ';
							if(!empty($view_user_name_l)) {/*echo $view_user_name_l;*/} else {}
							echo '<br>';
							} else {/*echo $view_user_login.'<br>';*/}
						//echo '<small><em><a href="?approve_card='.$view_card_id.'">Approve</a> &middot; <a href="?del_card='.$view_card_id.'">Delete</a></em></small>';
						}
					}
				
				
				
				echo '<hr>';
				echo '<h2>Company Details <a href="'.$PHP_SELF.'?edit='.$co_id.'">Edit</a></h2>';
				if(!empty($co_desc)) {echo '<p><strong>Description:</strong> '.$co_desc.'</p>';} else {}
				if(!empty($co_address_1) or !empty($co_address_2) or !empty($co_city) or !empty($co_state) or !empty($co_zip)) {echo '<p><strong>Address</strong>';} else {}
				if(!empty($co_address_1)) {echo ' &middot; '.$co_address_1;} else {}
				if(!empty($co_address_2)) {echo ' &middot; '.$co_address_2;} else {}
				if(!empty($co_city)) {echo ' &middot; '.$co_city;} else {}
				if(!empty($co_state))
					{
					$subresult = mysql_query("SELECT state_name FROM state WHERE $co_state=state_id") or die(mysql_error());
					while($subrow = mysql_fetch_array($subresult))
						{
						$state_name = $subrow['state_name'];
						echo ' &middot; '.$state_name;
						}
					} else {}
				if(!empty($co_zip)) {echo ' &middot; '.$co_zip;} else {}
				
				
				if(!empty($co_url1)) {echo '<p><strong>URL:</strong> '.$co_url1.'</p>';} else {}
				if(!empty($co_linkedin)) {echo '<p><strong>Linked In:</strong> <a href="'.$co_linkedin.'" target="_blank">'.$co_linkedin.'</a></p>'; } else {}
				if(!empty($co_facebook)) {echo '<p><strong>Facebook:</strong> <a href="'.$co_facebook.'" target="_blank">'.$co_facebook.'</a></p>'; } else {}
				if(!empty($co_google)) {echo '<p><strong>Google+:</strong> <a href="'.$co_google.'" target="_blank">'.$co_google.'</a></p>'; }
				if(!empty($co_twitter)) {echo '<p><strong>Twitter:</strong> <a href="'.$co_twitter.'" target="_blank">'.$co_twitter.'</a></p>'; } else {}
				
				
				}
			if($userlevel_no == '5'){
				echo '<hr>';
				echo '<h2>Delete Company <a href="'.$PHP_SELF.'?deletecompany='.$co_id.'">Edit</a></h2>';
				echo '<hr><h2>Extras</h2>';
				$sub1query = "SELECT co_feat_list_id FROM co_feat_list WHERE '$site_id'=co_feat_list.site_id AND '$co_id'=co_id LIMIT 1";
				$sub1result = mysql_query($sub1query) or die(mysql_error()); echo '<p><strong>Featured:</strong> ';
				if(mysql_num_rows($sub1result)==0)
					{
					echo '<img src="/assets/img/icon-x.gif"> <a href="/panel/co_feat?add='.$co_id.'">Mark as Featured</a></p>';;
					}
				else
					{
					echo '<img src="/assets/img/icon-check.gif"> <a href="/panel/co_feat?del='.$co_id.'">Remove as Featured</a></p>';
					}
				$sub2query = "SELECT co_spons_list_id FROM co_spons_list WHERE '$site_id'=co_spons_list.site_id AND '$co_id'=co_id LIMIT 1";
				$sub2result = mysql_query($sub2query) or die(mysql_error()); echo '<p><strong>Sponsor:</strong> ';
				if(mysql_num_rows($sub2result)==0)
					{
					echo '<img src="/assets/img/icon-x.gif"> <a href="/panel/co_spons?add='.$co_id.'">Mark as a Sponsor</a></p>';
					}
				else
					{
					echo '<img src="/assets/img/icon-check.gif"> <a href="/panel/co_spons?del='.$co_id.'">Remove as Sponsor</a></p>';
					}
			
				echo '<hr><h2>Arts Directory <a href="/panel/co_art_list.php?add='.$co_id.'">Add Company to Arts Directory</a></h2>';
				$sub1query = "SELECT co_art.co_art_id, co_art.co_art_name, co_art_list.co_art_list_id FROM co, co_art, co_art_list WHERE '$co_id'=co_art_list.co_id AND co_art.co_art_id=co_art_list.co_art_id AND co_art_list.co_id=co.co_id ORDER BY co.co_name, co_art.co_art_name ASC";
				$sub1result = mysql_query($sub1query) or die(mysql_error()); $art_id = '';
				while($sub1row = mysql_fetch_array($sub1result))
					{			
					$co_art_id=$sub1row['co_art_id']; $co_art_name=$sub1row['co_art_name']; $co_art_list_id=$sub1row['co_art_list_id'];
					echo '<p><strong><a href="/arts/'.$co_art_id.'">'.$co_art_name.'</a></strong> &middot; <a href="/panel/co_art_list.php?del='.$co_art_list_id.'">Remove</a></p>';
					}
			
				echo '<hr><h2>Business Directory <a href="/panel/co_bus_list.php?add='.$co_id.'">Add Company to Business Directory</a></h2>';
				$sub1query = "SELECT co_bus.co_bus_id, co_bus.co_bus_name, co_bus_list.co_bus_list_id FROM co, co_bus, co_bus_list WHERE '$co_id'=co_bus_list.co_id AND co_bus.co_bus_id=co_bus_list.co_bus_id AND co_bus_list.co_id=co.co_id ORDER BY co.co_name, co_bus.co_bus_name ASC";
				$sub1result = mysql_query($sub1query) or die(mysql_error()); $bus_id = '';
				while($sub1row = mysql_fetch_array($sub1result))
					{			
					$co_bus_id=$sub1row['co_bus_id']; $co_bus_name=$sub1row['co_bus_name']; $co_bus_list_id=$sub1row['co_bus_list_id'];
					echo '<p><strong><a href="/business/'.$co_bus_id.'">'.$co_bus_name.'</a></strong> &middot; <a href="/panel/co_bus_list.php?del='.$co_bus_list_id.'">Remove</a></p>';
					}
			
				echo '<hr><h2>Category Directory <a href="/panel/co_cat_list.php?add='.$co_id.'">Add Company to Category Directory</a></h2>';
				$sub1query = "SELECT co_cat.co_cat_id, co_cat.co_cat_name, co_cat_list.co_cat_list_id FROM co, co_cat, co_cat_list WHERE '$co_id'=co_cat_list.co_id AND co_cat.co_cat_id=co_cat_list.co_cat_id AND co_cat_list.co_id=co.co_id ORDER BY co.co_name, co_cat.co_cat_name ASC";
				$sub1result = mysql_query($sub1query) or die(mysql_error()); $cat_id = '';
				while($sub1row = mysql_fetch_array($sub1result))
					{			
					$co_cat_id=$sub1row['co_cat_id']; $co_cat_name=$sub1row['co_cat_name']; $co_cat_list_id=$sub1row['co_cat_list_id'];
					echo '<p><strong><a href="/category/'.$co_cat_id.'">'.$co_cat_name.'</a></strong> &middot; <a href="/panel/co_cat_list.php?del='.$co_cat_list_id.'">Remove</a></p>';
					}
				
				echo '<hr><h2>Community Directory <a href="/panel/co_com_list.php?add='.$co_id.'">Add Company to Community Directory</a></h2>';
				$sub1query = "SELECT co_com.co_com_id, co_com.co_com_name, co_com_list.co_com_list_id FROM co, co_com, co_com_list WHERE '$co_id'=co_com_list.co_id AND co_com.co_com_id=co_com_list.co_com_id AND co_com_list.co_id=co.co_id ORDER BY co.co_name, co_com.co_com_name ASC";
				$sub1result = mysql_query($sub1query) or die(mysql_error()); $com_id = '';
				while($sub1row = mysql_fetch_array($sub1result))
					{			
					$co_com_id=$sub1row['co_com_id']; $co_com_name=$sub1row['co_com_name']; $co_com_list_id=$sub1row['co_com_list_id'];
					echo '<p><strong><a href="/Community/'.$co_com_id.'">'.$co_com_name.'</a></strong> &middot; <a href="/panel/co_com_list.php?del='.$co_com_list_id.'">Remove</a></p>';
					}	
				echo '<hr><h2>Destination Directory <a href="/panel/co_dest_list.php?add='.$co_id.'">Add Company to Destination Directory</a></h2>';
				$sub1query = "SELECT co_dest.co_dest_id, co_dest.co_dest_name, co_dest_list.co_dest_list_id FROM co, co_dest, co_dest_list WHERE '$co_id'=co_dest_list.co_id AND co_dest.co_dest_id=co_dest_list.co_dest_id AND co_dest_list.co_id=co.co_id ORDER BY co.co_name, co_dest.co_dest_name ASC";
				$sub1result = mysql_query($sub1query) or die(mysql_error()); $dest_id = '';
				while($sub1row = mysql_fetch_array($sub1result))
					{			
					$co_dest_id=$sub1row['co_dest_id']; $co_dest_name=$sub1row['co_dest_name']; $co_dest_list_id=$sub1row['co_dest_list_id'];
					echo '<p><strong><a href="/destination/'.$co_dest_id.'">'.$co_dest_name.'</a></strong> &middot; <a href="/panel/co_dest_list.php?del='.$co_dest_list_id.'">Remove</a></p>';
					}
			
				
				echo '<hr><h2>Spotlights <a href="/panel/spotlights.php?add_bizcard='.$co_id.'">Add BizCard-Spotlight&trade;</a><a href="/panel/spotlights.php?add_video='.$co_id.'">Add Video Marketing Spotlight&trade;</a></h4>';
				$sub3query = "SELECT card_id, card_front, card_video FROM card WHERE $co_id=co_id ORDER BY card_front DESC";
				$sub3result = mysql_query($sub3query) or die(mysql_error()); $card_id = '';
				while($sub3row = mysql_fetch_array($sub3result))
					{
					$card_id=$sub3row['card_id']; $card_front=$sub3row['card_front']; $card_video=$sub3row['card_video'];
					if(!empty($card_front))
						{
						echo ' <p class="tiny"><img src="/assets/img/spotlights/tn-'.$card_front.'"> &middot; <a href="/panel/spotlights.php?del='.$card_id.'">Delete</a></p>';
						}
					else
						{
						echo ' <p><img src="/assets/img/spotlights/video.jpg" width="35" height="20"> &middot; <a href="/panel/spotlights.php?edit='.$card_id.'">Edit</a> &middot; <a href="/panel/spotlights.php?del='.$card_id.'">Delete</a></p>';
						}	
					}
				}
			}
		}
	}
elseif (isset($_GET['photo']))
	{if(isset($_GET['photo'])){$coo_id = $_GET['photo'];}
	//if(isset($_POST['conum'])){$coo_id = $_POST['conum'];}
	if (isset($_POST['submit']) && !empty($_FILES["card_front"]["name"]))
		{
		
		//Get the file information
		$userfile_name = $_FILES["card_front"]["name"];
		$userfile_tmp = $_FILES["card_front"]["tmp_name"];
		$userfile_size = ($_FILES["card_front"]["size"] / 1024);
		$filename = basename($_FILES["card_front"]["name"]);
		$file_ext = strtolower(substr($filename, strrpos($filename, ".") + 1));
		$max_file = '1024';
		if ((($file_ext=="jpg") OR ($file_ext=="jpeg")) && ($userfile_size < $max_file))
			{
			$subresult4 = mysql_query("SELECT card_id, co_id FROM card WHERE '$coo_id'=co_id ORDER BY card_id DESC LIMIT 1") or die(mysql_error());
			$num_subresult4 = mysql_num_rows($subresult4);
			if($num_subresult4 > 0){
				while($subrow4 = mysql_fetch_array($subresult4))
					{
					echo "if";
					$co_contact_email = $subrow4['co_contact_email'];
					$subresult_email = mysql_query("SELECT * FROM `user` FROM user_email='$co_contact_email'");
					while($userid=mysql_fetch_array($subresult_email)){
						$user_id = $userid['user_id'];		
		
						$card_front = strtolower($user_id."-".date("mdy")."-".strtolower(str_replace(' ', '', $_FILES["card_front"]["name"])));
						$card_front_target = "../assets/img/spotlights/".$card_front;
						move_uploaded_file($_FILES["card_front"]["tmp_name"],$card_front_target);
				
						$resizeObj = new resize('../assets/img/spotlights/'.$card_front); // *** 1) Initialise / load image
						$resizeObj -> resizeImage(445, 445, 'auto'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
						$resizeObj -> saveImage('../assets/img/spotlights/new-'.$card_front, 100); // *** 3) Save image
						$resizeObj2 = new resize('../assets/img/spotlights/'.$card_front); // *** 1) Initialise / load image
						$resizeObj2 -> resizeImage(270, 270, 'auto'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
						$resizeObj2 -> saveImage('../assets/img/spotlights/tn-'.$card_front, 100); // *** 3) Save image
				
						$subresult3 = mysql_query("UPDATE card SET card_front='$card_front', card_approve='0', co_id='$coo_id',city_code='1' WHERE card_id='$card_id'");
						if($user_credit=='card1-2')
							{
							$subresult = mysql_query("UPDATE user SET user_credit='card1-3' WHERE $user_id=user_id");
							}
						elseif($user_credit=='sponsor1-2')
							{
							$subresult = mysql_query("UPDATE user SET user_credit='sponsor1-3' WHERE $user_id=user_id");
							$subresult2 = mysql_query("INSERT INTO co_spons_list (co_id,site_id) VALUES ('$co_id','$site_id')");
							}
						elseif($user_credit=='sponsor2-2')
							{
							$subresult = mysql_query("UPDATE user SET user_credit='sponsor2-3' WHERE $user_id=user_id");
							$subresult2 = mysql_query("INSERT INTO co_spons_list (co_id,site_id) VALUES ('$co_id','$site_id')");
							}
						elseif($user_credit=='sponsor3-2')
							{
							$subresult = mysql_query("UPDATE user SET user_credit='sponsor3-3' WHERE $user_id=user_id");
							$subresult2 = mysql_query("INSERT INTO co_spons_list (co_id,site_id) VALUES ('$co_id','$site_id')");
							}
						else {}
							//mail to admin
							//subject and recipient
							$subject = $site_name.' - BizCard Log';
							$recipient = $site_contact;
							$headers ="From: ${_POST['new_user_email']}" . "\r\n";
					
							//mail server stuff
							$headers .= 'MIME-Version: 1.0' . "\r\n";
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";	
							$message = '<html><head><title>'.$site_name.' - BizCard Log</title></head>';
							$message .= '<body>';
					
							//email body
							$message .= "<p>There is a new item in the BizCard log.</p>
							</body></html>";
		
							//mail send function
							@$send=mail($recipient,$subject,$message,$headers);
						//end mail to admin
						echo ' <p>Card was added successfully! You will be redirected to <a href="/panel/redeem">Redeem Your Spotlight</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/redeem>';
						}
					}
				}else{
					$subresult4 = mysql_query("SELECT * FROM `co` WHERE co_id = '$coo_id'");
						while($subrow4 = mysql_fetch_array($subresult4))
							{
							//echo "else";
							$co_contact_email = $subrow4['co_contact_email'];
							//echo $co_contact_email;
							$subresult_email = mysql_query("SELECT * FROM `user` WHERE user_email='$co_contact_email'");
							while($userid=mysql_fetch_array($subresult_email)){
								$user_id = $userid['user_id'];
								
								$card_front = strtolower($user_id."-".date("mdy")."-".strtolower(str_replace(' ', '', $_FILES["card_front"]["name"])));

								$card_front_target = "../assets/img/spotlights/".$card_front;
								move_uploaded_file($_FILES["card_front"]["tmp_name"],$card_front_target);
								
								$resizeObj = new resize('../assets/img/spotlights/'.$card_front); // *** 1) Initialise / load image
								$resizeObj -> resizeImage(445, 445, 'auto'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
								$resizeObj -> saveImage('../assets/img/spotlights/new-'.$card_front, 100); // *** 3) Save image
								$resizeObj2 = new resize('../assets/img/spotlights/'.$card_front); // *** 1) Initialise / load image
								$resizeObj2 -> resizeImage(270, 270, 'auto'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
								$resizeObj2 -> saveImage('../assets/img/spotlights/tn-'.$card_front, 100); // *** 3) Save image
								//echo $card_front;	
								$subresult3 = mysql_query("INSERT INTO card (card_front,co_id,site_id, card_approve, user_id, city_code) VALUES ('$card_front','$coo_id','1','0','$user_id','1')");
								//echo $user_id;
								if($user_credit=='card1-2')
									{
									$subresult = mysql_query("UPDATE user SET user_credit='card1-3' WHERE $user_id=user_id");
									}
								elseif($user_credit=='sponsor1-2')
									{
									$subresult = mysql_query("UPDATE user SET user_credit='sponsor1-3' WHERE $user_id=user_id");
									$subresult2 = mysql_query("INSERT INTO co_spons_list (co_id,site_id) VALUES ('$co_id','$site_id')");
									}
								elseif($user_credit=='sponsor2-2')
									{
									$subresult = mysql_query("UPDATE user SET user_credit='sponsor2-3' WHERE $user_id=user_id");
									$subresult2 = mysql_query("INSERT INTO co_spons_list (co_id,site_id) VALUES ('$co_id','$site_id')");
									}
								elseif($user_credit=='sponsor3-2')
									{
									$subresult = mysql_query("UPDATE user SET user_credit='sponsor3-3' WHERE $user_id=user_id");
									$subresult2 = mysql_query("INSERT INTO co_spons_list (co_id,site_id) VALUES ('$co_id','$site_id')");
									}
								else {}
									//mail to admin
									//subject and recipient
									$subject = $site_name.' - BizCard Log';
									$recipient = $site_contact;
									$headers ="From: ${_POST['new_user_email']}" . "\r\n";
									
									//mail server stuff
									$headers .= 'MIME-Version: 1.0' . "\r\n";
									$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";	
									$message = '<html><head><title>'.$site_name.' - BizCard Log</title></head>';
									$message .= '<body>';
										
									//email body
									$message .= "<p>There is a new item in the BizCard log.</p>
									</body></html>";
								
									//mail send function
								@$send=mail($recipient,$subject,$message,$headers);
								//end mail to admin
								echo ' <p>Card was added successfully! You will be redirected to <a href="/panel/co.php?co='.$coo_id.'">your Admin area</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/co.php?co='.$coo_id.'>';
								
								}
							}
				}
			}
		else
			{
			echo '<h1>'.$pagetype.'</h1><hr><p>ONLY images under 1MB are accepted for upload. Please try again. You will be redirected to <a href="/panel/co.php?co='.$coo_id.'">your Admin area</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/co.php?co='.$coo_id.'>';
			}
		
		}
	else
		{
		?>
		<form method="post" action="<?php echo $PHP_SELF; ?>?photo=<?php echo $coo_id;?>" enctype="multipart/form-data"><input type="hidden" name="user_id" value="<? echo $_SESSION['user_id'];?>">
		<input type="hidden" name="conum" value="<? echo $coo_id;?>">
		
		<fieldset><legend>Card Front:</legend>
		<ul><li><input name="card_front" type="file" /></li></ul></fieldset>		
		
		<fieldset>
		<ul><li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul>
		</fieldset>
		
		</form>
<?php	}

	}
elseif(isset($_GET['deletecompany']))
	{
	$co_id = $_GET['deletecompany'];
	$company_sql = "SELECT * FROM `co` WHERE co_id = '$co_id'";
	$company_results = mysql_query($company_sql) or die(mysql_error());
	while($rows=mysql_fetch_array($company_results)){
		$company_name = $rows['co_name'];
	}
	$pagetype = "Delete Company";
	if (empty($_GET['deletecompany']))
		{ echo '<p>'.$pagetitle.' must be selected to be edited. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
	else
		{
		echo '<h1>Delete '.$company_name.'</h1><hr>';
		if ($userlevel_no == 5)
			{
			if (isset($_POST['delete']))
				{
				mysql_query("DELETE FROM `co` WHERE co_id='$co_id'");
				//mysql_query("UPDATE co SET supportartseducation_status='1' WHERE user_id ='$del_user'");
				echo '<p>Deleted! You will be redirected to <a href="'.$PHP_SELF.'?view_users">User Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'?view_users>';
				}
				else
				{ ?>
				<form method="post" action="<?php echo $PHP_SELF; ?>?deletecompany=<?php echo $co_id; ?>">	<fieldset><legend>Are you sure you want to delete this user?</legend><br />
						<ul><li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="delete" name="delete">Delete</button></li></ul></fieldset>
						</form>
			<?php	}
			}
		else
			{
			echo '<p>Sorry, you are not permitted to delete companies. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
			}
		}


	}
else
	{
	header("Location: /$site_index");
	exit;
	}





include '../'.$foot; ?>