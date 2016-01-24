<?php
    $url = $_POST['url'];
    $return;
    
    $pCnt = 0;
    
    
    if(strpos($url, "http://www.foxnews.com/") === false){
            exit("Fatal Error: not a fox news article");
    
    }
    $html = new simple_html_dom();
    
    $html->load_file($url);
    
    while (strlen($return) <= 500){
        $return .= $html->find('div[itemprop=articleBody] p', $pCnt);
    }
    
    $filename = "opt/apps/webdata/nora/temp.txt";
    

    $myfile = fopen($filename, "w") or die("Unable to open file!");
    fwrite($myfile, $return);
    fclose($myfile);
    
?>