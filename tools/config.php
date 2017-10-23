<?php
define("ROOT_DIR",dirname(__FILE__));
include "simplehtmldom_1_5/simple_html_dom.php";
include "libs/helper.php";

//database connection
include "libs/database/MysqliDb.php";
global $db;
$db = new MysqliDb ('localhost','truyenthegioi_co', 'Sta9D3#23tM9aj','truyenthegioi_com',3306,'utf8');

