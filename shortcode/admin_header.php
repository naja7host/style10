<?php

if (!defined('e107_INIT')) { exit; }

$action = (e_QUERY) ? e_QUERY : "main";

	switch ($action) 
	{
		case 'main':
		default :
			$main = " class='active' ";
		break;
		case 'fonts':
			$fonts = " class='active' ";
		break;		
		case 'style':
			$style = " class='active' ";
		break;	
		case 'slider':
			$slider = " class='active' ";
		break;
		case 'logo':
			$pictures = " class='active' ";
		break;
		case 'social':
			$social = " class='active' ";
		break;
		case 'links':
			$links = " class='active' ";
		break;
		case 'ads':
			$ads = " class='active' ";
		break;
		case 'catnews':
			$catnews = " class='active' ";
		break;
		case 'menus':
			$menus = " class='active' ";
		break;
		case 'newspage':
			$newspage = " class='active' ";
		break;
		case 'urgent':
			$urgent = " class='active' ";
		break;
		case 'update':
			$update = " class='active' ";
		break;
		case 'about':
			$about = " class='active' ";
		break;
		case 'promotion':
			$promotion = " class='active' ";
		break;
			
	}
$text ='
	<a class="sr-only" href="#content">'.LAN_THEME_ADMIN_92.'</a>
	
    <header class="navbar navbar-default navbar-static-top" role="banner">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="http://naja7host.com/news-template" target="_blank" class="navbar-brand">					
					<i class="icon-unlock-alt"></i>
					 '.SITENAME." - ".$themename.' 					
				</a>	
			</div>
	
			<nav class="collapse navbar-collapse bs-navbar-collapse navbar-right flip" role="navigation">
				<ul class="nav navbar-nav">
					<!-- <li><a href="#"><span class="glyphicon glyphicon-comment"></span>'. LAN_THEME_ADMIN_27 . '</a></li> -->
					<li><a href="#"><span class="glyphicon glyphicon-pencil"></span>'. LAN_THEME_ADMIN_28 . '</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-home"></span>'. LAN_THEME_ADMIN_29 . '</a></li>
					<li><a href="'.e_ADMIN_ABS.'index.php"><span class="glyphicon glyphicon-cog"></span> '.LAN_THEME_ADMIN_25.'</a></li>
					
					<li class="dropdown">
						<a class="dropdown-toggle " data-toggle="dropdown" href="#">'.LAN_THEME_ADMIN_2 . USERNAME.' 
							<span class="glyphicon glyphicon-user"></span>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu"  role="menu">
							<li><a href="'.e_HTTP.'usersettings.php"><span class="glyphicon glyphicon-asterisk"></span> '.LAN_THEME_ADMIN_3.'</a></li>
							<li><a href="'.e_HTTP.'user.php?id.'.USERID.'"><span class="glyphicon glyphicon-user"></span> '.LAN_THEME_ADMIN_4.'</a></li>
							<li class="divider"></li>
							<li><a href="'.e_ADMIN_ABS.'index.php"><span class="glyphicon glyphicon-cog"></span> '.LAN_THEME_ADMIN_25.'</a></li>
							<li class="divider"></li>
							<li><a href="'.e_HTTP.'news.php?logout"><span class="glyphicon glyphicon-log-out"></span> '.LAN_THEME_ADMIN_5.'</a></li>					
						</ul>						
					</li>
				</ul>
		
				
			</nav>
		</div>
	</header>
	
	
	<div class="container">
		<div class="row ">
			<!-- left menu starts -->
			<div class="col-md-3 well">
				<div class="  bs-sidebar hidden-print affix-top" role="complementary">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li '.$main.'><a href="'.e_SELF.'"><span class="glyphicon glyphicon-dashboard"></span><span> '.LAN_THEME_ADMIN_SIDE_1.'</span></a></li  >
						<li '.$fonts.' ><a href="'.e_SELF.'?fonts"><span class="glyphicon glyphicon-font"></span><span> '.LAN_THEME_ADMIN_SIDE_2.'</span></a></li>
						<li '.$style.' ><a href="'.e_SELF.'?style"><span class="glyphicon glyphicon-film "></span><span> '.LAN_THEME_ADMIN_SIDE_3.'</span></a></li>
						<li '.$slider.' ><a href="'.e_SELF.'?slider"><span class="glyphicon glyphicon-random"></span><span> '.LAN_THEME_ADMIN_SIDE_4.'</span></a></li>
						<li '.$pictures.' ><a href="'.e_SELF.'?logo"><span class="glyphicon glyphicon-picture"></span><span> '.LAN_THEME_ADMIN_SIDE_5.'</span></a></li>
						<li '.$social.' ><a href="'.e_SELF.'?social"><span class="glyphicon glyphicon-list"></span><span> '.LAN_THEME_ADMIN_SIDE_6.'</span></a></li>
						<li '.$links.' ><a href="'.e_SELF.'?links"><span class="glyphicon glyphicon-align-justify "></span><span> '.LAN_THEME_ADMIN_SIDE_7.'</span></a></li>
						<li '.$ads.' ><a href="'.e_SELF.'?ads"><span class="glyphicon glyphicon-usd "></span><span> '.LAN_THEME_ADMIN_SIDE_8.'</span></a></li>
						<li '.$catnews.' ><a href="'.e_SELF.'?catnews"><span class="glyphicon glyphicon-indent-right "></span><span> '.LAN_THEME_ADMIN_SIDE_9.'</span></a></li>
						<li '.$menus.' ><a href="'.e_SELF.'?menus"><span class="glyphicon glyphicon-th-large "></span><span> '.LAN_THEME_ADMIN_SIDE_10.'</span></a></li>
						<li '.$newspage.' ><a href="'.e_SELF.'?newspage"><span class="glyphicon glyphicon-list-alt "></span><span> '.LAN_THEME_ADMIN_SIDE_11.'</span></a></li>
						<li '.$urgent.' ><a href="'.e_SELF.'?urgent"><span class="glyphicon glyphicon-flash  "></span><span> '.LAN_THEME_ADMIN_SIDE_12.'</span></a></li>
						<li '.$update.' ><a href="'.e_SELF.'?update"><span class="glyphicon glyphicon-download-alt "></span><span> '.LAN_THEME_ADMIN_SIDE_13.'</span></a></li>
						<li '.$about.' ><a href="'.e_SELF.'?about"><span class="glyphicon glyphicon-copyright-mark "></span><span> '.LAN_THEME_ADMIN_SIDE_14.'</span></a></li>
						<li '.$promotion.' ><a href="'.e_SELF.'?promotion"><span class="glyphicon glyphicon-gift "></span><span> '.LAN_THEME_ADMIN_SIDE_15.'</span></a></li>

						<!--
						<li><a class="ajax-link" href="index.html"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>
						<li><a class="ajax-link" href="ui.html"><i class="icon-eye-open"></i><span class="hidden-tablet"> UI Features</span></a></li>
						<li><a class="ajax-link" href="form.html"><i class="icon-edit"></i><span class="hidden-tablet"> Forms</span></a></li>
						<li><a class="ajax-link" href="chart.html"><i class="icon-list-alt"></i><span class="hidden-tablet"> Charts</span></a></li>
						<li><a class="ajax-link" href="typography.html"><i class="icon-font"></i><span class="hidden-tablet"> Typography</span></a></li>
						<li><a class="ajax-link" href="gallery.html"><i class="icon-picture"></i><span class="hidden-tablet"> Gallery</span></a></li>
						<li class="nav-header hidden-tablet">Sample Section</li>
						<li><a class="ajax-link" href="table.html"><i class="icon-align-justify"></i><span class="hidden-tablet"> Tables</span></a></li>
						<li><a class="ajax-link" href="calendar.html"><i class="icon-calendar"></i><span class="hidden-tablet"> Calendar</span></a></li>
						<li><a class="ajax-link" href="grid.html"><i class="icon-th"></i><span class="hidden-tablet"> Grid</span></a></li>
						<li><a class="ajax-link" href="file-manager.html"><i class="icon-folder-open"></i><span class="hidden-tablet"> File Manager</span></a></li>
						<li><a href="tour.html"><i class="icon-globe"></i><span class="hidden-tablet"> Tour</span></a></li>
						<li><a class="ajax-link" href="icon.html"><i class="icon-star"></i><span class="hidden-tablet"> Icons</span></a></li>
						<li><a href="error.html"><i class="icon-ban-circle"></i><span class="hidden-tablet"> Error Page</span></a></li>
						<li><a href="login.html"><i class="icon-lock"></i><span class="hidden-tablet"> Login Page</span></a></li>
						-->
					</ul>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div class="col-md-9" role="main" >
			<!-- content starts -->';	
	
			
	list($uid)=(isset($_COOKIE[$pref['cookie_name']]) && $_COOKIE[$pref['cookie_name']] ? explode(".", $_COOKIE[$pref['cookie_name']]) : explode(".", $_SESSION[$pref['cookie_name']]));

	$userinfo = get_user_data($uid);
	
	if ($userinfo['user_password'] == "21232f297a57a5a743894a0e4a801fc3")
		$text .= "
			<div class='alert alert-danger alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<span class='glyphicon glyphicon-warning-sign '></span>	
				".LAN_THEME_ADMIN_74."						
				<strong >".LAN_THEME_ADMIN_75."</strong >						
			</div>";				

			$text .='
			<ol class="breadcrumb">
				<li><span class="glyphicon glyphicon-home"></span><a href="'. e_PAGE .'"> '.LAN_THEME_ADMIN_7.'</a></li>';
	
		