<?php $pagetitle = "Control Panel"; include '../core/base.php';




		
if(isset($_GET['add']))
	{
	$pagetitle = 'Add Page';
	include '../'.$head; check_logged(); check_access(5);
	if (isset($_POST) && !empty($_POST['page_name']) && !empty($_POST['page_url']) && ($_POST['page_url']!='home')  && ($_POST['page_url']!='contact')  && ($_POST['page_url']!='directory')  && ($_POST['page_url']!='featured')  && ($_POST['page_url']!='register')  && ($_POST['page_url']!='search')  && ($_POST['page_url']!='sponsors'))
		{
		$page_name = htmlentities(($_POST['page_name']), ENT_QUOTES, 'utf-8');
		$page_headline = htmlentities(($_POST['page_headline']), ENT_QUOTES, 'utf-8');
		$page_url_base = strtolower(htmlentities(($_POST['page_url']), ENT_QUOTES, 'utf-8'));
		$page_url = preg_replace("/[^a-zA-Z0-9]/", "", $page_url_base);
		$page_seo_desc = htmlentities(($_POST['page_seo_desc']), ENT_QUOTES, 'utf-8');
		$page_seo_keywords = htmlentities(($_POST['page_seo_keywords']), ENT_QUOTES, 'utf-8');
		$page_full = htmlentities(($_POST['page_full']), ENT_QUOTES, 'utf-8');
		$page_video = htmlentities(($_POST['page_video']), ENT_QUOTES, 'utf-8');
		$page_form = htmlentities(($_POST['page_form']), ENT_QUOTES, 'utf-8');
		$page_form_txt = htmlentities(($_POST['page_form_txt']), ENT_QUOTES, 'utf-8');
		$page_active = htmlentities(($_POST['page_active']), ENT_QUOTES, 'utf-8');
		$page_pass = htmlentities(($_POST['page_pass']), ENT_QUOTES, 'utf-8');
		$getcount = mysql_query("SELECT * FROM page WHERE '$site_id'=site_id", $link);
		$numrows = mysql_num_rows($getcount);
		$page_order = $numrows + 1;
		$page_type = 'page';
		$result = mysql_query("INSERT INTO page (page_name, page_headline, page_url, page_seo_desc, page_seo_keywords, page_full, page_video, page_form, page_form_txt, page_active, page_pass, page_date, page_order, page_type, site_id, user_id) VALUES ('$page_name','$page_headline','$page_url','$page_seo_desc','$page_seo_keywords','$page_full','$page_video','$page_form','$page_form_txt','$page_active','$page_pass',NOW(),'$page_order','$page_type','$site_id','$user_id')");
		echo '<h1>'.$pagetitle.'</h1><hr><p>'.$page_name.' was successfully added! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/site>';
		}
	else
		{
	?>
		
	
	<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>
	<h1>Add Page Entry</h1><hr>
	<form method="post" action="?add" class="page">
	<fieldset>
	    <legend>Page Navigation Name:</legend>
	    <ul><li><input name="page_name" value="<?= @$_POST['page_name']?>" type="text" maxlength="15"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Page Headline:</legend>
	    <ul><li><input name="page_headline" value="<?= @$_POST['page_headline']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Page URL:</legend>
	    <ul><li><input name="page_url" value="<?= @$_POST['page_url']?>" type="text"></li></ul>
	</fieldset>
	
	<fieldset>
		<legend>SEO Description:</legend>
		<ul><li><textarea name="page_seo_desc" class="widgEditor" rows="7"><?php echo $page_seo_desc; ?></textarea></li></ul>
	</fieldset>
				
	<fieldset>
		<legend>SEO Keywords:</legend>
		<ul><li><textarea name="page_seo_keywords" rows="7"><?php echo $page_seo_keywords; ?></textarea></li></ul></fieldset>
	<fieldset>
	
	    <legend>Video:</legend>
	    <ul><li><textarea name="page_video" rows="25"><?= @$_POST['page_video']?></textarea></li></ul>
	</fieldset>
	<fieldset>
		<legend>Entry:</legend>
		<ul><li><textarea name="page_full" rows="25" class="widgEditor"><?= @$_POST['page_full']?></textarea></li></ul>
	</fieldset>
	<fieldset>
	<fieldset>
		<legend>Form On/Off:</legend>
		<ul>			
		<li><select name="page_form">
		<option value="1">On</option>
		<option value="0">Off</option>
		</select></li>
		</ul>
	</fieldset>
	<fieldset>
		<legend>Form Text:</legend>
		<ul><li><textarea name="page_form_txt" rows="25" class="widgEditor"><?php echo $page_form_txt; ?></textarea></li></ul>
	</fieldset>
	<fieldset>
		<legend>On/Off in Navigation:</legend>
		<ul>			
		<li><select name="page_active">
		<option value="1">On</option>
		<option value="0">Off</option>
		</select></li>
		</ul>
	</fieldset>
	<fieldset>
		<legend>Password Protection On/Off:</legend>
		<ul>			
		<li><select name="page_pass">
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
	


elseif(isset($_GET['addlink']))
	{
	$pagetitle = 'Add Link';
	include '../'.$head; check_logged(); check_access(5);
	if (isset($_POST) && !empty($_POST['page_name']) && !empty($_POST['page_url']) && ($_POST['page_url']!='home')  && ($_POST['page_url']!='contact')  && ($_POST['page_url']!='directory')  && ($_POST['page_url']!='featured')  && ($_POST['page_url']!='register')  && ($_POST['page_url']!='search')  && ($_POST['page_url']!='sponsors'))
		{
		$page_name = htmlentities(($_POST['page_name']), ENT_QUOTES, 'utf-8');
		$page_url = htmlentities(($_POST['page_url']), ENT_QUOTES, 'utf-8');
		$page_type = 'link';
		$page_active = htmlentities(($_POST['page_active']), ENT_QUOTES, 'utf-8');
		$getcount = mysql_query("SELECT * FROM page WHERE '$site_id'=site_id", $link);
		$numrows = mysql_num_rows($getcount);
		$page_order = $numrows + 1;
		
		$result = mysql_query("INSERT INTO page (page_name, page_url, page_type, page_active, page_date, page_order, site_id, user_id) VALUES ('$page_name','$page_url','$page_type','$page_active',NOW(),'$page_order','$site_id','$user_id')");
		echo '<h1>'.$pagetitle.'</h1><hr><p>'.$page_name.' was successfully added! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/site>';
		}
	else
		{
	?>
	<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>
	<h1>Add Link</h1><hr>
	<form method="post" action="?addlink" class="page">
	<fieldset>
	    <legend>Link Navigation Name:</legend>
	    <ul><li><input name="page_name" value="<?= @$_POST['page_name']?>" type="text" maxlength="15"></li></ul>
	</fieldset>
	<fieldset>
	    <legend>Link URL:</legend>
	    <ul><li><input name="page_url" value="<?= @$_POST['page_url']?>" type="text"></li></ul>
	</fieldset>
	<fieldset>
		<legend>On/Off in Navigation:</legend>
		<ul>			
		<li><select name="page_active">
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



elseif(isset($_GET['edit']))
	{
	$edit = $_GET['edit'];
	$result = mysql_query("SELECT * FROM page WHERE page_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_page_name = $row["page_name"];
	$edit_page_headline = $row["page_headline"];
	$edit_page_url = $row["page_url"];
	$edit_page_seo_desc = $row["page_seo_desc"];
	$edit_page_seo_keywords = $row["page_seo_keywords"];
	$edit_page_full = $row["page_full"];
	$edit_page_form = $row["page_form"];
	$edit_page_form_txt = $row["page_form_txt"];
	$edit_page_video = $row["page_video"];
	$edit_page_active = $row["page_active"];
	$edit_page_pass = $row["page_pass"];
	$edit_page_date = $row["page_date"];
	$pagetitle = 'Edit '.$edit_page_name;
	include '../'.$head; check_logged(); check_access(5);
	if (empty($_GET['edit']))
		{ echo '<h1>Error</h1><hr><p>Page entry must be selected to be edited. You will be redirected to <a href="/panel/page">Page Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/page>'; }
	else
		{
		echo '<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>';
		echo '<h1>Edit '.$edit_page_name.'</h1><hr>';
		if (isset($_POST) && !empty($_POST['page_name']))
			{
			$page_name = htmlentities(($_POST['page_name']), ENT_QUOTES, 'utf-8');
			$page_headline = htmlentities(($_POST['page_headline']), ENT_QUOTES, 'utf-8');
			$page_url_base = strtolower(htmlentities(($_POST['page_url']), ENT_QUOTES, 'utf-8'));
			$page_url = preg_replace("/[^a-zA-Z0-9]/", "", $page_url_base);
			$page_seo_desc = htmlentities(($_POST['page_seo_desc']), ENT_QUOTES, 'utf-8');
			$page_seo_keywords = htmlentities(($_POST['page_seo_keywords']), ENT_QUOTES, 'utf-8');
			$page_full = htmlentities(($_POST['page_full']), ENT_QUOTES, 'utf-8');
			$page_form = htmlentities(($_POST['page_form']), ENT_QUOTES, 'utf-8');
			$page_form_txt = htmlentities(($_POST['page_form_txt']), ENT_QUOTES, 'utf-8');
			$page_video = htmlentities(($_POST['page_video']), ENT_QUOTES, 'utf-8');
			$page_active = htmlentities(($_POST['page_active']), ENT_QUOTES, 'utf-8');
			$page_pass = htmlentities(($_POST['page_pass']), ENT_QUOTES, 'utf-8');
			$result = mysql_query("UPDATE page SET page_name='$page_name', page_headline='$page_headline', page_url='$page_url', page_seo_desc='$page_seo_desc', page_seo_keywords='$page_seo_keywords', page_full='$page_full', page_form='$page_form', page_form_txt='$page_form_txt', page_video='$page_video', page_active='$page_active', page_pass='$page_pass', page_date=NOW(), user_id='$user_id' WHERE page_id='$edit' ");
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/site>';
			}
		else
			{ ?>
			<form method="post" action="<?php echo $PHP_SELF; ?>?edit=<?php echo $edit; ?>" class="page">			
			<fieldset>
			    <legend>Page Navigation Name:</legend>
			    <ul><li><input name="page_name" value="<?php echo $edit_page_name; ?>" type="text" maxlength="15"></li></ul>
			</fieldset>
			
			<fieldset>
			    <legend>Page Headline:</legend>
			    <ul><li><input name="page_headline" value="<?php echo $edit_page_headline; ?>" type="text"></li></ul>
			</fieldset>
			<?php
			if($edit_page_url=='home' OR $edit_page_url=='contact' OR $edit_page_url=='arts' OR $edit_page_url=='business' OR $edit_page_url=='category' OR $edit_page_url=='community' OR $edit_page_url=='destination' OR $edit_page_url=='featured' OR $edit_page_url=='sponsors' OR $edit_page_url=='panel' OR $edit_page_url=='register' OR $edit_page_url=='search' OR $edit_page_url=='shopbizcard' OR $edit_page_url=='shopsponsor' OR $edit_page_url=='shopvideo')
				{
				echo '<input name="page_url" value="'.$edit_page_url.'" type="hidden">';
				}
			else
				{
			?>
			<fieldset>
			    <legend>Page URL:</legend>
			    <ul><li><input name="page_url" value="<?php echo $edit_page_url; ?>" type="text"></li></ul>
			</fieldset>
			<?php
				}
				
				
			if($edit_page_url=='arts' OR $edit_page_url=='business' OR $edit_page_url=='category' OR $edit_page_url=='community' OR $edit_page_url=='destination' OR $edit_page_url=='panel' OR $edit_page_url=='shopbizcard' OR $edit_page_url=='shopsponsor' OR $edit_page_url=='shopvideo')
				{
				echo '<input name="page_seo_desc" value="'.$edit_page_seo_desc.'" type="hidden">';
				echo '<input name="page_seo_keywords" value="'.$edit_page_seo_keywords.'" type="hidden">';
				}
			else
				{
			?>
			<fieldset>
				<legend>SEO Description:</legend>
				<ul><li><textarea name="page_seo_desc" class="widgEditor" rows="7"><?php echo $edit_page_seo_desc; ?></textarea></li></ul>
			</fieldset>
						
			<fieldset>
				<legend>SEO Keywords:</legend>
				<ul><li><textarea name="page_seo_keywords" rows="7"><?php echo $edit_page_seo_keywords; ?></textarea></li></ul></fieldset>
			<fieldset>
			<?php
				}
				
				
			if($edit_page_url=='arts' OR $edit_page_url=='business' OR $edit_page_url=='category' OR $edit_page_url=='community' OR $edit_page_url=='destination' OR $edit_page_url=='search')
				{
				echo '<input name="page_video" value="'.$edit_page_video.'" type="hidden">';
				}
			else
				{
			?>
			<fieldset>
			    <legend>Video:</legend>
			    <ul><li><textarea name="page_video" class="widgEditor" rows="15"><?php echo $edit_page_video; ?></textarea></li></ul>
			</fieldset>
			<?php
				}
				
			if($edit_page_url=='arts' OR $edit_page_url=='business' OR $edit_page_url=='category' OR $edit_page_url=='community' OR $edit_page_url=='destination' OR $edit_page_url=='search')
				{
				echo '<input name="page_full" value="'.$edit_page_full.'" type="hidden">';
				}
			else
				{
			?>
			<fieldset>
				<legend>Entry:</legend>
				<ul><li><textarea name="page_full" rows="25" class="widgEditor"><?php echo $edit_page_full; ?></textarea></li></ul>
			</fieldset>
			<?php
				}
				
			if($edit_page_url=='home')
				{
			?>
			<fieldset>
				<legend>Form On/Off:</legend>
				<ul>			
				<li><select name="page_form">
				<option value="1"<?php if($edit_page_form=='1'){ echo ' selected'; } else {} ?>>On</option>
				<option value="0"<?php if($edit_page_form=='0'){ echo ' selected'; } else {} ?>>Off</option>
				</select></li>
				</ul>
			</fieldset>
			
			<fieldset>
				<legend>Form Text:</legend>
				<ul><li><textarea name="page_form_txt" rows="25" class="widgEditor"><?php echo $edit_page_form_txt; ?></textarea></li></ul>
			</fieldset>
			<?php 
				}
			else
				{
				echo '<input name="page_form" value="'.$edit_page_form.'" type="hidden">';
				//echo '<input name="page_form_txt" value="'.$page_form_txt.'" type="hidden">';
				}
								
			if($edit_page_url=='panel' OR $edit_page_url=='shopbizcard' OR $edit_page_url=='shopsponsor' OR $edit_page_url=='shopvideo')
				{
				echo '<input name="page_active" value="'.$edit_page_active.'" type="hidden">';
				echo '<input name="page_pass" value="'.$edit_page_pass.'" type="hidden">';
				}
			else
				{
			?>
			<fieldset>
				<legend>On/Off in Navigation:</legend>
				<ul>			
				<li><select name="page_active">
				<option value="1"<?php if($edit_page_active=='1'){ echo ' selected'; } else {} ?>>On</option>
				<option value="0"<?php if($edit_page_active=='0'){ echo ' selected'; } else {} ?>>Off</option>
				</select></li>
				</ul>
			</fieldset>
			<fieldset>
				<legend>Password Protection On/Off:</legend>
				<ul>			
				<li><select name="page_pass">
				<option value="1"<?php if($edit_page_pass=='1'){ echo ' selected'; } else {} ?>>On</option>
				<option value="0"<?php if($edit_page_pass=='0'){ echo ' selected'; } else {} ?>>Off</option>
				</select></li>
				</ul>
			</fieldset>
<?php			}
?>
			<fieldset>
				<ul>
				<li><button type="submit" value="Send" name="submit">Save</button></li>
				</ul>
			</fieldset>
			</form>
<?php
			}
			
		}
	}


elseif(isset($_GET['editlink']))
	{
	$edit = $_GET['editlink'];
	$result = mysql_query("SELECT * FROM page WHERE page_id='$edit' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$edit_page_name = $row["page_name"];
	$edit_page_url = $row["page_url"];
	$edit_page_active = $row["page_active"];
	$pagetitle = 'Edit '.$edit_page_name;
	include '../'.$head; check_logged(); check_access(5);
	if (empty($_GET['editlink']))
		{ echo '<h1>Error</h1><hr><p>Link entry must be selected to be edited. You will be redirected to <a href="/panel/page">Page Admin</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/page>'; }
	else
		{
		echo '<a href="#" onclick="history.go(-1);return false;" class="edit">Back</a>';
		echo '<h1>Edit '.$edit_page_name.'</h1><hr>';
		if (isset($_POST) && !empty($_POST['page_name']) && !empty($_POST['page_url']) && ($_POST['page_url']!='home')  && ($_POST['page_url']!='contact')  && ($_POST['page_url']!='directory')  && ($_POST['page_url']!='featured')  && ($_POST['page_url']!='register')  && ($_POST['page_url']!='search')  && ($_POST['page_url']!='sponsors'))
			{
			$page_name = htmlentities(($_POST['page_name']), ENT_QUOTES, 'utf-8');
			$page_url = $_POST['page_url'];
			$page_active = htmlentities(($_POST['page_active']), ENT_QUOTES, 'utf-8');
			$result = mysql_query("UPDATE page SET page_name='$page_name', page_url='$page_url', page_active='$page_active', page_date=NOW(), user_id='$user_id' WHERE page_id='$edit' ");
			echo '<p>Edited successfully! You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/site>';
			}
		else
			{ ?>
			<form method="post" action="<?php echo $PHP_SELF; ?>?editlink=<?php echo $edit; ?>" class="page">			
			<fieldset>
			    <legend>Link Navigation Name:</legend>
			    <ul><li><input name="page_name" value="<?php echo $edit_page_name; ?>" type="text" maxlength="15"></li></ul>
			</fieldset>
			<fieldset>
			    <legend>Page URL:</legend>
			    <ul><li><input name="page_url" value="<?php echo $edit_page_url; ?>" type="text"></li></ul>
			</fieldset>
			<fieldset>
				<legend>On/Off in Navigation:</legend>
				<ul>			
				<li><select name="page_active">
				<option value="1"<?php if($edit_page_active=='1'){ echo ' selected'; } else {} ?>>On</option>
				<option value="0"<?php if($edit_page_active=='0'){ echo ' selected'; } else {} ?>>Off</option>
				</select></li>
				<li><button type="submit" value="Send" name="submit">Save</button></li>
				</ul>
			</fieldset>
			</form>
<?php
			}
			
		}
	}


else
	{
	$pagetitle = 'Page Admin';
	include '../'.$head; check_logged(); check_access(5);
	echo '<p>You will be redirected to <a href="/panel/site">Site Editor</a> shortly.</p>'.'<meta http-equiv=Refresh content=5;url=/panel/site>';
	}





include '../'.$foot; ?>