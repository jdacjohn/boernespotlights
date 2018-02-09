<?php $pagetitle = "Destination"; include '../core/base.php'; include '../'.$head; check_logged(); check_access(2);





echo '<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>';
echo '<h1>'.$pagetitle.'</h1><hr>';
if(isset($_GET['add']))
	{
	$pagetype = "Add";
	$co_id = $_GET['add'];
	if (isset($_POST['submit']))
		{
		$co_id = $_POST['co_id'];
		$dest_id = $_POST['dest_id'];
		$result = mysql_query("INSERT INTO co_dest (co_id, dest_id) VALUES ('$co_id','$dest_id')");
		echo '<p>Added successfully! You will be redirected to the <a href="/panel/co/?co='.$co_id.'">Company View</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/co/?co='.$co_id.'>';
		}
	else
		{ ?>
		<form method="post" action="<?php echo $PHP_SELF; ?>?add" enctype="multipart/form-data">
		<input type="hidden" name="co_id" value="<? echo $co_id; ?>">	
		<fieldset><legend>Add Destination to <?php
		$result = mysql_query("SELECT co_name FROM co WHERE '$co_id'=co_id ORDER BY co_name ASC") or die(mysql_error());
		while($row = mysql_fetch_array($result))
			{
			$co_name = $row['co_name'];
			echo $co_name;
			} ?>:</legend>
		<ul><li><select name="dest_id"><?php
		$result = mysql_query("SELECT dest_id, dest_name FROM dest ORDER BY dest_id ASC") or die(mysql_error());
		while($row = mysql_fetch_array($result))
			{
			echo '<option value="' . $row['dest_id'] . '">' . $row['dest_name'] . '</option>';
			} 
		?></select></li>
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset></form>
<?php	}
	}
	
elseif(isset($_GET['del']))
	{
	$pagetype = "Delete";
	$co_dest_id = $_GET['del'];	
	if (empty($_GET['del']))
		{ echo '<p>'.$pagetitle.' must be selected to be deleted. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
	else
		{
		$result = mysql_query("SELECT * FROM co_dest WHERE '$co_dest_id'=co_dest_id") or die(mysql_error());
		while($row = mysql_fetch_array($result))
			{
			$co_id = $row['co_id'];
			$resultco = mysql_query("DELETE FROM co_dest WHERE '$co_dest_id'=co_dest_id");
			echo '<p>Deleted! You will be redirected to the <a href="/panel/co/?co='.$co_id.'">Company View</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/co/?co='.$co_id.'>';
			}
		}
	}

else
	{
	echo '<meta http-equiv=Refresh content=0;url=/panel>';
	}





include '../'.$foot; ?>