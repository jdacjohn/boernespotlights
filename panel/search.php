<?php $pagetitle = "Search Admin Panel"; include '../core/base.php'; include '../'.$head; check_logged(); check_access(5);




echo '<h1>Search</h1><hr>'; //foreach(range('A','Z') as $i) echo '<a href="?by='.$i.'">'.$i.'</a> ';
if(isset($_POST['submit']))
	{
	if(isset($_GET['go']))
		{
		if(preg_match("/^[  a-zA-Z]+/", $_POST['name']))
			{
			$name=$_POST['name'];
			?>
			<div class="admin">
			<form  method="post" action="/panel/search/?go"  id="searchform">
			<span>Search For Company:</span>
			<input type="text" name="name" value="<?php echo $name; ?>">
			<input type="submit" name="submit" id="button" value="Search">
			</form>
			<?php
			$result = mysql_query("SELECT co.co_id, co.co_name, co.co_desc FROM co, co_site_list WHERE co.co_id=co_site_list.co_id AND co_site_list.site_id='$site_id' AND (co_name LIKE '%" . $name .  "%' OR co_address_1 LIKE '%" . $name .  "%' OR co_address_2 LIKE '%" . $name .  "%' OR co_city LIKE '%" . $name .  "%' OR co_state LIKE '%" . $name .  "%' OR co_zip LIKE '%" . $name .  "%' OR co_phone LIKE '%" . $name .  "%' OR co_fax LIKE '%" . $name .  "%' OR co_email LIKE '%" . $name .  "%' OR co_url1 LIKE '%" . $name .  "%' OR co_desc LIKE '%" . $name ."%') ORDER BY co.co_name ASC") or die(mysql_error());
			if(mysql_num_rows($result)==0)
				{
				echo  '<p class="nav2">Sorry, there were no matches.</p>';
				}
			else
				{
				while($row = mysql_fetch_array($result))
					{
					$co_name =$row['co_name'];
					$co_id=$row['co_id'];
					
					//-display the result of the array
					echo '<p class="nav2">';
					echo "<a  href=\"/panel/co/?co=$co_id\">"   .$co_name . "</a></p>";
					}
				}
			}
		else
			{
			?>
			<div class="admin">
			<form  method="post" action="/panel/search/?go"  id="searchform">
			<span>Search For Company:</span>
			<input type="text" name="name">
			<input type="submit" name="submit" id="button" value="Search">
			</form>
			<?php
			echo  '<p class="nav2">Please enter a search query</p>';
			}
		}
	else
		{
		?>
		<div class="admin">
		<form  method="post" action="/panel/search/?go"  id="searchform">
		<span>Search For Company:</span>
		<input type="text" name="name">
		<input type="submit" name="submit" id="button" value="Search">
		</form>
		<?php
		echo  '<p class="nav2">Please enter a search query</p>';
		}
	echo '</div>';
	}//end of search form script
else
	{
	?>
	<div class="admin">
	<form  method="post" action="/panel/search/?go"  id="searchform">
	<span>Search For Company:</span>
	<input type="text" name="name">
	<input type="submit" name="submit" id="button" value="Search">
	</form>
	<?php
	echo  '<p class="nav2">Please enter a search query</p>';
	echo '</div>';
	}







include '../'.$foot; ?>