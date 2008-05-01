<?php

$path = $_REQUEST['path'];

$dir_handle = @opendir($path) or die("Unable to open $path");
$output = "";

if (strpos($path, '/') == false){
	$title = $path;
}else{
	$i_hate_php = split('/', $path);
	$title = $i_hate_php[1];
}

function clean_title($title){
	return str_replace('.mp4', '', str_replace('.m4v', '', $title));
}

function make_link($path, $file){
	if (is_dir($path . "/" . $file)){
		return "<li><a href=\"browse.php?path=$path/$file\">" . clean_title($file) . "</a></li>";
	}else{
		return "<li><a href=\"$path/$file\" target=\"_self\">" . clean_title($file) . "</a></li>";
	}
	
}

while ($file = readdir($dir_handle)){
	if(substr($file, 0, 1) != "."){
		$output .= make_link($path, $file);
	}
}


?>


<ul id="" title="<?php echo $title ?>" selected="true">
<?php echo $output ?>
</ul>
