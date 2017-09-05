<?php
$dirPath = "../images/";

function traverseDir( $dir ) {
  if ( !( $handle = opendir( $dir ) ) ) die( "Cannot open $dir." );
  $files = array();
  while ( $file = readdir( $handle ) ) {
    if ( $file != "." && $file != ".." ) {
      if ( is_dir( $dir . "/" . $file ) ) $file .= "/";
      $files[] = $file;
    }
  }
  sort( $files );
?>
<script type="text/javascript">
    var j = <?php echo count($files); ?>;
	var adImages = new Array(j);
	var i = 0;
</script>
<?php
  foreach ( $files as $file ) {
?>
<script type="text/javascript">
//adImages[i]='<a href="http://www.raymondlwhuang.com"><img src="../images/<?php echo $file; ?>" border=0"></a>'
adImages[i]='<img src="../images/<?php echo $file; ?>">';
i++;
</script>
<?php
	  foreach ( $files as $file ) {
		if ( substr( $file, -1 )  == "/" ) traverseDir( "$dir/" . substr( $file, 0, -1 ) );
	  }
  };
  closedir( $handle );
}
traverseDir( $dirPath );
?>

<script language="JavaScript1.2">

///////configure the below four variables to change the style of the slider///////
//set the scrollerwidth and scrollerheight to the width/height of the LARGEST image in your slideshow!
var scrollerwidth='100%'
var scrollerheight='100%'
var scrollerbgcolor='white'
//3000 miliseconds=3 seconds
var pausebetweenimages=50

var ie=document.all
var dom=document.getElementById

if (adImages.length>1)
i=2
else
i=0

function move1(whichlayer){
tlayer=eval(whichlayer)
if (tlayer.left>0&&tlayer.left<=5){
tlayer.left=0
setTimeout("move1(tlayer)",pausebetweenimages)
setTimeout("move2(document.main.document.second)",pausebetweenimages)
return
}
if (tlayer.left>=tlayer.document.width*-1){
tlayer.left-=5
setTimeout("move1(tlayer)",50)
}
else{
tlayer.left=parseInt(scrollerwidth)+5
tlayer.document.write(adImages[i])
tlayer.document.close()
if (i==adImages.length-1)
i=0
else
i++
}
}

function move2(whichlayer){
tlayer2=eval(whichlayer)
if (tlayer2.left>0&&tlayer2.left<=5){
tlayer2.left=0
setTimeout("move2(tlayer2)",pausebetweenimages)
setTimeout("move1(document.main.document.first)",pausebetweenimages)
return
}
if (tlayer2.left>=tlayer2.document.width*-1){
tlayer2.left-=5
setTimeout("move2(tlayer2)",50)
}
else{
tlayer2.left=parseInt(scrollerwidth)+5
tlayer2.document.write(adImages[i])
tlayer2.document.close()
if (i==adImages.length-1)
i=0
else
i++
}
}

function move3(whichdiv){
tdiv=eval(whichdiv)
if (parseInt(tdiv.style.left)>0&&parseInt(tdiv.style.left)<=5){
tdiv.style.left=0+"px"
setTimeout("move3(tdiv)",pausebetweenimages)
setTimeout("move4(scrollerdiv2)",pausebetweenimages)
return
}
if (parseInt(tdiv.style.left)>=tdiv.offsetWidth*-1){
tdiv.style.left=parseInt(tdiv.style.left)-5+"px"
setTimeout("move3(tdiv)",50)
}
else{
tdiv.style.left=scrollerwidth
tdiv.innerHTML=adImages[i]
if (i==adImages.length-1)
i=0
else
i++
}
}

function move4(whichdiv){
tdiv2=eval(whichdiv)
if (parseInt(tdiv2.style.left)>0&&parseInt(tdiv2.style.left)<=5){
tdiv2.style.left=0+"px"
setTimeout("move4(tdiv2)",pausebetweenimages)
setTimeout("move3(scrollerdiv1)",pausebetweenimages)
return
}
if (parseInt(tdiv2.style.left)>=tdiv2.offsetWidth*-1){
tdiv2.style.left=parseInt(tdiv2.style.left)-5+"px"
setTimeout("move4(scrollerdiv2)",50)
}
else{
tdiv2.style.left=scrollerwidth
tdiv2.innerHTML=adImages[i]
if (i==adImages.length-1)
i=0
else
i++
}
}

function startscroll(){
if (ie||dom){
scrollerdiv1=ie? first2 : document.getElementById("first2")
scrollerdiv2=ie? second2 : document.getElementById("second2")
move3(scrollerdiv1)
scrollerdiv2.style.left=scrollerwidth
}
else if (document.layers){
document.main.visibility='show'
move1(document.main.document.first)
document.main.document.second.left=parseInt(scrollerwidth)+5
document.main.document.second.visibility='show'
}
}

window.onload=startscroll

</script>

<ilayer id="main" width=&{scrollerwidth}; height=&{scrollerheight}; bgColor=&{scrollerbgcolor}; visibility=hide>
<layer id="first" left=1 top=0 width=&{scrollerwidth}; >
<script language="JavaScript1.2">
if (document.layers)
document.write(adImages[0])
</script>
</layer>
<layer id="second" left=0 top=0 width=&{scrollerwidth}; visibility=hide>
<script language="JavaScript1.2">
if (document.layers)
document.write(adImages[1])
</script>
</layer>
</ilayer>

<script language="JavaScript1.2">
if (ie||dom){
document.writeln('<div id="main2" style="position:relative;width:'+scrollerwidth+';height:'+scrollerheight+';overflow:hidden;background-color:'+scrollerbgcolor+'">')
document.writeln('<div style="position:absolute;width:'+scrollerwidth+';height:'+scrollerheight+';clip:rect(0 '+scrollerwidth+' '+scrollerheight+' 0);left:0px;top:0px">')
document.writeln('<div id="first2" style="position:absolute;width:'+scrollerwidth+';left:1px;top:0px;">')
document.write(adImages[0])
document.writeln('</div>')
document.writeln('<div id="second2" style="position:absolute;width:'+scrollerwidth+';left:0px;top:0px">')
document.write(adImages[1])
document.writeln('</div>')
document.writeln('</div>')
document.writeln('</div>')
}
</script>
		