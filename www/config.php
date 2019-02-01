<?php

//debug toggle
define("DEBUG", false);

//-----------------game definitions------------------
define("STAR2015", 1);

$GAME_INFO = array(
	STAR2015 => array("id" => STAR2015,
				"name" => "星际2015 3D",
				"table_name" => "t_star2015",
				"appid" => "120123002000")
);

/**
 * @param	int		$gameid	game id
 * @return	array	An assoc array of game info
 */
function getGameByID($gameid)
{
	global $GAME_INFO;
	return $GAME_INFO[$gameid];
}

function getGameByAppID($appid)
{
	global $GAME_INFO;
	foreach($GAME_INFO as $value)
	{
		if ($value["appid"] == $appid)
		{
			return $value;
		}
	}
}

//-----------------paycode definitions------------------

$PAY_CODE_PRICE = array("123456" => 2.00);

function getPrice($paycode)
{
	global $PAY_CODE_PRICE;
	return $PAY_CODE_PRICE[$paycode];
}

//-----------------platform definitions------------------
define("CHANNEL_NONE", 0);
define("CHANNEL_CHINEMOBILE", 1);
