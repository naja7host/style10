<?php
require_once("../../class2.php");
include_lan(THEME."languages/".e_LANGUAGE."_admin.php");
@include_lan(THEME."languages/English_admin.php");

global $active;

if (!getperms("P"))
{
	header("location:".e_BASE."index.php");
	exit;
}
function core_head() {

	$headerstyle ='	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="'.THEME_ABS.'css/bootstrap.min.css" rel="stylesheet" media="screen">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="'.THEME_ABS.'assets/js/html5shiv.js"></script>
      <script src="'.THEME_ABS.'assets/js/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript" src="'.THEME_ABS.'js/jquery.min.js"></script>
	<script type="text/javascript" src="'.THEME_ABS.'js/jquery-ui.min.js"></script>	
	<!--Admin styles-->
	<link rel="stylesheet" href="'.THEME_ABS.'css/admin/admin.css" />		
	';
	
	if(defined("TEXTDIRECTION")){
		$headerstyle .= '
		<link href="'.THEME_ABS.'css/'.TEXTDIRECTION.'bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="'.THEME_ABS.'css/admin/'.TEXTDIRECTION.'.css" rel="stylesheet" />';
	}
		
	if(defined("FONTS"))
		$headerstyle .= "<link href='".THEME_ABS."css/fonts/".FONTS.".css' rel='stylesheet' />";			
		
	return 	$headerstyle ;
}
require_once(HEADERF);

$action = (e_QUERY) ? e_QUERY : "main";

include("shortcode/admin_header.php");

	switch ($action) 
	{
		case 'main':
		default :
			include("shortcode/admin_default.php");			
		break;
		case 'fonts':
			include("shortcode/admin_fonts.php");
		break;	
		case 'style':
			include("shortcode/admin_style.php");
		break;
		case 'slider':
			include("shortcode/admin_slider.php");
		break;
		case 'logo':
			include("shortcode/admin_logo.php");
		break;
		case 'social':
			include("shortcode/admin_social.php");
		break;
		case 'links':
			include("shortcode/admin_links.php");
		break;	
		case 'ads':
			include("shortcode/admin_ads.php");
		break;	
		case 'catnews':
			include("shortcode/admin_catnews.php");
		break;			
		case 'menus':
			include("shortcode/admin_menus.php");
		break;
		case 'newspage':
			include("shortcode/admin_newspage.php");
		break;	
		case 'urgent':
			include("shortcode/admin_urgent.php");
		break;	
		case 'update':
			include("shortcode/admin_update.php");
		break;	
		case 'about':
			include("shortcode/admin_about.php");
		break;			
		case 'promotion':
			include("shortcode/admin_promotion.php");
		break;			
		case 'other':
			include("shortcode/admin_other.php");
		break;			
			
	}				
// 
include("shortcode/admin_footer.php");

$ns->tablerender("", $text, "no_caption");
require_once(FOOTERF);

?>