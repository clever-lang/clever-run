<?php

$file = '/var/www/tmp/' . uniqid();

file_put_contents($file, $_POST['code']);

$command = 'sh run.sh ' . $file;

$output = shell_exec($command);
$str = @file_get_contents($file . '.err');

if (!empty($str)) {
	echo 'Compiler Output:<br/>';
	echo '<pre>' . $str . '</pre><br/>';
}

echo '<pre>';
echo $output;
echo '</pre>';
?>
