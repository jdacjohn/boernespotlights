<?php $pagetitle = "Profile"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged(); check_access(1);





//profile
if(isset($_GET['edit']))
	{
	$pagetype = "Edit Company";
	$co_id = $_GET['edit'];
	$result = mysql_query("SELECT * FROM co WHERE co_id='$co_id' AND user_id='$user_id' LIMIT 1");
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
			$co_contact_name = htmlentities(($_POST['co_contact_name']), ENT_QUOTES, 'ISO-8859-1');
			$co_contact_email = htmlentities(($_POST['co_contact_email']), ENT_QUOTES, 'ISO-8859-1');
			$co_contact_phone = htmlentities(($_POST['co_contact_phone']), ENT_QUOTES, 'ISO-8859-1');
			$co_seo_desc = htmlentities(($_POST['co_seo_desc']), ENT_QUOTES, 'ISO-8859-1');
			$co_seo_keywords = htmlentities(($_POST['co_seo_keywords']), ENT_QUOTES, 'ISO-8859-1');
			
			$result = mysql_query("UPDATE co SET co_name='$co_name', co_desc='$co_desc', co_address_1='$co_address_1', co_address_2='$co_address_2', co_city='$co_city', co_state='$co_state', co_zip='$co_zip', co_phone='$co_phone', co_fax='$co_fax', co_email='$co_email', co_url1='$co_url1', co_url2='$co_url2', co_url2_name='$co_url2_name', co_url3='$co_url3', co_url3_name='$co_url3_name', co_gallery='$co_gallery', co_linkedin='$co_linkedin', co_facebook='$co_facebook', co_google='$co_google', co_twitter='$co_twitter', co_youtube='$co_youtube', co_desc='$co_desc', co_contact_name='$co_contact_name', co_contact_email='$co_contact_email', co_contact_phone='$co_contact_phone', co_seo_desc='$co_seo_desc', co_seo_keywords='$co_seo_keywords' WHERE co_id='$co_id' AND user_id='$user_id' ");
			
			$subresult = mysql_query("DELETE FROM co_art_list WHERE co_id='$co_id'");
			for($i=0; $i < count($_POST['co_art_list']);$i++)
				{
				if(!empty($_POST['co_art_list'][$i]))
					{
					$co_art_id = htmlspecialchars($_POST['co_art_list'][$i]);
					$subresult = mysql_query("INSERT INTO co_art_list (co_art_id, co_id) VALUES ('$co_art_id','$co_id')");
					}
				}
			
			$subresult = mysql_query("DELETE FROM co_bus_list WHERE co_id='$co_id'");
			for($i=0; $i < count($_POST['co_bus_list']);$i++)
				{
				if(!empty($_POST['co_bus_list'][$i]))
					{
					$co_bus_id = htmlspecialchars($_POST['co_bus_list'][$i]);
					$subresult = mysql_query("INSERT INTO co_bus_list (co_bus_id, co_id) VALUES ('$co_bus_id','$co_id')");
					}
				}
			
			$subresult = mysql_query("DELETE FROM co_cat_list WHERE co_id='$co_id'");
			for($i=0; $i < count($_POST['co_cat_list']);$i++)
				{
				if(!empty($_POST['co_cat_list'][$i]))
					{
					$co_cat_id = htmlspecialchars($_POST['co_cat_list'][$i]);
					$subresult = mysql_query("INSERT INTO co_cat_list (co_cat_id, co_id) VALUES ('$co_cat_id','$co_id')");
					}
				}
			
			$subresult = mysql_query("DELETE FROM co_com_list WHERE co_id='$co_id'");
			for($i=0; $i < count($_POST['co_com_list']);$i++)
				{
				if(!empty($_POST['co_com_list'][$i]))
					{
					$co_com_id = htmlspecialchars($_POST['co_com_list'][$i]);
					$subresult = mysql_query("INSERT INTO co_com_list (co_com_id, co_id) VALUES ('$co_com_id','$co_id')");
					}
				}
			
			$subresult = mysql_query("DELETE FROM co_dest_list WHERE co_id='$co_id'");
			for($i=0; $i < count($_POST['co_dest_list']);$i++)
				{
				if(!empty($_POST['co_dest_list'][$i]))
					{
					$co_dest_id = htmlspecialchars($_POST['co_dest_list'][$i]);
					$subresult = mysql_query("INSERT INTO co_dest_list (co_dest_id, co_id) VALUES ('$co_dest_id','$co_id')");
					}
				}
			
			
			echo '<h1>'.$pagetitle.'</h1><hr><p>'.$co_name.' was edited successfully! You will be redirected to <a href="/panel/profile">Your Profile</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/profile>';
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
			<ul><li><textarea name="co_desc" rows="10" class="widgEditor"><?php echo $co_desc; ?></textarea></li></ul></fieldset>
			
			<hr>
			
			<fieldset><legend>SEO Description:</legend>
			<ul><li><textarea name="co_seo_desc" rows="7"><?php echo $co_seo_desc; ?></textarea></li></ul></fieldset>
						
			<fieldset><legend>SEO Keywords:</legend>
			<ul><li><textarea name="co_seo_keywords" rows="7"><?php echo $co_seo_keywords; ?></textarea></li></ul></fieldset>
			
			<hr>
			<?php

			$subresult = mysql_query("SELECT co_art_list.co_art_id FROM co_art, co_art_list, co WHERE co.co_id='$co_id' AND co_art_list.co_id=co.co_id AND co_art.co_art_id=co_art_list.co_art_id") or die(mysql_error());
			if(mysql_num_rows($subresult)==0)
				{
				?>
				<fieldset>
					<legend>Art Directory:</legend>
					<ul>
						<li><select name="co_art_list[]"><option value=""></option>
						<?php
						$result = mysql_query("SELECT co_art_id, co_art_name FROM co_art WHERE '$site_id'=site_id ORDER BY co_art_name ASC") or die(mysql_error());
						while($row = mysql_fetch_array($result))
							{
							$sub_co_art_id=$row['co_art_id'];
							$sub_co_art_name=$row['co_art_name'];
							echo '<option value="'.$sub_co_art_id.'">'.$sub_co_art_name.'</option>';
							} 
						?></select></li>
						</ul>
					</fieldset>
				<?php
				}
			else
				{
				while($subrow = mysql_fetch_array($subresult))
					{
					$co_art_id=$subrow['co_art_id'];
					?>
					<fieldset>
						<legend>Art Directory:</legend>
						<ul>
							<li><select name="co_art_id"><option value=""></option>
							<?php
							$result = mysql_query("SELECT co_art_id, co_art_name FROM co_art WHERE '$site_id'=site_id ORDER BY co_art_name ASC") or die(mysql_error());
							while($row = mysql_fetch_array($result))
								{
								$sub_co_art_id=$row['co_art_id'];
								$sub_co_art_name=$row['co_art_name'];
								echo '<option value="'.$sub_co_art_id.'"';
								if($sub_co_art_id==$co_art_id) {echo " selected";} else {}
								echo '>'.$sub_co_art_name.'</option>';
								} 
							?></select></li>
							</ul>
						</fieldset>
					<?php		
					}
				}
				
			$subresult = mysql_query("SELECT co_bus_list.co_bus_id FROM co_bus, co_bus_list, co WHERE co.co_id='$co_id' AND co_bus_list.co_id=co.co_id AND co_bus.co_bus_id=co_bus_list.co_bus_id") or die(mysql_error());
			if(mysql_num_rows($subresult)==0)
				{
				?>
				<fieldset>
					<legend>Business Directory:</legend>
					<ul>
						<li><select name="co_bus_list[]"><option value=""></option>
						<?php
						$result = mysql_query("SELECT co_bus_id, co_bus_name FROM co_bus WHERE '$site_id'=site_id ORDER BY co_bus_name ASC") or die(mysql_error());
						while($row = mysql_fetch_array($result))
							{
							$sub_co_bus_id=$row['co_bus_id'];
							$sub_co_bus_name=$row['co_bus_name'];
							echo '<option value="'.$sub_co_bus_id.'">'.$sub_co_bus_name.'</option>';
							} 
						?></select></li>
						</ul>
					</fieldset>
				<?php
				}
			else
				{
				while($subrow = mysql_fetch_array($subresult))
					{
					$co_bus_id=$subrow['co_bus_id'];
					?>
					<fieldset>
						<legend>Business Directory:</legend>
						<ul>
							<li><select name="co_bus_id"><option value=""></option>
							<?php
							$result = mysql_query("SELECT co_bus_id, co_bus_name FROM co_bus WHERE '$site_id'=site_id ORDER BY co_bus_name ASC") or die(mysql_error());
							while($row = mysql_fetch_array($result))
								{
								$sub_co_bus_id=$row['co_bus_id'];
								$sub_co_bus_name=$row['co_bus_name'];
								echo '<option value="'.$sub_co_bus_id.'"';
								if($sub_co_bus_id==$co_bus_id) {echo " selected";} else {}
								echo '>'.$sub_co_bus_name.'</option>';
								} 
							?></select></li>
							</ul>
						</fieldset>
					<?php		
					}
				}
				
			$subresult = mysql_query("SELECT co_cat_list.co_cat_id FROM co_cat, co_cat_list, co WHERE co.co_id='$co_id' AND co_cat_list.co_id=co.co_id AND co_cat.co_cat_id=co_cat_list.co_cat_id") or die(mysql_error());
			if(mysql_num_rows($subresult)==0)
				{
				?>
				<fieldset>
					<legend>Category Directory:</legend>
					<ul>
						<li><select name="co_cat_list[]"><option value=""></option>
						<?php
						$result = mysql_query("SELECT co_cat_id, co_cat_name FROM co_cat WHERE '$site_id'=site_id ORDER BY co_cat_name ASC") or die(mysql_error());
						while($row = mysql_fetch_array($result))
							{
							$sub_co_cat_id=$row['co_cat_id'];
							$sub_co_cat_name=$row['co_cat_name'];
							echo '<option value="'.$sub_co_cat_id.'">'.$sub_co_cat_name.'</option>';
							} 
						?></select></li>
						</ul>
					</fieldset>
				<?php
				}
			else
				{
				while($subrow = mysql_fetch_array($subresult))
					{
					$co_cat_id=$subrow['co_cat_id'];
					?>
					<fieldset>
						<legend>Category Directory:</legend>
						<ul>
							<li><select name="co_cat_id"><option value=""></option>
							<?php
							$result = mysql_query("SELECT co_cat_id, co_cat_name FROM co_cat WHERE '$site_id'=site_id ORDER BY co_cat_name ASC") or die(mysql_error());
							while($row = mysql_fetch_array($result))
								{
								$sub_co_cat_id=$row['co_cat_id'];
								$sub_co_cat_name=$row['co_cat_name'];
								echo '<option value="'.$sub_co_cat_id.'"';
								if($sub_co_cat_id==$co_cat_id) {echo " selected";} else {}
								echo '>'.$sub_co_cat_name.'</option>';
								} 
							?></select></li>
							</ul>
						</fieldset>
					<?php		
					}
				}
			
			$subresult = mysql_query("SELECT co_com_list.co_com_id FROM co_com, co_com_list, co WHERE co.co_id='$co_id' AND co_com_list.co_id=co.co_id AND co_com.co_com_id=co_com_list.co_com_id") or die(mysql_error());
			if(mysql_num_rows($subresult)==0)
				{
				?>
				<fieldset>
					<legend>Community Directory:</legend>
					<ul>
						<li><select name="co_com_list[]"><option value=""></option>
						<?php
						$result = mysql_query("SELECT co_com_id, co_com_name FROM co_com WHERE '$site_id'=site_id ORDER BY co_com_name ASC") or die(mysql_error());
						while($row = mysql_fetch_array($result))
							{
							$sub_co_com_id=$row['co_com_id'];
							$sub_co_com_name=$row['co_com_name'];
							echo '<option value="'.$sub_co_com_id.'">'.$sub_co_com_name.'</option>';
							} 
						?></select></li>
						</ul>
					</fieldset>
				<?php
				}
			else
				{
				while($subrow = mysql_fetch_array($subresult))
					{
					$co_com_id=$subrow['co_com_id'];
					?>
					<fieldset>
						<legend>Community Directory:</legend>
						<ul>
							<li><select name="co_com_id"><option value=""></option>
							<?php
							$result = mysql_query("SELECT co_com_id, co_com_name FROM co_com WHERE '$site_id'=site_id ORDER BY co_com_name ASC") or die(mysql_error());
							while($row = mysql_fetch_array($result))
								{
								$sub_co_com_id=$row['co_com_id'];
								$sub_co_com_name=$row['co_com_name'];
								echo '<option value="'.$sub_co_com_id.'"';
								if($sub_co_com_id==$co_com_id) {echo " selected";} else {}
								echo '>'.$sub_co_com_name.'</option>';
								} 
							?></select></li>
							</ul>
						</fieldset>
					<?php		
					}
				}
				
			$subresult = mysql_query("SELECT co_dest_list.co_dest_id FROM co_dest, co_dest_list, co WHERE co.co_id='$co_id' AND co_dest_list.co_id=co.co_id AND co_dest.co_dest_id=co_dest_list.co_dest_id") or die(mysql_error());
			if(mysql_num_rows($subresult)==0)
				{
				?>
				<fieldset>
					<legend>Destination Directory:</legend>
					<ul>
						<li><select name="co_dest_list[]"><option value=""></option>
						<?php
						$result = mysql_query("SELECT co_dest_id, co_dest_name FROM co_dest WHERE '$site_id'=site_id ORDER BY co_dest_name ASC") or die(mysql_error());
						while($row = mysql_fetch_array($result))
							{
							$sub_co_dest_id=$row['co_dest_id'];
							$sub_co_dest_name=$row['co_dest_name'];
							echo '<option value="'.$sub_co_dest_id.'">'.$sub_co_dest_name.'</option>';
							} 
						?></select></li>
						</ul>
					</fieldset>
				<?php
				}
			else
				{
				while($subrow = mysql_fetch_array($subresult))
					{
					$co_dest_id=$subrow['co_dest_id'];
					?>
					<fieldset>
						<legend>Destination Directory:</legend>
						<ul>
							<li><select name="co_dest_id"><option value=""></option>
							<?php
							$result = mysql_query("SELECT co_dest_id, co_dest_name FROM co_dest WHERE '$site_id'=site_id ORDER BY co_dest_name ASC") or die(mysql_error());
							while($row = mysql_fetch_array($result))
								{
								$sub_co_dest_id=$row['co_dest_id'];
								$sub_co_dest_name=$row['co_dest_name'];
								echo '<option value="'.$sub_co_dest_id.'"';
								if($sub_co_dest_id==$co_dest_id) {echo " selected";} else {}
								echo '>'.$sub_co_dest_name.'</option>';
								} 
							?></select></li>
							</ul>
						</fieldset>
					<?php		
					}
				}
			?>	
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
		$result = mysql_query("SELECT * FROM card WHERE card_id='$del_card' AND user_id='$user_id' LIMIT 1");
		$row = mysql_fetch_assoc($result);
		$card_front = $row["card_front"];
		$card_user_id = $row["user_id"];
		if(!empty($card_front))
			{
			$path= '../assets/img/spotlights/'.$card_front.''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			$path2= '../assets/img/spotlights/new-'.$card_front.''; if(@unlink($path2)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
			} else {}
		$subresult1 = $subresult3 = mysql_query("UPDATE card SET card_front='', card_approve='del' WHERE card_id='$del_card'");
		echo '<p>Deleted! You will be redirected to <a href="/panel/profile">Your Profile</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/profile>';
		}
	}


elseif(isset($_GET['add_spot']))
	{
	$pagetype = "Add Spotlight";
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
			$subresult4 = mysql_query("SELECT card_id, co_id FROM card WHERE '$user_id'=user_id ORDER BY card_id DESC LIMIT 1") or die(mysql_error());
			while($subrow4 = mysql_fetch_array($subresult4))
				{
				$card_id = $subrow4['card_id'];
				$co_id = $subrow4['co_id'];
				
				$card_front = strtolower($user_id."-".date("mdy")."-".strtolower(str_replace(' ', '', $_FILES["card_front"]["name"])));
				$card_front_target = "../assets/img/spotlights/".$card_front;
				move_uploaded_file($_FILES["card_front"]["tmp_name"],$card_front_target);
				
				$resizeObj = new resize('../assets/img/spotlights/'.$card_front); // *** 1) Initialise / load image
				$resizeObj -> resizeImage(445, 445, 'auto'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> saveImage('../assets/img/spotlights/new-'.$card_front, 100); // *** 3) Save image
				$resizeObj2 = new resize('../assets/img/spotlights/'.$card_front); // *** 1) Initialise / load image
				$resizeObj2 -> resizeImage(270, 270, 'auto'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj2 -> saveImage('../assets/img/spotlights/tn-'.$card_front, 100); // *** 3) Save image
				
				$subresult3 = mysql_query("UPDATE card SET card_front='$card_front', card_approve='0' WHERE card_id='$card_id'");
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
				echo ' <p>Card was added successfully! You will be redirected to <a href="/panel/profile">Your Profile</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/profile>';
				}
			}
		else
			{
			echo '<h1>'.$pagetype.'</h1><hr><p>ONLY images under 1MB are accepted for upload. Please try again. You will be redirected to <a href="/panel/profile">Your Profile</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/profile>';
			}
		
		}
	else
		{
		?>
		<form method="post" action="<?php echo $PHP_SELF; ?>?add_spot" enctype="multipart/form-data"><input type="hidden" name="user_id" value="<? echo $_SESSION['user_id'];?>">
		
		<fieldset><legend>Card Front:</legend>
		<ul><li><input name="card_front" type="file" /></li></ul></fieldset>		
		
		<fieldset>
		<ul><li><button type="submit" name="submit">Save</button></li></ul>
		</fieldset>
		
		</form>
<?php	}
	}



else
	{
	$query = "SELECT * FROM co, co_site_list WHERE co_site_list.site_id='$site_id' AND co_site_list.co_id=co.co_id AND co.user_id='$user_id' ORDER BY co.co_id DESC";
	$result = mysql_query($query) or die(mysql_error());
	if(mysql_num_rows($result)==0)
		{
		$pagetitle = '';
		$result = mysql_query("SELECT page_pass FROM page WHERE page_url='home' AND '$site_id'=site_id");
		while($row = mysql_fetch_assoc($result))
			{
			$page_pass=$row['page_pass'];
			if($page_pass == '1'){check_logged();}
			}
		echo '<h1>Sorry</h1><hr>';
		echo '<p>This business does not exist.</p>';
		}
	else
		{
		while($row = mysql_fetch_array($result))
			{
			$co_id = $row['co_id'];
			$co_name = $row['co_name'];
			$co_phone = $row['co_phone'];
			$co_fax = $row['co_fax'];
			$co_address_1 = $row['co_address_1'];
			$co_address_2 = $row['co_address_2'];
			$co_city = $row['co_city'];
			$co_state = $row['co_state'];
			$co_zip = $row['co_zip'];
			$co_email = $row['co_email'];
			$co_url1 = $row['co_url1'];
			$co_url2 = $row['co_url2'];
			$co_url2_name = $row['co_url2_name'];
			$co_url3 = $row['co_url3'];
			$co_url3_name = $row['co_url3_name'];
			$co_gallery = $row['co_gallery'];
			$co_linkedin = $row['co_linkedin'];
			$co_facebook = $row['co_facebook'];
			$co_google = $row['co_google'];
			$co_twitter = $row['co_twitter'];
			$co_youtube = $row['co_youtube'];
			$co_desc = strip_tags(html_entity_decode($row['co_desc'], ENT_QUOTES, 'utf-8'),$allowed_html);
			$seo_desc = $row['co_seo_desc'];
			$seo_keywords = $row['co_seo_keywords'];
			$pagetitle = $co_name;				
			$subquery = "SELECT card_video FROM card WHERE '$short'=co_id AND card_video!='' AND card_approve='1' ORDER BY card_id DESC LIMIT 1";
			$subresult = mysql_query($subquery);
			if(mysql_num_rows($subresult)==0)
				{
				$facebookOg = '';
				}
			else
				{
				while($subrow = mysql_fetch_array($subresult))
					{
					$card_video=strip_tags(html_entity_decode($subrow['card_video'], ENT_QUOTES, 'utf-8'),$allowed_html);
					$video_id = my_strip('@videoPlayer" value="','" />',$card_video);
					$player_id = my_strip('playerID" value="','" />',$card_video);
					$video = $bc->find('find_video_by_id', $video_id);
					$facebookOg = '
					<meta property="og:description" content="'.$video->longDescription.'"/>
					<meta property="og:type" content="movie"/>
					<meta property="og:video:height" content="270"/>
					<meta property="og:video:width" content="480"/>
					<meta property="og:url" content="http://'.$site_url.'/company/'.$short.'"/>
					<meta property="og:video" content="http://c.brightcove.com/services/viewer/federated_f9/?isVid=1&isUI=1&playerID='.$player_id.'&autoStart=true&videoId='.$video_id.'">
					<meta property="og:video:secure_url" content="https://secure.brightcove.com/services/viewer/federated_f9/?isVid=1&isUI=1&playerID='.$player_id.'&autoStart=true&videoId='.$video_id.'&secureConnections=true">
					<meta property="og:image" content="'.$video->thumbnailURL.'"/>
					<meta property="og:video:type" content="application/x-shockwave-flash">
					<meta property="og:video" content="'.$video->FLVURL.'">
					<meta property="og:video:type" content="video/mp4"/>
					';
					}
				}
			include $head;
			check_logged();
			echo '<div class="page">';
			echo '<a href="?edit='.$co_id.'" class="edit">Edit this Page</a>';
			echo '</div>';
			echo '<h1>'.$pagetitle.'</h1><hr>';
			$subquery = "SELECT * FROM card WHERE '$co_id'=co_id AND city_code = '1' ORDER BY card_id ASC";
			$subresult = mysql_query($subquery) or die(mysql_error()); $card_id = '';
			if(mysql_num_rows($subresult)==0)
				{
				}
			elseif(mysql_num_rows($subresult)==1)
				{
				while($subrow = mysql_fetch_array($subresult))
					{
					$card_id=$subrow['card_id'];
					$card_front=$subrow['card_front'];
					$card_approve=$subrow['card_approve'];
					$card_video=strip_tags(html_entity_decode($subrow['card_video'], ENT_QUOTES, 'utf-8'),$allowed_html);
					echo '<div class="listing"><div>';
					if(!empty($card_front))
						{
						echo '<img src="/assets/img/spotlights/new-'.$card_front.'"><p><a href="/panel/profile/?del_card='.$card_id.'">Delete Image</a></p>';
						}
					if(!empty($card_video))
						{
						echo str_replace('class="BrightcoveExperience"', 'class="BrightcoveExperience"><param name="wmode" value="opaque"><param name="linkBaseURL" value="http://'.$site_url.'/company/'.$short.'"', $card_video);
						}
					if($card_approve=="del")
						{
						echo '<p><a href="/panel/profile/?add_spot='.$card_id.'">Add BizCardSpotlight&trade; Image</a></p>';
						}
					echo '</div></div>';
					}
				echo '<hr>';
				}
			else
				{
				while($subrow = mysql_fetch_array($subresult))
					{
					$card_id=$subrow['card_id']; $card_front=$subrow['card_front']; $card_video=strip_tags(html_entity_decode($subrow['card_video'], ENT_QUOTES, 'utf-8'),$allowed_html);
					
						
					echo '<div class="listing" id="l"><div>';
					if(!empty($card_front))
						{
						echo '<img src="/assets/img/spotlights/new-'.$card_front.'">';
						}
					if(!empty($card_video))
						{
						echo str_replace('class="BrightcoveExperience"', 'class="BrightcoveExperience"><param name="wmode" value="opaque"><param name="linkBaseURL" value="http://'.$site_url.'/company/'.$short.'"', $card_video);
						}
					else
						{
						}
					echo '</div></div>';
					}
				echo '<div class="clear">&nbsp;</div><hr>';
				}
			if(empty($co_desc)) {echo '';} else { echo '<p>'.$co_desc.'</p>'; }					
			echo '<div id="card"><div id="left">';	
			if(empty($co_phone)) {echo '';} else { echo '<p><strong>Phone:</strong> '.$co_phone.'</p>'; }
			if(empty($co_fax)) {echo '';} else { echo '<p><strong>Fax:</strong> '.$co_fax.'</p>'; }				
			if(empty($co_email)) {echo '';} else { echo '<p><strong>Email:</strong> <a href="mailto:'.$co_email.'">'.$co_email.'</a></p>'; }
			if(empty($co_address_1) && empty($co_address_2) && empty($co_city) && empty($co_state) && empty($co_zip))
				{
				}
			else
				{
				if(!empty($co_address_1) OR !empty($co_address_2) OR !empty($co_city) OR !empty($co_state) OR !empty($co_zip))
					{
					echo '<p><strong>Address:</strong><br/>';
					if(empty($co_address_1)) {echo '';} else { echo $co_address_1.'</br/>'; }
					if(empty($co_address_2)) {echo '';} else { echo $co_address_2.'</br/>'; }
					if(empty($co_city)) {echo '';} else { echo $co_city; }
					if(!empty($co_state))
						{
						$subresult = mysql_query("SELECT state_name FROM state WHERE $co_state=state_id") or die(mysql_error());
						while($subrow = mysql_fetch_array($subresult))
							{
							$state_name = $subrow['state_name'];
							echo ', '.$state_name;
							}
						}
					if(empty($co_zip)) {echo '';} else { echo ' '.$co_zip; }
					echo '</p>';
					
					echo '<p><a href="http://maps.google.com/maps?q=';
					if(!empty($co_address_1)){ echo $co_address_1.' '; }
					if(!empty($co_address_2)){ echo $co_address_2.' '; }
					if(!empty($co_city)) { echo $co_city.','; }
					if(!empty($co_state))
						{
						$subresult = mysql_query("SELECT state_name FROM state WHERE $co_state=state_id") or die(mysql_error());
						while($subrow = mysql_fetch_array($subresult))
							{
							$state_name = $subrow['state_name'];
							echo $state_name.' ';
							}
						}
					if(!empty($co_zip)){ echo $co_zip; }
					echo '" target="_blank">';
					echo '
					<img alt="Googlemap" src="http://maps.google.com/maps/api/staticmap?center=';
					if(!empty($co_address_1)){ echo $co_address_1.' '; }
					if(!empty($co_address_2)){ echo $co_address_2.' '; }
					if(!empty($co_city)) { echo $co_city.','; }
					if(!empty($co_state))
						{
						$subresult = mysql_query("SELECT state_name FROM state WHERE $co_state=state_id") or die(mysql_error());
						while($subrow = mysql_fetch_array($subresult))
							{
							$state_name = $subrow['state_name'];
							echo $state_name.' ';
							}
						}
					if(!empty($co_zip)){ echo $co_zip; }
					echo '&markers=small|';
					if(!empty($co_address_1)){ echo $co_address_1.' '; }
					if(!empty($co_address_2)){ echo $co_address_2.' '; }
					if(!empty($co_city)) { echo $co_city.','; }
					if(!empty($co_state))
						{
						$subresult = mysql_query("SELECT state_name FROM state WHERE $co_state=state_id") or die(mysql_error());
						while($subrow = mysql_fetch_array($subresult))
							{
							$state_name = $subrow['state_name'];
							echo $state_name.' ';
							}
						}
					if(!empty($co_zip)){ echo $co_zip; }
					echo '&zoom=14'
					.'&size=375x200'
					.'&sensor=false"/></a>';
					echo '<br><a href="http://maps.google.com/maps?q=';
					if(!empty($co_address_1)){ echo $co_address_1.' '; }
					if(!empty($co_address_2)){ echo $co_address_2.' '; }
					if(!empty($co_city)) { echo $co_city.','; }
					if(!empty($co_state))
						{
						$subresult = mysql_query("SELECT state_name FROM state WHERE $co_state=state_id") or die(mysql_error());
						while($subrow = mysql_fetch_array($subresult))
							{
							$state_name = $subrow['state_name'];
							echo $state_name.' ';
							}
						}
					if(!empty($co_zip)){ echo $co_zip; }
					echo '" target="_blank">View Larger Map</a></p>';
					}
				}
			echo '</div><div id="right">';		
			if(empty($co_url1)) {echo '';} else { echo '<p><strong>Website:</strong> <a href="http://'.remove_http($co_url1).'" target="_blank">'.remove_http($co_url1).'</a></p>'; }
			if(empty($co_url2) OR empty($co_url2_name)) {echo '';} else { echo '<p><strong>'.$co_url2_name.':</strong> <a href="http://'.remove_http($co_url2).'" target="_blank">'.remove_http($co_url2).'</a></p>'; }
			if(empty($co_url2) OR empty($co_url3_name)) {echo '';} else { echo '<p><strong>'.$co_url3_name.':</strong> <a href="http://'.remove_http($co_url3).'" target="_blank">'.remove_http($co_url3).'</a></p>'; }
			if(empty($co_gallery)) {echo '';} else { echo '<p><strong>Photo Gallery:</strong> <a href="http://'.remove_http($co_gallery).'" target="_blank">'.remove_http($co_gallery).'</a></p>'; }
			if(empty($co_linkedin)) {echo '';} else { echo '<p><strong>Linked In:</strong> <a href="http://'.remove_http($co_linkedin).'" target="_blank">'.remove_http($co_linkedin).'</a></p>'; }
			if(empty($co_facebook)) {echo '';} else { 
			echo '<p><strong>Facebook:</strong>';
			echo ' <a href="http://'.remove_http($co_facebook).'" target="_blank">'.remove_http($co_facebook).'</a><br>';
			echo ' <div style="float:left;" class="fb-like" data-href="'.remove_http($co_facebook).'" data-send="true" data-width="450" data-show-faces="true" data-font="arial"></div><br></p>';}
			if(empty($co_google)) {echo '';} else { echo '<p><strong>Google+:</strong> <a href="http://'.remove_http($co_google).'" target="_blank">'.remove_http($co_google).'</a></p>'; }
			if(empty($co_twitter)) {echo '';} else { echo '<p><strong>Twitter:</strong> <a href="http://'.remove_http($co_twitter).'" target="_blank">'.remove_http($co_twitter).'</a><br><a href="http://'.remove_http($co_twitter).'" target="_blank"><img src="../../assets/img/twitter.jpg"></a></p>'; }
			if(empty($co_youtube)) {echo '';} else { echo '<p><strong>YouTube:</strong> <a href="http://'.remove_http($co_youtube).'" target="_blank">'.remove_http($co_youtube).'</a></p>'; }
			echo '</div><div class="clear">&nbsp;</div></div>';
			}
		}
	}





include '../'.$foot; ?>