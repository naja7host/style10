<?php
if (!defined('e107_INIT')) { exit; }

	require_once(e_HANDLER.'form_handler.php');
	$rs = new form;	
	$css_file = THEME."css/custom.css";
	$form_readonly = "";
	
	if (isset($_POST['frontpage_news_submit_colorstyle'])) {
		$pref['frontpage_news_colorstyle'] = $_POST['frontpage_news_colorstyle'] ;	
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
	
	if (isset($_POST['frontpage_news_submit_update_css'])) {
		file_put_contents( $css_file , $_POST['css']."\n" , LOCK_EX);
		$result_msg = LAN_FRONTPAGE_16;
			$result = "		<div class='alert alert-block alert-success'>
								<button class='close' data-dismiss='alert' type='button'>
									<i class='icon-remove'></i>
								</button>
								<i class='icon-ok green'></i>	
								<strong >$result_msg</strong >
							</div>";
	}
	
	if (!is_writable(THEME."css/")){
		$readonly	= " readonly='readonly' ";
		$warning	= "<div class='alert alert-danger'>". LAN_THEME_STYLE_01 . THEME_ABS."css/ " . LAN_THEME_STYLE_02 ."</div>";
		$disabled	= " disabled='disabled' ";
	}
		
// ===========================================================================
    
	$text .= "	<li class='active'>".LAN_THEME_ADMIN_SIDE_3."</li>
			</ol><!--.breadcrumb-->
			". $result ."
			<!--PAGE CONTENT BEGINS HERE-->	
			<div class='panel panel-primary'>
				<div class='panel-heading'><i class='icon-star orange'></i> ". LAN_THEME_ADMIN_12 . LAN_THEME_ADMIN_SIDE_3 ."</div>							
				<div class='panel-body'>
					<div class='table-responsive' >
					". $rs->form_open("post", e_SELF."?style" ,  'frontpage_news_submit_colorstyle', '', 'enctype="multipart/form-data"') ."
						<table class='table  table-hover'>
							<tr >
								<td>". LAN_THEME_COLOR_01 ."	</td>
								<td>
									<div class='checkbox'>
										<label class='inline'>
											". $rs->form_radio("frontpage_news_colorstyle", "blue" , ($pref['frontpage_news_colorstyle']== "blue" ? " checked='checked'" : "") ) ."
											<span class='lbl'> ".LAN_THEME_COLOR_BLUE." </span>
										</label>
									</div>
									<div class='checkbox'>
										<label class='inline'>
											". $rs->form_radio("frontpage_news_colorstyle", "green" , ($pref['frontpage_news_colorstyle']=="green" ? " checked='checked'" : "") ) ."
											<span class='lbl'> ".LAN_THEME_COLOR_GREEN." </span>
										</label>
									</div>
									<div class='checkbox'>
										<label class='inline'>
											". $rs->form_radio("frontpage_news_colorstyle", "red" , ($pref['frontpage_news_colorstyle']=="red" ? " checked='checked'" : "") ) ."
											<span class='lbl'> " .LAN_THEME_COLOR_RED ."</span>
										</label>
									</div>
									<div class='checkbox'>
										<label class='inline'>
											". $rs->form_radio("frontpage_news_colorstyle", "purple" , ($pref['frontpage_news_colorstyle']=="purple" ? " checked='checked'" : "") ) ."
											<span class='lbl'> " .LAN_THEME_COLOR_PURPLE ."</span>
										</label>
									</div>
									<div class='checkbox'>
										<label class='inline'>
											". $rs->form_radio("frontpage_news_colorstyle", "orange" , ($pref['frontpage_news_colorstyle']=="orange" ? " checked='checked'" : "") ) ."
											<span class='lbl'> " .LAN_THEME_COLOR_ORANGE ."</span>
										</label>
									</div>
									<div class='checkbox'>
										<label class='inline'>
											". $rs->form_radio("frontpage_news_colorstyle", "yellow" , ($pref['frontpage_news_colorstyle']=="yellow" ? " checked='checked'" : "") ) ."
											<span class='lbl'> " .LAN_THEME_COLOR_YELLOW ."</span>
										</label>
									</div>									
									<div class='checkbox'>
										<label class='inline'>
											". $rs->form_radio("frontpage_news_colorstyle", "dark_blue" , ($pref['frontpage_news_colorstyle']=="dark_blue" ? " checked='checked'" : "") ) ."
											<span class='lbl'> " .LAN_THEME_COLOR_DARK_BLUE ."</span>
										</label>
									</div>
									<div class='checkbox'>
										<label class='inline'>
											". $rs->form_radio("frontpage_news_colorstyle", "gris" , ($pref['frontpage_news_colorstyle']=="gris" ? " checked='checked'" : "")  ) ."
											<span class='lbl'> " .LAN_THEME_COLOR_GRIS ."</span>
										</label>
									</div>
									<div class='checkbox'>
										<label class='inline'>
											". $rs->form_radio("frontpage_news_colorstyle", "black" , ($pref['frontpage_news_colorstyle']=="black" ? " checked='checked'" : "")  ) ."
											<span class='lbl'> " .LAN_THEME_COLOR_BLACK ."</span>
										</label>
									</div>
									<div class='checkbox'>
										<label class='inline'>
											". $rs->form_radio("frontpage_news_colorstyle", "white" , ($pref['frontpage_news_colorstyle']=="white" ? " checked='checked'" : "")  ) ."
											<span class='lbl'> " .LAN_THEME_COLOR_WHITE ."</span>
										</label>
									</div>
									
								</td>
							</tr>
						</table>
					</div><!-- end table respo -->
					<input type='hidden' name='e-token' value='".e_TOKEN."' />
					<button class='btn btn-info button-save' name='frontpage_news_submit_colorstyle'>
						<span class='glyphicon glyphicon-save'></span>
						<span class='hidden-phone'>". LAN_THEME_ADMIN_SAVE ."</span>
					</button>
					". $rs->form_close() ."					
				</div><!-- end panel body -->
			</div><!-- end panel -->
			
			<div class='panel panel-primary'>
				<div class='panel-heading'><i class='icon-star orange'></i> ". LAN_THEME_COLOR_02 ."</div>							
				<div class='panel-body'>
					". $warning ."
					". $rs->form_open("post", e_SELF."?style" ,  'frontpage_news_submit_update_css', '', 'enctype="multipart/form-data"') ."
					<div class='form-group'>
						<textarea class='form-control textarea-code' cols='70' rows='15' id='css' name='css' ". $readonly ." >". file_get_contents($css_file) ."</textarea>
					</div>
					<input type='hidden' name='e-token' value='".e_TOKEN."' />
					<button class='btn btn-info button-save' name='frontpage_news_submit_update_css' $disabled >
						<span class='glyphicon glyphicon-save'></span>
						<span class='hidden-phone'>".LAN_THEME_ADMIN_SAVE."</span>
					</button>
					". $rs->form_close() ."		
				</div><!-- end panel body -->
			</div><!-- end panel -->";