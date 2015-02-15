<?php
if (!defined('e107_INIT')) { exit; }

class style1 {
	
	public function get_new_version($theme) 
	{
		global $themeversion, $themerawname ;

		$update = "";
			
		if(is_writable(THEME))
		{
			$disabled ="" ;
			$writeable_message ="";
		} 
		else 
		{
			$disabled =" disabled='disabled'" ;
			$writeable_message ="
								<tr class='warning'>
									<td>". LAN_THEME_ADMIN_WARNING ."	</td>
									<td>". LAN_THEME_UPDATE_02 . THEME_ABS . LAN_THEME_UPDATE_03 ."</td>
								</tr>";
		}	
		
		// 
		$raw_response =  file_get_contents("https://raw.githubusercontent.com/naja7host/$themerawname/master/README.md");
		
		if ( !$raw_response  )
			return $version = "	$writeable_message
								<tr class='danger' >
									<td>". LAN_THEME_UPDATE_03."	</td>
									<td>N/A</td>
								</tr>";

		preg_match( '#^\s*`*~Current Version\:\s*([^~]*)~#im', $raw_response, $__version );

		if ( isset( $__version[1] ) ) {
			$version_readme = $__version[1];
			if (-1 == version_compare( $themeversion, $version_readme ) ) 
			{
				$class ="class='success'";
				$version = $version_readme;
				
				$update ="			
									<button class='btn btn-primary button-save btn-xs' $disabled  name='frontpage_news_submit_update_theme'>
										<span class='glyphicon glyphicon-import'></span>
										<span class='hidden-phone'>". LAN_THEME_UPDATE_05 ."</span>
									</button>";												
			}
			else 
			{
				$class ="";
				$version = $version_readme;
				$update ="			<button class='btn btn-default button-save btn-xs'  disabled='disabled' name='frontpage_news_submit_update_theme'>
										<span class='glyphicon glyphicon-stop'></span>
										<span class='hidden-phone'>". LAN_THEME_UPDATE_05 ."</span>
									</button>";
			}			
		}

		// Refresh every 6 hours
		// To be Added next release
		
		return "				$writeable_message
								<tr ".$class.">
									<td>". LAN_THEME_UPDATE_04 ."	</td>
									<td>". $version . $update ."</td>
								</tr>
								
								";
	}		
	
	/**
	 * Get Headers function
	 * @param str #url
	 * @return array
	 */
	public function getHeaders($url)
	{
		$ch = curl_init($url);
		curl_setopt( $ch, CURLOPT_NOBODY, true );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_MAXREDIRS, 3 );
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);		
		curl_exec( $ch );
		$headers = curl_getinfo( $ch );
		curl_close( $ch );

		return $headers;
	}	

	/**
	 * Download
	 * @param str $url, $path
	 * @return bool || void
	 */
	public function download($url, $path)
	{
		# open file to write
		$fp = fopen ($path, 'w+');
		# start curl
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		# set return transfer to false
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
		curl_setopt( $ch, CURLOPT_BINARYTRANSFER, false );
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);				
		// curl_setopt($ch, CURLOPT_NOPROGRESS, false);				
		// curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'progress');				
		// curl_setopt($ch,  CURLOPT_WRITEFUNCTION , 'body');				
		# increase timeout to download big file
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
		# write data to local file
		// curl_setopt( $ch, CURLOPT_FILE, $fp );
		
		# execute curl
		$data = curl_exec( $ch );
		file_put_contents($path, $data);	
		# close curl
		curl_close( $ch );
		# close local file
		fclose( $fp );

		if (filesize($path) > 0) return true;
	}
	
	public function download_file ($url, $path)
	{

		$newfilename = $path;
		$file = fopen ($url, "rb");
		if ($file) 
		{
			$newfile = fopen ($newfilename, "wb");
			if ($newfile)
			while(!feof($file)) 
			{
			  fwrite($newfile, fread($file, 1024 * 8 ), 1024 * 8 );
			}
		}
		if ($file) 
		{
			fclose($file);
		}
		if ($newfile) 
		{
			fclose($newfile);
		}
	}

	/**
	 * truncate Html
	 */
	public function truncateHtml($text,  $length = 150 , $strip_tags = true , $ending = ' ... ', $exact = false, $considerHtml = true  ) {
		if ($considerHtml) {
			// if the plain text is shorter than the maximum length, return the whole text
			if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
				$text = str_replace("&nbsp;", "", $text);
				return strip_tags($text);
			}
			
			// splits all html-tags to scanable lines
			preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
			$total_length = strlen($ending);
			$open_tags = array();
			$truncate = '';
			foreach ($lines as $line_matchings) {
				// if there is any html-tag in this line, handle it and add it (uncounted) to the output
				if (!empty($line_matchings[1])) {
					// if it's an "empty element" with or without xhtml-conform closing slash
					if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
						// do nothing
					// if tag is a closing tag
					} else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
						// delete tag from $open_tags list
						$pos = array_search($tag_matchings[1], $open_tags);
						if ($pos !== false) {
						unset($open_tags[$pos]);
						}
					// if tag is an opening tag
					} else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
						// add tag to the beginning of $open_tags list
						array_unshift($open_tags, strtolower($tag_matchings[1]));
					}
					// add html-tag to $truncate'd text
					$truncate .= $line_matchings[1];
				}
				// calculate the length of the plain text part of the line; handle entities as one character
				$content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
				if ($total_length+$content_length> $length) {
					// the number of characters which are left
					$left = $length - $total_length;
					$entities_length = 0;
					// search for html entities
					if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
						// calculate the real length of all entities in the legal range
						foreach ($entities[0] as $entity) {
							if ($entity[1]+1-$entities_length <= $left) {
								$left--;
								$entities_length += strlen($entity[0]);
							} else {
								// no more characters left
								break;
							}
						}
					}
					$truncate .= substr($line_matchings[2], 0, $left+$entities_length);
					// maximum lenght is reached, so get off the loop
					break;
				} else {
					$truncate .= $line_matchings[2];
					$total_length += $content_length;
				}
				// if the maximum length is reached, get off the loop
				if($total_length>= $length) {
					break;
				}
			}
		} else {
			if (strlen($text) <= $length) {
				return $text;
			} else {
				$truncate = substr($text, 0, $length - strlen($ending));
			}
		}
		// if the words shouldn't be cut in the middle...
		if (!$exact) {
			// ...search the last occurance of a space...
			$spacepos = strrpos($truncate, ' ');
			if (isset($spacepos)) {
				// ...and cut the text in this position
				$truncate = substr($truncate, 0, $spacepos);
			}
		}
		// add the defined ending to the text
		$truncate .= $ending;
		if($considerHtml) {
			// close all unclosed html-tags
			foreach ($open_tags as $tag) {
				$truncate .= '</' . $tag . '>';
			}
		}
		
		$truncate = str_replace("&nbsp;", " ", $truncate);
		
		if ($strip_tags)
			return strip_tags(htmlspecialchars_decode($truncate));
		else 
			return htmlspecialchars_decode($truncate);
	}	
}

function check_new_update() 
{
	global $pref , $themeversion, $themerawname  ;

	$update = "";
		
	if(is_writable(THEME."cache"))
	{
		$disabled ="" ;
		$writeable_message ="";
	} 
	else 
	{
		$disabled =" disabled='disabled'" ;
		$writeable_message ="
							<tr class='warning'>
								<td>". LAN_THEME_ADMIN_WARNING ."	</td>
								<td>". LAN_THEME_UPDATE_02 . THEME_ABS . LAN_THEME_UPDATE_03 ."</td>
							</tr>";
	}	
	
	// 
	$raw_response =  file_get_contents("https://raw.githubusercontent.com/naja7host/$themerawname/master/README.md");
	
	if ( !$raw_response  )
		return $version = "	$writeable_message
							<tr class='danger' >
								<td>". LAN_THEME_UPDATE_03."	</td>
								<td>N/A</td>
							</tr>";

	preg_match( '#^\s*`*~Current Version\:\s*([^~]*)~#im', $raw_response, $__version );

	if ( isset( $__version[1] ) ) {
		$version_readme = $__version[1];
		if (-1 == version_compare( $themeversion, $version_readme ) ) 
		{
			$class ="class='success'";
			$version = $version_readme;
			
			$update ="			
								<button class='btn btn-primary button-save btn-xs' $disabled  name='frontpage_news_submit_update_theme'>
									<span class='glyphicon glyphicon-import'></span>
									<span class='hidden-phone'>". LAN_THEME_UPDATE_05 ."</span>
								</button>";												
		}
		else 
		{
			$class ="";
			$version = $version_readme;
			$update ="			<button class='btn btn-default button-save btn-xs'  disabled='disabled' name='frontpage_news_submit_update_theme'>
									<span class='glyphicon glyphicon-stop'></span>
									<span class='hidden-phone'>". LAN_THEME_UPDATE_05 ."</span>
								</button>";
		}			
	}

	// Refresh every 6 hours
	// To be Added next release
	
	return "				$writeable_message
							<tr ".$class.">
								<td>". LAN_THEME_UPDATE_04 ."	</td>
								<td>". $version . $update ."</td>
							</tr>
							
							";
}	

if ($pref['frontpage_news_fonts'])
	define('FONTS', $pref['frontpage_news_fonts']);
else
	define('FONTS', "normal");
	
define('ADMINTOOLS', false);

//XXX XURL Definitions. 

$xurls = array(
	'facebook'		=> 	array('label'=>"Facebook",	"placeholder"=>"eg. https://www.facebook.com/naja7host"),
	'twitter'		=>	array('label'=>"Twitter",	"placeholder"=>"eg. https://twitter.com/naja7host"),
	'youtube'		=>	array('label'=>"Youtube",	"placeholder"=>"eg. https://youtube.com/naja7host"),
	'google'		=>	array('label'=>"Google+",	"placeholder"=>""),
	'flickr'		=>	array('label'=>"Flickr",	"placeholder"=>""),
	'instagram'		=>	array('label'=>"Instagram",	"placeholder"=>""),
	'linkedin'		=>	array('label'=>"LinkedIn",	"placeholder"=>"eg. http://www.linkedin.com/groups?home=&gid=1782682"),
	'github'		=>	array('label'=>"Github",	"placeholder"=>"eg. https://github.com/naja7host"),
	'pinterest'		=>	array('label'=>"Pinterest",	"placeholder"=>""),
	'skype'			=>	array('label'=>"Skype",		"placeholder"=>""),	
	'vimeo'			=>	array('label'=>"Vimeo",		"placeholder"=>""),	
	'picasa'		=>	array('label'=>"Picasa",	"placeholder"=>""),	
	'tumblr'		=>	array('label'=>"Tumblr",	"placeholder"=>""),		
	'rss'			=>	array('label'=>"RSS",		"placeholder"=>"eg. ". e_SITE . e_PLUGIN ."rss_menu/rss.php"),
);	
	
if(is_array($pref['xurl']))
{
	define('XURL_FACEBOOK', varsettrue($pref['xurl']['facebook'], false));
	define('XURL_TWITTER', varsettrue($pref['xurl']['twitter'], false));
	define('XURL_YOUTUBE', varsettrue($pref['xurl']['youtube'], false));
	define('XURL_GOOGLE', varsettrue($pref['xurl']['google'], false));
	define('XURL_FLICKR', varsettrue($pref['xurl']['flickr'], false));	
	define('XURL_INSTAGRAM', varsettrue($pref['xurl']['instagram'], false));	
	define('XURL_LINKEDIN', varsettrue($pref['xurl']['linkedin'], false));
	define('XURL_GITHUB', varsettrue($pref['xurl']['github'], false));
	define('XURL_PINTEREST', varsettrue($pref['xurl']['pinterest'], false));	
	define('XURL_SKYPE', varsettrue($pref['xurl']['skype'], false));
	define('XURL_VIMEO', varsettrue($pref['xurl']['vimeo'], false));
	define('XURL_PICASA', varsettrue($pref['xurl']['picasa'], false));
	define('XURL_TUMBLR', varsettrue($pref['xurl']['tumblr'], false));
	define('XURL_RSS', varsettrue($pref['xurl']['rss'],  e_PLUGIN ."rss_menu/rss.php"));
}
else
{
	define('XURL_FACEBOOK', "https://www.facebook.com/naja7host");
	define('XURL_TWITTER', "https://twitter.com/naja7host");
	define('XURL_YOUTUBE', "https://youtube.com/naja7host");
	define('XURL_GOOGLE', false);
	define('XURL_FLICKR', false);
	define('XURL_INSTAGRAM', false);	
	define('XURL_LINKEDIN', false);
	define('XURL_GITHUB', false);
	define('XURL_PINTEREST',  false);	
	define('XURL_SKYPE', false);
	define('XURL_VIMEO', false);
	define('XURL_PICASA', false);
	define('XURL_TUMBLR', false);
	define('XURL_RSS', e_PLUGIN ."rss_menu/rss.php");
}

if ($pref['frontpage_news_colorstyle'])
	define('COLORSTYLE', $pref['frontpage_news_colorstyle']);
else
	define('COLORSTYLE', "blue");

if($pref['frontpage_news_logo'])
	$logo = "<a href='".e_HTTP."'><img src='".THEME_ABS."images/logo".$pref['frontpage_news_logo']."' ".LOGOSTYLE." alt='{SITENAME}' /></a>";
else	
	$logo = "<a href='".e_HTTP."'><img src='".THEME_ABS."images/logo/logo.png' ".LOGOSTYLE." alt='{SITENAME}' /></a>";

if($pref['frontpage_news_slider'])
	$totalnews = $pref['frontpage_news_slider'] ;

else
	$totalnews = 7 ;
	

if(!$pref['frontpage_news_ta7rir'])
	$pref['frontpage_news_ta7rir'] = 2 ;

	
if(!$pref['frontpage_news_last24'])
	$pref['frontpage_news_last24'] = 13 ;	

if(!$pref['frontpage_news_last24_limit'])
	$pref['frontpage_news_last24_limit'] = 10 ;

if(!$pref['frontpage_news_block2_sect'])
	$pref['frontpage_news_block2_sect'] = 3 ;

if(!$pref['frontpage_box_1_limit'])
	$pref['frontpage_box_1_limit'] = 2 ;

if(!$pref['frontpage_box_2_limit'])
	$pref['frontpage_box_2_limit'] = 3 ;

if(!$pref['frontpage_catnews_limit'])
	$pref['frontpage_catnews_limit'] = 4 ;	

if($pref['frontpage_news_showdate'])
	$showdate = "<div class='label-info  news_box_index_newsdate '>{NEWSDATE=short}</div>";

else
	$showdate = "";	

if(!$pref['frontpage_video_limit'])
	$pref['frontpage_video_limit'] = 2 ;

if(!$pref['frontpage_news_photograph'])
	$pref['frontpage_news_photograph'] = 4 ;

if(!$pref['frontpage_news_caricature'])
	$pref['frontpage_news_caricature'] = 2 ;

if(!$pref['frontpage_news_datetype'])
	setlocale(LC_TIME, 'ar_IN');	

	
if(!$pref['frontpage_news_shorturl'])
	$pref['frontpage_news_shorturl'] = true;	
	
if(!defined("TEXTDIRECTION"))
	define('TEXTDIRECTION', "");	

?>