<?php $pagetitle = "Category Directory"; include '../core/base.php'; include '../'.$head; check_logged(); check_access(2);





if(isset($_GET['add']))
	{
	$pagetype = "Add";
	if (!empty($_POST['co_cat_name']) && isset($_POST['submit']))
		{
		$co_cat_name = htmlentities(($_POST['co_cat_name']), ENT_QUOTES, 'ISO-8859-1');
		$co_cat_desc = htmlentities(($_POST['co_cat_desc']), ENT_QUOTES, 'ISO-8859-1');
		$result = mysql_query("INSERT INTO co_cat (co_cat_name, co_cat_desc, site_id) VALUES ('$co_cat_name','$co_cat_desc','$site_id')");
		echo '<p>'.$co_cat_name.' was added successfully! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
		}
	else
		{ ?>
		<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>
		<h1>Add Category</h1><hr>
		<form method="post" action="<?php echo $PHP_SELF; ?>?add" enctype="multipart/form-data">
		<fieldset><legend class="<?= (isset($_POST['co_cat_name']) && empty($_POST['co_cat_name']) ? 'error' : '') ?>">Name:</legend>
		<ul><li><input name="co_cat_name" type="text" value="<?= @$_POST['co_cat_name']?>" /></li></ul></fieldset>		
		<fieldset><legend>Description:</legend>
		<ul><li><textarea name="co_cat_desc" class="widgEditor" rows="7"><?= @$_POST['co_cat_desc']?></textarea></li>
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset></form>
<?php	}
	}
	
elseif(isset($_GET['edit']))
	{
	$pagetype = "Edit";
	$co_cat_id = $_GET['edit'];
	$result = mysql_query("SELECT * FROM co_cat WHERE co_cat_id='$co_cat_id' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$co_cat_name = $row["co_cat_name"];
	$co_cat_desc = $row["co_cat_desc"];
	if (empty($_GET['edit']))
		{ echo '<p>'.$pagetitle.' must be selected to be edited. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
	else
		{
		if (!empty($_POST['co_cat_name']) && isset($_POST['submit']))
			{
			$co_cat_name = htmlentities(($_POST['co_cat_name']), ENT_QUOTES, 'ISO-8859-1');
			$co_cat_desc = htmlentities(($_POST['co_cat_desc']), ENT_QUOTES, 'ISO-8859-1');
			$result = mysql_query("UPDATE co_cat SET co_cat_name='$co_cat_name', co_cat_desc='$co_cat_desc' WHERE co_cat_id='$co_cat_id' ");
			echo '<p>'.$co_cat_name.' was edited successfully! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
			}
		else
			{ ?>
			<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>
			<h1>Edit Category</h1><hr>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $co_cat_id; ?>"><input type="hidden" name="co_cat_id" value="<? echo $row['co_cat_id']?>">		
			<fieldset><legend class="<?= (isset($_POST['co_cat_name']) && empty($_POST['co_cat_name']) ? 'error' : '') ?>">Name:</legend>
			<ul><li><input name="co_cat_name" type="text" id="co_cat_name" value="<? echo $co_cat_name; ?>" /></li></ul></fieldset>			
			<fieldset><legend>Description:</legend>
			<ul><li><textarea name="co_cat_desc" class="widgEditor" rows="7"><? echo $co_cat_desc ?></textarea></li>
			<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset></form>
<?php		}
		}
	}

elseif(isset($_GET['del']))
	{
	$pagetype = "Delete";
	$co_cat_id = $_GET['del'];	
	$del = mysql_query("SELECT * FROM co_cat WHERE '$co_cat_id'=co_cat_id");
	
	if (empty($_GET['del']))
		{ echo '<p>'.$pagetitle.' must be selected to be deleted. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
	else
		{
		$result = mysql_query("DELETE FROM co_cat WHERE '$co_cat_id'=co_cat_id");
		$resultcat = mysql_query("DELETE FROM co_cat WHERE '$co_cat_id'=co_cat_id");
		echo '<p>Deleted! You will be redirected to the <a href="'.$PHP_SELF.'">'.$pagetitle.'</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'>';
		}
	}
	
else
	{
	echo '<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>';
	echo '<h1>'.$pagetitle.' &middot; <a href="'.$PHP_SELF.'?add">Add</a></h1><div class="admin">';
	$result = mysql_query("SELECT * FROM co_cat WHERE '$site_id'=site_id ORDER BY co_cat_name ASC") or die(mysql_error());
	while($row = mysql_fetch_array($result))
		{
		$co_cat_id=$row['co_cat_id'];
		$co_cat_name=$row['co_cat_name'];
		$co_cat_desc=$row['co_cat_desc'];
		echo '<hr/><h2>'.$co_cat_name.'</h2><p>';
		if(!empty($co_cat_desc))
			{
			echo $co_cat_desc.'<br>';
			}
		else
			{}
		echo '<em><a href="'.$PHP_SELF.'?edit='.$co_cat_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$co_cat_id.'">Delete</a></em></p>';				
		}
	echo '</div>';
	}





include '../'.$foot; ?>