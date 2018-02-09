<?php

/*title*/
if(!empty($pagetitle))
	{
	if(!empty($pagetype))
		{
		$title = $pagetype.' '.$pagetitle.' &middot; '.$site_name;
		}
	else
		{
		$title = $pagetitle.' &middot; '.$site_name;
		}
	}
else
	{
	$title = $site_name;
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $title; ?></title>
<?php 
if($seo_desc!=''){echo '<meta name="description" content="'.$seo_desc.'" />';} else {echo '<meta name="description" content="'.$site_desc.'" />';}
if($seo_keywords!=''){echo '<meta name="keywords" content="'.$seo_keywords.'" />';}
?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="utf-8">
<meta property="og:description" content="<?php echo $site_desc ;?>"/>
<meta property="og:type" content="article"/>
<meta property="og:url" content="<?php echo current_url();?>"/>
<meta property="og:site_name" content="<?php echo $site_name; ?>"/>
<meta property="og:title" content="<?php echo $title; ?>"/>
<?php
if(!empty($facebookOg))
	{
	echo $facebookOg; 
	}
?>
<link type="text/css" href="<?php echo 'http://'.$site_url; ?>/assets/css/jquery.css" rel="stylesheet" media="screen">
<link type="text/css" href="<?php echo 'http://'.$site_url; ?>/assets/css/style.css" rel="stylesheet" media="screen">
<link type="text/css" href="<?php echo 'http://'.$site_url; ?>/assets/css/print.css" rel="stylesheet" media="print">
<!--[if IE]>
<link type="text/css" href="<?php echo 'http://'.$site_url; ?>/assets/css/style-ie.css" rel="stylesheet" />
<![endif]-->
<script type="text/javascript" src="<?php echo 'http://'.$site_url; ?>/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo 'http://'.$site_url; ?>/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo 'http://'.$site_url; ?>/assets/js/json.js"></script>
<script type="text/javascript" src="<?php echo 'http://'.$site_url; ?>/assets/js/cropper.js"></script>
<script type="text/javascript" src="<?php echo 'http://'.$site_url; ?>/assets/js/script.js"></script>
<script type="text/javascript" src="<?php echo 'http://'.$site_url; ?>/assets/js/contentslider.js"></script>
<script type="text/javascript">var switchTo5x=false;</script><script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'fc7013e1-cfe7-4a58-80a2-b9308ae33a4b'});</script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="container">
<div class="head">
<?php
if($user_log<='1')
{
	// Only show the control panel nav on non-VIP pages
	if (!isset($_GET['vip'])) {
		echo '<ul class="nav"><li id="home"><a href="http://'.$site_url.'/'.$site_index.'">Home</a></li><li>';
		//greeting based on time
		$differencetolocaltime=2; $new_U=date("U")+$differencetolocaltime*3600; $fulllocaldatetime= date("d-m-Y h:i:s A", $new_U); $hour = date("H", $new_U);
		// 13 = 11
		if ($hour < 14) 	{ echo 'Good morning '; }
			elseif ($hour < 15) { echo 'Hello '; }
			elseif ($hour < 18) { echo 'Good afternoon '; }
			elseif ($hour < 20) { echo 'Hello '; }
		else 			{ echo 'Good evening '; }
		//first name of user
		if($user_name_f!=''){echo $user_name_f;}else{echo $user_login;}
		echo ' <em>|</em> <a href="/panel/">Control Panel</a> <em>|</em> <a href="/login/?logoff">Log Off</a></li></ul>';
	}
	
	$vip = $_REQUEST['vip'];
	$vip_id = mysql_escape_string($vip);

	if (!empty($vip_id))
		{
		$result = mysql_query("SELECT * FROM vip WHERE vip_url='$vip_id' AND site_id='$site_id'");

		if (mysql_num_rows($result) > 0)
			{
			while($row = mysql_fetch_array($result))
				{	
				$vip_banner1 = $row['vip_banner1'];
				$vip_banner1_url = $row['vip_banner1_url'];
				if(!empty($row['vip_banner1_newwindow'])){$vip_banner1_newwindow = "_blank"; }
				$vip_banner2 = $row['vip_banner2'];
				$vip_banner2_url = $row['vip_banner2_url'];
				if(!empty($row['vip_banner2_newwindow'])){$vip_banner2_newwindow = "_blank"; }
				$vip_banner3 = $row['vip_banner3'];
				$vip_banner3_url = $row['vip_banner3_url'];
				if(!empty($row['vip_banner3_newwindow'])){$vip_banner3_newwindow = "_blank"; }
				}
			}
		}
		
	if(!empty($vip_banner1) || !empty($vip_banner2)  || !empty($vip_banner3))
		{
		?>
		<div id="banner">	
		<style>
		#slider1 .pagination{display: none;}
		</style>
		<div id="slider1" class="contentslide">
			<div class="opacitylayer">	
				<?php if(!empty($vip_banner2)){	?>	
					<div class="contentdiv">
						<?php echo '<a href="'.$vip_banner2_url.'" target="'.$vip_banner2_newwindow.'"><img src="http://'.$site_url.'/assets/img/'.$vip_banner2.'" alt="'.$site_name.'" width="960" height="190" ></a>'; ?>
								</div>
				<?php } ?>
				<?php if(!empty($vip_banner1)){	?>						
					<div class="contentdiv">		
						<?php echo '<a href="'.$vip_banner1_url.'" target="'.$vip_banner1_newwindow.'"><img src="http://'.$site_url.'/assets/img/'.$vip_banner1.'" alt="'.$site_name.'" width="960" height="190" ></a>'; ?>
					</div>
				<?php } ?>
				<?php if(!empty($vip_banner3)){	?>	
					<div class="contentdiv">
						<?php echo '<a href="'.$vip_banner3_url.'" target="'.$vip_banner3_newwindow.'"><img src="http://'.$site_url.'/assets/img/'.$vip_banner3.'" alt="'.$site_name.'" width="960" height="190" ></a>'; ?>
					</div>
				<?php } ?>
					</div>
			<div class="pagination" id="paginate-slider1"></div>
			<script type="text/javascript">
				ContentSlider("slider1", 7000)
			</script>
		</div>
		</div>
			<?php
		}
	elseif(!empty($site_banner2) || !empty($site_banner3) || !empty($site_banner1) )
		{
	?>
	<div id="banner">	
	<style>
	#slider1 .pagination{display: none;}
	</style>
	<div id="slider1" class="contentslide">
		<div class="opacitylayer">	
			<?php if(!empty($site_banner2)){	?>	
				<div class="contentdiv">
					<?php echo '<a href="'.$site_banner2_url.'"><img src="http://'.$site_url.'/assets/img/'.$site_banner2.'" alt="'.$site_name.'" width="960" height="190" target="_blank"></a>'; ?>
				</div>
			<?php } ?>
			<?php if(!empty($site_banner1)){	?>						
				<div class="contentdiv">		
					<?php echo '<a href="'.$site_banner1_url.'"><img src="http://'.$site_url.'/assets/img/'.$site_banner1.'" alt="'.$site_name.'" width="960" height="190" target="_blank"></a>'; ?>
				</div>
			<?php } ?>
			<?php if(!empty($site_banner3)){	?>	
				<div class="contentdiv">
					<?php echo '<a href="'.$site_banner3_url.'"><img src="http://'.$site_url.'/assets/img/'.$site_banner3.'" alt="'.$site_name.'" width="960" height="190" target="_blank"></a>'; ?>
				</div>
			<?php } ?>
				</div>
		<div class="pagination" id="paginate-slider1"></div>
		<script type="text/javascript">
			ContentSlider("slider1", 7000)
		</script>
	</div>
		
			
		</div>
	<?php
		}
	else
		{
		echo '<img src="http://'.$site_url.'/assets/img/bg-body.gif" alt="'.$site_name.'" width="960" height="190">';	
		}
	echo '';
}
else
{
	?>
	<form action="<?php echo 'http://'.$site_url; ?>/login.php?Login" method="post" class="nav">
	<fieldset id="home">
	<?php echo '<a href="http://'.$site_url.'/'.$site_index.'">Home</a>'; ?>
	</fieldset>
	<fieldset>
	<a href="/register/">Register</a> <em>|</em>
	<span>email:</span>
	<input type="text" name="user_login">
	<span>password:</span>
	<input type="password" name="user_pass">
	<input type="submit" name="submit" value="Log In" class="login">
	</fieldset>
	</form> 
	<?php
	//////////////////// Below Controls Banner for VIP Pages ///////////////////
	

	echo '<a href="http://'.$site_url.'/'.$site_banner1_url.'">';
	if(!empty($site_banner1))
		{
		echo '<img src="http://'.$site_url.'/assets/img/'.$site_banner1.'" alt="'.$site_name.'" width="960" height="190">';
		}
	else
		{
		echo '<img src="http://'.$site_url.'/assets/img/bg-body.gif" alt="'.$site_name.'" width="960" height="190">';	
		}
	echo '</a>';
}
if(isset($_GET['vip'])){
 $vip_url = $_GET['vip'];
 $vip_sql = "SELECT * FROM `vip` WHERE vip_url='$vip_url'";
 $vip_result = mysql_query($vip_sql);
 while($rows = mysql_fetch_array($vip_result)){
 	$nav_bar = $rows['nav_bar'];
 }
}
if($nav_bar == 1 || !isset($_GET['vip'])){
echo '<ul class="subnav">';
$nav_query  = "SELECT page_url, page_name, page_type FROM page WHERE '$site_id'=site_id AND '1'=page_active ORDER BY page_order ASC LIMIT 0, 6";
$nav_result = mysql_query($nav_query);
while($nav_row = mysql_fetch_array($nav_result))
	{
	$nav_page_url = $nav_row['page_url'];
	$nav_page_name = $nav_row['page_name'];
	$nav_page_type = $nav_row['page_type'];
	if($nav_page_type=='page')
		{
		if($nav_page_url=='destination')
			{
			echo '<li class="top drop"><em>'.$nav_page_name.'</em><ul>';
			$sub2result = mysql_query("SELECT DISTINCT co_dest.co_dest_id, co_dest.co_dest_name FROM co_dest, co_dest_list, card, co WHERE $site_id=card.site_id and co_dest_list.co_id=card.co_id and co_dest_list.co_dest_id=co_dest.co_dest_id ORDER BY co_dest.co_dest_name ASC") or die(mysql_error());
				while($sub2row = mysql_fetch_array($sub2result))
				{
				$co_dest_id=$sub2row['co_dest_id'];
				$co_dest_name=$sub2row['co_dest_name'];
				echo '<li><a href="http://'.$site_url.'/destination/'.$co_dest_id.'">'.$co_dest_name.'</a></li>';
				}
			echo '</ul></li>';
			}
		
		elseif($nav_page_url=='arts')
			{
			echo '<li class="top drop"><em>'.$nav_page_name.'</em><ul>';
			$sub2result = mysql_query("SELECT DISTINCT co_art.co_art_id, co_art.co_art_name FROM co_art, co_art_list, card, co WHERE $site_id=card.site_id and co_art_list.co_id=card.co_id and co_art_list.co_art_id=co_art.co_art_id ORDER BY co_art.co_art_name ASC") or die(mysql_error());
				while($sub2row = mysql_fetch_array($sub2result))
				{
				$co_art_id=$sub2row['co_art_id'];
				$co_art_name=$sub2row['co_art_name'];
				echo '<li><a href="http://'.$site_url.'/arts/'.$co_art_id.'">'.$co_art_name.'</a></li>';
				}
			echo '</ul></li>';
			}
		elseif($nav_page_url=='business')
			{
			echo '<li class="top drop"><em>'.$nav_page_name.'</em><ul>';
			$sub2result = mysql_query("SELECT DISTINCT co_bus.co_bus_id, co_bus.co_bus_name FROM co_bus, co_bus_list, card, co WHERE $site_id=card.site_id and co_bus_list.co_id=card.co_id and co_bus_list.co_bus_id=co_bus.co_bus_id ORDER BY co_bus.co_bus_name ASC") or die(mysql_error());
				while($sub2row = mysql_fetch_array($sub2result))
				{
				$co_bus_id=$sub2row['co_bus_id'];
				$co_bus_name=$sub2row['co_bus_name'];
				echo '<li><a href="http://'.$site_url.'/business/'.$co_bus_id.'">'.$co_bus_name.'</a></li>';
				}
			echo '</ul></li>';
			}
		elseif($nav_page_url=='community')
			{
			echo '<li class="top drop"><em>'.$nav_page_name.'</em><ul>';
			$sub2result = mysql_query("SELECT DISTINCT co_com.co_com_id, co_com.co_com_name FROM co_com, co_com_list, card, co WHERE $site_id=card.site_id and co_com_list.co_id=card.co_id and co_com_list.co_com_id=co_com.co_com_id ORDER BY co_com.co_com_name ASC") or die(mysql_error());
				while($sub2row = mysql_fetch_array($sub2result))
				{
				$co_com_id=$sub2row['co_com_id'];
				$co_com_name=$sub2row['co_com_name'];
				echo '<li><a href="http://'.$site_url.'/community/'.$co_com_id.'">'.$co_com_name.'</a></li>';
				}
			echo '</ul></li>';
			}
		elseif($nav_page_url=='category')
			{
			echo '<li class="top drop"><em>'.$nav_page_name.'</em><ul>';
			$sub2result = mysql_query("SELECT DISTINCT co_cat.co_cat_id, co_cat.co_cat_name FROM co_cat, co_cat_list, card, co WHERE $site_id=card.site_id and co_cat_list.co_id=card.co_id and co_cat_list.co_cat_id=co_cat.co_cat_id ORDER BY co_cat.co_cat_name ASC") or die(mysql_error());
				while($sub2row = mysql_fetch_array($sub2result))
				{
				$co_cat_id=$sub2row['co_cat_id'];
				$co_cat_name=$sub2row['co_cat_name'];
				echo '<li><a href="http://'.$site_url.'/category/'.$co_cat_id.'">'.$co_cat_name.'</a></li>';
				}
			echo '</ul></li>';
			}
		elseif($nav_page_url=='home')
			{
			echo '<li class="top"><a href="http://'.$site_url.'/'.$site_index.'">'.$nav_page_name.'</a></li>';
			}
		elseif($nav_page_url=='featured')
			{
			echo '<li class="top"><a href="http://'.$site_url.'/featured">'.$nav_page_name.'</a></li>';
			}
		elseif($nav_page_url=='sponsors')
			{
			echo '<li class="top"><a href="http://'.$site_url.'/sponsors">'.$nav_page_name.'</a></li>';
			}
		elseif($nav_page_url=='register')
			{
			echo '<li class="top"><a href="http://'.$site_url.'/register">'.$nav_page_name.'</a></li>';
			}
		elseif($nav_page_url=='search')
			{
			echo '<li class="top" id="search">
				<form  method="post" action="http://'.$site_url.'/search.php?go"  id="searchform">
				<input  type="text" name="name" value="Search" onFocus="this.value=';
			echo "''";
			echo '">
				<input  type="submit" name="submit" id="button" value="GO">
				</form>
			</li>';
			}
		else
			{
			echo '<li class="top"><a href="http://'.$site_url.'/pages/'.$nav_page_url.'">'.$nav_page_name.'</a></li>';
			}
		}
	elseif($nav_page_type=='link')
		{
		echo '<li class="top"><a href="http://'.remove_http($nav_page_url).'" target="_blank">'.$nav_page_name.'</a></li>';
		} else {}
	}
echo '</ul>';
if(!empty($site_facebook))
	{
	echo '<a href="http://'.remove_http($site_facebook).'" class="facebook" target="_blank">F</a>';
	}
if(!empty($site_twitter))
	{
	echo '<a href="http://'.remove_http($site_twitter).'" class="twitter" target="_blank">T</a>';
	}
}
?>
<br class="clear">
</div>
<?php
if($homepage != "on")
{
	echo '<div class="content"';
	if($divname==''){echo ' id="nocol"';} else{echo ' id="'.$divname.'"';}
	echo '>';
	}
?>