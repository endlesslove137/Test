<?php
/**
 * Created by PhpStorm.
 * User: WorrySprite
 * Date: 2015/7/28
 * Time: 15:06
 */
require_once("db.php");
require_once("error.php");

/********** notify format ************
<?xml version="1.0" encoding="UTF-8"?>
<request>
	<userId>12345678</userId>
	<contentId>120123002000</contentId >
	<consumeCode>120123002001</consumeCode>
	<cpID>723002</cpID>
	<hRet>0</hRet>
	<status>1800</status>
	<versionId>21120</versionId>
	<cpParam>0000000000000000</cpParam>
	<packageID></packageID>
</request>
 ***************************************/
/********* response format ***********
<?xml version="1.0" encoding="UTF-8"?>
<response>
	<hRet>0</hRet>
	<message>Successful</message>
</response>
 ***************************************/
//http://localhost/cm_notify.php?tradeId=20130517120524899339&point=4&amount=4&extraInfo=HJ&ts=1368257066&class=1
if (true)
{
	$tradeid = (string)$_GET["tradeId"]; //交易编号1
	$point = (int)$_GET["point"];   //账单点数
	$amount = (int)$_GET["amount"];//请求成功点数
	$extraInfo = (string)$_GET["extraInfo"];//开发商自订参数
	$ts = (string)$_GET["ts"];//时间戳
	$tclass = (int)$_GET["class"];//支付类型
	$billData = array("tradeId" => $tradeid,
					  "point" => $point,
					  "amount" => $amount,
					  "extraInfo" => $extraInfo,
					  "ts" => $ts,
					  "class" => $tclass);
	saveBill($billData, true);
//	reply(SUCCESS);
}
else
{
//	reply(ERROR_INVALID_XML);
}
