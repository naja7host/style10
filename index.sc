	global $tp , $ns, $totalnews , $showdate , $idnews ;
	
	include_lan(e_PLUGIN.'frontpage/languages/'.e_LANGUAGE.'_front.php');
	require_once(e_HANDLER."news_class.php");
			
	$newsfrom = 0;
	$order = 'news_datestamp';
	$ix = new news;
	$nobody_regexp = "'(^|,)(".str_replace(",", "|", e_UC_NOBODY).")(,|$)'";
	

	
	//****************************************************************************//
	//********** 3 Column  first **************************************************//
	//****************************************************************************//	

	for ($i=1 ; $i<4 ; $i++) {
		if ($pref['frontpage_box_'.$i.''] != 0) 
		{
		
			$query1 = "SELECT n.*, u.user_id, u.user_name, u.user_customtitle, nc.category_name, nc.category_icon FROM #news AS n
			LEFT JOIN #user AS u ON n.news_author = u.user_id
			LEFT JOIN #news_category AS nc ON n.news_category = nc.category_id
			WHERE news_category='".$pref['frontpage_box_'.$i.'']."'  AND n.news_class REGEXP '".e_CLASS_REGEXP."' AND NOT (n.news_class REGEXP ".$nobody_regexp.")
			AND n.news_start < ".time()." AND (n.news_end=0 || n.news_end>".time().")
			AND n.news_id NOT IN ('".join("','", $idnews)."')
			ORDER BY n.news_sticky DESC, ".$order." DESC LIMIT ".intval($newsfrom).",". $pref['frontpage_box_1_limit'];
			$sql->db_Select_gen($query1);
			
				$text = "<div class='module-posts-2'>
							<ul>";					
				while($row = $sql -> db_Fetch())
				{
					$pref['shortdate'] = "%d-%m-%Y";
					extract($row);
					$caption = "
								<span>
									<a class='module-category-color-2' href='".e_BASE."news.php?cat.$news_category' >".$category_name."</a>
								</span>								
								";
		
					if (strlen($news_thumbnail) == 0)
						$news_thumbnail = "no_image.png";
						
							$NEWSLISTSTYLE1 = "
							<li class='block_1' >		
								<div class='thumbnail'>
									{NEWSIMAGETHUMB}
								</div>

								<div class='text'>
									<div class='title'>
										{NEWSTITLELINK=extend}									
									</div>								
									" .$showdate. "
									{NEWSBODY=380}
								</div>
							</li>";
							

							$text .= $ix->render_newsitem($row, 'return', '', $NEWSLISTSTYLE1, $param);
	
				}
					$text .= "</ul>
					</div>
					<div class='module-more-post'>
						<a  href='".e_BASE."news.php?cat.$news_category' >".LAN_THEME_33."</a>
					</div>	";					
				$ns -> tablerender($caption , $text, "newsindex_3col");				
				unset($text);	
				unset($caption);
				
		}
	}
	//echo "</div>";
	
	unset($text);	
	unset($caption);