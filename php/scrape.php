<?php
    include("simple_html_dom.php");
    
    //$url = $_POST['url'];
    $url = "http://www.foxnews.com/politics/2016/01/23/report-bloomberg-considering-indepedent-2016-white-house-bid.html?intcmp=hpbt2";
    $return;
    
    $pCnt = 1;
    
    
    if(strpos($url, "http://www.foxnews.com/") === false){
            exit("Fatal Error: not a fox news article");
    
    }
    $html = new simple_html_dom();
    
    $html->load_file($url);
    
    while (strlen($return) <= 500 || $pCnt <= 3){
        $return .= $html->find('div[itemprop=articleBody] p', $pCnt);
        $pCnt += 1;
    }
    
    $h1 = $html->find("h1", 0);
    
    $filename = "/home/ccastellanoit/public_html/nora/files/" . urlencode($h1) . ".txt";
    

    $myfile = fopen($filename, "w") or die("Unable to open file!");
    fwrite($myfile, $return);
    fclose($myfile);
    
    $ch = curl_init("../working/javaLoad.php");
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $filename);
    curl_exec($ch);
    curl_close($ch);


    
?>