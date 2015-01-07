<?php
if (!defined('e107_INIT')) { exit; }
	require_once(e_HANDLER.'form_handler.php');
	$rs = new form;	
	
	if (isset($_POST['frontpage_news_submit_ads'])) {
		$pref['frontpage_ads_728x90'] = ($_POST['frontpage_ads_728x90'] ? $_POST['frontpage_ads_728x90'] : null) ;	
		$pref['frontpage_ads_468x60'] = ($_POST['frontpage_ads_468x60'] ? $_POST['frontpage_ads_468x60'] : null) ;	
		$pref['frontpage_ads_300x250'] = ($_POST['frontpage_ads_300x250'] ? $_POST['frontpage_ads_300x250'] : null) ;	
		$pref['frontpage_ads_320x100'] = ($_POST['frontpage_ads_320x100'] ? $_POST['frontpage_ads_320x100'] : null) ;	
		$pref['frontpage_ads_300x600'] = ($_POST['frontpage_ads_300x600'] ? $_POST['frontpage_ads_300x600'] : null) ;	
		$pref['frontpage_ads_336x280'] = ($_POST['frontpage_ads_336x280'] ? $_POST['frontpage_ads_336x280'] : null) ;	
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
	
	$text .= "	<li class='active'>".LAN_THEME_ADMIN_SIDE_8."</li>
			</ol><!--.breadcrumb-->
			". $result ."
			<!--PAGE CONTENT BEGINS HERE-->	
			<div class='panel panel-primary'>
				<div class='panel-heading'><i class='icon-star orange'></i> ".  LAN_THEME_ADMIN_12 . LAN_THEME_ADMIN_SIDE_8 ."</div>							
				<div class='panel-body'>
					". $rs->form_open("post", e_SELF."?ads" ,  'frontpage_news_submit_ads', '', 'enctype="multipart/form-data"' , "class='form-horizontal'") ."	
					<div class='alert alert-warning'>". LAN_THEME_ADS_01 . LAN_THEME_ADS_02 ."</div>
					<div class='form-group'>
						<label class='col-sm-2 control-label'>". LAN_THEME_ADS_01 ."</label>
						<div class='col-sm-10'>
							<textarea class='form-control textarea-code' cols='70' rows='6' id='css' name='frontpage_ads_728x90'>". $pref['frontpage_ads_728x90'] ."</textarea>
						</div>
					</div>
					
					<div class='alert alert-warning'>". LAN_THEME_ADS_01 . LAN_THEME_ADS_03 ."</div>
					<div class='form-group'>
						<label class='col-sm-2 control-label'>". LAN_THEME_ADS_01 ."</label>
						<div class='col-sm-10'>
							<textarea class='form-control textarea-code' cols='70' rows='6' id='css' name='frontpage_ads_468x60'>". $pref['frontpage_ads_468x60'] ."</textarea>
						</div>
					</div>
					
					<div class='alert alert-warning'>". LAN_THEME_ADS_01 . LAN_THEME_ADS_04 ."</div>
					<div class='form-group'>
						<label class='col-sm-2 control-label'>". LAN_THEME_ADS_01 ."</label>
						<div class='col-sm-10'>
							<textarea class='form-control textarea-code' cols='70' rows='6' id='css' name='frontpage_ads_300x250'>". $pref['frontpage_ads_300x250'] ."</textarea>
						</div>
					</div>
					
					<div class='alert alert-warning'>". LAN_THEME_ADS_01 . LAN_THEME_ADS_05 ."</div>
					<div class='form-group'>
						<label class='col-sm-2 control-label'>". LAN_THEME_ADS_01 ."</label>
						<div class='col-sm-10'>
							<textarea class='form-control textarea-code' cols='70' rows='6' id='css' name='frontpage_ads_320x100'>". $pref['frontpage_ads_320x100'] ."</textarea>
						</div>
					</div>
					
					<div class='alert alert-warning'>". LAN_THEME_ADS_01 . LAN_THEME_ADS_06 ."</div>
					<div class='form-group'>
						<label class='col-sm-2 control-label'>". LAN_THEME_ADS_01 ."</label>
						<div class='col-sm-10'>
							<textarea class='form-control textarea-code' cols='70' rows='6' id='css' name='frontpage_ads_300x600'>". $pref['frontpage_ads_300x600'] ."</textarea>
						</div>
					</div>
															
					<div class='alert alert-warning'>". LAN_THEME_ADS_01 . LAN_THEME_ADS_07 ."</div>
					<div class='form-group'>
						<label class='col-sm-2 control-label'>". LAN_THEME_ADS_01 ."</label>
						<div class='col-sm-10'>
							<textarea class='form-control textarea-code' cols='70' rows='6' id='css' name='frontpage_ads_336x280'>". $pref['frontpage_ads_336x280'] ."</textarea>
						</div>
					</div>

					<input type='hidden' name='e-token' value='".e_TOKEN."' />
					<button class='btn btn-info button-save' name='frontpage_news_submit_ads'>
						<span class='glyphicon glyphicon-save'></span>
						<span class='hidden-phone'>".LAN_THEME_ADMIN_SAVE."</span>
					</button>
					". $rs->form_close() ."						
				</div><!-- end panel body -->
			</div><!-- end panel -->";