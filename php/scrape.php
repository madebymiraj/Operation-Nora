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

    
    foreach($html->find('div[itemprop=articleBody] div.article-text p') as $articleP){
        
        echo $articleP;
        var_dump($articleP);
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_HTTPHEADER => array(
            'X-Mashape-Key: JwBE6QlxDqmshDdkMdTrXoTvT2iAp125ImBjsnGT8v9IcHL6eD',
            'Accept: application/json',
            'Content-Type: application/json'),
            CURLOPT_URL => 'https://sentity-v1.p.mashape.com/v1/sentiment',
            CURLOPT_POSTFIELDS => $articleP,
        ));
       
        // Send the request & save response to $resp
        $response = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        
        
        $newSentiment = ($response->pos > $response->neg ? $response->pos : $response->neg);
        if ($topSentiment > $newSentiment){
            $result = $articleP;
        }
    }
    echo "script finished";
    echo $return;


    function replaceSpacePlus($string){
        $string=preg_replace("/ /","+",$string);
        return $string;
    }
?>