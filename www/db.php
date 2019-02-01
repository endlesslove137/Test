<?php
/**
 * Created by PhpStorm.
 * User: WorrySprite
 * Date: 2015/7/28
 * Time: 16:49
 */
require_once("log.php");
require_once("error.php");
require_once("config.php");

$link = NULL;

/**
 * @return PDO|PDO connection
 */
function getDBConnection()
{
	global $link;
	if (!$link)
	{
		try
		{
			$link = new PDO("mysql:host=192.168.9.142;dbname=fatso", "root", "123456");
		}
		catch (PDOException $e)
		{
			error("db connection failed: " . $e->getMessage());
			return NULL;
		}
		$link->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$link->query("set names utf8");
	}
	return $link;
}

/**
 * Update or create a bill by bill number.
 * @param	string	$billid		bill id
 * @param	int		$gameid		game id
 * @param	array	$billData	the bill data need to update or create
 * @param	bool	$create		create new bill or update
 * @return	int		SUCCESS or error code.
INSERT INTO `t_user` VALUES ('842', '1C:78:39:08:B6:99', '2015-09-18 16:43:34', '2015-09-18 16:43:34', '91', '0', '2015-09-18 16:43:34', null, null, 'ÍõÈóÖÇ', '0', '0', '0', '0', '2015-09-18 16:57:36', '1', '0'); 
 */
function saveBill(array &$billData, $create = true)
{
	$table = "trade_hj";
	$num = 0;
	if ($create)
	{
		$sql = "INSERT INTO $table SET ";
	}
	else
	{
		$sql = "UPDATE $table SET ";
	}
	foreach ($billData as $key => $value)
	{
		if ($num > 0)
		{
			$sql .= ", ";
		}
		$sql .= $key . "=?";
		++$num;
	}
	if ($create)
	{
		$sql .= ",LogTime=Now();";
	}
	else
	{
		$sql .= " WHERE id=?";
	}
	$link = getDBConnection();
	if (!$link)
	{
		return ERROR_DB_FAILED;
	}
	$sth = $link->prepare($sql);
	if (!$sth)
	{
		$error = $link->errorInfo();
		error("pdo prepare failed! sql=" . $sql . " SQLSTATE error code:" . $error[0] . ", error code:" . $error[1] . ", error msg:" . $error[2]);
		return ERROR_DB_FAILED;
	}
	$num = 1;
	foreach ($billData as $key => $value)
	{
		if (is_string($value) || is_float($value))
		{
			$sth->bindValue($num, $value, PDO::PARAM_STR);
		}
		else
		{
			$sth->bindValue($num, $value, PDO::PARAM_INT);
		}
		++$num;
	}
	var_dump($sth);
	if (!$create)
	{
		$sth->bindParam($num, $billid, PDO::PARAM_INT);
	}
	var_dump($sth);
	if (!$sth->execute())
	{
		$error = $link->errorInfo();
		error("pdo execute failed! sql=" . $sql . " SQLSTATE error code:" . $error[0] . ", error code:" . $error[1] . ", error msg:" . $error[2]);
		return ERROR_DB_FAILED;
	}
	return SUCCESS;
}