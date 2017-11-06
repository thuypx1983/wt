<?php
//https://github.com/joshcam/PHP-MySQLi-Database-Class
include 'config.php';
$helper=new helper();
$domain='webtruyen.com';

$db = MysqliDb::getInstance();
$db->where('status',0);
$story=$db->getOne('crawl_story');
if(!$story){
  echo "completed";
  exit();
}
$html_str =$helper->curl_download($story['url_source']);
$html = new simple_html_dom();
$html->load($html_str);
$data=array();

//$data['title']=$html->find('.detail h1 a',0)->innertext;
$data['category']=$html->find('span[itemprop=title]',1)->innertext;
$data['image']=$html->find('.detail-thumbnail img',0)->src;
$data['detail']=strip_tags($html->find('.summary',0)->innertext);
$data['author']=strip_tags($html->find('.detail-info li',0)->innertext);
$data['status']=1;
$status=trim(strip_tags($html->find('.detail-info ul',0)->find('li', 3)->plaintext));
if($status=='Đang cập nhật'){
  $data['state']=1;
}else{
  $data['state']=2;
}
$db->where ('id',$story['id']);
$db->update('crawl_story',$data);

$chapters=array();
$weight=1;

//get list chapter in first page
foreach($html->find('#divtab',0)->find('.w3-ul li a') as $a){
    $chapters[]=array(
        'url_source'=>$a->href,
        'title'=>strip_tags(strip_tags($a->innertext)),
        'weight'=>$weight,
        'story_id'=>$story['id'],
        'domain'=>$domain,
    );
    $weight++;
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
            $chapters[]=array(
                'url_source'=>$a->href,
                'title'=>$a->plaintext,
                'weight'=>$weight,
                'story_id'=>$story['id'],
                'domain'=>$domain,
            );
            $weight++;
        }
    };
}
if(count($chapters)){
    $db->insertMulti('crawl_story_chapter', $chapters);
}
echo "done";

