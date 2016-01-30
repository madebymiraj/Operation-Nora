<?php
    include("simple_html_dom.php");
    
    //$url = $_POST['url'];
    $url = "http://www.foxnews.com/politics/2016/01/23/report-bloomberg-considering-indepedent-2016-white-house-bid.html?intcmp=hpbt2";
    $return;
    $topSentiment;
    
    $pCnt = 1;
    
    
    if(strpos($url, "http://www.foxnews.com/") === false){
            exit("Fatal Error: not a fox news article");
    
    }
    $html = new simple_html_dom();
    
    $html->load_file($url);
    
    foreach($html->find('div[itemprop=articleBody]') as $articleP){
        
        // These code snippets use an open-source library. http://unirest.io/php
        $response = Unirest\Request::get("https://sentity-v1.p.mashape.com/v1/sentiment?text=" . urlencode(replaceSpacePlus($string)),
          array(
            "X-Mashape-Key" => "JwBE6QlxDqmshDdkMdTrXoTvT2iAp125ImBjsnGT8v9IcHL6eD",
            "Accept" => "application/json"
          )
        );
        
        $newSentiment = ($response["pos"] > $response["neg"] ? $response["pos"] : $response["neg"]);
        if ($topSentiment > $newSentiment){
            $result = $articleP;
        }
    }
    
    echo $return;


    function replaceSpacePlus($string){
        $string=preg_replace("/ /","+",$string);
        return $string;
    }
?>