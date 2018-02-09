<?php
if(!defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');

$site_id = '1';
$mode = 'DEV';
if ($mode = 'DEV') {
	$siteRoot = 'http://192.168.42.97/boernespotlights.com';
	$siteBase = '192.168.42.97/';
	$db_host = '192.168.42.97';
} else {
	$siteRoot = 'http://www.boernespotlights.com';
	$siteBase = 'www.';
	$db_host = 'internal-db.s139590.gridserver.com';
}
// $db_host = 'internal-db.s139590.gridserver.com'; 
// $db_host = '192.168.42.97';
$db_user = 'db139590';
$db_user_pass = 'upp3rc4s3sp0tl1ghts';
$db_database = 'db139590_spotlights';
?>