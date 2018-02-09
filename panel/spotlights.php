<?php $pagetitle = "Spotlights"; include '../core/base.php'; include '../'.$head; check_logged(); check_access(2);





if(isset($_GET['add']))
	{
	$co_id = $_GET['add'];
	echo '<h1>'.$pagetitle.'</h1><hr>';
	echo '<a href="?add_bizcard';
	if(!empty($co_id)){echo '='.$co_id;} else{}
	echo '">BizCard-Spotlight™</a> &middot; <a href="?add_video';
	if(!empty($co_id)){echo '='.$co_id;} else{}
	echo '">Video Marketing Spotlight™</a>';
	}
	



elseif(isset($_GET['add_bizcard']))
	{
	$pagetype = "Add Spotlight";
	$co_id = $_GET['add_bizcard'];
	if (isset($_POST['submit']) && !empty($_FILES["card_front"]["name"]))
		{
		if (!empty($_FILES["card_front"]["name"]))
			{
			$co_id = htmlentities(($_POST['co_id']), ENT_QUOTES, 'utf-8');
			//Get the file information
			$userfile_name = $_FILES["card_front"]["name"];
			$userfile_tmp = $_FILES["card_front"]["tmp_name"];
			$userfile_size = ($_FILES["card_front"]["size"] / 1024);
			$filename = basename($_FILES["card_front"]["name"]);
			$file_ext = strtolower(substr($filename, strrpos($filename, ".") + 1));
			$max_file = '1024';
			
			//$img_md5 = date("mdy")."-".substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
			
			if ((($file_ext=="jpg") OR ($file_ext=="jpeg")) /*&& ($userfile_size < $max_file)*/)
				{
				$card_front = strtolower($user_id."-".date("mdy")."-".strtolower(str_replace(' ', '', $_FILES["card_front"]["name"])));
				$card_front_target = "../assets/img/spotlights/".$card_front;
				move_uploaded_file($_FILES["card_front"]["tmp_name"],$card_front_target);
				
				$resizeObj = new resize('../assets/img/spotlights/'.$card_front); // *** 1) Initialise / load image
				$resizeObj -> resizeImage(445, 445, 'auto'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> saveImage('../assets/img/spotlights/new-'.$card_front, 100); // *** 3) Save image
				$resizeObj2 = new resize('../assets/img/spotlights/'.$card_front); // *** 1) Initialise / load image
				$resizeObj2 -> resizeImage(270, 270, 'auto'); // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj2 -> saveImage('../assets/img/spotlights/tn-'.$card_front, 100); // *** 3) Save image
				
				
				$result = mysql_query("INSERT INTO card (card_front, card_approve, co_id, site_id, user_id, city_code) VALUES ('$card_front', '1', '$co_id', '$site_id', '$user_id', '1')") or die(mysql_error());
				echo '<h1>'.$pagetype.'</h1><hr><p>Card was added successfully! You will be redirected to the <a href="/panel/admin/?co='.$co_id.'">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/admin/?co='.$co_id.'>';
				}
			else
				{
				echo '<h1>'.$pagetype.'</h1><hr><p>ONLY JPG images under 5MB are accepted for upload. Please try again. You will be redirected to the <a href="/panel/admin/?co='.$co_id.'">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/admin/?co='.$co_id.'>';
				}
			}
		}
	else
		{ echo '<h1>'.$pagetype.'</h1><hr>';
		?>
		<form method="post" action="<?php echo $PHP_SELF; ?>?add_bizcard" enctype="multipart/form-data">
		<input type="hidden" name="co_id" value="<?php echo $co_id; ?>">
		<fieldset><legend>Card Front:</legend>
		<ul><li><input name="card_front" type="file" /></li>
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
		
		</form>
<?php	}
	}
	
elseif(isset($_GET['add_video']))
	{
	$pagetype = "Add Spotlight";
	$co_id = $_GET['add_video'];
	if (isset($_POST['submit']) && !empty($_POST['card_video']))
		{
		$card_video = htmlentities(($_POST['card_video']), ENT_QUOTES, 'utf-8');
		$co_id = htmlentities(($_POST['co_id']), ENT_QUOTES, 'utf-8');
		$result = mysql_query("INSERT INTO card (card_video, card_approve, co_id, site_id, user_id, city_code) VALUES ('$card_video','1','$co_id','$site_id','$user_id','1')");
		echo '<h1>'.$pagetype.'</h1><hr><p>Card was added successfully! You will be redirected to the <a href="/panel/admin/?co='.$co_id.'">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/admin/?co='.$co_id.'>';
		}
	else
		{ echo '<h1>'.$pagetype.'</h1><hr>';
		?>
		<form method="post" action="<?php echo $PHP_SELF; ?>?add_video">
		<input type="hidden" name="co_id" value="<?php echo $co_id; ?>">
		
		<fieldset><legend>Video:</legend>
		<ul><li><textarea name="card_video" rows="15"><?= @$_POST['card_video']?></textarea></li>
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
		
		</form>
<?php	}
	}

	
elseif(isset($_GET['edit']))
	{
	$pagetype = "Edit Spotlight";
	$card_id = $_GET['edit'];
	$result = mysql_query("SELECT * FROM card WHERE card_id='$card_id' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$card_front = $row["card_front"];
	$old_card_video=strip_tags(html_entity_decode($row['card_video'], ENT_QUOTES, 'utf-8'),$allowed_html);
	$co_id = $row["co_id"];
	$site_id = $row["site_id"];
	$user_id = $row["user_id"];
	if (empty($_GET['edit']))
		{ echo '<h1>'.$pagetype.'</h1><hr><p>'.$pagetitle.' must be selected to be edited. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
	else
		{
		if (isset($_POST['submit']))
			{
			$card_front = htmlentities(($_POST['card_front']), ENT_QUOTES, 'utf-8');
			$card_back = htmlentities(($_POST['card_back']), ENT_QUOTES, 'utf-8');
			$card_video = htmlentities(($_POST['video']), ENT_QUOTES, 'utf-8');
			$result = mysql_query("UPDATE card SET card_video='$card_video' WHERE card_id='$card_id' ");
			echo '<h1>'.$pagetype.'</h1><hr><p>Card was edited successfully! You will be redirected to the <a href="/panel/admin/?co='.$co_id.'">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/admin/?co='.$co_id.'>';
			}
		else
			{ echo '<h1>'.$pagetype.'</h1><hr>';
			
			?>
	<?php
		if(!empty($card_front))
			{
			echo '<div class="center"><a href="/assets/img/spotlights/'.$card_front.'"><img src="/assets/img/spotlights/'.$card_front.'" width="350" height="200" border="0"></a></div>';
			}
		else
			{
			echo '<div class="center">'.$old_card_video.'</div>';
			} ?>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $card_id; ?>"><input type="hidden" name="card_id" value="<? echo $row['card_id'];?>">
			<input type="hidden" name="card_front" value="<? echo $card_front; ?>">
			<input type="hidden" name="card_back" value="<? echo $card_back; ?>">
			<fieldset><ul>
		<?php
			if(!empty($old_card_video))
				{
				?>
				<legend>Video:</legend>
				<ul><li><textarea name="video" rows="15"><?php echo $old_card_video; ?></textarea></li>
<?php
				} 
			else
				{}?>
			<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
			
			</form>
<?php		}
		}
	}

elseif(isset($_GET['del']))
	{
	$pagetype = "Delete Spotlight";
	$card_id = $_GET['del'];
	$result = mysql_query("SELECT * FROM card WHERE card_id='$card_id' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$co_id = $row["co_id"];
	if (empty($_GET['del']))
		{
		echo '<p>'.$pagetitle.' must be selected to be deleted. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
		}
	else
		{
		$delpic = mysql_query("SELECT card_front FROM card WHERE card_id='$card_id'");
		while($row = mysql_fetch_array($delpic))
			{
			$file_name = $row['card_front'];
			if(!empty($file_name))
				{
				$file_name;
				$path= '../assets/img/spotlights/'. $file_name .'';
				if(@unlink($path)){/* echo "Deleted file "; */} else{}
				$path2= '../assets/img/spotlights/new-'. $file_name .'';
				if(@unlink($path2)){/* echo "Deleted file "; */} else{}
				$path3= '../assets/img/spotlights/tn-'. $file_name .'';
				if(@unlink($path3)){/* echo "Deleted file "; */} else{}
				}
			else
				{
				}
			}
		$result = mysql_query("DELETE FROM card WHERE '$card_id'=card_id");
		echo '<h1>'.$pagetype.'</h1><hr><p>Deleted! You will be redirected to the <a href="/panel/admin/?co='.$co_id.'">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/admin/?co='.$co_id.'>';
		}
	}

else
	{
	echo '<h1>'.$pagetitle.' &middot; <a href="'.$PHP_SELF.'?add">Add</a></h1>';
	$result = mysql_query("SELECT * FROM card ORDER BY card_id DESC") or die(mysql_error());
	while($row = mysql_fetch_array($result))
		{ $card_id=$row['card_id']; $card_front=$row['card_front']; $card_back=$row['card_back']; $co_id=$row['co_id']; $site_id=$row['site_id'];
			echo '<hr/>';
			if(!empty($card_front)) {echo '<a href="/assets/img/spotlights/'.$card_front.'"><img src="/assets/img/spotlights/'.$card_front.'" width="350" height="200" border="0"></a>';} else {}
			if(!empty($card_back)) {echo '<a href="/assets/img/spotlights/'.$card_back.'"><img src="/assets/img/spotlights/'.$card_back.'" width="350" height="200" border="0"></a>';} else {}
			echo '<p>';
			
			$subresult = mysql_query("SELECT co_name FROM co WHERE $co_id=co_id") or die(mysql_error());
			while($row = mysql_fetch_array($subresult))
				{ $co_name=$row['co_name']; echo $co_name.'<br>';}
			$subresult2 = mysql_query("SELECT site_name FROM site WHERE $site_id=site_id") or die(mysql_error());
			while($row = mysql_fetch_array($subresult2))
				{ $site_name=$row['site_name']; echo $site_name.'<br>';}
			echo '<small><em><a href="'.$PHP_SELF.'?edit='.$card_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$card_id.'">Delete</a></em></small></p>';					
		}
	}





include '../'.$foot; ?>