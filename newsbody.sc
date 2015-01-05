global $tp;
$news_item = getcachedvars('current_news_item');
$param = getcachedvars('current_news_param');

$style1 = new style1;

	if ($parm == '')
		$limit = 350 ;
	else 
		$limit = $parm ;
				
	$text = $tp -> toHTML($news_item['news_body'], TRUE, 'BODY, fromadmin', $news_item['news_author']);


if($news_item['news_extended'] && (isset($_POST['preview']) || strpos(e_QUERY, 'extend') !== FALSE) && $parm != "noextend")
{
    $news_extended = $tp -> toHTML($news_item['news_extended'], TRUE, 'BODY, fromadmin', $news_item['news_author']);
    $text .= "<br /><br />".$news_extended;
	return $text;
} else {
	return $style1->truncateHtml($text , $limit );
}
   
