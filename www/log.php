<?php
function debug($content)
{
	date_default_timezone_set('PRC');
	$file = fopen("log/debug.log", "a");
	$data = date("Y/m/d H:i:s") . "  " . $content . "\n";
	fwrite($file, $data);
	fclose($file);
}

function error($content)
{
	date_default_timezone_set('PRC');
	$file = fopen("log/error.log", "a");
	$data = date("Y/m/d H:i:s") . "  " . $content . "\n";
	fwrite($file, $data);
	fclose($file);
}