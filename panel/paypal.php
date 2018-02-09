<?php $pagetitle = "PayPal Buttons"; include '../core/base.php'; include '../'.$head; check_logged(); check_access(2);




//cart_item, cart_type, cart_site_id FROM cart WHERE cart_item='$item_number'
if(isset($_GET['add']))
	{
	$pagetype = "Add";
	if (!empty($_POST['cart_item']) && isset($_POST['submit']))
		{
		$cart_item = htmlentities(($_POST['cart_item']), ENT_QUOTES, 'ISO-8859-1');
		$cart_type = htmlentities(($_POST['cart_type']), ENT_QUOTES, 'ISO-8859-1');
		$result = mysql_query("INSERT INTO cart (cart_item, cart_type, cart_site_id) VALUES ('$cart_item','$cart_type','$site_id')");
		echo '<p>'.$cart_item.' was added successfully! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
		}
	else
		{ ?>
		<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>
		<h1>Add PayPal Item Number</h1><hr>
		<form method="post" action="<?php echo $PHP_SELF; ?>?add" enctype="multipart/form-data">
		<fieldset><legend class="<?= (isset($_POST['cart_item']) && empty($_POST['cart_item']) ? 'error' : '') ?>">Name:</legend>
		<ul><li><input name="cart_item" type="text" value="<?= @$_POST['cart_item']?>" /></li></ul></fieldset>		
		<fieldset><legend>Type:</legend>
		<ul>
		<li><select name="cart_type">
		<option value="card1">BizCard Spotlight</option>
		<option value="video1">Video Spotlight</option>
		<option value="video2">Video Spotlight Interview</option>
		<option value="sponsor1">Sponsor</option>
		</select></li>
		<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset></form>
<?php	}
	}
	
elseif(isset($_GET['edit']))
	{
	$pagetype = "Edit";
	$cart_id = $_GET['edit'];
	$result = mysql_query("SELECT * FROM cart WHERE cart_id='$cart_id' AND cart_site_id='$site_id' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$cart_item = $row["cart_item"];
	$cart_type = $row["cart_type"];
	if (empty($_GET['edit']))
		{ echo '<p>'.$pagetitle.' must be selected to be edited. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
	else
		{
		if (!empty($_POST['cart_item']) && isset($_POST['submit']))
			{
			$cart_item = htmlentities(($_POST['cart_item']), ENT_QUOTES, 'ISO-8859-1');
			$cart_type = htmlentities(($_POST['cart_type']), ENT_QUOTES, 'ISO-8859-1');
			$result = mysql_query("UPDATE cart SET cart_item='$cart_item', cart_type='$cart_type' WHERE cart_id='$cart_id' ");
			echo '<p>'.$cart_item.' was edited successfully! You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>';
			}
		else
			{ ?>
			<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>
			<h1>Edit PayPal Item Number</h1><hr>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $cart_id; ?>"><input type="hidden" name="cart_id" value="<? echo $row['cart_id']?>">		
			<fieldset><legend class="<?= (isset($_POST['cart_item']) && empty($_POST['cart_item']) ? 'error' : '') ?>">Name:</legend>
			<ul><li><input name="cart_item" type="text" id="cart_item" value="<? echo $cart_item; ?>" /></li></ul></fieldset>			
			<fieldset><legend>Type:</legend>
			<ul><li><select name="cart_type"><?php
			if($cart_type=='card1'){echo '<option value="card1" selected>BizCard Spotlight</option>';} else{echo '<option value="card1">BizCard Spotlight</option>';}
			if($cart_type=='video1'){echo '<option value="video1" selected>Video Spotlight</option>';} else{echo '<option value="video1">Video Spotlight</option>';}
			if($cart_type=='video2'){echo '<option value="video2" selected>Video Spotlight Interview</option>';} else{echo '<option value="video2">Video Spotlight Interview</option>';}
			if($cart_type=='sponsor1'){echo '<option value="sponsor1" selected>Sponsor</option>';} else{echo '<option value="sponsor1">Sponsor</option>';}
			?></select></li>
			<li><button type="button" onclick="history.go(-1);return false;">Cancel</button><button type="submit" name="submit">Save</button></li></ul></fieldset></form>
<?php		}
		}
	}

elseif(isset($_GET['del']))
	{
	$pagetype = "Delete";
	$cart_id = $_GET['del'];	
	$del = mysql_query("SELECT * FROM cart WHERE '$cart_id'=cart_id AND card_site_id='$site_id'");
	
	if (empty($_GET['del']))
		{ echo '<p>'.$pagetitle.' must be selected to be deleted. You will be redirected to the <a href="/panel">Control Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel>'; }
	else
		{
		$result = mysql_query("DELETE FROM co_cart WHERE '$cart_id'=cart_id");
		$resultcart = mysql_query("DELETE FROM cart WHERE '$cart_id'=cart_id");
		echo '<p>Deleted! You will be redirected to the <a href="'.$PHP_SELF.'">'.$pagetitle.'</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url='.$PHP_SELF.'>';
		}
	}
	
else
	{
	echo '<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>';
	echo '<h1>'.$pagetitle.' &middot; <a href="'.$PHP_SELF.'?add">Add</a></h1><div class="admin">';
	$result = mysql_query("SELECT * FROM cart WHERE $site_id=cart_site_id ORDER BY cart_item ASC") or die(mysql_error());
	while($row = mysql_fetch_array($result))
		{
		$cart_id=$row['cart_id']; $cart_item=$row['cart_item']; $cart_type=$row['cart_type'];
		echo '<hr/><h2>'.$cart_item.'</h2><p>';
		if($cart_type=='card1'){echo 'BizCard Spotlight';}
		if($cart_type=='video1'){echo 'Video Spotlight';}
		if($cart_type=='video2'){echo 'Video Spotlight Interview';}
		if($cart_type=='sponsor1'){echo 'Sponsor';}
		echo '<br><em><a href="'.$PHP_SELF.'?edit='.$cart_id.'">Edit</a> &middot; <a href="'.$PHP_SELF.'?del='.$cart_id.'">Delete</a></em></p>';				
		}
	echo '</div>';
	}





include '../'.$foot; ?>