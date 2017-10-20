<?php
//https://github.com/joshcam/PHP-MySQLi-Database-Class
include 'config.php';
$helper=new helper();
$domain='webtruyen.com';
$config=$helper->getConfig($domain);

if($config['current_page']<0){
  echo "Don't find new page";
  die();
}
if($config['current_page']==0){
  $config['current_page']=$config['total_page'];
}else{
  $config['current_page']=$config['current_page']-1;
}

$url=$config['url'].$config['current_page'].'/';

$helper->saveConfig($domain,$config);

$html_str =$helper->curl_download($url);
$html = new simple_html_dom();
$html->load($html_str);
$db = MysqliDb::getInstance();
foreach($html->find('.list-content a.w3-hover-opacity') as $a)
{
  $db->where('url_source',$a->href);
  $row=$db->getOne('crawl_story');
  if($row){
    echo "Exist record".PHP_EOL;
  }else{
    echo 'inserted: ',$a->href.PHP_EOL;
    $db->insert('crawl_story',array('domain'=>$domain,'url_source'=>$a->href));
  }
}

