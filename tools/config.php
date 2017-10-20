<?php
define("ROOT_DIR",dirname(__FILE__));
include "simplehtmldom_1_5/simple_html_dom.php";
include "libs/helper.php";

//database connection
include "libs/database/MysqliDb.php";
global $db;
$db = new MysqliDb ('localhost','root', 'root','wt_crawl',3306,'utf8');

