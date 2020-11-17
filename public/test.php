<?php


$filename = 'https://www.amazon.co.uk/progress-tracker/package/ref=pe_3187911_189395841_TE_typ?_encoding=UTF8&from=gp&itemId=&orderId=203-2171364-3066749&packageIndex=0&shipmentId=23796758607302';
$file = file_get_contents($filename);
$html = new DOMDocument();
@$html->loadHTML($file);
foreach($html->getElementsByTagName('span') as $a) {
    $property=$a->getAttribute('id');
    if (strpos($property , "primaryStatus")){
		print_r($property);
		echo "<br />o";
        print_r($a);
	}
		print_r($property);

}
?>


