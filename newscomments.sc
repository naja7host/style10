if(stristr(e_PAGE.(e_QUERY ? "?".e_QUERY : ""), 'news.php?extend') == TRUE) 
{
	global $nid , $editall,$pref, $sql, $tp;
	
	$news_item = getcachedvars('current_news_item'); 
	$nid = $news_item['news_id'] ;
	$editall = FALSE ;

	if($pref['comments_disabled'] == 1)
	{
		return;
	}	
	
	if(!$news_item['news_allow_comments'])
	{
	require_once(e_HANDLER."secure_img_handler.php");
	$sec_img = new secure_image;
	$codeverify = $sec_img->random_number ;
	$addcommenttext = "<a href='#addcomments'>".ADD_COMMENT."</a>";	
	$commenteditor = "
		<!-- respond -->
		$edit
		<div class='clearfix'></div>	
			<div class='add_comment well'  >
				<div class='title_box' id='addcomments' >".ADD_COMMENT_HEADER."</div>					
				<form id='addcomment' action='comment.php?comment.news.".$nid."' method='post' > 
								
								<div class='form-group has-feedback'>	
									<label for='author_name'>".ADD_COMMENT_AUTHOR."</label> <span id='inputError2Status' class='hidden'> (".ADD_COMMENT_ERR.") </span>	
									<input type='text' class='form-control '  id='author_name' name='author_name' />
									<span class='glyphicon glyphicon-remove form-control-feedback hidden' aria-hidden='true'></span>
																	
								</div>
								<div class='form-group has-feedback'>	
									<label for='subject'>".ADD_COMMENT_SUBJECT."</label> <span id='inputError2Status' class='hidden'> (".ADD_COMMENT_ERR.") </span>
									<input type='text' class='form-control '  id='subject' name='subject' />
									<span class='glyphicon glyphicon-remove form-control-feedback hidden' aria-hidden='true'></span>
								</div>
								<div class='form-group has-feedback'>	
									<label for='message' >".ADD_COMMENT_BODY."</label> <span id='inputError2Status' class='hidden'> (".ADD_COMMENT_ERR.") </span>
									<textarea class='form-control' rows='3' id='message' name='comment' ></textarea>
									<span class='glyphicon glyphicon-remove form-control-feedback hidden' aria-hidden='true'></span>
								</div>
								<div class='form-group has-feedback'>								
									<label for='code_verify' >".ADD_COMMENT_CAPTCHA." : ".$sec_img->r_image()." </label>   <span id='inputError2Status' class='hidden'> (".ADD_COMMENT_ERR.") </span>
									<input type='text' class='form-control' id='code_verify' name='code_verify' >
									<span class='glyphicon glyphicon-remove form-control-feedback hidden' aria-hidden='true'></span>
									<input type='hidden' id='rand_num' name='rand_num' value='".$codeverify."' />
								

							";
						
						if ($sql->db_Select("tmp", "tmp_info", "tmp_ip = '".$tp -> toDB($codeverify)."'"))
						{
							$row = $sql->db_Fetch(MYSQL_ASSOC);
							$code = intval($row['tmp_info']);
							$commenteditor .= "<input type='hidden' id='codeverify'  name='codeverify' value='".$code."' />\n";
						}	

				$commenteditor .= "
								</div>
								<div class='form-group'>
									<input type='hidden' name='e-token' value='".e_TOKEN."' />\n					
									<button id='commentsubmit' name='commentsubmit' type='submit' class='btn btn-send  btn-lg btn-block'>".ADD_COMMENT_BUTTON."</button>
								</div>
					<script type='text/javascript' src='".THEME_ABS."script.js'></script>	
				</form>				
			<!-- /respond -->
			</div>";
			
	}	
	
	function comids($cid) 
	{
		global $nid;
		$sql = new db;
		
			if ( intval($cid) ) 
			{
				$qry = "SELECT comment_id FROM #comments WHERE comment_pid = '$cid' AND comment_pid != '0'  AND comment_item_id = '$nid' AND comment_type = '0'  ";
							} 
			else 
			{
				$qry = "SELECT comment_id FROM #comments WHERE comment_pid = '0' AND comment_item_id = '$nid' AND comment_type = '0'  ";
				
			}
			
		$sql->db_select_gen( $qry );
		
			while( $row=$sql->db_Fetch() ) 
			{
				$ids[] .= $row['comment_id'];
			} 
		return $ids;
		
	}

	function create_commentz($cid) 
	{
		global $nid;
			if (comids($cid)) 
			{
				$comment .= "<li id='comment-$cid' class='comment even thread-even depth-1'>";
				$comment .= create_subcomments_tpl($cid);
				//echo "depth-1 - ". $cid."<br />";
				$cids = comids($cid);

					$depths = "<ul class='children'>";
					$depthc ='';
					foreach ( $cids as $scid ) 
					{							
						//echo "depth-2 - ". $scid."<br />";
						$depthc .= "<li id='comment-$scid' class='comment depth-2'>";
						$depthc .= create_subcomments_tpl($scid);
						
						
						$cidss = comids($scid);
						
							$depthss = "<ul class='children'>";
							$depthcc ='';
							foreach ( $cidss as $sscid ) 
							{							
								//echo "depth-3 - ". $sscid."<br />";
								$depthcc .= "<li id='comment-$sscid' class='comment depth-3'>";
								$depthcc .= create_commentz_tpl($sscid);						
								$depthcc .="</li>";
							}
							$depthee = "</ul>";	

							if ($depthcc)
								$depthh = $depthss . $depthcc . $depthee; 
								
							$depthc .= $depthh ;
							unset($depthh);	
						
						
						$depthc .="</li>";

					}
					$depthe = "</ul>";	

					if ($depthc)
						$depth = $depths . $depthc . $depthe; 
						
					$comment .= $depth ."</li>";
					unset($depth);
			} 
			else 
			{
				$comment .= "<li id='comment-$cid' >";
				$comment .= create_subcomments_tpl($cid);
				$comment .= "</li>"; 
				//echo "kepth-1 - ". $cid."<br />";
			}
			
		return $comment; 
	}

	function create_subcomments_tpl($cid) 
	{
		global $nid , $editall;
		$sql = new db;
		
		if (ADMIN && getperms("B"))
			$edit = "<div class='reply-btn'><a href='".e_ADMIN_ABS."modcomment.php?news.$nid.$cid' class='edit' >تعديل التعليق</a></div>";	

		$sql->db_select_gen("SELECT * FROM #comments WHERE comment_id = '$cid' AND comment_item_id = '$nid' AND comment_type = '0' ");
			while( $row=$sql->db_Fetch() ) 
			{
				extract($row);
				$author = explode('.',$comment_author );
				$date = strftime("%d %B %Y", $comment_datestamp); 
				$time = strftime("%H:%M", $comment_datestamp); 
				if ($comment_blocked == '0') 
				{
					$text .= "						
								<div id='comments'>
									<div id='comment-title'>
										<div class='user-name'>
											<div class='comments-name'>
												<h4>$author[1]</h4>
											</div>
											<div class='comments-date'>بتاريخ  $date على الساعة $time</div>
										</div>
									</div>
									<div class='comments-data'>
										<p>". nl2br($comment_comment) ."</p>
									</div>
									<div class='reply-btn'><a href='comment.php?reply.news.$cid.$nid' title='' class='reply' >الرد على التعليق</a></div>
									$edit
																	
								</div>
								<div class='clearfix'>  </div>	
								";
				}
				else
				{
					if (ADMIN && getperms("B"))
					{
						$text .="<ol class='warning'>هذا تعليق غير متاح للعموم و  يحتاج للموافقة حتى يتم نشره بالموقع: <br />". nl2br($comment_comment) ."<br /><a href='".e_ADMIN_ABS."modcomment.php?news.$nid'>نشر التعليق</a></ol>";
						$editall = TRUE ;
					}	
				}
				
			}
		return $text;
	}
	
	function create_commentz_tpl($cid) 
	{
		global $nid , $editall;
		$sql = new db;
		
		if (ADMIN && getperms("B"))
			$edit = "<div class='comment_edit'><a href='".e_ADMIN_ABS."modcomment.php?news.$nid.$cid' class='edit' >تعديل التعليق</a></div>";	

		$sql->db_select_gen("SELECT * FROM #comments WHERE comment_id = '$cid' AND comment_item_id = '$nid' AND comment_type = '0' ");
			while( $row=$sql->db_Fetch() ) 
			{
				extract($row);
				$author = explode('.',$comment_author );
				$date = strftime("%d %B %Y", $comment_datestamp); 
				$time = strftime("%H:%M", $comment_datestamp); 
				if ($comment_blocked == '0') 
				{
					$text .= "						
								<div id='comments'>
									<div id='comment-title'>
										<div class='user-name'>
											<div class='comments-name'>
												<h4>$author[1]</h4>
											</div>
											<div class='comments-date'>بتاريخ  $date على الساعة $time</div>
										</div>
									</div>
									<div class='comments-data'>
										<p>". nl2br($comment_comment) ."</p>
									</div>
								</div>	
								
								<div class='comment_reply'>
								</div>
								$edit
													
						";
				}
				else
				{
					if (ADMIN && getperms("B"))
					{
						$text .="<ol class='warning'>هذا تعليق غير متاح للعموم و  يحتاج للموافقة حتى يتم نشره بالموقع: <br />". nl2br($comment_comment) ."<br /><a href='".e_ADMIN_ABS."modcomment.php?news.$nid'>نشر التعليق</a></ol>";
						$editall = TRUE ;
					}	
				}
				
			}
		return $text;
	}

	$comment .= $addcommenttext ;
	$comment .= "<ol class='commentlist'>" ;
	
	foreach ( comids() as $cid ) { 
		$comment .= create_commentz($cid); 
	}

	if ($editall)	
		$edit = "<div class='info'><a href='".e_ADMIN_ABS."modcomment.php?news.$nid'>تعديل التعليقات</a></div>";
				
	$comment .=	$commenteditor ;
	$comment .= "</ol>" ;
	return $comment;
}