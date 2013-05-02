<?php
  date_default_timezone_set('America/Los_Angeles');
  error_reporting(E_ERROR | E_PARSE);

/* Parse the page */
	$curl = curl_init('http://www.reddit.com/r/pics/comments/1deapr/made_this_for_my_friendhe_was_not_happy/');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.10 (KHTML, like Gecko) Chrome/8.0.552.224 Safari/534.10');
	$html = curl_exec($curl);
	curl_close($curl);

/* Catch if html is wrong for whatever reason */
	if (!$html)
		die("something's wrong");

/* Setup the DOM and XPath */
	$dom = new DOMDocument;
	$dom->loadHTML($html);
	$dom->preserveWhiteSpace = false;
	$xpath = new DOMXPath($dom);
	
	foreach( $xpath->query('//div[@class="linkinfo"]/span[@class="upvotes"]/span[@class="number"]') as $n) {
		$a = $n->nodeValue;
	}
	foreach( $xpath->query('//div[@class="linkinfo"]/span[@class="downvotes"]/span[@class="number"]') as $n) {
		$b = $n->nodeValue;
	}
?>

<Response>
	<Sms><?php echo $a . ", " . $b?></Sms>
</Response>
