<?php
//$file = $_GET["filename"];
//echo "<h1>Source Code for: ".$file."</h1>";
////open file for reading only
//
////retrieve table which translates HTML tags to entities, eg convert < to &lt;
//    $line = file_get_contents($file);
//    $trans = get_html_translation_table(HTML_ENTITIES);
////get one line from file $fp
//
////performs translation/sub string replacement based on translation table
//    $line = strtr($line,$trans);
////replace tab character with 4 HTML spaces to maintain some formatting
//    $line = str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;",$line);
//    $line = str_replace("\n","<br/>",$line);
////echo line to screen, followed by break
//    echo $line."<br />";
//

$file = $_GET["filename"];
echo "<h1>Source Code for: " . $file . "</h1>";
highlight_file($file);


