<?php
//https://github.com/joshcam/PHP-MySQLi-Database-Class
include 'config.php';
$helper=new helper();
$domain='webtruyen.com';


$url='http://webtruyen.com/all/';

$html_str =$helper->curl_download($url);
$html = new simple_html_dom();
$html->load($html_str);
$db = MysqliDb::getInstance();
foreach($html->find('.list-content .list-caption a') as $a)
{
  $db->where('url_source',$a->href);
  $row=$db->getOne('crawl_story');
  if($row){
    echo "Exist record".PHP_EOL;
  }else{
      $title=$helper->cleanTitle($a->plaintext);
      $title_code=$helper->encodeTitle($a->plaintext);

      $db->where('title_code',$title_code);
      $row=$db->getOne('crawl_story');
        $data=array(
            'domain'=>$domain,
            'url_source'=>$a->href,
            'title' => $title,
            'title_code'=>$title_code,
        );
        if($row){
            $data['duplicate']=1;
        }
      $db->insert('crawl_story',$data);
  }
}
echo 'done';

