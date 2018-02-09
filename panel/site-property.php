<?php $pagetitle = "Properties"; include '../core/base.php'; include '../'.$head; check_logged(); check_access(2);





if(isset($_GET['add']))
	{
	$pagetype = "Add Property";
	if (!empty($_POST['site_name']) && isset($_POST['submit']))
		{
		$site_name = htmlentities(($_POST['site_name']), ENT_QUOTES, 'ISO-8859-1');
		$site_desc = htmlentities(($_POST['site_desc']), ENT_QUOTES, 'ISO-8859-1');
		$site_domain = htmlentities(($_POST['site_domain']), ENT_QUOTES, 'ISO-8859-1');
		$site_url = htmlentities(($_POST['site_url']), ENT_QUOTES, 'ISO-8859-1');
		$site_tagline = htmlentities(($_POST['site_tagline']), ENT_QUOTES, 'ISO-8859-1');
		$site_keywords = htmlentities(($_POST['site_keywords']), ENT_QUOTES, 'ISO-8859-1');
		$site_desc = htmlentities(($_POST['site_desc']), ENT_QUOTES, 'ISO-8859-1');
		$result = mysql_query("INSERT INTO site (site_name, site_domain, site_url, site_tagline, site_keywords, site_desc) VALUES ('$site_name','$site_domain','$site_url','$site_tagline','$site_keywords','$site_desc')");
		echo '<h1>'.$$pagetype.'</h1><hr><p>'.$site_name.' was added successfully! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
		}
	else
		{ ?>
		<h1><?php echo $pagetype; ?></h1><hr>
		<form method="post" action="<?php echo $PHP_SELF; ?>?add" enctype="multipart/form-data">
		
		<fieldset><legend class="<?= (isset($_POST['site_name']) && empty($_POST['site_name']) ? 'error' : '') ?>">Name:</legend>
		<ul><li><input name="site_name" type="text" value="<?= @$_POST['site_name']?>" /></li></ul></fieldset>
		
		<fieldset><legend>Domain:</legend>
		<ul><li><input name="site_domain" type="text" value="<?= @$_POST['site_domain']?>" /></li></ul></fieldset>
		
		<fieldset><legend>URL:</legend>
		<ul><li><input name="site_url" type="text" value="<?= @$_POST['site_url']?>" /></li></ul></fieldset>
		
		<fieldset><legend>Tagline:</legend>
		<ul><li><input name="site_tagline" type="text" value="<?= @$_POST['site_tagline']?>" /></li></ul></fieldset>
		
		<fieldset><legend>Keywords:</legend>
		<ul><li><textarea name="site_keywords" rows="3"><?= @$_POST['site_keywords']?></textarea></li></ul>
		
		<fieldset><legend>Description:</legend>
		<ul><li><textarea name="site_desc" rows="7"><?= @$_POST['site_desc']?></textarea></li>
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
		
		</form>
<?php	}
	}
		
elseif(isset($_GET['edit']))
	{
	$pagetype = "Edit Property";
	$site_id = $_GET['edit'];
	$result = mysql_query("SELECT * FROM site WHERE site_id='$site_id' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$site_name = $row["site_name"];
	$site_desc = $row["site_desc"];
	$site_domain = $row["site_domain"];
	$site_url = $row["site_url"];
	$site_tagline = $row["site_tagline"];
	$site_keywords = $row["site_keywords"];
	$site_desc = $row["site_desc"];
	if (empty($_GET['edit']))
		{ echo '<p>'.$pagetitle.' must be selected to be edited. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
	else
		{
		if (!empty($_POST['site_name']) && isset($_POST['submit']))
			{
			
			$site_name = htmlentities(($_POST['site_name']), ENT_QUOTES, 'ISO-8859-1');
			$site_desc = htmlentities(($_POST['site_desc']), ENT_QUOTES, 'ISO-8859-1');
			$site_domain = htmlentities(($_POST['site_domain']), ENT_QUOTES, 'ISO-8859-1');
			$site_url = htmlentities(($_POST['site_url']), ENT_QUOTES, 'ISO-8859-1');
			$site_tagline = htmlentities(($_POST['site_tagline']), ENT_QUOTES, 'ISO-8859-1');
			$site_keywords = htmlentities(($_POST['site_keywords']), ENT_QUOTES, 'ISO-8859-1');
			$site_desc = htmlentities(($_POST['site_desc']), ENT_QUOTES, 'ISO-8859-1');
			$result = mysql_query("UPDATE site SET site_name='$site_name', site_desc='$site_desc', site_domain='$site_domain', site_url='$site_url', site_tagline='$site_tagline', site_keywords='$site_keywords', site_desc='$site_desc' WHERE site_id='$site_id' ");
			echo '<h1>'.$pagetype.'</h1><hr><p>'.$site_name.' was edited successfully! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
			}
		else
			{ ?>
			<h1><?php echo $pagetype; ?></h1><hr>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $site_id; ?>"><input type="hidden" name="site_id" value="<? echo $row['site_id']?>">
				
			<fieldset><legend class="<?= (isset($_POST['site_name']) && empty($_POST['site_name']) ? 'error' : '') ?>">Name:</legend>
			<ul><li><input name="site_name" type="text" value="<?php echo $site_name; ?>" /></li></ul></fieldset>
			
			<fieldset><legend>Domain:</legend>
			<ul><li><input name="site_domain" type="text" value="<?php echo $site_domain; ?>" /></li></ul></fieldset>
			
			<fieldset><legend>URL:</legend>
			<ul><li><input name="site_url" type="text" value="<?php echo $site_url; ?>" /></li></ul></fieldset>
			
			<fieldset><legend>Tagline:</legend>
			<ul><li><input name="site_tagline" type="text" value="<?php echo $site_tagline; ?>" /></li></ul></fieldset>
			
			<fieldset><legend>Keywords:</legend>
			<ul><li><textarea name="site_keywords" rows="3"><?php echo $site_keywords; ?></textarea></li></ul>
			
			<fieldset><legend>Description:</legend>
			<ul><li><textarea name="site_desc" rows="7"><?php echo $site_desc; ?></textarea></li>
			<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset>
			
			</form>
<?php		}
		}
	}
elseif(isset($_GET['del']))
	{
	$pagetitle = "Delete Property";
	$site_id = $_GET['del'];	
	$del = mysql_query("SELECT * FROM site WHERE '$site_id'=site_id");
	if (empty($_GET['del']))
		{ echo '<p>'.$pagetitle.' must be selected to be deleted. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
	else
		{
		echo '<h1>'.$pagetitle.'</h1><hr>';
		$result = mysql_query("DELETE FROM site WHERE '$site_id'=site_id");
		echo '<p>Deleted! You will be redirected to the <a href="'.$PHP_SELF.'">'.$pagetitle.'</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'>';
		}
	}
else
	{
	echo '<h1>'.$pagetitle.' &middot; <a href="'.$PHP_SELF.'?add">Add</a></h1>';
	$result = mysql_query("SELECT * FROM site ORDER BY site_name ASC") or die(mysql_error());
	while($row = mysql_fetch_array($result))
		{ $site_id=$row['site_id']; $site_name=$row['site_name']; $site_desc=$row['site_desc']; $site_url=$row['site_url'];
			echo '
			<hr/>
			
			<h2><a href="http://'.$site_url.'" target="_blank">'.$site_name.'</a></h2>
			<p>'.$site_desc.'<br><small><em><a href="'.$PHP_SELF.'?edit='.$site_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$site_id.'">Delete</a></em></small></p>';					
		}
	}





include '../'.$foot; ?>