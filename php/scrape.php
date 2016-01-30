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
        
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://sentity-v1.p.mashape.com/v1/sentiment?text=' . urlencode(replaceSpacePlus($articleP)),
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'X-Mashape-Key: JwBE6QlxDqmshDdkMdTrXoTvT2iAp125ImBjsnGT8v9IcHL6eD',
            'Accept: application/json'
            ));
        // Send the request & save response to $resp
        $response = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        var_dump($response);
        
        //$newSentiment = ($response["pos"] > $response["neg"] ? $response["pos"] : $response["neg"]);
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