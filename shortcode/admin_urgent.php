<?php
if (!defined('e107_INIT')) { exit; }
	require_once(e_HANDLER.'form_handler.php');
	$rs = new form;	
	
	if (isset($_POST['frontpage_news_submit_urgent'])) {
		$pref['frontpage_urgent_news'] = ($_POST['frontpage_urgent_news'] ? $_POST['frontpage_urgent_news'] : null) ;	
		$pref['frontpage_urgent_position'] = ($_POST['frontpage_urgent_position'] ? $_POST['frontpage_urgent_position'] : null) ;	

		save_prefs();
		$result_msg = LAN_FRONTPAGE_16;
		$result = "			<div class='alert alert-block alert-success'>
								<button class='close' data-dismiss='alert' type='button'>
									<i class='icon-remove'></i>
								</button>
								<i class='icon-ok green'></i>	
								<strong >$result_msg</strong >
							</div>";	
	}	
// ===========================================================================
	
	$text .= "	<li class='active'>".LAN_THEME_ADMIN_SIDE_12."</li>
			</ol><!--.breadcrumb-->
			". $result ."
			<!--PAGE CONTENT BEGINS HERE-->	
			<div class='panel panel-primary'>
				<div class='panel-heading'><i class='icon-star orange'></i> ".  LAN_THEME_ADMIN_12 . LAN_THEME_ADMIN_SIDE_12 ."</div>							
				<div class='panel-body'>
					". $rs->form_open("post", e_SELF."?urgent" ,  'frontpage_news_submit_urgent', '', 'enctype="multipart/form-data"' , "class='form-horizontal'") ."					
					<div class='alert alert-warning'>". LAN_THEME_URGENT_05 ."</div>
					<div class='form-group'>
						<label class='col-sm-2 control-label'>". LAN_THEME_URGENT_04 ."</label>
						<div class='col-sm-10'>
							<textarea class='form-control textarea-code' cols='70' rows='05' id='frontpage_urgent_news' name='frontpage_urgent_news' >". $pref['frontpage_urgent_news'] ."</textarea>
						</div>
					</div>
					
					<div class='alert alert-info'>". LAN_THEME_URGENT_01 ."</div>					
					<div class='radio'>
						<label>
						".$rs->form_radio("frontpage_urgent_position", 0, ($pref['frontpage_urgent_position'] ? 0 : 1)). LAN_THEME_URGENT_02 ."							
						</label>
					</div>
					<div class='radio'>
						<label>
						".$rs->form_radio("frontpage_urgent_position", 1, ($pref['frontpage_urgent_position'] ? 1 : "")). LAN_THEME_URGENT_03 ."
						</label>
					</div>
					<input type='hidden' name='e-token' value='".e_TOKEN."' />
					<button class='btn btn-info button-save' name='frontpage_news_submit_urgent' >
						<span class='glyphicon glyphicon-save'></span>
						<span class='hidden-phone'>".LAN_THEME_ADMIN_SAVE."</span>
					</button>
					". $rs->form_close() ."
				</div><!-- end panel body -->
			</div><!-- end panel -->
			
			";