 <?php

echo "test";
// show_source(__FILE__);

$url = 'http://download.piriform.com/ccsetup311.exe'; // 3mb file;
$url2 = 'https://github.com/naja7host/style10/archive/master.zip'; //148 mb file
$url3 = 'http://ftp.gwdg.de/pub/linux/slackware/slackware-10.2-iso/slackware-10.2-install-d2.iso'; // >600 mb file

function progress($totaldownload, $downloaded, $us, $ud) {
 static $last;
 $ind =  @round($downloaded/$totaldownload*100); // division by zero - to correct
 if($last < $ind) echo $ind . "% ..." . str_pad(' ', 4096);       //if percentage change ->print
// if($last < $ind) echo $ind . "%<br />";
 flush();
 $last = $ind; //Remember last percentage number
}

function body($ch, $string) {
 $length = strlen($string);
 // join body chunks 
 // global $data;
 // $data .= $string;
 return $length;
}

function connect($url) {
 $ch = curl_init();
 $opts = array(CURLOPT_RETURNTRANSFER => false,
        CURLOPT_URL => $url,
        CURLOPT_NOPROGRESS => false,
		CURLOPT_FOLLOWLOCATION =>  1,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_PROGRESSFUNCTION => 'progress',
        CURLOPT_WRITEFUNCTION => 'body'
        );
 curl_setopt_array($ch, $opts);
 curl_exec($ch);
 curl_close($ch);
}

connect($url2); 

//echo strlen($data);

?> 