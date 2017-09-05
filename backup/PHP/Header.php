	<?php
// Check for mobile device.
		require_once 'Mobile_Detect.php';
		$detect = new Mobile_Detect();
		$layout = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
	?>            

	<div>
	<input type="image" src="../images/home.png" name="Home" id="Home" value="Home" width="40" onClick="window.open('index.php',target='_top');">
	<input type="image" src="../images/sharing.jpg" name="sharing" id="sharing" value="sharing" width="40" onclick="window.open('SetSharing.php',target='_top');">
	<input type="image" src="../images/setup.jpg" name="Setup" id="Setup" value="Setup" width="40" onClick="window.open('PickFriend.php',target='_top');">
	<input type="image" src="../images/pictureupload.jpg" name="PUpload" id="PUpload" value="Picture Upload" width="40" onClick="window.open('FileUploader.php',target='_top');">
	<input type="image" src="../images/videoupload.png" name="VUpload" id="VUpload" value="Video Upload" width="40" onClick="window.open('UploadVideo.php',target='_top');">
	<input type="image" src="../images/deletepic.png" name="DeleteP" id="DeleteP" value="Delete Picture" width="40" onClick="window.open('PRemove.php',target='_top');">
	<input type="image" src="../images/deletevideo.png" name="DeleteV" id="DeleteV" value="Delete Video" width="40" onClick="window.open('VRemove.php',target='_top');">
	<input type="image" src="../images/HERecorder.jpg" name="HERecorder" id="HERecorder" value="Household Expenese" width="40" onclick="window.open('HERecorder.php',target='_top');">
	<input type="image" src="../images/profile.png" name="Profile" id="Profile" value="Profile" width="40" onclick="window.open('ChangeProfile.php',target='_top');">
	<object type="application/x-shockwave-flash" data="player_mp3_maxi.swf" id="audio" width="40" height="40">
		<param name="movie" value="player_mp3_maxi.swf" />
		<param name="bgcolor" value="#000000" />
		<param name="FlashVars" value="mp3=Cherries.mp3&amp;width=40&amp;height=40&amp;showslider=0&amp;sliderwidth=0&amp;sliderheight=0&amp;volumewidth=0&amp;volumeheight=0" />
	</object>
	<?php if($layout!='tablet' && $layout!='mobile') : ?>
		<input type="image" src="../images/chat.png" name="start_chat" id="Chat" value="Chat" width="40" onClick="chat();">
	<?php else: ?>
		<input type="image" src="../images/chat.png" name="start_chat" id="Chat" value="Chat" width="40"  onClick="window.open('chat.php',target='_top');">
	<?php endif; ?>
	<div style='display:inline-block'>
	<font style="font-size:16px;color:blue;" id="Available"><div style='display:inline-block'><font style="font-size:8px;color:green;">0 Friend Online</font>
	<font id="AvailMsg"></font></div>
	</font><font style="font-size:20px;color:red;font-weight:bold;"><?php if(isset($message)) echo $message ?></font>
	</div>
	<input type="image" src="../images/logout.png" name="Logout" id="Logout" value="Logout" width="40" style="float:right;" onClick="window.open('signout.php',target='_top');">
	</div><hr>
