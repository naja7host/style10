//SC_BEGIN NEWSIMAGE
$news_item = getcachedvars('current_news_item');
$param = getcachedvars('current_news_param');
$url = make_url($news_item);

	if ($parm == '')
		$thumb = "&amp;w=450&amp;zc=0" ;
	else 
		$thumb = $parm ;
		
return (isset($news_item['news_thumbnail']) && $news_item['news_thumbnail']) ? "<img class='".$GLOBALS['NEWS_CSSMODE']."_image' src='".THEME."thumbs.php?src=".e_IMAGE_ABS."newspost_images/".$news_item['news_thumbnail']. $thumb ."' alt='". $news_item['news_title'] ."' />" : "";
//SC_END

return "<img src='".e_IMAGE_ABS."newspost_images/".$parm."' alt='' />";

