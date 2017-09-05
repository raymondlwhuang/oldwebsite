<?php
session_start();
if (get_magic_quotes_gpc())
{
    function _stripslashes_rcurs($variable, $top = true)
    {
        $clean_data = array();
        foreach ($variable as $key => $value)
        {
            $key = ($top) ? $key : stripslashes($key);
            $clean_data[$key] = (is_array($value)) ?
                stripslashes_rcurs($value, false) : stripslashes($value);
        }
        return $clean_data;
    }
    $_GET = _stripslashes_rcurs($_GET);
    $_POST = _stripslashes_rcurs($_POST);
}
if (!isset($_SESSION["LoginAccept"]) || $_SESSION["LoginAccept"] != "yes"){ header( "Location: index.php" );}
define( "PATH_TO_FILES", "." );
function logout() {
  unset( $_SESSION["username"] );
  unset( $_SESSION["LoginAccept"] );
  session_write_close();
  header( "Location: index.php" );
}
if ( isset( $_GET["action"] ) and $_GET["action"] == "logout" ) {
  logout();
} 
if ( isset( $_POST["saveFile"] ) ) {
  saveFile();
} elseif ( isset( $_GET["filename"] ) ) {
  displayEditForm();
} elseif ( isset( $_POST["createFile"] ) ) {
  createFile();
} else {
  displayFileList();
}

function displayFileList( $message="" ) {
  displayPageHeader();
  if ( !file_exists( PATH_TO_FILES ) ) die( "Directory not found" );
  if ( !( $dir = dir( PATH_TO_FILES ) ) ) die( "Can't open directory" );

?>
    <?php if ( $message ) echo '<p class="error">' . $message . '</p>' ?>
    <h2>Create a new file: <center><a href="index.php?action=logout">Logout</a></center></h2>
    <form action="MyHelp.php" method="post">
      <div style="width: 20em;">
        <label for="filename">Filename</label>
        <div style="float: right; width: 7%; margin-top: 0.7em;"> .txt</div>
        <input type="text" name="filename" id="filename" style="width: 50%;" value="" />
        <div style="clear: both;">
          <input type="submit" name="createFile" value="Create File" />
        </div>
      </div>
    </form>	
    <h2>Or Choose a file to edit/View:</h2>
    <table cellspacing="0" border="0" style="border: 1px solid #666;">
      <tr>
        <th>Filename</th>
        <th>Description</th>
        <th>Example</th>
      </tr>
<?php

  while ( $filename = $dir->read() ) {
    $filepath = PATH_TO_FILES . "/$filename";
    if ( $filename != "." && $filename != ".." && !is_dir( $filepath ) && strrchr( $filename, "." ) == ".txt" && $filename != 'robot.txt' && $filename != 'robots.txt') {
	   $handle = @fopen($filepath, "r");
	   $description = fgets($handle);
	   $excutefile = substr($filename,0,-3)."php";
       echo '<tr><td><a href="MyHelp.php?filename=' . urlencode( $filename ) . '">' . $filename . '</a></td>';
       echo '<td>' . substr($description,2,(strlen($description) - 6)) . '</td>';
       echo "<td><a href='$excutefile'" . 'TARGET = "_blank">' . $excutefile . '</a></td></tr>';
    }
  }

  $dir->close();
?>
    </table>
  </body>
</html>
<?php
}

function displayEditForm( $filename="" ) {
  if ( !$filename ) $filename = basename( $_GET["filename"] );
  if ( !$filename ) die( "Invalid filename" );
  $filepath = PATH_TO_FILES . "/$filename";
  if ( !file_exists( $filepath ) ) die( "File not found" );
  displayPageHeader();
?>
<!--    <h2>Editing <?php echo $filename ?></h2> -->
    <form action="MyHelp.php" method="post">
      <div style="width: 78em;">
        <input type="hidden" name="filename" value="<?php echo htmlspecialchars( $filename ) ?>" />
        <textarea name="fileContents" id="fileContents" rows="50" cols="180" style="width: 100%;"><?php
           echo htmlspecialchars( file_get_contents( $filepath ) );
        ?></textarea>
        <div style="clear: both;">
          <input type="submit" name="saveFile" value="Save File" />
          <input type="submit" name="cancel" value="Cancel" style="margin-right: 20px;" />
        </div>
      </div>
    </form>
  </body>
</html>
<?php
}

function saveFile() {
  $filename = basename( $_POST["filename"] );
  $filepath = PATH_TO_FILES . "/$filename";
  if ( file_exists( $filepath ) ) {
    if ( file_put_contents( $filepath, $_POST["fileContents"] ) === false ) die( "Couldn't save file" );
    displayFileList();
  } else {
    die( "File not found" );
  }
}
    
function createFile() {
  $filename = basename( $_POST["filename"] );
  $filename = preg_replace( "/[^A-Za-z0-9_\- ]/", "", $filename );

  if ( !$filename ) {
    displayFileList( "Invalid filename - please try again" );
    return;
  }

  $filename .= ".txt";
  $filepath = PATH_TO_FILES . "/$filename";
  if ( file_exists( $filepath ) ) {
    displayFileList( "The file $filename already exists!" );
  } else {
    if ( file_put_contents( $filepath, "" ) === false ) die( "Couldn't create file" );
    chmod( $filepath, 0666 );
    displayEditForm( "$filename" );
  }
}
 
function displayPageHeader() {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>My important resource</title>
    <link rel="stylesheet" type="text/css" href="common.css" />
    <style type="text/css">
      .error { background: #d33; color: white; padding: 0.2em; }
      th { text-align: left; background-color: #999; }
      th, td { padding: 0.4em; }
    </style>
  </head>
  <body>
    <!--<h1>My important resource</h1> -->
<?php
}
?>

