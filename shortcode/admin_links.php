<?php
if (!defined('e107_INIT')) { exit; }
	require_once(e_HANDLER.'form_handler.php');
	$rs = new form;	
	
	
	
	if (isset($_POST['frontpage_news_submit_links'])) {
		$pref['nclm_type'] = $_POST['nclm_type'] ;	
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
	
	if(isset($_POST['frontpage_news_submit_nclm']))
	{
		extract($_POST);
		
		$pref['nclm_all']					= $nclm_all;
		$pref['nclm_cat']					= $nclm_cat;
		$pref['nclm_mainlink']				= $nclm_mainlink;

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
	
	$sql->db_Select("news_category", "*", "order by category_id", "no_where");
	
// ===========================================================================	
	
	$text_main_links	= LAN_THEME_LINKS_05 . '<a href="'.e_ADMIN_ABS.'links.php">'.  LAN_THEME_LINKS_06 .'</a>' ;

	$text_cat_links		= $rs->form_open("post", e_SELF."?links" ,  'frontpage_news_submit_nclm', '', 'enctype="multipart/form-data"') ."
					<div class='table-responsive' >
						<table class='table  table-hover'>
							<tr>
								<td colspan='2' class='forumheader'>
									".LAN_THEME_LINKS_01."
								</td>
							</tr>

							<tr>
								<td style='width:40%' class='forumheader3'>".LAN_THEME_LINKS_02."</td>
								<td style='width:60%' class='forumheader3'>".
									$rs -> form_select_open(nclm_all).
									$rs -> form_option(LAN_THEME_ADMIN_YES, (($pref['nclm_all'] == 0)?"1":""), $form_value = "0").
									$rs -> form_option(LAN_THEME_ADMIN_NO, (($pref['nclm_all'] == 1)?"1":""), $form_value = "1").
									$rs -> form_select_close().
								"</td>
							</tr>
							<tr>
								<td style='width:40%' class='forumheader3'>" . LAN_THEME_LINKS_03 . "</td>
								<td style='width:60%' class='forumheader3'>".
									$rs -> form_select_open(nclm_mainlink).
									$rs -> form_option(LAN_THEME_ADMIN_YES, (($pref['nclm_mainlink'] == 0)?"1":""), $form_value = "0").
									$rs -> form_option(LAN_THEME_ADMIN_NO, (($pref['nclm_mainlink'] == 1)?"1":""), $form_value = "1").
									$rs -> form_select_close().
								"</td>
							</tr>
							</tr>
							<tr>
								<td colspan='2' class='forumheader'>
									".LAN_THEME_LINKS_04."
								</td>
							</tr>";			

						while($row = $sql->db_Fetch() )
						{
							$ch = (in_array($row['category_id'], $pref['nclm_cat']) ? " checked='checked'" : '');
							$text_cat_links .= "
							<tr>
								<td style='width:40%' class='forumheader3'>" . $row['category_name'] . "</td>
								<td style='width:60%' class='forumheader3'>".$rs->form_checkbox("nclm_cat[]", $row['category_id'], $ch) ."</td>
							</tr>";
							$i++;
						}		

	$text_cat_links .="</table>
					<input type='hidden' name='e-token' value='".e_TOKEN."' />
					<button class='btn btn-info button-save' name='frontpage_news_submit_nclm' type='submit' >
						<span class='glyphicon glyphicon-save'></span>
						<span class='hidden-phone'>".LAN_THEME_ADMIN_SAVE."</span>
					</button>
					<input type='hidden' name='e-token' value='".e_TOKEN."' />
					". $rs->form_close() ;
					
	$text .= "	<li class='active'>".LAN_THEME_ADMIN_SIDE_7."</li>
			</ol><!--.breadcrumb-->
			". $result ."
			<!--PAGE CONTENT BEGINS HERE-->	
			<div class='panel panel-primary'>
				<div class='panel-heading'><i class='icon-star orange'></i> ".  LAN_THEME_ADMIN_12 . LAN_THEME_ADMIN_SIDE_7 ."</div>							
				<div class='panel-body'>
					". $rs->form_open("post", e_SELF."?links" ,  'frontpage_news_links', '', 'enctype="multipart/form-data"') ."
					".LAN_THEME_LINKS_07."					
					<div class='radio'>
						<label>
						".$rs->form_radio("nclm_type", 0, ($pref['nclm_type'] ? 0 : 1)). LAN_THEME_LINKS_08 ."							
						</label>
					</div>
					<div class='radio'>
						<label>
						".$rs->form_radio("nclm_type", 1, ($pref['nclm_type'] ? 1 : "")). LAN_THEME_LINKS_09 ."
						</label>
					</div>
					<input type='hidden' name='e-token' value='".e_TOKEN."' />
					<button class='btn btn-info button-save' name='frontpage_news_submit_links' type='submit' >
						<span class='glyphicon glyphicon-save'></span>
						<span class='hidden-phone'>".LAN_THEME_ADMIN_SAVE."</span>
					</button>
					<input type='hidden' name='e-token' value='".e_TOKEN."' />
					". $rs->form_close() ."					
				</div><!-- end panel body -->
			</div><!-- end panel -->
			
			<div class='panel panel-info'>
				<div class='panel-heading'><i class='icon-star orange'></i> ".  LAN_THEME_ADMIN_3 ."</div>							
				<div class='panel-body'>
					". ( $pref['nclm_type'] ? $text_main_links : $text_cat_links ) ."
				</div><!-- end panel body -->
			</div><!-- end panel -->";						