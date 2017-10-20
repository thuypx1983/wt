<?php
//https://github.com/joshcam/PHP-MySQLi-Database-Class
include 'config.php';
$helper=new helper();
$domain='sutunam.com';

$db = MysqliDb::getInstance();
$db->where('status',0);
$story=$db->getOne('crawl_story');

$html_str =$helper->curl_download($story['url_source']);
$html = new simple_html_dom();
$html->load($html_str);
$data=array();

$data['title']=strtolower($html->find('.detail h1 a',0)->plaintext);
$data['category']=strtolower($html->find('span[itemprop=title]',1)->plaintext);
$data['image']=$html->find('.detail-thumbnail img',0)->src;
$data['detail']=strtolower(strip_tags($html->find('.summary',0)->outertext));
$data['author']=$html->find('.detail-info li',0)->plaintext;
$data['first_chapter']='';
$data['status']=1;

$db->where ('id',$story['id']);
$db->update('crawl_story',$data);
print_r($story);
print_r($data);
