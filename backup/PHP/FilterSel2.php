<div style="display:none;" id="effect">
	<div style="font-size:9px;display:inline-block;vertical-align:top;">
	<table>
	<tr>
	<td align="right">
	Smooth: <input type="checkbox" value="10" onchange="flag=1;PictureFilter();Changed('filter8','Smoothvalue',10);" id="filter8"></td><td>
		<table>
		<tbody>
		<tr>
		<td>
			<!-- Horizontal slider 1 (green) -->
			<div class="horizontal_track" id="horizontal_track_1">
				<div class="horizontal_slit" id="horizontal_slit_1">&nbsp;</div>
				<div class="horizontal_slider" id="horizontal_slider_1" style="left: 0px; top: 0px;"  onmouseover="thisvalue=document.getElementById('Smoothvalue').value;" onmousedown="slide(event, 'horizontal', 100, -20, 20, 0, 0, 'Smoothvalue');" onmouseout="flag=1;DoPictureFilter('filter8','Smoothvalue');">&nbsp;</div>
			</div>
		</td>
		<td>
			<!-- Value display 1 (green) -->
			<div class="display_holder" id="display_holder_1">
			<input type="text" value="10" size="3" class="value_display" id="Smoothvalue" onchange="flag=1;PictureFilter();"  onfocus="blur(this);" style="font-size:9px;" >
			</div>
		</td>
		</tr>
		</tbody>
		</table>
	</td></tr><tr><td align="right">
	Contrast: <input type="checkbox" value="3" onchange="flag=1;PictureFilter();Changed('filter10','Contrast',0);" id="filter10"></td><td>
		<table>
		<tbody>
		<tr>
		<td>
			<!-- Horizontal slider 1 (green) -->
			<div class="horizontal_track" id="horizontal_track_2">
				<div class="horizontal_slit" id="horizontal_slit_2">&nbsp;</div>
				<div class="horizontal_slider" id="horizontal_slider_2" style="left: 0px; top: 0px;"  onmouseover="thisvalue=document.getElementById('Contrast').value;" onmousedown="slide(event, 'horizontal', 100, -255, 255, 0, 0, 'Contrast');" onmouseout="flag=1;DoPictureFilter('filter10','Contrast');">&nbsp;</div>
			</div>
		</td>
		<td>
			<!-- Value display 1 (green) -->
			<div class="display_holder" id="display_holder_2">
			<input type="text" value="0" size="3" class="value_display" id="Contrast" onchange="flag=1;PictureFilter();"  onfocus="blur(this);" style="font-size:9px;" >
			</div>
		</td>
		</tr>
		</tbody>
		</table>
	</td></tr><tr><td align="right">
	Brightness: <input type="checkbox" value="2" onchange="flag=1;PictureFilter();Changed('filter11','Brightness',0);" id="filter11"></td><td>
		<table>
		<tbody>
		<tr>
		<td>
			<!-- Horizontal slider 1 (green) -->
			<div class="horizontal_track" id="horizontal_track_3">
				<div class="horizontal_slit" id="horizontal_slit_3">&nbsp;</div>
				<div class="horizontal_slider" id="horizontal_slider_3" style="left: 0px; top: 0px;"  onmouseover="thisvalue=document.getElementById('Brightness').value;" onmousedown="slide(event, 'horizontal', 100, -255, 255, 0, 0, 'Brightness');" onmouseout="flag=1;DoPictureFilter('filter11','Brightness');">&nbsp;</div>
			</div>
		</td>
		<td>
			<!-- Value display 1 (green) -->
			<div class="display_holder" id="display_holder_3">
			<input type="text" value="0" size="3" class="value_display" id="Brightness" onchange="flag=1;PictureFilter();"  onfocus="blur(this);" style="font-size:9px;" >
			</div>
		</td>
		</tr>
		</tbody>
		</table>
	</td></tr><tr><td align="right">
	Pixelate: <input type="checkbox" value="11" onchange="flag=1;PictureFilter();Changed('filter12','Pixelate',0);" id="filter12"></td><td>
		<table>
		<tbody>
		<tr>
		<td>
			<!-- Horizontal slider 1 (green) -->
			<div class="horizontal_track" id="horizontal_track_4">
				<div class="horizontal_slit" id="horizontal_slit_4">&nbsp;</div>
				<div class="horizontal_slider" id="horizontal_slider_4" style="left: 0px; top: 0px;"  onmouseover="thisvalue=document.getElementById('Pixelate').value;" onmousedown="slide(event, 'horizontal', 100, 0, 20, 0, 0, 'Pixelate');" onmouseout="flag=1;DoPictureFilter('filter12','Pixelate');">&nbsp;</div>
			</div>
		</td>
		<td>
			<!-- Value display 1 (green) -->
			<div class="display_holder" id="display_holder_4">
			<input type="text" value="0" size="3" class="value_display" id="Pixelate" onchange="flag=1;PictureFilter();"  onfocus="blur(this);" style="font-size:9px;" >
			</div>
		</td>
		</tr>
		</tbody>
		</table>
	</td></tr><tr><td align="right">
	Colorize: <input type="checkbox" value="4" onchange="flag=1;PictureFilter();Changed('filter9','red',0);" id="filter9">R:</td><td>
		<table>
		<tbody>
		<tr>
		<td>
			<!-- Horizontal slider 1 (green) -->
			<div class="horizontal_track" id="horizontal_track_5">
				<div class="horizontal_slit" id="horizontal_slit_5">&nbsp;</div>
				<div class="horizontal_slider" id="horizontal_slider_5" style="left: 0px; top: 0px;"  onmouseover="thisvalue=document.getElementById('red').value;" onmousedown="slide(event, 'horizontal', 100, 0, 255, 0, 0, 'red');" onmouseout="flag=1;DoPictureFilter('filter9','red');">&nbsp;</div>
			</div>
		</td>
		<td>
			<!-- Value display 1 (green) -->
			<div class="display_holder" id="display_holder_5">
			<input type="text" value="0" size="1" class="value_display" id="red" onchange="flag=1;PictureFilter();" style="font-size:9px;" >
			</div>
		</td>
		</tr>
		</tbody>
		</table>
	</td></tr><tr><td align="right">
	G:</td><td>
		<table>
		<tbody>
		<tr>
		<td>
			<!-- Horizontal slider 1 (green) -->
			<div class="horizontal_track" id="horizontal_track_6">
				<div class="horizontal_slit" id="horizontal_slit_6">&nbsp;</div>
				<div class="horizontal_slider" id="horizontal_slider_6" style="left: 0px; top: 0px;"  onmouseover="thisvalue=document.getElementById('green').value;" onmousedown="slide(event, 'horizontal', 100, 0, 255, 0, 0, 'green');" onmouseout="flag=1;DoPictureFilter('filter9','green');">&nbsp;</div>
			</div>
		</td>
		<td>
			<!-- Value display 1 (green) -->
			<div class="display_holder" id="display_holder_6">
			<input type="text" value="0" size="1" class="value_display" id="green" onchange="flag=1;PictureFilter();" style="font-size:9px;" >
			</div>
		</td>
		</tr>
		</tbody>
		</table>
	</td></tr><tr><td align="right">
	B:</td><td>
		<table>
		<tbody>
		<tr>
		<td>
			<!-- Horizontal slider 1 (green) -->
			<div class="horizontal_track" id="horizontal_track_7">
				<div class="horizontal_slit" id="horizontal_slit_7">&nbsp;</div>
				<div class="horizontal_slider" id="horizontal_slider_7" style="left: 0px; top: 0px;"  onmouseover="thisvalue=document.getElementById('blue').value;" onmousedown="slide(event, 'horizontal', 100, 0, 255, 0, 0, 'blue');" onmouseout="flag=1;DoPictureFilter('filter9','blue');">&nbsp;</div>
			</div>
		</td>
		<td>
			<!-- Value display 1 (green) -->
			<div class="display_holder" id="display_holder_7">
			<input type="text" value="0" size="1" class="value_display" id="blue" onchange="flag=1;PictureFilter();" style="font-size:9px;" >
			</div>
		</td>
		</tr>
		</tbody>
		</table>
	</td></tr>
	</table>
	</div>
	<div style="font-size:9px;display:inline-block;vertical-align:top;">
		<table width="100%">
		<tr>
		<td align="right">
		Emboss: <input type="checkbox" value="6" onchange="flag=1;PictureFilter();" id="filter1"></td><td align="right">
		Selective Blur: <input type="checkbox" value="8" onchange="flag=1;PictureFilter();" id="filter2"></td></tr><tr><td align="right">
		Negate: <input type="checkbox" value="0" onchange="flag=1;PictureFilter();" id="filter3"></td><td align="right">
		Gaussian Blur: <input type="checkbox" value="7" onchange="flag=1;PictureFilter();" id="filter4"></td></tr><tr><td align="right">
		Grayscale: <input type="checkbox" value="1" onchange="flag=1;PictureFilter();" id="filter5"></td><td align="right">
		Mean Removal: <input type="checkbox" value="9" onchange="flag=1;PictureFilter();" id="filter6"></td></tr><tr><td align="right">
		Edgedetect: <input type="checkbox" value="5" onchange="flag=1;PictureFilter();" id="filter7"></td><td align="right">
		<?php if(!isset($EditMode)) :?>
		<input type="image" src="../images/edit.png" name="Edit" id="Edit" value="Edit" onclick="EditPicture();">
		<input type="checkbox"  onchange="if(this.checked) EditPicture();">
		<?php endif; ?>
		</td></tr>
		</table>
		<div style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
			<div style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
			Resize: <input type="checkbox" value="10" onchange="flag=2;PictureFilter();Changed('doResize','resize',100);" id="doResize"></div>
			<div style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
				<table>
				<tbody>
				<tr>
				<td>
					<!-- Horizontal slider 1 (green) -->
					<div class="horizontal_track" id="horizontal_track_8">
						<div class="horizontal_slit" id="horizontal_slit_8">&nbsp;</div>
						<div class="horizontal_slider" id="horizontal_slider_8" style="left: 0px; top: 0px;" onmouseover="thisvalue=document.getElementById('resize').value;" onmousedown="slide(event, 'horizontal', 100, 10, 150, 0, 0, 'resize');" onmouseout="flag=2;DoPictureFilter('doResize','resize');">&nbsp;</div>
					</div>
				</td>
				<td>
					<!-- Value display 1 (green) -->
					<div class="display_holder" id="display_holder_8">
					<input type="text" value="100" size="3" class="value_display" id="resize" onchange="flag=2;PictureFilter();"  onfocus="blur(this);" style="font-size:9px;" >
					</div>
				</td>
				</tr>
				</tbody>
				</table>
			</div><br/>						
			<div style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
			Rotation Angle: <input type="checkbox" value="10" onchange="flag=2;PictureFilter();Changed('doRotation','degrees',0);" id="doRotation"></div>
			<div style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
				<table>
				<tbody>
				<tr>
				<td>
					<!-- Horizontal slider 1 (green) -->
					<div class="horizontal_track" id="horizontal_track_9">
						<div class="horizontal_slit" id="horizontal_slit_9">&nbsp;</div>
						<div class="horizontal_slider" id="horizontal_slider_9" style="left: 0px; top: 0px;" onmouseover="thisvalue=document.getElementById('degrees').value;" onmousedown="slide(event, 'horizontal', 100, 0, 360, 0, 0, 'degrees');" onmouseout="flag=2;DoPictureFilter('doRotation','degrees');">&nbsp;</div>
					</div>
				</td>
				<td>
					<!-- Value display 1 (green) -->
					<div class="display_holder" id="display_holder_9">
					<input type="text" value="0" size="3" class="value_display" id="degrees" onchange="flag=2;PictureFilter();"  onfocus="blur(this);" style="font-size:9px;" >
					</div>
				</td>
				</tr>
				</tbody>
				</table>
			</div><br/>
			<div style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
			Corner Radius: <input type="checkbox" value="10" onchange="if(this.checked==false) document.getElementById('corner').style.display='none'; flag=2;PictureFilter();Changed('doRoundCorner','radius',0);" id="doRoundCorner"></div>
			<div style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
				<table>
				<tbody>
				<tr>
				<td>
					<!-- Horizontal slider 1 (green) -->
					<div class="horizontal_track" id="horizontal_track_10">
						<div class="horizontal_slit" id="horizontal_slit_10">&nbsp;</div>
						<div class="horizontal_slider" id="horizontal_slider_10" style="left: 0px; top: 0px;" onmouseover="thisvalue=document.getElementById('radius').value;" onmousedown="slide(event, 'horizontal', 100, 0, 360, 0, 0, 'radius');" onmouseout="flag=2;DoPictureFilter('doRoundCorner','radius');">&nbsp;</div>
					</div>
				</td>
				<td>
					<!-- Value display 1 (green) -->
					<div class="display_holder" id="display_holder_10">
					<input type="text" value="0" size="3" class="value_display" id="radius" onchange="flag=2;PictureFilter();"  onfocus="blur(this);" style="font-size:9px;" >
					</div>
				</td>
				</tr>
				</tbody>
				</table>
			</div><br/>
			<div id="corner" style="display:none;vertical-align:top;text-align:right;font-size:9px;">
					top left?:	<input type="checkbox" value="yes" id="topleft" onchange="flag=2;PictureFilter();" checked="checked" style="font-size:9px;" >
					top right:	<input type="checkbox" value="yes" id="topright" onchange="flag=2;PictureFilter();" checked="checked"  style="font-size:9px;" >
					bottom left?:	<input type="checkbox" value="yes" id="bottomleft" onchange="flag=2;PictureFilter();" checked="checked"  style="font-size:9px;" >
					bottom right?:<input type="checkbox" value="yes" id="bottomright" onchange="flag=2;PictureFilter();" checked="checked"  style="font-size:9px;" >
			</div>
		</div>
	</div>
</div>
<div style="display:none;vertical-align:top;text-align:right;font-size:9px;" id="addtext">
	<table style="display:inline-block;">
	<tr>
	<td width="150" align="center">
	Startposition x <p id="cursorX" style="display:inline;" ></p>
	</td>
	<td width="150" align="center">
	Startposition y <p id="cursorY" style="display:inline;" ></p>
	</td>
	</tr>
	<tr>
	<td>
	<input type="text" name="positionx" id="positionx" value="0" size="15" onchange="AddText();" />
	</td>
	<td>
	<input type="text" name="positiony"  id="positiony" value="0" size="15" onchange="AddText();" />
	</td>
	</tr>
	<tr>
	<td colspan="2" >
	<div style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
	Font <input type="checkbox" value="10" onchange="Changed('dofont','font',24);AddText();" id="dofont"></div>
	<div style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
		<table>
		<tbody>
			<tr>
				<td>&nbsp;&nbsp;</td>
				<td>
				<select id='font' style='width:172px;' onchange='AddText();'>
					<?php
					$files = getFiles("../fonts/");
					foreach ($files as $file) {
						if($file['name']=="timesbi.ttf")  echo "<option value='../fonts/$file[name]' selected='selected' >$file[name]</option>";
						else echo "<option value='../fonts/$file[name]'>$file[name]</option>";
					 }
					?>	
					</select>
				</td>
			</tr>
		</tbody>
		</table>
	</div>		
	</td>
	</tr>	
	<tr>
	<td colspan="2" >
	<div style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
	Font Size <input type="checkbox" value="10" onchange="Changed('dofontsize','fontsize',24);AddText();" id="dofontsize"></div>
	<div style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
		<table>
		<tbody>
			<tr>
			<td>&nbsp;&nbsp;</td>
			<td>
				<!-- Horizontal slider 1 (green) -->
				<div class="horizontal_track" id="horizontal_track_11">
					<div class="horizontal_slit" id="horizontal_slit_11">&nbsp;</div>
					<div class="horizontal_slider" id="horizontal_slider_11" style="left: 0px; top: 0px;" onmouseover="thisvalue=document.getElementById('fontsize').value;" onmousedown="slide(event, 'horizontal', 100, 4, 120, 0, 0, 'fontsize');" onmouseout="flag=3;DoPictureFilter('dofontsize','fontsize');">&nbsp;</div>
				</div>
			</td>
			<td>
				<!-- Value display 1 (green) -->
				<div class="display_holder" id="display_holder_11">
				<input type="text" value="24" size="3" class="value_display" id="fontsize" onfocus="blur(this);" style="font-size:9px;" >
				</div>
			</td>
			</tr>
		</tbody>
		</table>
	</div>		
	</td>
	</tr>
	<tr>
		<td colspan="2" >
		<div style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
		Font Color <input type="checkbox" value="1" onchange="Changed('dofontcolor','FontR',0);Changed('dofontcolor','FontG',0);Changed('dofontcolor','FontB',0);AddText();" id="dofontcolor"></div>
		<div style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
			<table>
			<tbody>
			<tr>
			<td>R</td>
			<td>
				<!-- Horizontal slider 1 (green) -->
				<div class="horizontal_track" id="horizontal_track_13">
					<div class="horizontal_slit" id="horizontal_slit_13">&nbsp;</div>
					<div class="horizontal_slider" id="horizontal_slider_13" style="left: 0px; top: 0px;" onmouseover="thisvalue=document.getElementById('FontR').value;" onmousedown="slide(event, 'horizontal', 100, 0, 255, 0, 0, 'FontR');" onmouseout="flag=3;DoPictureFilter('dofontcolor','FontR');">&nbsp;</div>
				</div>
			</td>
			<td>
				<!-- Value display 1 (green) -->
				<div class="display_holder" id="display_holder_13">
				<input type="text" value="0" size="3" class="value_display" id="FontR" onchange="AddText();" style="font-size:9px;" >
				</div>
			</td>
			</tr>
			</tbody>
			</table>
		</div>		
		</td>
	</tr>
	<tr>
		<td colspan="2" >
		<div style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
			<table>
			<tbody>
			<tr>
			<td>G</td>
			<td>
				<!-- Horizontal slider 1 (green) -->
				<div class="horizontal_track" id="horizontal_track_14">
					<div class="horizontal_slit" id="horizontal_slit_14">&nbsp;</div>
					<div class="horizontal_slider" id="horizontal_slider_14" style="left: 0px; top: 0px;" onmouseover="thisvalue=document.getElementById('FontG').value;" onmousedown="slide(event, 'horizontal', 100, 0, 255, 0, 0, 'FontG');" onmouseout="flag=3;DoPictureFilter('dofontcolor','FontG');">&nbsp;</div>
				</div>
			</td>
			<td>
				<!-- Value display 1 (green) -->
				<div class="display_holder" id="display_holder_14">
				<input type="text" value="0" size="3" class="value_display" id="FontG"  onchange="AddText();" style="font-size:9px;" >
				</div>
			</td>
			</tr>
			</tbody>
			</table>
		</div>		
		</td>
	</tr>
	<tr>
		<td colspan="2" >
		<div style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
			<table>
			<tbody>
			<tr>
			<td>B</td>
			<td>
				<!-- Horizontal slider 1 (green) -->
				<div class="horizontal_track" id="horizontal_track_15">
					<div class="horizontal_slit" id="horizontal_slit_15">&nbsp;</div>
					<div class="horizontal_slider" id="horizontal_slider_15" style="left: 0px; top: 0px;" onmouseover="thisvalue=document.getElementById('FontB').value;" onmousedown="slide(event, 'horizontal', 100, 0, 255, 0, 0, 'FontB');" onmouseout="flag=3;DoPictureFilter('dofontcolor','FontB');">&nbsp;</div>
				</div>
			</td>
			<td>
				<!-- Value display 1 (green) -->
				<div class="display_holder" id="display_holder_15">
				<input type="text" value="0" size="3" class="value_display" id="FontB" onchange="AddText();"  style="font-size:9px;" >
				</div>
			</td>
			</tr>
			</tbody>
			</table>
		</div>		
		</td>
	</tr>
	<tr>
	<td colspan="2" >
	<div style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
	Text Rotation <input type="checkbox" value="10" onchange="Changed('dotextrotate','textrotate',0);AddText();" id="dotextrotate"></div>
	<div style="display:inline-block;vertical-align:top;text-align:right;font-size:9px;">
		<table>
		<tbody>
			<tr>
			<td>&nbsp;&nbsp;</td>
			<td>
				<!-- Horizontal slider 1 (green) -->
				<div class="horizontal_track" id="horizontal_track_12">
					<div class="horizontal_slit" id="horizontal_slit_12">&nbsp;</div>
					<div class="horizontal_slider" id="horizontal_slider_12" style="left: 0px; top: 0px;" onmouseover="thisvalue=document.getElementById('textrotate').value;" onmousedown="slide(event, 'horizontal', 100, 0, 360, 0, 0, 'textrotate');" onmouseout="flag=3;DoPictureFilter('dotextrotate','textrotate');">&nbsp;</div>
				</div>
			</td>
			<td>
				<!-- Value display 1 (green) -->
				<div class="display_holder" id="display_holder_12">
				<input type="text" value="0" size="3" class="value_display" id="textrotate" onfocus="blur(this);" style="font-size:9px;" >
				</div>
			</td>
			</tr>
		</tbody>
		</table>
	</div>		
	</td>
	</tr>
	</table>						
	<table style="display:inline-block;vertical-align:top;">
	<tr>
	<td colspan="2" align="left" >
	Enter text for the picture if needed
	</td>
	</tr>
	<tr>
	<td colspan="2">
	<textarea cols="30" rows="9" id="text_to_display" onfocus="AddText();" onkeyup="AddText();"></textarea>
	</td>
	</tr>
	<tr>
	<td colspan="2">
	<div class="help" style="display:inline-block;font-size:9px;">
		<div class="help-header" >Instructions</div>
		<div class="help-content" >Enter a text.<br/>Startposition x and y starts from the top left image corner.<br/>You can click on the image to select a startposition</div>
	</div>
	</td>
	</tr>
	</table>						
</div>
<div style="font-size:9px;display:inline-block;vertical-align:top;">
	<div id="loading" style="height:4px; font-size:9px;display:none;vertical-align:top;;background-image: url(../images/loader.gif);background-repeat:no-repeat;position:relative;left:10px;top:-1px;"></div><br/>
</div>