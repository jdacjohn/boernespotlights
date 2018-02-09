<?php $pagetitle = "Control Panel"; include '../core/base.php'; include '../'.$head; check_logged();




if(isset($_GET['business']))
	{
	?>
	<h1>Purchase a Business Profile</h1>
	<hr>
	<div class="business">
	<div class="paypal">
	<div class="info-l">
	<h4>BizCardSpotlight&trade; $125<a name="bizcard"></a><span><a href="/pages/products#bizcard">Read Description</a></span></h4>
	
	<p><strong>BizCard Spotlight&trade; 12 Month Special</strong></p>

	<ol>
		<li>Purchase Your BizCard Spotlight&trade;</li>
		<li>Complete Your Business Listing</li>
		<li>Upload an Image of your Biz Card</li>
		<li>Once complete, we will push posts out on Twitter and Facebook and run random featured listings of your BizCard Spotlight&trade; throughout the year.</li>
	</ol>
	</div>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
	<input type="hidden" name="custom" value="<?php echo $user_id; ?>">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="VZU6YJLLNTMUJ">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	<div class="clear">&nbsp;</div>
	</div>
	<hr>
	<div class="paypal">
	<div class="info-l">
	<h4>VideoMarketingSpotlight&trade; Basic $250<a name="video-basic"></a><span><a href="/pages/products#video-basic">Read Description</a></span></h4>
	
	<p><strong>Video Marketing Spotlight&trade;</strong></p>
	
	<h6>We shoot, edit, post, and host all for one low fee!</h6>

	<ol>
		<li>Purchase your Video Marketing Spotlight&trade;</li>
		<li>Set up your appointment to shoot your video</li>
		<li>We will edit and post your video within 10 days</li>
		<li>Once complete, you will receive a code to embed directly onto your website. Additionally we will help promote you through Twitter and Facebook.</li>
	</ol>
	</div>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
	<input type="hidden" name="custom" value="<?php echo $user_id; ?>">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="BXH5PC6E47DGJ">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	<div class="clear">&nbsp;</div>
	</div>
	<hr>
	<div class="paypal">
	<div class="info-l">
	<h4>VideoMarketingSpotlight&trade; Interview $475<a name="video-interview"</a><span><a href="/pages/products#video-interview">Read Description</a></span></h4>
	
	<p><strong>Video Marketing Spotlight&trade;</strong></p>
	
	<h6>We shoot, edit, post, and host all for one low fee!</h6>

	<ol>
		<li>Purchase your Video Marketing Spotlight&trade;</li>
		<li>Set up your appointment to shoot your video</li>
		<li>We will edit and post your video within 10 days</li>
		<li>Once complete, you will receive a code to embed directly onto your website. Additionally we will help promote you through Twitter and Facebook.</li>
	</ol>
	</div>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
	<input type="hidden" name="custom" value="<?php echo $user_id; ?>">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="WMX4TWBLSABEW">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	</div>
	<div class="clear">&nbsp;</div>
	</div>
	<?php
	}
	
elseif(isset($_GET['sponsor']))
	{
	?>
	<h1>Purchase a Sponsor Profile</h1>
	<hr>
	<div class="sponsor">
	<div class="paypal">
	<h4>Directory Sponsor<br>$250<a name="directory"></a></h4>
	<p>[<a href="/pages/sponsorships#directory">Read Description</a>]</p>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
	<input type="hidden" name="custom" value="<?php echo $user_id; ?>">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="6Y24934AUCW54">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	</div>
	<div class="paypal">
	<h4>Silver Spotlight Sponsor<br>$500<a name="silver"></a></h4>
	<p>[<a href="/pages/sponsorships#silver">Read Description</a>]</p>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
	<input type="hidden" name="custom" value="<?php echo $user_id; ?>">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="AHS7WAGJCCE52">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	</div>
	<div class="paypal">
	<h4>Gold Spotlight Sponsor<br>$1000<a name="gold"></a></h4>
	<p>[<a href="/pages/sponsorships#gold">Read Description</a>]</p>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
	<input type="hidden" name="custom" value="<?php echo $user_id; ?>">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="YYVC6WTZQA9VY">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	</div>
	<div class="clear">&nbsp;</div>
	</div>
	<?php
	}
	
elseif(isset($_GET['chamber']))
	{
	?>
	<h1>Chamber of Commerce Special</h1>
	<hr>
	<div class="chamber">
	<p>If you are a member in good standing with the Boerne Chamber of Commerce, go ahead and take advantage of an additional 20% off your BizCard-Spotlight™</p>
	<div class="paypal">
	<h4>Boerne BizCardSpotlight&trade;<br>$100</h4>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
	<input type="hidden" name="custom" value="<?php echo $user_id; ?>">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="QWRUL64Z3QVDL">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	</div>
	<div class="clear">&nbsp;</div>
	</div>
	<?php
	}
	
else
	{
	?>
	<div class="controlpanel">
	<h1>My Account</h1>
<?php

if(!empty($user_credit))
	{
	echo '<hr><h3><a href="/panel/redeem">Redeem Your Spotlight!</a></h3>';
	}
	else
	{
?>
	<hr>
	<h3><a href="?business">Purchase a Business Profile</a></h3>
	<hr>
	<h3><a href="?sponsor">Purchase a Sponsor Profile</a></h3>
	<hr>
	<h3><a href="?chamber">Chamber of Commerce Special</a></h3>	
<?php
	}
	?>
	</div>
<?php
	}





include '../'.$foot; ?>