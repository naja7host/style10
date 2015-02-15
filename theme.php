<?php
/*---------------------------------------------------------------+
|	Long Live The Machines!
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://www.gnu.org).
+---------------------------------------------------------------*/
if (!defined('e107_INIT')) { exit; }

if (e_LANGUAGE == "Arabic")
	$themename = " الستايل الإخباري - الشكل 10";
else 
	$themename = " News Style - Design 10 ";
	
include_lan(THEME."languages/".e_LANGUAGE.".php");
//@include_lan(THEME."languages/English.php");


define("STANDARDS_MODE", TRUE);
define("LOGOSTYLE", " class='logo' ");


//$row['news_allow_comments'] = 0;
// [theme]


	
$themeversion = "2.8";
$themeauthor = "Naja7Host";
$themedate = "03-12-2014";
$themeinfo = "e107v7+";
$THEME_DISCLAIMER = LAN_THEME_6 ;
$themerawname = "style10";
$layout = "_default";

$xhtmlcompliant = TRUE;
$csscompliant = TRUE;
$no_core_css = TRUE;

// Core SHortcodes
$register_sc[] = "NEWSIMAGE";
$register_sc[] = "NEWSIMAGETHUMB";
$register_sc[] = 'NEWSTITLELINK';
$register_sc[] = 'NEWSBODY';
$register_sc[] = 'EXTENDED';
$register_sc[] = 'NEWSCOMMENTS';
$register_sc[] = 'SITELINKS';

// Custom Menus 
$register_sc[] = 'LAST24';
$register_sc[] = 'FACEBOOK';
$register_sc[] = 'VIDEO';
$register_sc[] = 'NEWSCATEGORYLINKS';

// Addons
$register_sc[] = 'INDEX';
$register_sc[] = 'INDEX1';
$register_sc[] = 'INDEX2';
$register_sc[] = 'SLIDER';
$register_sc[] = 'FOOTERLINKS';
$register_sc[] = 'MAQALAT';
$register_sc[] = 'SHARE';
$register_sc[] = 'SHOURTURL';
$register_sc[] = 'LASTBLOCK';
$register_sc[] = 'ADMINTOOLS';
$register_sc[] = 'SOCIALICONS';
$register_sc[] = 'BREAKINGNEWS';

// Ads
$register_sc[] = 'ADSTOP';
$register_sc[] = 'ADSTOPSIDE';
$register_sc[] = 'ADSNEWSTOP';
$register_sc[] = 'ADSNEWSBOTTOM';
$register_sc[] = 'ADSLEFTFIXED';
$register_sc[] = 'ADSRIGHTFIXED';

// $register_sc[] = "TICKER";
// $register_sc[] = 'TA7RIR';
// $register_sc[] = 'CARICATURE';
// $register_sc[] = 'PHOTOGRAPH';



include('urlrewrite.php');
include('functions.php');



// [header function]
function theme_head() {

	$headerstyle = "
		<meta name='viewport' content='width=device-width, initial-scale=1.0' />
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<link href='".THEME_ABS."css/bootstrap.min.css' rel='stylesheet'  media='screen' />
		<link href='".THEME_ABS."css/bootstrap-theme.min.css' rel='stylesheet'  media='screen' />
		<!--[if lt IE 9]>
		  <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
		  <script src='https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js'></script>
		  <script src='http://html5shim.googlecode.com/svn/trunk/html5.js'></script>
		<![endif]-->
		<link href='".THEME_ABS."css/template.css' rel='stylesheet'  media='screen' />
		<!-- Display Image Home For Facebook
		<link rel='image_src' href='".THEME_ABS."images/logo/".$pref['frontpage_news_logo']."' /> -->
		";
		
	if(defined("TEXTDIRECTION"))
		$headerstyle .= "
		<link href='".THEME_ABS."css/".TEXTDIRECTION."bootstrap.min.css' rel='stylesheet'  media='screen' />";

		
	if(defined("COLORSTYLE"))
		$headerstyle .= "
		<link href='".THEME_ABS."css/colors/".COLORSTYLE.".css' rel='stylesheet' />";	
		
	if(defined("FONTS"))
		$headerstyle .= "
		<link href='".THEME_ABS."css/fonts/".FONTS.".css' rel='stylesheet' />";			
		
		
		$headerstyle .= "
		<script type='text/javascript' src='".THEME_ABS."js/jquery.min.js'></script>
		<script type='text/javascript' src='".THEME_ABS."js/jquery-ui.min.js'></script>	";
	
	if(!stristr(e_PAGE.(e_QUERY ? "?".e_QUERY : ""), 'admin-theme.php') == TRUE)
		return $headerstyle;
}

function theme_footer() {
	
	$footerstyle = "";

	if(defined("TEXTDIRECTION"))
		$footerstyle .= "
		<link href='".THEME_ABS."css/".TEXTDIRECTION.".css' rel='stylesheet' />";

	if(file_exists(THEME."css/custom.css"))
		$footerstyle .= "
		<link href='".THEME_ABS."css/custom.css' rel='stylesheet' />";
		
	return $footerstyle ; 	
}		

$HEADERCALL = "
{BREAKINGNEWS}
<div class='container'>
	<div class='nav-first-w'>
		{ADSLEFTFIXED}
		{ADSRIGHTFIXED}
		
		<div class='nav-first '>
			<div class='col-md-6 nav-first-right hidden-xs hidden-sm row'>
			     {LINKSTYLE=topnav2}{SITELINKS=flat:2}              			
			</div>

			<div class='col-md-6 social'>
			    {SOCIALICONS}
			</div>
		</div>
		<div class='clearfix'></div>
	</div>
	<div class='clearfix'></div>
	
	<div class='col-md-12  logo-advert'>
		<div class='col-md-4  logo-header'>					
		  ".$logo."
		</div>
		<div class='col-md-8 advert-header-728 hidden-xs hidden-sm'>
			{ADSTOP}
		</div>	
		<div class='clearfix'></div>
	</div>
	<div class='clearfix'></div>
	

		<nav class='nav-last navbar-inverse'>
			". ( $pref['nclm_type'] ? "{LINKSTYLE=topnav}{SITELINKS=flat:1}" : "{NEWSCATEGORYLINKS}") ."
		</nav>

	<div class='clearfix'></div>
	
	<div class='wspfull'>		
	    <div class='main'>
	    	<div class='row'>";

$HEADER = $HEADERCALL ;
$HEADER .= "	<div class='col-md-8 content'>" ;
		
$FOOTER = "		</div>
				<div class='col-md-4 sidebar'>
					{SETSTYLE=menu}
					{ADSTOPSIDE}
					{LAST24}					
					{MENU=1}					
					{MENU=2}
					{MENU=3}
					{MENU=5}
					{FACEBOOK}
				</div>
			</div>
		</div>

		<div class='footer'>			
			<div class='footer-style'>
				<div class='footer-box'>			
					{SETSTYLE=footer_block}
					<div class='col-md-4'>
						{PLUGIN=rss_menu}
					</div>	
					<div class='col-md-5'>	
						{FOOTERLINKS}
					</div>	
					<div class='col-md-3'>
						<div class='footer-blocks footerlinks'>
							<h4>{SITENAME}</h4>
							".$logo."
						</div>
					</div>					
				</div>			
			</div>
		</div>	
		<div class='clearfix'></div>
		
		<div id='footer' class='row  copyright-w'>
			<div class='col-md-12 copyright'>
				<div class='col-md-6 '>
					<p><small>{SITEDISCLAIMER}</small></p>
					<!-- Developped AND design by Naja7host.com  -->
				</div>	
				<div class='col-md-6 '>
					<p class='text-right'><small>$THEME_DISCLAIMER</small></p>
					<!-- Developped AND design by Naja7host.com  -->
				</div>		
			</div> <!--End Inner-->
		</div> <!--end bottom Bar-->	

		<div class='clearfix'></div>

	</div>
</div>	
<!-- Placed at the end of the document so the pages load faster -->
<script type='text/javascript' src='".THEME_ABS."js/bootstrap.min.js'></script>
<script type='text/javascript' src='".THEME_ABS."js/custom.js'></script>
<!-- Developped AND design by Naja7host.com  -->
". theme_footer() ."";

// Index template
$HEADERINDEX =  $HEADERCALL ;
		

$FOOTERINDEX = "
				<div class='home-featured'>			
					<div class='col-md-8 '>
						<div class='slider-home hidden-xs hidden-sm '>
							{SLIDER}
							<div class='clearfix'></div>
						</div>
						
						<div class='content'>
							{VIDEO}
							{INDEX}
							{MAQALAT}
							{INDEX1}				
						</div>							
					</div>
					<div class='col-md-4 sidebar'>						
							{SETSTYLE=menu}
							{LAST24}
							{MENU=1}
							{ADSTOPSIDE}
							{MENU=2}
							{MENU=3}
							{MENU=5}
							{FACEBOOK}
					</div>					
				</div>

				<div class='clearfix'></div>
				
				<div class='col-md-12'>		    	
					{INDEX2}				
				</div>
				<div class='clearfix'></div>
			</div>
		</div>

		<div class='footer'>			
			<div class='footer-style'>
				<div class='footer-box'>				
					{SETSTYLE=footer_block}
					<div class='col-md-4'>
						{PLUGIN=rss_menu}
					</div>	
					<div class='col-md-5'>	
						{FOOTERLINKS}
					</div>	
					<div class='col-md-3'>
						<div class='footer-blocks footerlinks'>
							<h4>{SITENAME}</h4>
							".$logo."
						</div>
					</div>					
				</div>			
			</div>
		</div>	
		<div class='clearfix'></div>
		
		<div id='footer' class='row  copyright-w'>
			<div class='col-md-12 copyright'>
				<div class='col-md-6 colright'>
					<p class='copyrights muted'><h6>{SITEDISCLAIMER}</h6></p>
					<!-- Developped AND design by Naja7host.com  -->
				</div>	
				<div class='col-md-6 colleft'>
					<p class='text-muted '><h6>$THEME_DISCLAIMER</h6></p>
					<!-- Developped AND design by Naja7host.com  -->
				</div>		
			</div> <!--End Inner-->
		</div> <!--end bottom Bar-->	
		<div class='clearfix'></div>
	</div>
</div>
<!-- Placed at the end of the document so the pages load faster -->
<script type='text/javascript' src='".THEME_ABS."js/bootstrap.min.js'></script>
<script type='text/javascript' src='".THEME_ABS."js/custom.js'></script>
<!-- Developped AND design by Naja7host.com  -->";

$FOOTERINDEX .="
<link href='".THEME_ABS."css/video.css' rel='stylesheet'  />
<link href='".THEME_ABS."sliders/".$pref['frontpage_news_slider_type']."/slider.css' rel='stylesheet'  />
". theme_footer() ."
<script type='text/javascript' src='".THEME_ABS."sliders/".$pref['frontpage_news_slider_type']."/slider.js'></script>
<script type='text/javascript' src='".THEME_ABS."js/jquery.cycle.all.min.js'></script>
<script type='text/javascript' src='".THEME_ABS."js/amazingcarousel.js'></script>
<script type='text/javascript' src='".THEME_ABS."js/initcarousel-1.js'></script>
<script type='text/javascript'>
$('#myTab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>";

$CUSTOMHEADER['index'] = $HEADERINDEX ;
$CUSTOMFOOTER['index'] = $FOOTERINDEX ;
$CUSTOMPAGES['index']  = SITEURL.'index.php';

// admin templates 
$CUSTOMHEADER['admin-theme'] = " ";
$CUSTOMFOOTER['admin-theme'] = " ";
$CUSTOMPAGES['admin-theme']  = 'admin-theme.php';

// You can customize the news-category bullet listing here.
$NEWSARCHIVE ="<div>
		<table style='width:98%;'>
		<tr>
		<td>
		<div>{ARCHIVE_BULLET} <b>{ARCHIVE_LINK}</b> <span class='smalltext'><i>{ARCHIVE_AUTHOR} @ ({ARCHIVE_DATESTAMP}) ({ARCHIVE_CATEGORY})</i></span></div>
		</td>
		</tr>
		</table>
		</div>";
		
$NEWSLISTSTYLE = "	
	<article >
		<div class='panel panel-default'>
			<div class='panel-heading'>
				<h2 class='panel-title'>{NEWSTITLELINK=extend}</h2>
			</div>
			<div class='panel-body item-list'>
				<div class='col-md-4 thumbnail post-thumbnail '>{NEWSIMAGETHUMB}</div>
				<div class='col-md-8 entry'>
					<p>{NEWSBODY}{EXTENDED}</p>				
				</div>
			</div>		
		</div>	
	</article>";

$NEWSSTYLE = "";
if(stristr(e_PAGE.(e_QUERY ? "?".e_QUERY : ""), 'news.php?extend') == TRUE) 
{
	$NEWSSTYLE .= "
    <ul class='breadcrumb'>
		<li><a href='". SITEURL ."' >".LAN_THEME_7."</a> </li>
		<li>{NEWSCATEGORY}</li>
		<li class='active'>{NEWSTITLELINK}</li>
    </ul>
	
    <div class='breadcrumb'>
		<span class='glyphicon glyphicon-time'></span> ".LAN_THEME_40." {NEWSDATE}
		<div class='btn-group pull-right'>
			<button type='button' class='btn btn-default'>".LAN_THEME_39."</button>
			<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
				<span class='caret'></span>
				<span class='sr-only'>Toggle Dropdown</span>
			</button>
			<ul class='dropdown-menu' role='menu'>
				<li> </li>
				<li>{EMAILICON} {PRINTICON} {ADMINOPTIONS}</li>
				<li class='divider'></li>
				<li>{PDFICON}{TRACKBACK}</li>
			</ul>
		</div>
		
		<div class='clearfix'></div>
    </div>	
	
	{ADSNEWSTOP}
	
	<div class='well'>	
		<article>
			
			<div class='alert title-news text-center'>
				
				<h1>{NEWSTITLE}</h1>
			</div>
			
			<div class='panel panel-default text-center'>
			  <div class='panel-body'>
				{NEWSIMAGE}
			  </div>
			  <div class='panel-footer'>{NEWSSUMMARY}</div>
			</div>

			<p class='text-justify'>{NEWSBODY}</p>
			<div class='clearfix'>  </div>
			
			{ADSNEWSBOTTOM}
			
			<div class='alert title-news'>
				{SHARE}
				<div class='clearfix'>  </div>	
			</div>
			
			{SHOURTURL}
			
		</article>	
	</div>
	<div class='well well-small'>
		<span class='glyphicon glyphicon-user'></span> ".LAN_THEME_4."  : {NEWSAUTHOR} <div class='clearfix'>  </div>
		 <div class='clearfix'>  </div>
		<span class='glyphicon glyphicon-tasks'></span> {VIEWS} <div class='clearfix'>  </div>
		<span class='glyphicon glyphicon-comment'></span> ".LAN_THEME_36." {NEWSCOMMENTCOUNT} <div class='clearfix'>  </div>
		{PDFICON} {EMAILICON} {PRINTICON} {ADMINOPTIONS} {TRACKBACK} <div class='clearfix'>  </div>
	</div>
	
	{NEWSCOMMENTS}	
	";
} else {
	$NEWSSTYLE .= "
	<article >
		<div class='panel panel-default'>
			<div class='panel-heading'>
				<h2 class='panel-title'>{NEWSTITLELINK=extend}</h2>
			</div>
			<div class='panel-body item-list'>
				<div class='col-md-3 thumbnail post-thumbnail '>{NEWSIMAGETHUMB}</div>
				<div class='col-md-8 entry'>
					<p>{NEWSBODY}{EXTENDED}</p>	
				</div>
			</div>		
		</div>	
	</article>";
};


//	[tablestyle]
function tablestyle($caption, $text, $mode){
global $style ;

	switch ($mode) 
	{
		case 'video':
		echo "
			<div style='margin:0px auto;'>
				<div id='amazingcarousel-container-1'>
					<div class='title_def'>
						<div class='mudule-tile-search'>".$caption."</div>					
					</div>
					<div id='amazingcarousel-1'>
						<div class='amazingcarousel-list-container'>
								<ul class='amazingcarousel-list'>
								".$text."
								</ul>
							<div class='amazingcarousel-prev'></div>
							<div class='amazingcarousel-next'></div>
						</div>
					</div>
				</div>
			</div>
			<div class='amazingcarousel-nav'></div>";
		return;
		break;
		
		case 'newsindex_3col':
		echo "
			<div class='module-border-2'>
				<div class='mudule-tile-search'>".$caption."</div>
				".$text."			
				<div class='clearfix'></div>
			</div>";			
		return;
		break;
		
		case 'newsindex':
		echo "
			<div class='module-border-2'>
				<div class='mudule-tile-search2'>".$caption."</div>			
				".$text."			
				<div class='clearfix'></div>
			</div>";
		return;		
		break;
		
		case 'lastblock':
		echo "
			<div class='module-border-2'>
				<div class='mudule-tile-search1'>".$caption."</div>
				".$text."
				<div class='clearfix'></div>
			</div>";			
		return;
		break;
				
		case 'no_caption' :
		case 'clock' :
		echo $text;
		return;	
		break;
		
		case 'no-text' :
		echo $caption;		
		return;	
		break;
		
		case 'facebook':
		echo "
			<div class='row'>			
				<h4 class='widget-facebook'>".$caption."</h4>			
				<div class='border_box ads'>				
					".$text."
				</div>			
				<div class='clearfix'></div>
			</div>
			<div class='clearfix'></div>";	
		return;				
		break;
	}
	
	switch ($style) 
	{	

		case 'facebook':
		echo "
			<div class='row'>			
				<div class='widget-facebook'><h4 >".$caption."</h4></div>		
				<div class='border_box ads'>				
					".$text."
				</div>			
				<div class='clearfix'></div>
			</div>
			<div class='clearfix'></div>";		
		break;				
		case 'menu':
		echo "
			<div class='sidebar-wrapper module-border-2'>
				<div class='title_box'>
					<h4>".$caption."</h4>
				</div>
				<div class='sidebar-content'>				
					".$text."
					<div class='clearfix'></div>
				</div>			
				<div class='clearfix'></div>
			</div>";
		break;		
		case 'footer_block':
		echo "
			<div class='footer-blocks footerlinks'>
				<h4>".$caption."</h4>
				".$text."
			</div>";		
		break;
		
		
		case 'photo':
		echo "
			<div class='box_outer photo'>
				<div class='widget'>
					<h3 class='widget_title'>".$caption."</h3>
					<div class='wid_border'></div>				
					".$text."
				</div>
			</div>";
		break;

		
		case 'search':
		echo "<div class='box_outer widget_search'>
					<div class='widget'>
						".$text."
					</div>
				</div>";
		break;

		default:
		echo "
			<div class='single-post module-border-2'>
				<div class='title_box'>
					<h4>".$caption."</h4>
				</div>
				<div class='sidebar-content'>				
					".$text."
					<div class='clearfix'></div>
				</div>
			</div>";			
		break;
	}	
}

	
// linkstyle
// http://wiki.e107.org/?title=Styling_Individual_Sitelink_Menus
function linkstyle($np_linkstyle) 
{
	// Common to all styles (for this theme)
	$linkstyleset['linkdisplay']      = 1;  /* 1 - along top, 2 - in left or right column */
	$linkstyleset['linkalign']        = "center";

	// Common sublink settings
	// NOTE: *any* settings can be customized for sublinks by using
	//       'sub' as a prefix for the setting name. Plus, there's "subindent"
	//  $linkstyleset['sublinkclass'] = "mysublink2;
	//  $linkstyleset['subindent']    = " ";

	// Now for some per-style setup
	switch ($np_linkstyle)
	{
		case 'topnav':
			$linkstyleset['linkdisplay']      = 1;
			$linkstyleset['prelink'] = "<ul class='nav navbar-nav'>";
			$linkstyleset['postlink'] = "</ul>";
			// parent normal links
			$linkstyleset['linkstart'] = "<li>";
			$linkstyleset['linkstart_hilite'] = "<li class='active'>  "; // css style
			$linkstyleset['linkend'] = "</li>";

			// parent link with sublinks
			$linkstyleset['linkstart_dropdown'] = "<li class='dropdown'>"; // css style
			$linkstyleset['linkstart_dropdown_hilite'] = "<li class='active dropdown'>"; // css style
			$linkstyleset['linkstart_dropdown_end'] = "</li>";
			$linkstyleset['linkstart_dropdown_prefix'] = " class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false' ";
			$linkstyleset['linkstart_dropdown_suffix'] = "  <span class='caret'>";

			$linkstyleset['linkseparator'] = "";
			// sublinks styes
			$linkstyleset['subprelink'] = "<ul class='dropdown-menu' role='menu' >";
			$linkstyleset['subpostlink'] = "</ul>";
			$linkstyleset['sublinkstart'] = "<li>";
			$linkstyleset['sublinkend'] = "</li>";
			
			$linkstyleset['subsublinkstart'] = "<li class='dropdown-submenu'>";
			$linkstyleset['subsublinkend'] = "</li>";			
			
			$linkstyleset['sublinkclass'] = "";
			$linkstyleset['subindent'] = "";
			
		break;
		
		case 'topnav2':
			$linkstyleset['linkdisplay']      = 1;
			$linkstyleset['prelink'] = "<ul class='nav nav-pills '>";
			$linkstyleset['postlink'] = "</ul>";
			// parent normal links
			$linkstyleset['linkstart'] = "<li>";
			$linkstyleset['linkstart_hilite'] = "<li class='active'>  "; // css style
			$linkstyleset['linkend'] = "</li>";

			// parent link with sublinks
			$linkstyleset['linkstart_dropdown'] = "<li class='dropdown'>"; // css style
			$linkstyleset['linkstart_dropdown_hilite'] = "<li class='active dropdown'>"; // css style
			$linkstyleset['linkstart_dropdown_end'] = "</li>";
			$linkstyleset['linkstart_dropdown_prefix'] = " class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false' ";
			$linkstyleset['linkstart_dropdown_suffix'] = "  <span class='caret'>";

			$linkstyleset['linkseparator'] = "";
			// sublinks styes
			$linkstyleset['subprelink'] = "<ul class='dropdown-menu' role='menu' >";
			$linkstyleset['subpostlink'] = "</ul>";
			$linkstyleset['sublinkstart'] = "<li>";
			$linkstyleset['sublinkend'] = "</li>";
			
			$linkstyleset['subsublinkstart'] = "<li class='dropdown-submenu'>";
			$linkstyleset['subsublinkend'] = "</li>";			
			
			$linkstyleset['sublinkclass'] = "";
			$linkstyleset['subindent'] = "";
		break;	

		
		default: // if no LINKSTYLE defined
			$linkstyleset['prelink'] = "<ul class='menu'>";
			$linkstyleset['postlink'] = "</ul>";
			$linkstyleset['linkstart'] = "<li>";
			$linkstyleset['linkend'] = "</li>";
			$linkstyleset['linkstart_hilite'] = "";
			$linkstyleset['linkclass_hilite'] = "";
			$linkstyleset['linkclass'] = "";
			$linkstyleset['sublinkclass'] = "";
	}
	return $linkstyleset;
}


define("OTHERNEWS_LIMIT",10);
define("COMMENTLINK", LAN_THEME_1);
define("COMMENTOFFSTRING", LAN_THEME_2);
define("PRE_EXTENDEDSTRING", "");
define("EXTENDEDSTRING", LAN_THEME_3);
define("POST_EXTENDEDSTRING", "");

// icons
define("ICONPRINT", TEXTDIRECTION."printer.png");
define("ICONMAIL", TEXTDIRECTION."email.png");
define("ICONPRINTPDF", TEXTDIRECTION."pdf.png");
define("ICONSTYLE", "float: right; border: 0; margin-right: 10px;");

?>