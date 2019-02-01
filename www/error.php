<?php
define("SUCCESS", 0);
define("ERROR_INVALID_XML", 1);
define("ERROR_DB_FAILED", 2);
define("ERROR_UNKNOW_GAME", 2);

$ERROR_MSG = array(SUCCESS => "Successful",
				ERROR_INVALID_XML => "invalid xml",
				ERROR_DB_FAILED => "db error",
				ERROR_UNKNOW_GAME => "unknow game");

function getErrMsg($err)
{
	global $ERROR_MSG;
	return $ERROR_MSG[$err];
}

/**
 * @param int		$code	error code
 */
function reply($code)
{
	$msg = getErrMsg($code);
	header("Content-Type:text/html;charset=utf8");
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><response><hRet>$code</hRet><message>$msg</message></response>";
	exit(0);
}
