<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">
	stLight.options({
		publisher:'12345'
	});
</script>
</div>
<div class="foot">
<ul>
<?php
if (isset($_GET['vip'])) {
	$target = ' target="_blank" ';
} else {
	$target = '';
}

$nav_query  = "SELECT page_url, page_name, page_type FROM page WHERE '$site_id'=site_id AND '1'=page_active ORDER BY page_order ASC LIMIT 6, 8";
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
			echo '<li><a href="http://'.$site_url.'/destination"' . $target . '>'.$nav_page_name.'</a></li>';
			}
		
		elseif($nav_page_url=='arts')
			{
			echo '<li><a href="http://'.$site_url.'/arts"' . $target . '>'.$nav_page_name.'</a></li>';
			}
		elseif($nav_page_url=='business')
			{
			echo '<li><a href="http://'.$site_url.'/business"' . $target . '>'.$nav_page_name.'</a></li>';
			}
		elseif($nav_page_url=='community')
			{
			echo '<li><a href="http://'.$site_url.'/community"' . $target . '>'.$nav_page_name.'</a></li>';
			}
		elseif($nav_page_url=='category')
			{
			echo '<li><a href="http://'.$site_url.'/category"' . $target . '>'.$nav_page_name.'</a></li>';
			}
		elseif($nav_page_url=='home')
			{
			echo '<li class="top"><a href="http://'.$site_url.'/'.$site_index.'"' . $target . '>'.$nav_page_name.'</a></li>';
			}
		elseif($nav_page_url=='featured')
			{
			echo '<li class="top"><a href="http://'.$site_url.'/featured"' . $target . '>'.$nav_page_name.'</a></li>';
			}
		elseif($nav_page_url=='sponsors')
			{
			echo '<li class="top"><a href="http://'.$site_url.'/sponsors"' . $target . '>'.$nav_page_name.'</a></li>';
			}
		elseif($nav_page_url=='register')
			{
			echo '<li class="top"><a href="http://'.$site_url.'/register"' . $target . '>'.$nav_page_name.'</a></li>';
			}
		elseif($nav_page_url=='search')
			{
			echo ' <li id="search">
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
			echo ' <li><a href="http://'.$site_url.'/pages/'.$nav_page_url.'"' . $target . '>'.$nav_page_name.'</a></li>';
			}
		}
	elseif($nav_page_type=='link')
		{
		echo '<li><a href="http://'.remove_http($nav_page_url).'" target="_blank">'.$nav_page_name.'</a></li>';
		} else {}
	}
?>
</ul>
</div>
</div></div>
<div id="subfoot">
<?php
$nav_query  = "SELECT page_url, page_name, page_type FROM page WHERE '$site_id'=site_id AND '1'=page_active ORDER BY page_order ASC LIMIT 14, 500";
$nav_result = mysql_query($nav_query);
if(mysql_num_rows($nav_result)==0)
	{
	}
else
	{
	while($nav_row = mysql_fetch_array($nav_result))
		{
		$nav_page_url = $nav_row['page_url'];
		$nav_page_name = $nav_row['page_name'];
		$nav_page_type = $nav_row['page_type'];
		echo '<em>&middot;</em> ';
		if($nav_page_type=='page')
			{	
			if($nav_page_url=='destination')
				{
				echo '<a href="http://'.$site_url.'/destination">'.$nav_page_name.'</a>';
				}
			elseif($nav_page_url=='arts')
				{
				echo '<a href="http://'.$site_url.'/arts">'.$nav_page_name.'</a>';
				}
			elseif($nav_page_url=='business')
				{
				echo '<a href="http://'.$site_url.'/business">'.$nav_page_name.'</a>';
				}
			elseif($nav_page_url=='community')
				{
				echo '<a href="http://'.$site_url.'/community">'.$nav_page_name.'</a>';
				}
			elseif($nav_page_url=='category')
				{
				echo '<a href="http://'.$site_url.'/category">'.$nav_page_name.'</a>';
				}
			elseif($nav_page_url=='home')
				{
				echo '<a href="http://'.$site_url.'/'.$site_index.'">'.$nav_page_name.'</a>';
				}
			elseif($nav_page_url=='featured')
				{
				echo '<a href="http://'.$site_url.'/featured">'.$nav_page_name.'</a>';
				}
			elseif($nav_page_url=='sponsors')
				{
				echo '<a href="http://'.$site_url.'/sponsors">'.$nav_page_name.'</a>';
				}
			elseif($nav_page_url=='register')
				{
				echo '<a href="http://'.$site_url.'/register">'.$nav_page_name.'</a>';
				}
			elseif($nav_page_url=='search')
				{
				echo '
					<form  method="post" action="http://'.$site_url.'/search.php?go"  id="searchform">
					<input  type="text" name="name" value="Search" onFocus="this.value=';
				echo "''";
				echo '">
					<input  type="submit" name="submit" id="button" value="GO">
					</form>';
				}
			else
				{
				echo ' <a href="http://'.$site_url.'/pages/'.$nav_page_url.'">'.$nav_page_name.'</a>';
				}
			}
		elseif($nav_page_type=='link')
			{
			echo ' <a href="http://'.remove_http($nav_page_url).'" target="_blank">'.$nav_page_name.'</a>';
			} else {}
		}
	echo ' <em>&middot;</em>';
	}
?>
</div>
<p id="footer">Copyright <?php $copyYear = 2011; $curYear = date('Y'); echo '&copy; ' . $copyYear . (($copyYear != $curYear) ? '&mdash;' . $curYear : ''); ?> LocalSpotlights.com, All Rights Reserved</p>

</body>
</html>