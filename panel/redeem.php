<?php $pagetitle = "Redeem Your Spotlight"; include '../core/base.php'; include '../'.$head; check_logged();





echo '<h1>'.$pagetitle.'</h1><hr>';
if($user_credit!='' AND $user_credit_site_id==$site_id)
	{
	echo '<h2>Step 1</h2><hr>';
	if($user_credit=='card1' OR $user_credit=='video1' OR $user_credit=='video2' OR $user_credit=='sponsor1' OR $user_credit=='sponsor2' OR $user_credit=='sponsor3')
		{
		if(isset($_GET['use_co']))
			{
			$co_id = $_GET['use_co'];
			if($user_credit=='card1')
				{
				$subresult = mysql_query("UPDATE user SET user_credit='card1-2' WHERE $user_id=user_id");
				}
			elseif($user_credit=='video1')
				{
				$subresult = mysql_query("UPDATE user SET user_credit='video1-2' WHERE $user_id=user_id");
				}
			elseif($user_credit=='video2')
				{
				$subresult = mysql_query("UPDATE user SET user_credit='video1-2' WHERE $user_id=user_id");
				}
			elseif($user_credit=='sponsor1')
				{
				$subresult = mysql_query("UPDATE user SET user_credit='sponsor1-2' WHERE $user_id=user_id");
				}
			elseif($user_credit=='sponsor2')
				{
				$subresult = mysql_query("UPDATE user SET user_credit='sponsor2-2' WHERE $user_id=user_id");
				}
			elseif($user_credit=='sponsor3')
				{
				$subresult = mysql_query("UPDATE user SET user_credit='sponsor3-2' WHERE $user_id=user_id");
				}
			else {}
			
			
			$result = mysql_query("SELECT co.co_id, co.co_name FROM co, co_site_list WHERE '$user_id'=co.user_id AND co_site_list.co_id=co.co_id AND '$site_id'=co_site_list.site_id ORDER BY co_name ASC") or die(mysql_error());
			if(mysql_num_rows($result)==0)
				{
				echo '<h3><a href="'.$PHP_SELF.'?add_co">Make a New Business Profile</a></h3>';
				}
			elseif(mysql_num_rows($result)==1)
				{
				echo '<h3>Would you like to use your spotlight for your current company or a new business profile?</h3><h3><a href="'.$PHP_SELF.'?add_co">Make a New Business Profile</a>';
				while($row = mysql_fetch_assoc($result))
					{
					$co_id=$row['co_id'];
					$co_name=$row['co_name'];
					echo ' &middot; <a href="'.$PHP_SELF.'?use_co='.$co_id.'">'.$co_name.'</a>';
					}
				echo '</h3>';
				}
			$subresult1 = mysql_query("SELECT co_id FROM co_site_list WHERE co_id='$co_id'") or die(mysql_error());
			while($subrow1 = mysql_fetch_array($subresult1))
				{
				$result_co_id = $subrow1["co_id"];
				if($result_co_id!=$co_id)
					{
					mysql_query("INSERT INTO co_site_list (co_id, site_id) VALUES ('$co_id','$site_id')");
					}
				}
			$subresult2 = mysql_query("INSERT INTO card (card_approve, co_id, site_id, user_id, city_code) VALUES ('-','$co_id','$site_id','$user_id','1')");
			echo '<meta http-equiv=Refresh content=0;url=/panel/redeem>';
			}
		elseif(isset($_GET['add_co']))
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
				$result = mysql_query("INSERT INTO co (co_name, co_address_1, co_address_2, co_city, co_state, co_zip, co_phone, co_fax, co_email, co_url1, co_url2_name, co_url2, co_url3_name, co_url3, co_gallery, co_linkedin, co_facebook, co_google, co_twitter, co_youtube, co_desc, co_contact_name, co_contact_email, co_contact_phone, user_id) VALUES ('$co_name','$co_address_1','$co_address_2','$co_city','$co_state','$co_zip','$co_phone','$co_fax','$co_email','$co_url1','$co_url2_name','$co_url2','$co_url3_name','$co_url3','$co_gallery','$co_linkedin','$co_facebook','$co_google','$co_twitter','$co_youtube','$co_desc','$co_contact_name','$co_contact_email','$co_contact_phone','$user_id')") or die(mysql_error());
				
				$subresult1 = mysql_query("SELECT co_id FROM co WHERE $user_id=user_id ORDER BY co_id DESC LIMIT 1") or die(mysql_error());
				while($subrow1 = mysql_fetch_array($subresult1))
					{
					$co_id = $subrow1["co_id"];
					$subresult2 = mysql_query("INSERT INTO co_site_list (co_id, site_id) VALUES ('$co_id','$site_id')");
					$subresult3 = mysql_query("INSERT INTO card (card_approve, co_id, site_id, user_id, city_code) VALUES ('-','$co_id','$site_id','$user_id','1')");
					}	
				if($user_credit=='card1')
					{
					$subresult = mysql_query("UPDATE user SET user_credit='card1-2' WHERE $user_id=user_id");
					}
				elseif($user_credit=='video1')
					{
					$subresult = mysql_query("UPDATE user SET user_credit='video1-2' WHERE $user_id=user_id");
					}
				elseif($user_credit=='video2')
					{
					$subresult = mysql_query("UPDATE user SET user_credit='video2-2' WHERE $user_id=user_id");
					}
				elseif($user_credit=='sponsor1')
					{
					$subresult = mysql_query("UPDATE user SET user_credit='sponsor1-2' WHERE $user_id=user_id");
					}
				elseif($user_credit=='sponsor2')
					{
					$subresult = mysql_query("UPDATE user SET user_credit='sponsor2-2' WHERE $user_id=user_id");
					}
				elseif($user_credit=='sponsor3')
					{
					$subresult = mysql_query("UPDATE user SET user_credit='sponsor3-2' WHERE $user_id=user_id");
					}
				else {}
				
				echo '<p>'.$co_name.' was added successfully! You will be redirected to <a href="/panel/redeem">Redeem Your Spotlight</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/redeem>';
				}
			else
				{ ?>
				<form method="post" action="<?php echo $PHP_SELF; ?>?add_co" enctype="multipart/form-data">
				
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
				<ul><li><textarea name="co_desc" rows="10" class="widgEditor"><?= @$_POST['co_desc']?></textarea></li></ul></fieldset>
				
				<hr>
				
				<fieldset><legend>Primary Contact's Name:</legend>
				<ul><li><input name="co_contact_name" type="text" value="<?php
				if(!empty($user_name_f))
					{
					echo $user_name_f;
					} else {}
				if(!empty($user_name_l))
					{
					echo ' '.$user_name_l;
					} else {}
				 ?>"></li></ul></fieldset>
				
				<fieldset><legend>Primary Contact's Email:</legend>
				<ul><li><input name="co_contact_email" type="text" value="<?php echo $user_email; ?>"></li></ul></fieldset>
				
				<fieldset><legend>Primary Contact's Phone:</legend>
				<ul><li><input name="co_contact_phone" type="text" value="<?= @$_POST['co_contact_phone']?>"></li>
				<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
				
				</form>
		<?php
				}
			}
		else
			{
			$result = mysql_query("SELECT co.co_id, co.co_name FROM co, co_site_list WHERE '$user_id'=co.user_id AND co_site_list.co_id=co.co_id AND '$site_id'=co_site_list.site_id ORDER BY co_name ASC") or die(mysql_error());
			if(mysql_num_rows($result)==0)
				{
				echo '<h3><a href="'.$PHP_SELF.'?add_co">Make a New Business Profile</a></h3>';
				}
			elseif(mysql_num_rows($result)==1)
				{
				echo '<h3>Would you like to use your spotlight for your current company or a new business profile?</h3><h3><a href="'.$PHP_SELF.'?add_co">Make a New Business Profile</a>';
				while($row = mysql_fetch_assoc($result))
					{
					$co_id=$row['co_id'];
					$co_name=$row['co_name'];
					echo ' &middot; <a href="'.$PHP_SELF.'?use_co='.$co_id.'">'.$co_name.'</a>';
					}
				echo '</h3>';
				}
			else
				{
				echo '<h3>Would you like to use your spotlight for one of your current companies or a new business profile?</h3><h3><a href="'.$PHP_SELF.'?add_co">Make a New Business Profile</a>';
				while($row = mysql_fetch_assoc($result))
					{
					$co_id=$row['co_id'];
					$co_name=$row['co_name'];
					echo ' &middot; <a href="'.$PHP_SELF.'?use_co='.$co_id.'">'.$co_name.'</a>';
					}
				echo '</h3>';
				}
			}
		}
	else
		{
		echo ' <p>Complete!</p><hr><h2>Step 2</h2>';
		if($user_credit=='video1-2' OR $user_credit=='video2-2')
			{
			if(isset($_GET['schedule']))
				{
				$pagetype = "Schedule Video Spotlight Recording";
				if (isset($_POST) && !empty($_POST['co_contact_name']) && !empty($_POST['co_contact_phone']) && (filter_var($_POST['co_contact_email'], FILTER_VALIDATE_EMAIL)))
					{
					$subresult2 = mysql_query("SELECT card_id, co_id FROM card WHERE $user_id=user_id ORDER BY card_id DESC LIMIT 1") or die(mysql_error());
					while($subrow = mysql_fetch_array($subresult2))
						{
						$co_id = $subrow['co_id'];
						$card_id = $subrow['card_id'];
						$co_contact_name = htmlentities(($_POST['co_contact_name']), ENT_QUOTES, 'ISO-8859-1');
						$co_contact_email = htmlentities(($_POST['co_contact_email']), ENT_QUOTES, 'ISO-8859-1');
						$co_contact_phone = htmlentities(($_POST['co_contact_phone']), ENT_QUOTES, 'ISO-8859-1');
						$subresult3 = mysql_query("UPDATE co SET co_contact_name='$co_contact_name', co_contact_email='$co_contact_email', co_contact_phone='$co_contact_phone' WHERE $user_id=user_id AND $co_id=co_id");
						$subresult4 = mysql_query("UPDATE card SET card_approve='0b' WHERE card_id='$card_id'");
						if($user_credit=='video1-2')
							{
							$subresult = mysql_query("UPDATE user SET user_credit='video1-3' WHERE $user_id=user_id");
							}
						elseif($user_credit=='video2-2')
							{
							$subresult = mysql_query("UPDATE user SET user_credit='video2-3' WHERE $user_id=user_id");
							}
						else {}
						}
					//mail to admin
						//subject and recipient
						$subject = $site_name.' - Video Log';
						$recipient = $site_contact;
						$headers ="From: ${_POST['new_user_email']}" . "\r\n";
						
						//mail server stuff
						$headers .= 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";	
						$message = '<html><head><title>'.$site_name.' - Video Log</title></head>';
						$message .= '<body>';
						
						//email body
						$message .= "<p>There is a new item in the video log.</p>
						</body></html>";
			
						//mail send function
						@$send=mail($recipient,$subject,$message,$headers);
					//end mail to admin
					echo ' <p>Request sent successfully! You will be redirected to <a href="/panel/redeem">Redeem Your Spotlight</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/redeem>';
					}
				else
					{
					
					$result = mysql_query("SELECT co_contact_name, co_contact_email, co_contact_phone FROM co WHERE $user_id=user_id ORDER BY co_id DESC LIMIT 1") or die(mysql_error());
					while($row = mysql_fetch_array($result))
						{
						$co_contact_name = $row['co_contact_name'];
						$co_contact_email = $row['co_contact_email'];
						$co_contact_phone = $row['co_contact_phone'];
					?>
					<h3>Please confirm your contact information is correct. After you have confirmed this, we will contact you to set up your VideoSpotlight&trade; Shoot.</h3>
					<hr>
					<form method="post" action="<?php echo $PHP_SELF; ?>?schedule" enctype="multipart/form-data"><input type="hidden" name="user_id" value="<? echo $_SESSION['user_id'];?>">
					
					<fieldset><legend>*Primary Contact's Name:</legend>
					<ul><li><input name="co_contact_name" type="text" value="<?php echo $co_contact_name; ?>"></li></ul></fieldset>
					
					<fieldset><legend>*Primary Contact's Email:</legend>
					<ul><li><input name="co_contact_email" type="text" value="<?php echo $co_contact_email; ?>"></li></ul></fieldset>
					
					<fieldset><legend>*Primary Contact's Phone:</legend>
					<ul><li><input name="co_contact_phone" type="text" value="<?php echo $co_contact_phone; ?>"></li></ul></fieldset>	
					
					<fieldset>
					<ul><li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul>
					</fieldset>
					
					</form>
			<?php		}
					}
				}
			else
				{
				header("Location: /panel/redeem/?schedule");
				}
			}
		if($user_credit=='card1-2' OR $user_credit=='sponsor1-2' OR $user_credit=='sponsor2-2' OR $user_credit=='sponsor3-2')
			{
			if(isset($_GET['add_spot']))
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
					else
						{
						echo '<h1>'.$pagetype.'</h1><hr><p>ONLY images under 1MB are accepted for upload. Please try again. You will be redirected to <a href="/panel/redeem">Redeem Your Spotlight</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/redeem>';
						}
					
					}
				else
					{
					?>
					<form method="post" action="<?php echo $PHP_SELF; ?>?add_spot" enctype="multipart/form-data"><input type="hidden" name="user_id" value="<? echo $_SESSION['user_id'];?>">
					
					<fieldset><legend>Card Front:</legend>
					<ul><li><input name="card_front" type="file" /></li></ul></fieldset>		
					
					<fieldset>
					<ul><li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul>
					</fieldset>
					
					</form>
			<?php	}
				}
			else
				{
				header("Location: /panel/redeem/?add_spot");
				}
		}
		else
			{
			if($user_credit=='video1-3' OR $user_credit=='video2-3')
				{
				echo ' <p>Complete!</p><hr><h2>Step 3</h2>';
				echo ' <p>Your spotlight is currently being scheduled or reviewed. Thank you for your patience.</p>';
				}
			elseif($user_credit=='card1-3' OR $user_credit=='sponsor1-3' OR $user_credit=='sponsor2-3' OR $user_credit=='sponsor3-3')
				{
				$subresult = mysql_query("SELECT * FROM card WHERE $user_id=user_id ORDER BY card_id DESC LIMIT 1") or die(mysql_error());
				while($subrow = mysql_fetch_array($subresult))
					{
					$card_id = $subrow['card_id'];
					$card_front = $subrow['card_front'];
					echo '<img src="/assets/img/spotlights/'.$card_front.'">';
					}
				echo ' <p>Complete!</p><hr><h2>Step 3</h2>';
				echo ' <p>Your spotlight is currently being reviewed. Thank you for your patience.</p>';
				}
			else
				{
				}
			}
		}
	}
else
	{
	if($user_credit_site_id!=$site_id && $user_credit_site_id!='')
		{
		
		$result = mysql_query("SELECT site_name, site_url FROM site WHERE site_id='$user_credit_site_id'") or die(mysql_error());
		while($row = mysql_fetch_array($result))
			{ $site_name=$row['site_name']; $site_url=$row['site_url'];
				echo '<p>Sorry, you must redeem your Spotlight at <a href="http://'.$site_url.'" target="_blank">'.$site_name.'</a>. Please <a href="/pages/contact">Contact Us</a> if you need any assistance.</p>';					
			}
		}
	else
		{
		echo '<p>Sorry, at this time you do not have a spotlight to redeem. Please <a href="/pages/contact">Contact Us</a> if you need any assistance.</p>';
		}
	}





include '../'.$foot; ?>