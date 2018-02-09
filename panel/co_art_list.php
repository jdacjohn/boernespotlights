<?php $pagetitle = "Arts"; include '../core/base.php'; include '../'.$head; check_logged(); check_access(2);





echo '<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>';
echo '<h1>'.$pagetitle.'</h1><hr>';
if(isset($_GET['add']))
	{
	$pagetype = "Add";
	$co_id = $_GET['add'];
	if (isset($_POST['submit']))
		{
		$co_id = $_POST['co_id'];
		$co_art_id = $_POST['co_art_id'];
		$result = mysql_query("INSERT INTO co_art_list (co_id, co_art_id) VALUES ('$co_id','$co_art_id')");
		echo '<p>Added successfully! You will be redirected to the <a href="/panel/co/?co='.$co_id.'">Company View</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/co/?co='.$co_id.'>';
		}
	else
		{ ?>
		<form method="post" action="<?php echo $PHP_SELF; ?>?add" enctype="multipart/form-data">
		<input type="hidden" name="co_id" value="<? echo $co_id; ?>">	
		<fieldset><legend>Add Arts to <?php
		$result = mysql_query("SELECT co_name FROM co WHERE '$co_id'=co_id ORDER BY co_name ASC") or die(mysql_error());
		while($row = mysql_fetch_array($result))
			{
			$co_name = $row['co_name'];
			echo $co_name;
			} ?>:</legend>
		<ul><li><select name="co_art_id"><?php
		$result = mysql_query("SELECT co_art_id, co_art_name FROM co_art WHERE '$site_id'=site_id ORDER BY co_art_id ASC") or die(mysql_error());
		while($row = mysql_fetch_array($result))
			{
			echo '<option value="' . $row['co_art_id'] . '">' . $row['co_art_name'] . '</option>';
			} 
		?></select></li>
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset></form>
<?php	}
	}
	
elseif(isset($_GET['del']))
	{
	$pagetype = "Delete";
	$co_art_list_id = $_GET['del'];	
	if (empty($_GET['del']))
		{ echo '<p>'.$pagetitle.' must be selected to be deleted. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
	else
		{
		$result = mysql_query("SELECT * FROM co_art_list WHERE '$co_art_list_id'=co_art_list_id") or die(mysql_error());
		while($row = mysql_fetch_array($result))
			{
			$co_id = $row['co_id'];
			$resultco = mysql_query("DELETE FROM co_art_list WHERE '$co_art_list_id'=co_art_list_id");
			echo '<p>Deleted! You will be redirected to the <a href="/panel/co/?co='.$co_id.'">Company View</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/co/?co='.$co_id.'>';
			}
		}
	}

else
	{
	echo '<meta http-equiv=Refresh content=0;url=/panel>';
	}





include '../'.$foot; ?>