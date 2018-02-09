<?php
error_reporting(E_ALL);
define('INCLUDE_CHECK',true);
require 'config.php';
require 'classes.php';
require 'connect.php';
require 'functions.php';
require 'session.php';

/*includes*/
$head = 'core/template/head.php';
$side = 'core/template/side.php';
$foot = 'core/template/foot.php';

/*constants*/
date_default_timezone_set('America/Chicago');
$facebook = '';
$facebookOg = '';
$seo_desc = '';
$seo_keywords = '';
$homepage = 'off';
$divname = '';
$allowed_html = '<a>,<b>,<strong>,<i>,<em>,<p>,<br>,<ul>,<ol>,<li>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<hr>,<div><script><noscript><img><object><param>,<form>,<input>';

/*php self*/
$PHP_SELF = get_php_self();
//$PHP_SELF = '/'.basename($_SERVER['PHP_SELF'],".php");

/*user info*/
if(isset($_SESSION['user_id']))
	{
	$result = mysql_query("SELECT * FROM user WHERE user_id='".$_SESSION['user_id']."'") or die(mysql_error()); $row = mysql_fetch_array($result);
	$user_id = $row['user_id']; $userlevel_no = $row['userlevel_no']; $user_login = $row['user_login']; $user_name_f = $row['user_name_f']; $user_name_l = $row['user_name_l']; $user_email = $row['user_email']; $user_credit = $row['user_credit']; $user_credit_site_id = $row['user_credit_site_id']; $user_log = '1';
	}
else
	{
	$userlevel_no = '0'; $user_login = ''; $user_name_f = 'Guest'; $user_log = '0'; $user_id = '0';
	}
	
/*site details*/
$result = mysql_query("SELECT * FROM site WHERE $site_id=site_id") or die(mysql_error());
$row = mysql_fetch_array($result);
$site_name = $row['site_name'];
$site_url = $row['site_url'];
$site_desc = $row['site_desc'];
$site_contact = $row['site_contact'];
$site_facebook = $row['site_facebook'];
$site_twitter = $row['site_twitter'];
$site_banner1 = $row['site_banner1'];
$site_banner1_url = $row['site_banner1_url'];
$site_banner2 = $row['site_banner2'];
$site_banner2_url = $row['site_banner2_url'];
$site_banner3 = $row['site_banner3'];
$site_banner3_url = $row['site_banner3_url'];
$site_city = $row['site_city'];
$site_state = $row['site_state'];
$result = mysql_query("SELECT page_pass FROM page WHERE page_url='home' AND '$site_id'=site_id");
while($row = mysql_fetch_assoc($result))
	{
	$page_pass=$row['page_pass'];
	if($page_pass == '0'){$site_index='';} else {$site_index='prelaunch';}
	}
	
	
if(isset($_GET['co']))
	{
	$short = mysql_escape_string($_GET['co']);
	if(empty($_GET['co']))
		{
		header("Location: /$site_index");
		exit;
		}
	else
		{
		//echo $short.$site_id;
		$query = "SELECT * FROM co, co_site_list WHERE '$short'=co.co_id AND '$site_id'=co_site_list.site_id AND co_site_list.co_id=co.co_id LIMIT 1";
		$result = mysql_query($query) or die(mysql_error());
		if(mysql_num_rows($result)==0)
			{
			$pagetitle = '';
			$result = mysql_query("SELECT page_pass FROM page WHERE page_url='home' AND '$site_id'=site_id");
			while($row = mysql_fetch_assoc($result))
				{
				$page_pass=$row['page_pass'];
				if($page_pass == '1'){
					//check_logged();
					}
				}
			echo '<h1>Sorry</h1><hr>';
			echo '<p>This business does not exist.</p>';
			}
		else
			{
			while($row = mysql_fetch_array($result))
				{
				$co_name = $row['co_name'];
				$co_desc = strip_tags(html_entity_decode($row['co_desc'], ENT_QUOTES, 'utf-8'),$allowed_html);
				$seo_desc = $row['co_seo_desc'];
				$seo_keywords = $row['co_seo_keywords'];
				}
			}
		}
	}
else
	{
/*social networking*/
	$currentpage = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	$social_network = '<hr><span style="position:relative;top:4px;margin-right:-1px;margin-top:0px;margin-bottom:0px;padding-bottom:-10px;padding-top:10px;"><a title="'.$site_name.'" href="http://www.facebook.com/sharer.php?s=100&p[url]='.$currentpage.'&p[images][0]=http://boernespotlights.com/assets/img/logo.png&p[title]='.$site_name.'&p[summary]='.$site_desc.'" target="_blank" style=""><img src="http://boernespotlights.com/assets/img/facebook-icon.png" alt="Share on Facebook" style="margin-top:0px;" /></a></span>
	<span class="st_linkedin"></span><span class="st_twitter" ></span><span class="st_email"></span><a href="javascript:window.print()" class="print">Print</a>';
	$social_network_home = '<span class="st_linkedin"></span><span class="st_facebook" st_url="http://boernespotlights.com" st_title="Boernespotlights.com" ></span><span class="st_google"></span><span class="st_twitter" ></span><span class="st_email"></span><a href="javascript:window.print()" class="print">Print</a>';
		}

/*Brightcove*/
// Include the BCMAPI SDK
require('library/bc-mapi.php');
require('library/bc-mapi-cache.php');
// Using flat files
$bc = new BCMAPI('tJG0pJFCs6ezVe3cfhRj0eMiXw_D1UstarhXUvUC_-BX6vX99TfIPg..', 'tJG0pJFCs6ezVe3cfhRj0eMiXw_D1UstarhXUvUC_-BX6vX99TfIPg..');
$bc_cache = new BCMAPICache('file', 600, '/temp/', '.cache');
?>