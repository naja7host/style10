$socialicons ="<ul class='socialsite'>"; 

	$socialicons .= "<li class='follow'>".LAN_THEME_47."</li>";	

if (XURL_FACEBOOK)
	$socialicons .=	"<li><a class='facebook' alt='".LAN_THEME_18."' title='".LAN_THEME_18."' href='".XURL_FACEBOOK."'>facebook</a></li>";		
if (XURL_TWITTER)	
	$socialicons .=	"<li><a class='twitter' alt='".LAN_THEME_17."' title='".LAN_THEME_17."' href='".XURL_TWITTER."'>twitter</a></li>";		
if (XURL_YOUTUBE)
	$socialicons .=	"<li><a class='youtube' alt='".LAN_THEME_19."' title='".LAN_THEME_19."' href='".XURL_YOUTUBE."'>rss</a></li>";
if (XURL_GOOGLE)
	$socialicons .=	"<li><a class='googleplus' alt='".LAN_THEME_20."' title='".LAN_THEME_20."' href='".XURL_GOOGLE."'>google +</a></li>";
if (XURL_FLICKR)
	$socialicons .=	"<li><a class='flicker' alt='".LAN_THEME_23."' title='".LAN_THEME_23."' href='".XURL_FLICKR."'>flicker</a></li>";
if (XURL_INSTAGRAM)
	$socialicons .=	"<li><a class='instagram' alt='".LAN_THEME_24."' title='".LAN_THEME_24."' href='".XURL_INSTAGRAM."'>instagram</a></li>";
if (XURL_LINKEDIN)
	$socialicons .=	"<li><a class='linkedin' alt='".LAN_THEME_21."' title='".LAN_THEME_21."' href='".XURL_INSTAGRAM."'>linkedin</a></li>";
if (XURL_GITHUB)
	$socialicons .=	"<li><a class='github' alt='".LAN_THEME_22."' title='".LAN_THEME_22."' href='".XURL_GITHUB."'>github</a></li>";	
if (XURL_PINTEREST)
	$socialicons .=	"<li><a class='pinterest' alt='".LAN_THEME_51."' title='".LAN_THEME_51."' href='".XURL_PINTEREST."'>pinterest</a></li>";
if (XURL_SKYPE)
	$socialicons .=	"<li><a class='skype' alt='".LAN_THEME_50."' title='".LAN_THEME_50."' href='".XURL_SKYPE."'>skype</a></li>";	
if (XURL_VIMEO)
	$socialicons .=	"<li><a class='vimeo' alt='".LAN_THEME_52."' title='".LAN_THEME_52."' href='".XURL_VIMEO."'>vimeo</a></li>";
if (XURL_PICASA)
	$socialicons .=	"<li><a class='picasa' alt='".LAN_THEME_53."' title='".LAN_THEME_53."' href='".XURL_PICASA."'>Picasa</a></li>";
if (XURL_TUMBLR)
	$socialicons .=	"<li><a class='tumblr' alt='".LAN_THEME_54."' title='".LAN_THEME_54."' href='".XURL_TUMBLR."'>Tumblr</a></li>";

	
if (XURL_RSS)
	$socialicons .=	"<li><a class='rss' alt='".LAN_THEME_10."' title='".LAN_THEME_10."' href='".XURL_RSS."'>rss</a></li>";	
	

	
return $socialicons;

