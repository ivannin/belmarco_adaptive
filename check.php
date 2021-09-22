<?php

scan_dir();

function scan_dir($dir='.'){
$dh = opendir($dir);
while(($f = readdir($dh)) !== false){
if(in_array($f, array('.', '..'))){
continue;
}
$fp = $dir.'/'.$f;

if(is_dir($fp)){
scan_dir($fp);
}
if(strpos($f, '.php') !== false){
$str = file_get_contents($fp);

if(preg_match('/^\s+<\?php|\?>\s+$/i', $str)){
echo $fp."<br>";
}
}
}
}

?>