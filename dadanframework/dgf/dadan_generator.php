<?php
$myfile = fopen("index3.php", "w") or die("Unable to open file!");
$txt = file_get_contents("template.php");
fwrite($myfile, $txt);
?>
