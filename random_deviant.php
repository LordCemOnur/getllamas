<?php


//TODO This Page

include('simple_html_dom.php');
	
$url = "http://www.deviantart.com/random/deviant";
$deviantHTML = file_get_html($url); 
foreach($deviantHTML->find('div.bubbleview div.catbar div.gruserbadge h1 span a') as $element) {
    $randomUser = $element->plaintext;
    echo "<br>" .$randomUser;
}

/*
$findUser = $deviantHTML->find('div.bubbleview div.catbar div.gruserbadge h1 span a');
echo "<br>" .$findUser;
$randomUser = $findUser->plaintext;
*/
//$currentContent = $element->plaintext;
        
        
	//echo "<br>" .$randomUser;
    //echo "<br><br><br><br><br><br><br>" .$currentContent;

	$llama_check = "true";
	$_SESSION['LlamaCheck'] = $llama_check;


?>
