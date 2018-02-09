<?php $pagetitle = "Categories"; include '../core/base.php'; include '../'.$head; check_logged(); check_access(2);





if(isset($_GET['add']))
	{
	$pagetype = "Add";
	if (!empty($_POST['cat_name']) && isset($_POST['submit']))
		{
		$cat_name = htmlentities(($_POST['cat_name']), ENT_QUOTES, 'ISO-8859-1');
		$cat_desc = htmlentities(($_POST['cat_desc']), ENT_QUOTES, 'ISO-8859-1');
		$result = mysql_query("INSERT INTO cat (cat_name, cat_desc) VALUES ('$cat_name','$cat_desc')");
		echo '<p>'.$cat_name.' was added successfully! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
		}
	else
		{ ?>
		<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>
		<h1>Add Category</h1><hr>
		<form method="post" action="<?php echo $PHP_SELF; ?>?add" enctype="multipart/form-data">
		<fieldset><legend class="<?= (isset($_POST['cat_name']) && empty($_POST['cat_name']) ? 'error' : '') ?>">Name:</legend>
		<ul><li><input name="cat_name" type="text" value="<?= @$_POST['cat_name']?>" /></li></ul></fieldset>		
		<fieldset><legend>Description:</legend>
		<ul><li><textarea name="cat_desc" rows="7"><?= @$_POST['cat_desc']?></textarea></li>
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset></form>
<?php	}
	}
	
elseif(isset($_GET['edit']))
	{
	$pagetype = "Edit";
	$cat_id = $_GET['edit'];
	$result = mysql_query("SELECT * FROM cat WHERE cat_id='$cat_id' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$cat_name = $row["cat_name"];
	$cat_desc = $row["cat_desc"];
	if (empty($_GET['edit']))
		{ echo '<p>'.$pagetitle.' must be selected to be edited. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
	else
		{
		if (!empty($_POST['cat_name']) && isset($_POST['submit']))
			{
			$cat_name = htmlentities(($_POST['cat_name']), ENT_QUOTES, 'ISO-8859-1');
			$cat_desc = htmlentities(($_POST['cat_desc']), ENT_QUOTES, 'ISO-8859-1');
			$result = mysql_query("UPDATE cat SET cat_name='$cat_name', cat_desc='$cat_desc' WHERE cat_id='$cat_id' ");
			echo '<p>'.$cat_name.' was edited successfully! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
			}
		else
			{ ?>
			<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>
			<h1>Edit Category</h1><hr>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $cat_id; ?>"><input type="hidden" name="cat_id" value="<? echo $row['cat_id']?>">		
			<fieldset><legend class="<?= (isset($_POST['cat_name']) && empty($_POST['cat_name']) ? 'error' : '') ?>">Name:</legend>
			<ul><li><input name="cat_name" type="text" id="cat_name" value="<? echo $cat_name; ?>" /></li></ul></fieldset>			
			<fieldset><legend>Description:</legend>
			<ul><li><textarea name="cat_desc" rows="7"><? echo $cat_desc ?></textarea></li>
			<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset></form>
<?php		}
		}
	}

elseif(isset($_GET['del']))
	{
	$pagetype = "Delete";
	$cat_id = $_GET['del'];	
	$del = mysql_query("SELECT * FROM cat WHERE '$cat_id'=cat_id");
	if (empty($_GET['del']))
		{ echo '<h1>Delete Category</h1><hr><p>'.$pagetitle.' must be selected to be deleted. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
	elseif ($_GET['del'] == '14')
		{ echo '<h1>Delete Category</h1><hr><p>Sponsors Category cannot be deleted. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
	elseif ($_GET['del'] == '17')
		{ echo '<h1>Delete Category</h1><hr><p>Featured Category cannot be deleted. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
	else
		{
		$resultCoCat = mysql_query("DELETE FROM cocat WHERE '$cat_id'=cat_id");
		$resultCat = mysql_query("DELETE FROM cat WHERE '$cat_id'=cat_id");
		echo '<h1>Delete Category</h1><hr><p>Deleted! You will be redirected to the <a href="'.$PHP_SELF.'">'.$pagetitle.'</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'>';
		}
	}
	
else
	{
	echo '<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>';
	echo '<h1>'.$pagetitle.' &middot; <a href="'.$PHP_SELF.'?add">Add</a></h1><div class="admin">';
	$result = mysql_query("SELECT * FROM cat WHERE cat_id!='14' AND cat_id!='17' ORDER BY cat_name ASC") or die(mysql_error());
	while($row = mysql_fetch_array($result))
		{
		$cat_id=$row['cat_id']; $cat_name=$row['cat_name']; $cat_desc=$row['cat_desc'];
		echo '<hr/><h2>'.$cat_name.'</h2><p>';
		if(!empty($cat_desc))
			{
			echo $cat_desc.'<br>';
			}
		else
			{}
		echo '<em><a href="'.$PHP_SELF.'?edit='.$cat_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$cat_id.'">Delete</a></em></p>';			
		}
	echo '</div>';
	}





include '../'.$foot; ?>