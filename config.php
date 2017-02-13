<?php defined("CATALOG") or die("Access denied");

define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DB", "catalog");
define("PATH", "http://catalog.loc/");
define("VIEW", "views/apple/");
define("PERPAGE", 6);
define("PRODUCTIMG", "userfiles/products/");
$option_perpage = array(5, 10, 15);

$connection = @mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die("Нет соединения с БД");
mysqli_set_charset($connection, "utf8") or die("Не установлена кодировка соединения");