<?php
if (!defined('e107_INIT')) { exit; }
	require_once(e_HANDLER.'form_handler.php');
	$rs = new form;
	
	if (isset($_POST['frontpage_news_submit_newspage'])) {
	
		$pref['frontpage_news_shorturl']	= $_POST['frontpage_news_shorturl'];
		$pref['frontpage_news_share']	= $_POST['frontpage_news_share'];
		$pref['frontpage_news_print']	= $_POST['frontpage_news_print'];
		$pref['frontpage_news_email']	= $_POST['frontpage_news_email'];
		$pref['frontpage_news_poster']	= $_POST['frontpage_news_poster'];
		$pref['frontpage_news_dateaddedd']	= $_POST['frontpage_news_dateaddedd'];
		$pref['frontpage_news_countview']	= $_POST['frontpage_news_countview'];
		$pref['frontpage_news_countcomments']	= $_POST['frontpage_news_countcomments'];
		
		save_prefs();
		
		$result_msg = LAN_FRONTPAGE_16;
		$result = "			<div class='alert alert-success'>
								<button class='close' data-dismiss='alert' type='button'>
									<i class='icon-remove'></i>
								</button>
								<i class='icon-ok green'></i>	
								<strong >$result_msg</strong >
								
							</div>	
							";		
	}
	
// ===========================================================================
	
	$text .= "	<li class='active'>".LAN_THEME_ADMIN_SIDE_11."</li>
			</ol><!--.breadcrumb-->
			". $result ."
			<!--PAGE CONTENT BEGINS HERE-->	
			<div class='panel panel-primary'>
				<div class='panel-heading'><i class='icon-star orange'></i> ".  LAN_THEME_ADMIN_12 . LAN_THEME_ADMIN_SIDE_11 ."</div>							
				<div class='panel-body'>
					". $rs->form_open("post", e_SELF."?newspage" ,  'frontpage_news_submit_newspage', '', 'enctype="multipart/form-data"' , ' class="form-horizontal" ') ."
					<div class='checkbox'>
						<label>
							". $rs->form_checkbox("frontpage_news_shorturl", 1 ,($pref['frontpage_news_shorturl'] ? " checked='checked'" : "")) ." ". LAN_THEME_NEWSPAGE_01 ."
						</label>
					</div>
					<div class='checkbox'>
						<label>
							". $rs->form_checkbox("frontpage_news_share", 1 ,($pref['frontpage_news_share'] ? " checked='checked'" : "")) ." ". LAN_THEME_NEWSPAGE_02 ."
						</label>
					</div>
				
					<div class='checkbox'>
						<label>
							". $rs->form_checkbox("frontpage_news_print", 1 ,($pref['frontpage_news_print'] ? " checked='checked'" : ""), "" , "disabled") ." ". LAN_THEME_NEWSPAGE_03 ."
						</label>
						<span class='label label-warning'>". LAN_THEME_ADMIN_94 ."</span>
					</div>
					<div class='checkbox'>
						<label>
							". $rs->form_checkbox("frontpage_news_email", 1 ,($pref['frontpage_news_email'] ? " checked='checked'" : ""), "" , "disabled") ." ". LAN_THEME_NEWSPAGE_04 ."
						</label>
						<span class='label label-warning'>". LAN_THEME_ADMIN_94 ."</span>
					</div>
					<div class='checkbox'>
						<label>
							". $rs->form_checkbox("frontpage_news_poster", 1 ,($pref['frontpage_news_poster'] ? " checked='checked'" : ""), "" , "") ." ". LAN_THEME_NEWSPAGE_05 ."
						</label>
					</div>	
					<div class='checkbox'>
						<label>
							". $rs->form_checkbox("frontpage_news_dateaddedd", 1 ,($pref['frontpage_news_dateaddedd'] ? " checked='checked'" : "")) ." ". LAN_THEME_NEWSPAGE_06 ."
						</label>
					</div>
					<div class='checkbox'>
						<label>
							". $rs->form_checkbox("frontpage_news_countview", 1 ,($pref['frontpage_news_countview'] ? " checked='checked'" : "")) ." ". LAN_THEME_NEWSPAGE_07 ."
						</label>
					</div>
					<div class='checkbox'>
						<label>
							". $rs->form_checkbox("frontpage_news_countcomments", 1 ,($pref['frontpage_news_countcomments'] ? " checked='checked'" : "")) ." ". LAN_THEME_NEWSPAGE_08 ."
						</label>
					</div>	
				
					<input type='hidden' name='e-token' value='".e_TOKEN."' />
					<button class='btn btn-info button-save' name='frontpage_news_submit_newspage' >
						<span class='glyphicon glyphicon-save'></span>
						<span class='hidden-phone'>".LAN_THEME_ADMIN_SAVE."</span>
					</button>
					". $rs->form_close() ."					
				</div><!-- end panel body -->
			</div><!-- end panel -->";