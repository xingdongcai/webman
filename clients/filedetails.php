<?php
//we passed the name of the file via a QueryString
$file = $_GET["filename"];
//display name of file
echo "<h1>Details of file: ".$file."</h1>";
//display absolute path of file using realpath function
echo "<h2>File path: ".realpath($file)."</h2>";
echo "<h2>File data</h2>";
//display date last accessed in d/m/yyy hh:mm format using fileattime
echo "File last accessed: ".date("d/m/Y h:i A", fileatime($file))."<br>";
//display date last modified in dd mth yyyy hh:mm format using filetime
//j – day of month without leading zero, F – long month name
//h – hours in 12 hour format with leading zero and A gives upper AM or PM
//H – gives hours in 24 hour format, i - gives minutes with leading zero
echo "File last modified: ".date("j F Y H:i", filemtime($file))."<br>";
//display file type
echo "File type: ".filetype($file)."<br>";
//display file size
echo "File size: ".filesize($file)." bytes<br>";
