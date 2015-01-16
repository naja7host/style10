<?php
if (!defined('e107_INIT')) { exit; }
	require_once(e_HANDLER.'form_handler.php');
	$rs = new form;	
	
	if (isset($_POST['frontpage_news_submit_ads'])) {
		$pref['frontpage_ads_top'] = ($_POST['frontpage_ads_top'] ? $tp -> toDB($_POST['frontpage_ads_top']) : null) ;	
		$pref['frontpage_ads_newstop'] = ($_POST['frontpage_ads_newstop'] ? $tp -> toDB($_POST['frontpage_ads_newstop']) : null) ;	
		$pref['frontpage_ads_newsbottom'] = ($_POST['frontpage_ads_newsbottom'] ? $tp -> toDB($_POST['frontpage_ads_newsbottom']) : null) ;	
		$pref['frontpage_ads_topside'] = ($_POST['frontpage_ads_topside'] ? $tp -> toDB($_POST['frontpage_ads_topside']) : null) ;		
		$pref['frontpage_ads_leftfixed'] = ($_POST['frontpage_ads_leftfixed'] ? $tp -> toDB($_POST['frontpage_ads_leftfixed']) : null) ;	
		$pref['frontpage_ads_rightfixed'] = ($_POST['frontpage_ads_rightfixed'] ? $tp -> toDB( $_POST['frontpage_ads_rightfixed']) : null) ;	
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
							<textarea class='form-control textarea-code' cols='70' rows='6' id='css' name='frontpage_ads_top'>". $pref['frontpage_ads_top'] ."</textarea>
						</div>
					</div>
					
					<div class='alert alert-warning'>". LAN_THEME_ADS_01 . LAN_THEME_ADS_04 ."</div>
					<div class='form-group'>
						<label class='col-sm-2 control-label'>". LAN_THEME_ADS_01 ."</label>
						<div class='col-sm-10'>
							<textarea class='form-control textarea-code' cols='70' rows='6' id='css' name='frontpage_ads_topside'>". $pref['frontpage_ads_topside'] ."</textarea>
						</div>
					</div>
					
					<div class='alert alert-warning'>". LAN_THEME_ADS_01 . LAN_THEME_ADS_05 ."</div>
					<div class='form-group'>
						<label class='col-sm-2 control-label'>". LAN_THEME_ADS_01 ."</label>
						<div class='col-sm-10'>
							<textarea class='form-control textarea-code' cols='70' rows='6' id='css' name='frontpage_ads_newstop'>". $pref['frontpage_ads_newstop'] ."</textarea>
						</div>
					</div>
					
					<div class='alert alert-warning'>". LAN_THEME_ADS_01 . LAN_THEME_ADS_03 ."</div>
					<div class='form-group'>
						<label class='col-sm-2 control-label'>". LAN_THEME_ADS_01 ."</label>
						<div class='col-sm-10'>
							<textarea class='form-control textarea-code' cols='70' rows='6' id='css' name='frontpage_ads_newsbottom'>". $pref['frontpage_ads_newsbottom'] ."</textarea>
						</div>
					</div>
					
					<div class='alert alert-warning'>". LAN_THEME_ADS_01 . LAN_THEME_ADS_06 ."</div>
					<div class='form-group'>
						<label class='col-sm-2 control-label'>". LAN_THEME_ADS_01 ."</label>
						<div class='col-sm-10'>
							<textarea class='form-control textarea-code' cols='70' rows='6' id='css' name='frontpage_ads_leftfixed'>". $pref['frontpage_ads_leftfixed'] ."</textarea>
						</div>
					</div>
															
					<div class='alert alert-warning'>". LAN_THEME_ADS_01 . LAN_THEME_ADS_07 ."</div>
					<div class='form-group'>
						<label class='col-sm-2 control-label'>". LAN_THEME_ADS_01 ."</label>
						<div class='col-sm-10'>
							<textarea class='form-control textarea-code' cols='70' rows='6' id='css' name='frontpage_ads_rightfixed'>". $pref['frontpage_ads_rightfixed'] ."</textarea>
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