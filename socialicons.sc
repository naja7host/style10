$socialicons ="<ul class='socialsite'>"; 

	$socialicons .=	"<li class='follow' >".LAN_THEME_47."</li>";	

if (XURL_TWITTER)	
	$socialicons .=	"<li><a class='twitter' alt='".LAN_THEME_17."' title='".LAN_THEME_17."' href='".XURL_TWITTER."'>".LAN_THEME_17."</a></li>";		
if (XURL_FACEBOOK)
	$socialicons .=	"<li><a class='facebook' alt='".LAN_THEME_18."' title='".LAN_THEME_18."' href='".XURL_FACEBOOK."'>".LAN_THEME_18."</a></li>";		
if (XURL_YOUTUBE)
	$socialicons .=	"<li><a class='youtube' alt='".LAN_THEME_19."' title='".LAN_THEME_19."' href='".XURL_YOUTUBE."'>".LAN_THEME_19."</a></li>";
if (XURL_GOOGLE)
	$socialicons .=	"<li><a class='googleplus' alt='".LAN_THEME_20."' title='".LAN_THEME_20."' href='".XURL_GOOGLE."'>".LAN_THEME_20."</a></li>";
if (XURL_LINKEDIN)
	$socialicons .=	"<li><a class='linkedin' alt='".LAN_THEME_21."' title='".LAN_THEME_21."' href='".XURL_INSTAGRAM."'>".LAN_THEME_21."</a></li>";
if (XURL_GITHUB)
	$socialicons .=	"<li><a class='github' alt='".LAN_THEME_22."' title='".LAN_THEME_22."' href='".XURL_GITHUB."'>".LAN_THEME_22."</a></li>";	
if (XURL_FLICKR)
	$socialicons .=	"<li><a class='flicker' alt='".LAN_THEME_23."' title='".LAN_THEME_23."' href='".XURL_FLICKR."'>".LAN_THEME_23."</a></li>";
if (XURL_INSTAGRAM)
	$socialicons .=	"<li><a class='instagram' alt='".LAN_THEME_24."' title='".LAN_THEME_24."' href='".XURL_INSTAGRAM."'>".LAN_THEME_24."</a></li>";
if (XURL_SKYPE)
	$socialicons .=	"<li><a class='skype' alt='".LAN_THEME_50."' title='".LAN_THEME_50."' href='#'>".XURL_SKYPE."</a></li>";	
if (XURL_PINTEREST)
	$socialicons .=	"<li><a class='pinterest' alt='".LAN_THEME_51."' title='".LAN_THEME_51."' href='".XURL_PINTEREST."'>".LAN_THEME_51."</a></li>";
if (XURL_VIMEO)
	$socialicons .=	"<li><a class='vimeo' alt='".LAN_THEME_52."' title='".LAN_THEME_52."' href='".XURL_VIMEO."'>".LAN_THEME_52."</a></li>";
if (XURL_PICASA)
	$socialicons .=	"<li><a class='picasa' alt='".LAN_THEME_53."' title='".LAN_THEME_53."' href='".XURL_PICASA."'>".LAN_THEME_53."</a></li>";
if (XURL_TUMBLR)
	$socialicons .=	"<li><a class='tumblr' alt='".LAN_THEME_54."' title='".LAN_THEME_54."' href='".XURL_TUMBLR."'>".LAN_THEME_54."</a></li>";
if (XURL_MAIL)
	$socialicons .=	"<li><a class='mail' alt='".LAN_THEME_55."' title='".LAN_THEME_55."' href='mailto:".XURL_MAIL."'>".XURL_MAIL."</a></li>";
if (XURL_PHONE)
	$socialicons .=	"<li><a class='phone' alt='".LAN_THEME_56."' title='".LAN_THEME_56."' href='#'>".XURL_PHONE."</a></li>";
if (XURL_HTML5)
	$socialicons .=	"<li><a class='html5' alt='".LAN_THEME_57."' title='".LAN_THEME_57."' href='".XURL_HTML5."'>".XURL_HTML5."</a></li>";
if (XURL_INTERNET)
	$socialicons .=	"<li><a class='internet' alt='".LAN_THEME_58."' title='".LAN_THEME_58."' href='".XURL_INTERNET."'>".XURL_INTERNET."</a></li>";
if (XURL_RSS)
	$socialicons .=	"<li><a class='rss' alt='".LAN_THEME_10."' title='".LAN_THEME_10."' href='".XURL_RSS."'>".LAN_THEME_10."</a></li>";			
	

$socialicons .="</ul>"; 
	
return $socialicons;

