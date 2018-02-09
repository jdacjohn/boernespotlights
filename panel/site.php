<?php $pagetitle = "Control Panel"; include '../core/base.php'; include '../'.$head; check_logged(); check_access(2);





echo '<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>';
if(isset($_GET['name']))
	{
	$pagetitle = "Edit Site Name";
	$result = mysql_query("SELECT site_name FROM site WHERE site_id='$site_id' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$site_name = $row["site_name"];
	if (isset($_POST['submit']))
		{
		$site_name = htmlentities(($_POST['site_name']), ENT_QUOTES, 'ISO-8859-1');
		$result = mysql_query("UPDATE site SET site_name='$site_name' WHERE site_id='$site_id' ");
		echo '<h1>'.$pagetitle.'</h1><hr><p>Site name was edited successfully! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/site>';
		}
	else
		{ ?>
		<h1><?php echo $pagetitle; ?></h1><hr>
		<form method="post" action="?name">
		<fieldset><legend>Site Name:</legend>
		<ul><li><input name="site_name" type="text" value="<? echo $site_name; ?>" /></li>
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
		</form>
<?php	}
	}





elseif(isset($_GET['desc']))
	{
	$pagetitle = "Edit Site Description";
	$result = mysql_query("SELECT site_desc FROM site WHERE site_id='$site_id' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$site_desc = $row["site_desc"];
	if (isset($_POST['submit']))
		{
		$site_desc = htmlentities(($_POST['site_desc']), ENT_QUOTES, 'ISO-8859-1');
		$result = mysql_query("UPDATE site SET site_desc='$site_desc' WHERE site_id='$site_id' ");
		echo '<h1>'.$pagetitle.'</h1><hr><p>Site description was edited successfully! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/site>';
		}
	else
		{ ?>
		<h1><?php echo $pagetitle; ?></h1><hr>
		<form method="post" action="?desc">
			
		<fieldset><legend>Site Description:</legend>
		<ul><li><textarea name="site_desc" rows="7"><?php echo $site_desc; ?></textarea></li>
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
		
		</form>
<?php	}
	}




elseif(isset($_GET['contact']))
	{
	$pagetitle = "Edit Site Contact Email";
	$result = mysql_query("SELECT site_contact, site_facebook, site_twitter FROM site WHERE site_id='$site_id' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$site_contact = $row["site_contact"];
	$site_facebook = $row["site_facebook"];
	$site_twitter = $row["site_twitter"];
	if (isset($_POST['submit']))
		{
		$site_contact = htmlentities(($_POST['site_contact']), ENT_QUOTES, 'ISO-8859-1');
		$site_facebook = htmlentities(($_POST['site_facebook']), ENT_QUOTES, 'ISO-8859-1');
		$site_twitter = htmlentities(($_POST['site_twitter']), ENT_QUOTES, 'ISO-8859-1');
		$result = mysql_query("UPDATE site SET site_contact='$site_contact', site_facebook='$site_facebook', site_twitter='$site_twitter' WHERE site_id='$site_id' ");
		echo '<h1>'.$pagetitle.'</h1><hr><p>Site Contact Email was edited successfully! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/site>';
		}
	else
		{ ?>
		<h1><?php echo $pagetitle; ?></h1><hr>
		<form method="post" action="?contact">
			
		<fieldset><legend>Site Facebook:</legend>
		<ul><li><input name="site_facebook" type="text" value="<? echo $site_facebook; ?>" /></li></ul></fieldset>
		
		<fieldset><legend>Site Twitter:</legend>
		<ul><li><input name="site_twitter" type="text" value="<? echo $site_twitter; ?>" /></li></ul></fieldset>
		
		<fieldset><legend>Site Contact Email:</legend>
		<ul><li><input name="site_contact" type="text" value="<? echo $site_contact; ?>" />
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
		
		</form>
<?php	}
	}





elseif(isset($_GET['banner1']))
	{
	$pagetitle = "Edit Site Banner #1";
	if (isset($_POST['submit']))
		{
		if (!empty($_FILES["site_banner1"]["name"]))
			{
			$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$img_tmp = $_FILES["site_banner1"]["tmp_name"];
			$img_size = ($_FILES["site_banner1"]["size"] / 1024);
			$file_name = basename($_FILES["site_banner1"]["name"]);
			$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
			$max_file = '2048';
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
				{
				$site_banner1_name = $img_md5.'.'.$file_ext;
				$site_banner1_target = "../assets/img/".$site_banner1_name;
				move_uploaded_file($_FILES["site_banner1"]["tmp_name"],$site_banner1_target);
				$resizeObj = new resize('../assets/img/'.$site_banner1_name); // *** 1) Initialise / load image
				$resizeObj -> resizeImage(960, 190, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> saveImage('../assets/img/-'.$site_banner1, 100); // *** 3) Save image
				}
			else
				{
				$site_banner1_name = $site_banner1;
				}
			}
		else
			{
			$site_banner1_name = $site_banner1;
			}
		$new_site_banner1_url = htmlentities(($_POST['site_banner1_url']), ENT_QUOTES, 'ISO-8859-1');
		$result = mysql_query("UPDATE site SET site_banner1='$site_banner1_name', site_banner1_url='$new_site_banner1_url' WHERE site_id='$site_id'") or die(mysql_error());
		echo ' <p>Edited successfully! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/site>';
		
		
		}
	else
		{ ?>
		<h1><?php echo $pagetitle; ?></h1><hr>
		<form method="post" action="?banner1" enctype="multipart/form-data">
		<fieldset><legend>Banner #1 Img:</legend>
		<ul><li>
		<?php
		if($site_banner1 != '')
			{
			echo '<input type="hidden" name="site_banner1" value="'.$site_banner1.'">';
			echo '<img src="/assets/img/'.$site_banner1.'" width="480" height="95">';
			echo '<br><a href="?del_banner1">Delete Image</a>';
			}
		else
			{
			echo '<input name="site_banner1" type="file" />';
			}
		?>
		</li></ul></fieldset>
		<fieldset><legend>Banner #1 URL:</legend>
		<ul><li><input name="site_banner1_url" type="text" value="<? echo $site_banner1_url; ?>" /></li>
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
		</form>
<?php	}
	}


elseif(isset($_GET['del_banner1']))
	{
	$path= '../assets/img/'. $site_banner1 .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
	$result = mysql_query("UPDATE site SET site_banner1='' WHERE site_id='$site_id' ");
	echo '<h1>Banner #1</h1><hr><p>Site Banner #1 has successfully been deleted! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/site>';
	}




elseif(isset($_GET['banner2']))
	{
	$pagetitle = "Edit Site Banner #2";
	if (isset($_POST['submit']))
		{
		if (!empty($_FILES["site_banner2"]["name"]))
			{
			$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$img_tmp = $_FILES["site_banner2"]["tmp_name"];
			$img_size = ($_FILES["site_banner2"]["size"] / 1024);
			$file_name = basename($_FILES["site_banner2"]["name"]);
			$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
			$max_file = '2048';
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
				{
				$site_banner2_name = $img_md5.'.'.$file_ext;
				$site_banner2_target = "../assets/img/".$site_banner2_name;
				move_uploaded_file($_FILES["site_banner2"]["tmp_name"],$site_banner2_target);
				$resizeObj = new resize('../assets/img/'.$site_banner2_name); // *** 1) Initialise / load image
				$resizeObj -> resizeImage(960, 190, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> saveImage('../assets/img/-'.$site_banner2, 100); // *** 3) Save image
				}
			else
				{
				$site_banner2_name = $site_banner2;
				}
			}
		else
			{
			$site_banner2_name = $site_banner2;
			}
		$new_site_banner2_url = htmlentities(($_POST['site_banner2_url']), ENT_QUOTES, 'ISO-8859-1');
		$result = mysql_query("UPDATE site SET site_banner2='$site_banner2_name', site_banner2_url='$new_site_banner2_url' WHERE site_id='$site_id'") or die(mysql_error());
		echo ' <p>Edited successfully! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/site>';
		
		
		}
	else
		{ ?>
		<h1><?php echo $pagetitle; ?></h1><hr>
		<form method="post" action="?banner2" enctype="multipart/form-data">
		<fieldset><legend>Banner #2 Img:</legend>
		<ul><li>
		<?php
		if($site_banner2 != '')
			{
			echo '<input type="hidden" name="site_banner2" value="'.$site_banner2.'">';
			echo '<img src="/assets/img/'.$site_banner2.'" width="480" height="95">';
			echo '<br><a href="?del_banner2">Delete Image</a>';
			}
		else
			{
			echo '<input name="site_banner2" type="file" />';
			}
		?>
		</li></ul></fieldset>
		<fieldset><legend>Banner #2 URL:</legend>
		<ul><li><input name="site_banner2_url" type="text" value="<? echo $site_banner2_url; ?>" /></li>
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
		</form>
<?php	}
	}


elseif(isset($_GET['del_banner2']))
	{
	$path= '../assets/img/'. $site_banner2 .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
	$result = mysql_query("UPDATE site SET site_banner2='' WHERE site_id='$site_id' ");
	echo '<h1>Banner #2</h1><hr><p>Site Banner #1 has successfully been deleted! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/site>';
	}

elseif(isset($_GET['banner3']))
	{
	$pagetitle = "Edit Site Banner #3";
	if (isset($_POST['submit']))
		{
		if (!empty($_FILES["site_banner3"]["name"]))
			{
			$img_md5 = $user_id."-".date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			$img_tmp = $_FILES["site_banner3"]["tmp_name"];
			$img_size = ($_FILES["site_banner3"]["size"] / 1024);
			$file_name = basename($_FILES["site_banner3"]["name"]);
			$file_ext = substr($file_name, strrpos($file_name, ".") + 1);
			$max_file = '2048';
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg") OR ($file_ext=="png") OR ($file_ext=="gif")) && ($img_size < $max_file))
				{
				$site_banner3_name = $img_md5.'.'.$file_ext;
				$site_banner3_target = "../assets/img/".$site_banner3_name;
				move_uploaded_file($_FILES["site_banner3"]["tmp_name"],$site_banner3_target);
				$resizeObj = new resize('../assets/img/'.$site_banner3_name); // *** 1) Initialise / load image
				$resizeObj -> resizeImage(960, 190, 'crop'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> saveImage('../assets/img/-'.$site_banner3, 100); // *** 3) Save image
				}
			else
				{
				$site_banner3_name = $site_banner3;
				}
			}
		else
			{
			$site_banner3_name = $site_banner3;
			}
		$new_site_banner3_url = htmlentities(($_POST['site_banner3_url']), ENT_QUOTES, 'ISO-8859-1');
		$result = mysql_query("UPDATE site SET site_banner3='$site_banner3_name', site_banner3_url='$new_site_banner3_url' WHERE site_id='$site_id'") or die(mysql_error());
		echo ' <p>Edited successfully! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/site>';
		
		
		}
	else
		{ ?>
		<h1><?php echo $pagetitle; ?></h1><hr>
		<form method="post" action="?banner3" enctype="multipart/form-data">
		<fieldset><legend>Banner #3 Img:</legend>
		<ul><li>
		<?php
		if($site_banner3 != '')
			{
			echo '<input type="hidden" name="site_banner3" value="'.$site_banner3.'">';
			echo '<img src="/assets/img/'.$site_banner3.'" width="480" height="95">';
			echo '<br><a href="?del_banner3">Delete Image</a>';
			}
		else
			{
			echo '<input name="site_banner3" type="file" />';
			}
		?>
		</li></ul></fieldset>
		<fieldset><legend>Banner #3 URL:</legend>
		<ul><li><input name="site_banner3_url" type="text" value="<? echo $site_banner3_url; ?>" /></li>
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
		</form>
<?php	}
	}


elseif(isset($_GET['del_banner3']))
	{
	echo "UPDATE site SET site_banner3='' WHERE site_id='$site_id' ";
	$path= '../assets/img/'. $site_banner3 .''; if(@unlink($path)) {/* echo "Deleted file "; */} else{/* echo "File can't be deleted"; */}
	$result = mysql_query("UPDATE site SET site_banner3='' WHERE site_id='$site_id' ");
	echo '<h1>Banner #3</h1><hr><p>Site Banner #3 has successfully been deleted! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/site>';
	}

elseif(isset($_GET['update']))
	{
	$count = 1;
	$array = $_POST['arrayorder'];
	foreach($array as $idval)
		{
		$query = "UPDATE page SET page_order = " . $count . " WHERE '$site_id'=site_id AND page_id = " . $idval;
		mysql_query($query) or die('Error, insert query failed');
		$count ++;
		}
	}


else
	{
	echo '
	<div class="admin"><h1>Site Editor</h1><hr>
	<h2>Site Configuration</h1><hr>
	<ul>
	<li><a href="?banner1">Edit Site Banner #1</a></li>
	<li><a href="?banner2">Edit Site Banner #2</a></li>
	<li><a href="?banner3">Edit Site Banner #3</a></li>
	<li><a href="?contact">Edit Contact Information</a></li>
	<li><a href="?desc">Edit Site Description</a></li>
	<li><a href="?name">Edit Site Name</a></li>
	<li><a href="/panel/paypal">PayPal Admin</a></li>
	</ul>
	<hr><h2>Page Editor <a href="/panel/page.php?add">Add Page</a> <a href="/panel/page.php?addlink">Add Link</a></h2><hr>
	<ul id="list">';
	$query  = "SELECT page_id, page_name, page_type, page_order, page_active FROM page WHERE '$site_id'=site_id ORDER BY page_order ASC";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
		$page_id = stripslashes($row['page_id']);
		$page_order = stripslashes($row['page_order']);
		$page_name = stripslashes($row['page_name']);
		$page_type = stripslashes($row['page_type']);
		$page_active = stripslashes($row['page_active']);
		echo '<li id="arrayorder_'.$page_id.'"';
		if($page_active=='0')
			{
			echo ' class="inactive"';
			} else {}
		echo '><a href="/panel/page.php?edit';
		if($page_type=='link')
			{
			echo 'link';
			} else {}
		echo '='.$page_id.'">Edit '.$page_name.'</a></li>';
		}
	echo '</ul>';
	
	echo '
	<hr><h2>VIP Page Editor <a href="/panel/vip.php?add">Add VIP Page</a></h2><hr>
	<ul id="list">';
	$query  = "SELECT vip_id, vip_name, vip_type, vip_order, vip_active, sponsors FROM vip WHERE '$site_id'=site_id ORDER BY vip_order ASC";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
		$vip_id = stripslashes($row['vip_id']);
		$vip_order = stripslashes($row['vip_order']);
		$vip_name = stripslashes($row['vip_name']);
		$vip_type = stripslashes($row['vip_type']);
		$vip_sponsors = $row['sponsors'];
		$vip_active = stripslashes($row['vip_active']);
		echo '<li id="arrayorder_'.$vip_id.'"';
		if($vip_active=='0')
			{
			echo ' class="inactive"';
			} else {}
		echo '><a href="/panel/vip.php?edit';
		if($vip_type=='link')
			{
			echo 'link';
			} else {}
		echo '='.$vip_id.'">Edit '.$vip_name.'</a></li>';
		echo "<a href='/panel/vip.php?sponsors=".$vip_id."'>add or remove sponsors</a> | ";
		$sponsors = explode(',', $vip_sponsors);
		foreach($sponsors as $sponsor){
			$sponsor_img = mysql_query("SELECT * FROM `card` WHERE card_id = '$sponsor'");
			while($rows = mysql_fetch_array($sponsor_img)){
				$co_id = $rows['co_id'];
				$co_name = mysql_query("SELECT * FROM `co` WHERE co_id='$co_id'");
				while($co_info = mysql_fetch_array($co_name)){
					echo $co_info['co_name']." | ";
				}
				//echo "<p class='spot'><a href='#'><img src='http://www.boernespotlights.com/assets/img/spotlights/tn-".$rows['card_front']."'></a></p>";
			}
		}
		echo "<br />";
		echo "<a href='/panel/vip.php?banner1=".$vip_id."'>Edit VIP Banner #1</a><br />";
		echo "<a href='/panel/vip.php?banner2=".$vip_id."'>Edit VIP Banner #2</a><br />";
		echo "<a href='/panel/vip.php?banner3=".$vip_id."'>Edit VIP Banner #3</a><br />";
		echo "<br />";
	}
	echo '</ul>
	</div>';
	
	}





include '../'.$foot; ?>