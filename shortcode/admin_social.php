<?php
if (!defined('e107_INIT')) { exit; }

	require_once(e_HANDLER.'form_handler.php');
	$rs = new form;	
	
	if (isset($_POST['frontpage_news_submit_social'])) {	

		foreach($_POST['xurl'] as $k=>$var)
		{
			$pref['xurl'][$k] = $_POST['xurl'][$k] ;
		}	
		
		save_prefs();
		$result_msg = LAN_FRONTPAGE_16;
		$result = "			<div class='alert alert-success'>
								<button class='close' data-dismiss='alert' type='button'>
									<i class='icon-remove'></i>
								</button>
								<i class='icon-ok green'></i>	
								<strong >$result_msg</strong >
							</div>";
	}  						
// ===========================================================================

	$text .= "	<li class='active'>". LAN_THEME_ADMIN_SIDE_6 ."</li>
			</ol><!--.breadcrumb-->
			". $result ."
			<!--PAGE CONTENT BEGINS HERE-->	
			<div class='panel panel-primary'>
				<div class='panel-heading'><i class='icon-star orange'></i> ". LAN_THEME_SOCIAL_01 ."</div>							
				<div class='panel-body'>
					<div class='alert alert-warning'>". LAN_THEME_SOCIAL_03 ."</div>
					". $rs->form_open("post", e_SELF."?social" ,  'frontpage_news_submit_social', '', 'enctype="multipart/form-data"') ."";										
					foreach($xurls as $k=>$var)
					{
						$keypref = "xurl[".$k."]";
						$def = "XURL_". strtoupper($k);
						
						$text .= "
						<div class='form-group'>
							<label for='".$var['label']."'>".LAN_THEME_SOCIAL_02 .$var['label']."</label>								
							".$rs->form_text($keypref, 50 , $pref['xurl'][$k],"","form-control text-left")."								
						</div>							
						";
						// <span class='pull-right label label-danger'>". LAN_THEME_ADMIN_80 ."<b>".$def."</b>". LAN_THEME_ADMIN_81 .  $var['label']."</span>
					}	
					$text .="
					<button class='btn btn-info button-save' name='frontpage_news_submit_social'>
						<span class='glyphicon glyphicon-save'></span>
						<span class='hidden-phone'>".LAN_THEME_ADMIN_SAVE."</span>
					</button>
					<input type='hidden' name='e-token' value='".e_TOKEN."' />					
					". $rs->form_close() ."
				</div><!-- end panel body -->
			</div><!-- end panel -->";	
