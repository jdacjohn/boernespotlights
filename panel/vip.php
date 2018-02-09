<?php $pagetitle = "Control Panel"; include '../core/base.php';




		
if(isset($_GET['add']))
	{
	$pagetitle = 'Add VIP';
	include '../'.$head; check_logged(); check_access(5);
	if (isset($_POST) && !empty($_POST['vip_name']) && !empty($_POST['vip_url']) && ($_POST['vip_url']!='home')  && ($_POST['vip_url']!='contact')  && ($_POST['vip_url']!='directory')  && ($_POST['vip_url']!='featured')  && ($_POST['vip_url']!='register')  && ($_POST['vip_url']!='search')  && ($_POST['vip_url']!='sponsors'))
		{
		$vip_name = htmlentities(($_POST['vip_name']), ENT_QUOTES, 'utf-8');
		$vip_headline = htmlentities(($_POST['vip_headline']), ENT_QUOTES, 'utf-8');
		$vip_url_base = strtolower(htmlentities(($_POST['vip_url']), ENT_QUOTES, 'utf-8'));
		$vip_url = preg_replace("/[^a-zA-Z0-9]/", "", $vip_url_base);
		$vip_seo_desc = htmlentities(($_POST['vip_seo_desc']), ENT_QUOTES, 'utf-8');
		$vip_seo_keywords = htmlentities(($_POST['vip_seo_keywords']), ENT_QUOTES, 'utf-8');
		$vip_full = htmlentities(($_POST['vip_full']), ENT_QUOTES, 'utf-8');
		$vip_video = htmlentities(($_POST['vip_video']), ENT_QUOTES, 'utf-8');
		$vip_active = htmlentities(($_POST['vip_active']), ENT_QUOTES, 'utf-8');
		$getcount = mysql_query("SELECT * FROM vip WHERE '$site_id'=site_id", $link);
		$numrows = mysql_num_rows($getcount);
		$vip_order = $numrows + 1;
		$vip_type = 'vip';
		$result = mysql_query("INSERT INTO vip (vip_name, vip_headline, vip_url, vip_seo_desc, vip_seo_keywords, vip_full, vip_video, vip_active, vip_date, vip_order, vip_type, site_id, user_id) VALUES ('$vip_name','$vip_headline','$vip_url','$vip_seo_desc','$vip_seo_keywords','$vip_full','$vip_video','$vip_active',NOW(),'$vip_order','$vip_type','$site_id','$user_id')");
		echo '<h1>'.$pagetitle.'</h1><hr><p>'.$vip_name.' was successfully added! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/site>';
		}
	else
		{
	?>
	<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>
	<h1>Add VIP Entry</h1><hr>
	<form method="post" action="?add" class="vip">
	<fieldset>
	    <legend>VIP Navigation Name:</legend>
	    <ul><li><input name="vip_name" value="<?= @$_POST['vip_name']?>" type="text" maxlength="15"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>VIP Headline:</legend>
	    <ul><li><input name="vip_headline" value="<?= @$_POST['vip_headline']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>VIP URL:</legend>
	    <ul><li><input name="vip_url" value="<?= @$_POST['vip_url']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
		<legend>VIP Description:</legend>
		<ul><li><textarea name="vip_seo_desc" rows="7"><?= @$_POST['vip_seo_desc']?></textarea></li></ul>
	</fieldset>	
	<fieldset>
		<legend>VIP Keywords:</legend>
		<ul><li><textarea name="vip_seo_keywords" rows="7"><?= @$_POST['vip_seo_keywords']?></textarea></li></ul></fieldset>
	<fieldset>
	<fieldset>
	    <legend>Video:</legend>
	    <ul><li><textarea name="vip_video" rows="25"><?= @$_POST['vip_video']?></textarea></li></ul>
	</fieldset>
	<fieldset>
		<legend>Entry:</legend>
		<ul><li><textarea name="vip_full" rows="25" class="widgEditor"><?= @$_POST['vip_full']?></textarea></li></ul>
	</fieldset>
	<fieldset>
		<legend>On/Off:</legend>
		<ul>			
		<li><select name="vip_active">
		<option value="1">On</option>
		<option value="0">Off</option>
		</select></li>
		<li><button type="submit" value="Send" name="submit">Save</button></li>
		</ul>
	</fieldset>
	</form>
<?php
		}
	}


elseif(isset($_GET['del']))
	{
	$del = $_GET['del'];
	include '../'.$head; check_logged(); check_access(5);
	if (empty($_GET['del']))
		{ echo '<h1>Error</h1><hr><p>VIP Entry must be selected to be deleted. You will be redirected to <a href="/panel/vip">VIP Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/vip>'; }
	else
		{
			if(isset($_POST['confirm'])){
			$result = mysql_query("DELETE FROM vip WHERE vip_id='$del' AND site_id='$site_id' LIMIT 1");
			$resultart = mysql_query("DELETE FROM co_art WHERE '$co_art_id'=co_art_id");
			echo '<p>Deleted! You will be redirected to <a href="/panel/vip">VIP Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/vip>';
			}else{ ?>
				<form method="post" action="?del=<?php echo $del; ?>" class="vip">
				<fieldset>
					<ul>			
					<li>Are you sure you want to Delete this VIP page?</li>
					<li><button type="submit" value="Send" name="confirm">Delete</button></li>
					</ul>
				</fieldset>
				</form>
			<?php }
		}	
	}	


elseif(isset($_GET['edit']))
	{
	$edit = $_GET['edit'];
	$result = mysql_query("SELECT * FROM vip WHERE vip_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_vip_name = $row["vip_name"];
	$edit_vip_headline = $row["vip_headline"];
	$edit_vip_url = $row["vip_url"];
	$edit_vip_seo_desc = $row["vip_seo_desc"];
	$edit_vip_seo_keywords = $row["vip_seo_keywords"];
	$edit_vip_full = $row["vip_full"];
	$edit_vip_video = $row["vip_video"];
	$edit_vip_active = $row["vip_active"];
	$edit_vip_sponsors_title = $row["sponsors_title"];
	$edit_vip_sponsors_toggle = $row["sponsors_toggle"];
	$edit_vip_date = $row["vip_date"];
	$edit_vip_nav = $row["nav_bar"];
	$pagetitle = 'Edit '.$edit_vip_name;
	include '../'.$head; check_logged(); check_access(5);
	if (empty($_GET['edit']))
		{ echo '<h1>Error</h1><hr><p>VIP Entry must be selected to be edited. You will be redirected to <a href="/panel/vip">VIP Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/vip>'; }
	else
		{
		echo '<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>';
		echo '<h1>Edit '.$edit_vip_name.'</h1><hr>';
		if (isset($_POST) && !empty($_POST['vip_name']))
			{
			$vip_name = htmlentities(($_POST['vip_name']), ENT_QUOTES, 'utf-8');
			$vip_headline = htmlentities(($_POST['vip_headline']), ENT_QUOTES, 'utf-8');
			$vip_url_base = strtolower(htmlentities(($_POST['vip_url']), ENT_QUOTES, 'utf-8'));
			$vip_url = preg_replace("/[^a-zA-Z0-9]/", "", $vip_url_base);
			$vip_seo_desc = htmlentities(($_POST['vip_seo_desc']), ENT_QUOTES, 'utf-8');
			$vip_seo_keywords = htmlentities(($_POST['vip_seo_keywords']), ENT_QUOTES, 'utf-8');
			$vip_full = htmlentities(($_POST['vip_full']), ENT_QUOTES, 'utf-8');
			$vip_video = htmlentities(($_POST['vip_video']), ENT_QUOTES, 'utf-8');
			$vip_active = htmlentities(($_POST['vip_active']), ENT_QUOTES, 'utf-8');
			$vip_sponsors_title = htmlentities(($_POST['vip_sponsors_title']), ENT_QUOTES, 'utf-8');
			$vip_sponsors_toggle = htmlentities(($_POST['sponsors_toggle']), ENT_QUOTES, 'utf-8');
			$vip_nav = htmlentities(($_POST['vip_nav']), ENT_QUOTES, 'utf-8');
			$result = mysql_query("UPDATE vip SET vip_name='$vip_name', vip_headline='$vip_headline', vip_url='$vip_url', vip_seo_desc='$vip_seo_desc', vip_seo_keywords='$vip_seo_keywords', vip_full='$vip_full', vip_video='$vip_video', vip_active='$vip_active', vip_date=NOW(), user_id='$user_id', nav_bar='$vip_nav', sponsors_toggle='$vip_sponsors_toggle' WHERE vip_id='$edit' ");
			mysql_query("UPDATE vip SET sponsors_title='$vip_sponsors_title' WHERE vip_id='$edit' ");
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/vip">VIP Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/vip>';
			}
		else
			{ ?>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $edit; ?>" class="vip">			
			<fieldset>
			    <legend>VIP Navigation Name:</legend>
			    <ul><li><input name="vip_name" value="<?php echo $edit_vip_name; ?>" type="text" maxlength="15"></li></ul>
			</fieldset>
			<fieldset>
			    <legend>VIP Headline:</legend>
			    <ul><li><input name="vip_headline" value="<?php echo $edit_vip_headline; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
			    <legend>VIP URL:</legend>
			    <ul><li><input name="vip_url" value="<?php echo $edit_vip_url; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
				<legend>SEO Description:</legend>
				<ul><li><textarea name="vip_seo_desc" rows="7"><?php echo $edit_vip_seo_desc; ?></textarea></li></ul>
			</fieldset>
						
			<fieldset>
				<legend>SEO Keywords:</legend>
				<ul><li><textarea name="vip_seo_keywords" rows="7"><?php echo $edit_vip_seo_keywords; ?></textarea></li></ul></fieldset>
			<fieldset>
			<fieldset>
			    <legend>Video:</legend>
			    <ul><li><textarea name="vip_video" rows="15"><?php echo $edit_vip_video; ?></textarea></li></ul>
			</fieldset>
			<fieldset>
				<legend>Entry:</legend>
				<ul><li><textarea name="vip_full" rows="25" class="widgEditor"><?php echo $edit_vip_full; ?></textarea></li></ul>
			</fieldset>
			
			<fieldset>
				<legend>Active On/Off:</legend>
				<ul>			
				<li><select name="vip_active">
				<option value="1"<?php if($edit_vip_active=='1'){ echo ' selected'; } else {} ?>>On</option>
				<option value="0"<?php if($edit_vip_active=='0'){ echo ' selected'; } else {} ?>>Off</option>
				</select></li>
				</ul>
			</fieldset>
			<fieldset>
			    <legend>VIP Sponsors Title Area:</legend>
			    <ul><li><input name="vip_sponsors_title" value="<?php echo $edit_vip_sponsors_title; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
				<legend>VIP Sponsors On/Off:</legend>
				<ul>			
				<li><select name="sponsors_toggle">
				<option value=""<?php if(empty($edit_vip_sponsors_toggle)){ echo ' selected'; } else {} ?>>On</option>
				<option value="1"<?php if($edit_vip_sponsors_toggle=='1'){ echo ' selected'; } else {} ?>>Off</option>
				</select></li>
				</ul>
			</fieldset>
			<fieldset>
				<legend>Nav Bar On/Off:</legend>
				<ul>			
				<li><select name="vip_nav">
				<option value="1"<?php if($edit_vip_nav=='1'){ echo ' selected'; } else {} ?>>On</option>
				<option value="0"<?php if($edit_vip_nav=='0'){ echo ' selected'; } else {} ?>>Off</option>
				</select></li>
				<li><button type="submit" value="Send" name="submit">Save</button></li>
				</ul>
			</fieldset>
			
			<hr><h2><a href="/panel/vip/?del=<?php echo $edit; ?>">Click to Delete This VIP Page</h2>
			</form>
<?php
			}
			
		}
	}
elseif(isset($_GET['sponsors'])){
	$pagetitle = 'Add VIP';
	include '../'.$head; check_logged(); check_access(5);
	$sponsor_id = $_GET['sponsors'];
	$query  = "SELECT vip_id, vip_name, vip_type, vip_order, vip_active, sponsors FROM vip WHERE vip_id = '$sponsor_id' AND '$site_id'=site_id ORDER BY vip_order ASC";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
		$vip_id = stripslashes($row['vip_id']);
		$vip_order = stripslashes($row['vip_order']);
		$vip_name = stripslashes($row['vip_name']);
		$vip_type = stripslashes($row['vip_type']);
		$vip_sponsors = $row['sponsors'];
		$vip_active = stripslashes($row['vip_active']);
		echo '<div id="arrayorder_'.$vip_id.'"';
		if($vip_active=='0')
			{
			echo ' class="inactive"';
			} else {}
		echo '>';
		if($vip_type=='link')
			{
			echo 'link';
			} else {}
		echo 'Sponsors - '.$vip_name.'</div>';
		$sponsors = explode(',', $vip_sponsors);
		if(isset($_GET['sponsors_delete'])){
			$sponsors_delete = $_GET['sponsors_delete'];
			//echo $vip_sponsors."<br />".$sponsors_delete; 
			$updated_sponsors = str_replace($sponsors_delete,'',$vip_sponsors);
			//echo "<br />".$updated_sponsors;
			//echo $vip_sponsors."<br />".$updated_sponsors."<br />".$sponsor_id;
			mysql_query("UPDATE `vip` SET sponsors='$updated_sponsors' WHERE vip_id='$sponsor_id'");
			echo '<p>You will be redirected to <a href="/panel/vip.php?sponsors='.$sponsor_id.'">Site Editor</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/vip.php?sponsors='.$sponsor_id.'>';
		
		}
		if(isset($_GET['sponsors_add'])){
			if(empty($_GET['sponsors_add'])){
				$cards_results = mysql_query("SELECT * FROM `card` WHERE card_front <> ''");
				echo "<form method='GET' action='".$PHP_SELF."'>";
				while($rows = mysql_fetch_array($cards_results))
					{
					$card_id = $rows['card_id'];
					$co_id = $rows['co_id'];
					$co_name = mysql_query("SELECT * FROM `co` WHERE co_id='$co_id'");
					while($co_info = mysql_fetch_array($co_name)){
						echo "<br /><input type='radio' name='newsponsor' value='".$card_id."' >".$co_info['co_name']."<br />";
						}
					}
				echo "<input type='hidden' name='sponsors' value='".$sponsor_id."'>";
				echo "<input type='hidden' name='sponsors_add' value='y'>";
				echo "<br /><input type='submit' name='sponsors_add_it' >";
				echo "</form>";
			}
		}
		if(!isset($_GET['sponsors_add']) && !isset($_GET['sponsors_delete']))
			{	
			foreach($sponsors as $sponsor)
				{
				$sponsor_img = mysql_query("SELECT * FROM `card` WHERE card_id = '$sponsor'");
				while($rows = mysql_fetch_array($sponsor_img))
					{
					$co_id = $rows['co_id'];
					$co_name = mysql_query("SELECT * FROM `co` WHERE co_id='$co_id'");
					while($co_info = mysql_fetch_array($co_name))
						{
							echo "<br /><a href='/panel/vip.php?sponsors=".$vip_id."&sponsors_delete=".$sponsor."'>Delete Sponsor</a> - ".$co_info	['co_name']."";
						}
					//	echo "<br /><br /><a href='/panel/vip.php?sponsors=".$vip_id."&sponsors_add'>Add Sponsor</a>";
					//echo "<p class='spot'><a href='#'><img src='http://www.boernespotlights.com/assets/img/spotlights/tn-".$rows['card_front']."'></a></p>";
					}
				
				}
				echo "<br /><br /><a href='/panel/vip.php?sponsors=".$vip_id."&sponsors_add'>Add Sponsor</a>";
			}
		}
		if(isset($_GET['sponsors_add_it']))
			{
			$newsponsor = $_GET['newsponsor'];
			$vip_sql = mysql_query("SELECT * FROM `vip` WHERE vip_id = '$vip_id'");
			while($update = mysql_fetch_array($vip_sql))
				{
				$sponsor_list = $update['sponsors'];
			
			
				}
			$updated_list = $sponsor_list.",".$newsponsor;
			//echo $updated_list;
			mysql_query("UPDATE `vip` SET sponsors='$updated_list' WHERE vip_id='$vip_id'");
			echo '<p>You will be redirected to <a href="/panel/vip.php?sponsors='.$sponsor_id.'">Site Editor</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/vip.php?sponsors='.$sponsor_id.'>';
			}
	}
elseif(isset($_GET['banner1']))
	{
	$pagetitle = "Edit VIP Banner #1";
	include '../'.$head; check_logged(); check_access(5);
	$banner_id = $_GET['banner1'];
	$query  = "SELECT vip_id, vip_name, vip_type, vip_order, vip_active, sponsors, vip_banner1, vip_banner1_url, vip_banner1_newwindow FROM vip WHERE vip_id = '$banner_id' AND '$site_id'=site_id ORDER BY vip_order ASC";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
		$vip_id = stripslashes($row['vip_id']);
		$vip_order = stripslashes($row['vip_order']);
		$vip_name = stripslashes($row['vip_name']);
		$vip_banner1 = stripslashes($row['vip_banner1']);
		$vip_banner1_url = stripslashes($row['vip_banner1_url']);
		$vip_banner1_newwindow = stripslashes($row['vip_banner1_newwindow']);
		
		}
	if (isset($_POST['submit']))
		{
		if (!empty($_FILES["vip_banner1"]["name"]))
			{
			$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$img_tmp = $_FILES["vip_banner1"]["tmp_name"];
			$img_size = ($_FILES["vip_banner1"]["size"] / 1024);
			$file_name = basename($_FILES["vip_banner1"]["name"]);
			$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
			$max_file = '2048';
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
				{
				$vip_banner1_name = $img_md5.'.'.$file_ext;
				$vip_banner1_target = "../assets/img/".$vip_banner1_name;
				move_uploaded_file($_FILES["vip_banner1"]["tmp_name"],$vip_banner1_target);
				$resizeObj = new resize('../assets/img/'.$vip_banner1_name); // *** 1) Initialise / load image
				$resizeObj -> resizeImage(960, 190, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> saveImage('../assets/img/-'.$vip_banner1, 100); // *** 3) Save image
				}
			else
				{
				$vip_banner1_name = $vip_banner1;
				}
			}
		else
			{
			$vip_banner1_name = $vip_banner1;
			}
		$new_vip_banner1_url = htmlentities(($_POST['vip_banner1_url']), ENT_QUOTES, 'ISO-8859-1');
		$new_vip_banner1_newwindow = htmlentities(($_POST['new_window1']), ENT_QUOTES, 'ISO-8859-1');

		$result = mysql_query("UPDATE vip SET vip_banner1='$vip_banner1_name', vip_banner1_url='$new_vip_banner1_url',vip_banner1_newwindow='$new_vip_banner1_newwindow'  WHERE site_id='$site_id' AND vip_id = '$banner_id'") or die(mysql_error());
		echo ' <p>Edited successfully! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/site>';
		}
	else
		{ ?>
		<h1><?php echo $pagetitle; ?></h1><hr>
		<form method="post" action="?banner1=<?php echo $banner_id; ?>" enctype="multipart/form-data">
		<fieldset><legend>Banner #1 Img:</legend>
		<ul><li>
		<?php
		if($vip_banner1 != '')
			{
			echo '<input type="hidden" name="vip_banner1" value="'.$vip_banner1.'">';
			echo '<img src="/assets/img/'.$vip_banner1.'" width="480" height="95">';
			echo '<br><a href="?del_banner1='.$banner_id.'">Delete Image</a>';
			}
		else
			{
			echo '<input name="vip_banner1" type="file" />';
			}
				?>
		</li></ul></fieldset>
		<fieldset>
			<legend>URL to Open in New Window?</legend>
			<ul>			
			<li><select name="new_window1">
			<option value="1"<?php if($vip_banner1_newwindow=='1'){ echo ' selected'; } else {} ?>>Yes</option>
			<option value=""<?php if(empty($vip_banner1_newwindow)){ echo ' selected'; } else {} ?>>No</option>
			</select></li>
			</ul>
		</fieldset>
		<fieldset><legend>Banner #1 URL:</legend>
		<ul><li><input name="vip_banner1_url" type="text" value="<? echo $vip_banner1_url; ?>" /></li>
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
		</form>
<?php	}
	}
elseif(isset($_GET['del_banner1']))
	{
	$pagetitle = "Deleting VIP Banner #1";
	$banner_id = $_GET['del_banner1'];
	include '../'.$head; check_logged(); check_access(5);
	$path= '../assets/img/'. $vip_banner1 .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
	$result = mysql_query("UPDATE vip SET vip_banner1='' WHERE site_id='$site_id' AND vip_id = '$banner_id'");
	echo '<h1>Banner #1</h1><hr><p>VIP Banner #1 has successfully been deleted! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/site>';
	}
elseif(isset($_GET['banner2']))
	{
	$pagetitle = "Edit VIP Banner #2";
	include '../'.$head; check_logged(); check_access(5);
	$banner_id = $_GET['banner2'];
	$query  = "SELECT vip_id, vip_name, vip_type, vip_order, vip_active, sponsors, vip_banner2, vip_banner2_url, vip_banner2_newwindow FROM vip WHERE vip_id = '$banner_id' AND '$site_id'=site_id ORDER BY vip_order ASC";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
		$vip_id = stripslashes($row['vip_id']);
		$vip_order = stripslashes($row['vip_order']);
		$vip_name = stripslashes($row['vip_name']);
		$vip_type = stripslashes($row['vip_type']);
		$vip_banner2 = stripslashes($row['vip_banner2']);
		$vip_banner2_url = stripslashes($row['vip_banner2_url']);
		$vip_banner2_newwindow = stripslashes($row['vip_banner2_newwindow']);
		}
	if (isset($_POST['submit']))
		{
		if (!empty($_FILES["vip_banner2"]["name"]))
			{
			$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$img_tmp = $_FILES["vip_banner2"]["tmp_name"];
			$img_size = ($_FILES["vip_banner2"]["size"] / 1024);
			$file_name = basename($_FILES["vip_banner2"]["name"]);
			$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
			$max_file = '2048';
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
				{
				$vip_banner2_name = $img_md5.'.'.$file_ext;
				$vip_banner2_target = "../assets/img/".$vip_banner2_name;
				move_uploaded_file($_FILES["vip_banner2"]["tmp_name"],$vip_banner2_target);
				$resizeObj = new resize('../assets/img/'.$vip_banner2_name); // *** 1) Initialise / load image
				$resizeObj -> resizeImage(960, 190, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> saveImage('../assets/img/-'.$vip_banner2, 100); // *** 3) Save image
				}
			else
				{
				$vip_banner2_name = $vip_banner2;
				}
			}
		else
			{
			$vip_banner2_name = $vip_banner2;
			}
		$new_vip_banner2_url = htmlentities(($_POST['vip_banner2_url']), ENT_QUOTES, 'ISO-8859-1');
		$new_vip_banner2_newwindow = htmlentities(($_POST['new_window2']), ENT_QUOTES, 'ISO-8859-1');
				
		$result = mysql_query("UPDATE vip SET vip_banner2='$vip_banner2_name', vip_banner2_url='$new_vip_banner2_url',vip_banner2_newwindow='$new_vip_banner2_newwindow' WHERE site_id='$site_id' AND vip_id = '$banner_id'") or die(mysql_error());
		echo ' <p>Edited successfully! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/site>';
		}
	else
		{ ?>
		<h1><?php echo $pagetitle; ?></h1><hr>
		<form method="post" action="?banner2=<?php echo $banner_id; ?>" enctype="multipart/form-data">
		<fieldset><legend>Banner #2 Img:</legend>
		<ul><li>
		<?php
		if($vip_banner2 != '')
			{
			echo '<input type="hidden" name="vip_banner2" value="'.$vip_banner2.'">';
			echo '<img src="/assets/img/'.$vip_banner2.'" width="480" height="95">';
			echo '<br><a href="?del_banner2='.$banner_id.'">Delete Image</a>';
			}
		else
			{
			echo '<input name="vip_banner2" type="file" />';
			}
				?>
		</li></ul></fieldset>
		<fieldset>
			<legend>URL to Open in New Window?</legend>
			<ul>			
			<li><select name="new_window2">
			<option value="1"<?php if($vip_banner2_newwindow=='1'){ echo ' selected'; } else {} ?>>Yes</option>
			<option value=""<?php if(empty($vip_banner2_newwindow)){ echo ' selected'; } else {} ?>>No</option>
			</select></li>
			</ul>
		</fieldset>
		<fieldset><legend>Banner #2 URL:</legend>
		<ul><li><input name="vip_banner2_url" type="text" value="<? echo $vip_banner2_url; ?>" /></li>
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
		</form>
<?php	}
	}
elseif(isset($_GET['del_banner2']))
	{
	$pagetitle = "Deleting VIP Banner #2";
	$banner_id = $_GET['del_banner2'];
	include '../'.$head; check_logged(); check_access(5);
	$path= '../assets/img/'. $vip_banner2 .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
	$result = mysql_query("UPDATE vip SET vip_banner2='' WHERE site_id='$site_id' AND vip_id = '$banner_id'");
	echo '<h1>Banner #2</h1><hr><p>VIP Banner #2 has successfully been deleted! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/site>';
	}
elseif(isset($_GET['banner3']))
	{
	$pagetitle = "Edit VIP Banner #3";
	include '../'.$head; check_logged(); check_access(5);
	$banner_id = $_GET['banner3'];
	$query  = "SELECT vip_id, vip_name, vip_type, vip_order, vip_active, sponsors, vip_banner3, vip_banner3_url, vip_banner1_newwindow FROM vip WHERE vip_id = '$banner_id' AND '$site_id'=site_id ORDER BY vip_order ASC";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
		$vip_id = stripslashes($row['vip_id']);
		$vip_order = stripslashes($row['vip_order']);
		$vip_name = stripslashes($row['vip_name']);
		$vip_type = stripslashes($row['vip_type']);
		$vip_banner3 = stripslashes($row['vip_banner3']);
		$vip_banner3_url = stripslashes($row['vip_banner3_url']);
		$vip_banner3_newwindow = stripslashes($row['vip_banner3_newwindow']);
		}
	if (isset($_POST['submit']))
		{
		if (!empty($_FILES["vip_banner3"]["name"]))
			{
			$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$img_tmp = $_FILES["vip_banner3"]["tmp_name"];
			$img_size = ($_FILES["vip_banner3"]["size"] / 1024);
			$file_name = basename($_FILES["vip_banner3"]["name"]);
			$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
			$max_file = '2048';
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
				{
				$vip_banner3_name = $img_md5.'.'.$file_ext;
				$vip_banner3_target = "../assets/img/".$vip_banner3_name;
				move_uploaded_file($_FILES["vip_banner3"]["tmp_name"],$vip_banner3_target);
				$resizeObj = new resize('../assets/img/'.$vip_banner3_name); // *** 1) Initialise / load image
				$resizeObj -> resizeImage(960, 190, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> saveImage('../assets/img/-'.$vip_banner3, 100); // *** 3) Save image
				}
			else
				{
				$vip_banner3_name = $vip_banner3;
				}
			}
		else
			{
			$vip_banner3_name = $vip_banner3;
			}
		$new_vip_banner3_url = htmlentities(($_POST['vip_banner3_url']), ENT_QUOTES, 'ISO-8859-1');
		$new_vip_banner3_newwindow = htmlentities(($_POST['new_window3']), ENT_QUOTES, 'ISO-8859-1');
		
		$result = mysql_query("UPDATE vip SET vip_banner3='$vip_banner3_name', vip_banner3_url='$new_vip_banner3_url',vip_banner3_newwindow='$new_vip_banner3_newwindow' WHERE site_id='$site_id' AND vip_id = '$banner_id'") or die(mysql_error());
		echo ' <p>Edited successfully! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/site>';
		}
	else
		{ ?>
		<h1><?php echo $pagetitle; ?></h1><hr>
		<form method="post" action="?banner3=<?php echo $banner_id; ?>" enctype="multipart/form-data">
		<fieldset><legend>Banner #3 Img:</legend>
		<ul><li>
		<?php
		if($vip_banner3 != '')
			{
			echo '<input type="hidden" name="vip_banner3" value="'.$vip_banner3.'">';
			echo '<img src="/assets/img/'.$vip_banner3.'" width="480" height="95">';
			echo '<br><a href="?del_banner3='.$banner_id.'">Delete Image</a>';
			}
		else
			{
			echo '<input name="vip_banner3" type="file" />';
			}
				?>
		</li></ul></fieldset>
		<fieldset>
			<legend>URL to Open in New Window?</legend>
			<ul>			
			<li><select name="new_window3">
			<option value="1"<?php if($vip_banner3_newwindow=='1'){ echo ' selected'; } else {} ?>>Yes</option>
			<option value=""<?php if(empty($vip_banner3_newwindow)){ echo ' selected'; } else {} ?>>No</option>
			</select></li>
			</ul>
		</fieldset>
		<fieldset><legend>Banner #3 URL:</legend>
		<ul><li><input name="vip_banner3_url" type="text" value="<? echo $vip_banner3_url; ?>" /></li>
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
		</form>
<?php	}
	}
elseif(isset($_GET['del_banner3']))
	{
	$pagetitle = "Deleting VIP Banner #1";
	$banner_id = $_GET['del_banner3'];
	include '../'.$head; check_logged(); check_access(5);
	$path= '../assets/img/'. $vip_banner3 .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
	$result = mysql_query("UPDATE vip SET vip_banner3='' WHERE site_id='$site_id' AND vip_id = '$banner_id'");
	echo '<h1>Banner #3</h1><hr><p>Site Banner #3 has successfully been deleted! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/site>';
	}	
else
	{
	$pagetitle = 'VIP Admin';
	include '../'.$head; check_logged(); check_access(5);
	echo '<p>You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/site>';
	}





include '../'.$foot; ?>