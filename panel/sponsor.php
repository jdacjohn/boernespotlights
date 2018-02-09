<?php $pagetitle = "Sponsor Company"; include '../core/base.php'; include '../'.$head; check_logged(); check_access(2);





if(isset($_GET['add']))
	{
	echo '<h1>'.$pagetitle.'</h1><hr>';
	$co_id = $_GET['add'];
	if(empty($_GET['add']))
		{
		echo '<p>Company must be selected.</p>';
		}
	else
		{
		$query = "SELECT co_id, co_name FROM co WHERE $co_id=co_id LIMIT 1";
		$result = mysql_query($query) or die(mysql_error());
		if(mysql_num_rows($result)==0)
			{
			echo '<p>This company does not exist.</p>';
			}
		else
			{
			$subresult = mysql_query("INSERT INTO cocat (co_id, cat_id) VALUES ('$co_id','14')");
			echo '<p>This company is now a Sponsor Company. You will be redirected to the <a href="/panel/admin">Admin Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/admin>';
			}
		}
	}





elseif(isset($_GET['del']))
	{
	echo '<h1>'.$pagetitle.'</h1><hr>';
	$del = $_GET['del'];
	if(empty($_GET['del']))
		{
		echo '<p>Company must be selected.</p>';
		}
	else
		{
		$query = "SELECT co.co_id, co.co_name FROM co, cocat WHERE $del=co.co_id AND co.co_id=cocat.co_id AND cocat.cat_id='14' LIMIT 1";
		$result = mysql_query($query) or die(mysql_error());
		if(mysql_num_rows($result)==0)
			{
			echo '<p>This company is not a Sponsor Company.</p>';
			}
		else
			{
			while($row = mysql_fetch_array($result))
				{
				$resultco = mysql_query("DELETE FROM cocat WHERE '$del'=co_id AND cat_id='14'");
				echo '<p>This company is no longer a Sponsor Company. You will be redirected to the <a href="/panel/admin">Admin Panel</a> shortly.</p><meta http-equiv=Refresh content=5;url=/panel/admin>';
				}
			}
		}
	}





else
	{
	echo '<p>You will be redirected to the <a href="/panel/admin">Admin Panel</a> shortly.</p><meta http-equiv=Refresh content=0;url=/panel/admin>';
	}





include '../'.$foot; ?>