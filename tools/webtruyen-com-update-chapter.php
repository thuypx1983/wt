<?php
//https://github.com/joshcam/PHP-MySQLi-Database-Class
include 'config.php';
$helper=new helper();
$domain='webtruyen.com';

$db = MysqliDb::getInstance();
$db->where('status',2);
$story=$db->getOne('crawl_story');
if(!$story){
  echo "completed";
  exit();
}

$html_str =$helper->curl_download($story['url_source']);
$html = new simple_html_dom();
$html->load($html_str);
$data=array();

$db->where ('id',$story['id']);
$db->update('crawl_story',array('status'=>1));

$chapters=array();
$weight=1;

//get list chapter in first page
foreach($html->find('#divtab',0)->find('.w3-ul li a') as $a){
    $title=strip_tags($a->innertext);
    preg_match_all('!(\d+)!', $title, $matches);
    //$weight=(int)(implode('',$matches[1]));
    $weight=$matches[1][0];

    $db->where('url_source',$a->href);
    $row=$db->getOne('crawl_story_chapter');
    if(!$row){
      $chapters[]=array(
        'url_source'=>$a->href,
        'title'=>$title,
        'weight'=>$weight,
        'story_id'=>$story['id'],
        'domain'=>$domain,
      );
    }
}
$html->clear();
$html->load($html_str);
$max_page=0;
$last_page= $html->find('.w3-pagination a',-1);
if($last_page){
    $last_href=$last_page->href;
    $max_page=(int)basename($last_href);
    for($i=2;$i<=$max_page;$i++){
        $url= $story['url_source'].$i.'/';
        $html1 = new simple_html_dom();
        $html_str1=$helper->curl_download($url);
        $html1->load($html_str1);

        foreach($html1->find('#divtab',0)->find('.w3-ul li a') as $a){
            $title=strip_tags($a->innertext);
            preg_match_all('!(\d+)!', $title, $matches);
            //$weight=(int)(implode('',$matches[1]));
            $weight=$matches[1][0];

          $db->where('url_source',$a->href);
          $row=$db->getOne('crawl_story_chapter');
          if(!$row) {
            $chapters[]=array(
              'url_source'=>$a->href,
              'title'=>$title,
              'weight'=>$weight,
              'story_id'=>$story['id'],
              'domain'=>$domain,
            );
          }
        }
    };
}
if(count($chapters)){
    $db->insertMulti('crawl_story_chapter', $chapters);
}
echo "done";

