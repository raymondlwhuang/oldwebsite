<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>		
<meta charset="utf-8">
<title>Raymond Huang | Website Developer</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="author" content="Raymond Huang">
<link rel="stylesheet" type="text/css" href="../css/style.css">
	<style type="text/css">
		.jsOff{
			display:none;
		}
	</style>
</head>

<body>	
<div id="top-bar">		</div>
<div id="bg">
	<div id="wrap">
		<div id="frontpage-content"> 
			<div id="headline">
<?php
			if(!isset( $_COOKIE["greeting"] ))
			{
				echo '<h2><font color="red">Please enable Cookie and then refresh the page.</font></h2>';
			}
?>
			
				<noscript><h2><font color="red">Please enable JavaScript and then refresh the page.</font></h2></noscript>
				<h2>Hi. I'm Raymond Huang. 	<button id="jsOff" style="border-style:outset;cursor: pointer;width:145px;color: #252525;" class="jsOff" onClick="window.open('index.php',target='_top');"><img src="../images/home2.png" width="40"><font style="color: #8BA3AF;">To Main Page</font></button>
				<br> A frontend/backend developer.
				You can use the main page as a reference. This site is few years old. Currently I am working on it to move the source into framework. Please visit the home page few weeks later. The intention of this site is for personal use. It could use for video display. 
				So it is recomment that you upgrade your browser to the <font color="red">latest version</font> for better performent.
				Also if you have any question or found any problem please feel free to send <a href="mailto:raymondlwhuang@yahoo.com"><img src="images/email_on.png" alt="email" id="mail" height="40" width="40">
				e-mail</a> to me.<br/>
				</h2>
			</div><!--end headline-->
			
				
			<div id="featured-section">   	
				<div id="featured-section-image">    		
				<img src="../pictures/07-01-2011_184232.jpg"  width="320" alt="Portfolio">    		
				</div><!--end featured-section-image-->    		
				<div id="featured-section-details">
					<h2>Clean, Simple &amp; modern design</h2></h2>
					<p>With all my work, I strive to combine a clean and modern 
					aesthetic with an easy to navigate and intuitive design. Under the hood 
					you'll find web standards compliant HTML and CSS.</p>
				</div><!--end featured-section-details-->    	
			</div><!--end featured-section-->			
			<div id="recent-work">    	
				<h2>Current Projects I involved with</h2>
				
				<div class="recent-project">    		
					<a href="http://www.mundomedia.com">
					<img src="images/mundomedia.jpg" alt="mundomedia.com" title="mundomedia.com" height="190" width="280">
					</a>
				</div><div  class="recent-project" style="width:18px;"></div>    		
				<div class="recent-project">    		
					<a href="http://www.popularproductsonline.com/">
					<img src="images/popularproductsonline.jpg" alt="popularproductsonline.com" title="popularproductsonline.com" height="190" width="280">
					</a>
				</div><div  class="recent-project" style="width:18px;"></div>    		
				<div class="recent-project">    		
					<a href="http://www.todaysluckywinner.com/">
					<img src="images/todaysluckywinner.jpg" alt="todaysluckywinner.com" title="todaysluckywinner.com" height="190" width="280">
					</a>
				</div>    		
			</div>    
		</div><!--end frontpage-content-->
		<div class="line"></div>
	</div> <!--end wrap-->
</div>
	<script type="text/javascript">
		document.getElementById('jsOff').className = "";
	</script>

</body>	
</html>