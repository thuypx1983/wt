<?php
class helper{


  function curl_download($Url){

    // is cURL installed yet?
    if (!function_exists('curl_init')){
      die('Sorry cURL is not installed!');
    }

    // OK cool - then let's create a new cURL resource handle
    $ch = curl_init();

    // Now set some options (most are optional)

    // Set URL to download
    curl_setopt($ch, CURLOPT_URL, $Url);

    // Set a referer
    curl_setopt($ch, CURLOPT_REFERER, "http://www.google.com/bot.html");

    // User agent
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");

    // Include header in result? (0 = yes, 1 = no)
    curl_setopt($ch, CURLOPT_HEADER, 0);

    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    // Download the given URL, and return output
    $output = curl_exec($ch);

    // Close the cURL resource, and free system resources
    curl_close($ch);

    return $output;
  }

  function getConfig($domain){
    return json_decode(file_get_contents(ROOT_DIR.'/'.$domain.'.json'),true);
  }

  function saveConfig($domain,$config=array()){
    file_put_contents(ROOT_DIR.'/'.$domain.'.json',json_encode($config));
  }

  function encodeTitle($title){
      return base64_encode($this->cleanTitle($title));
  }
  function cleanTitle($title){
     return trim($title);
  }
}