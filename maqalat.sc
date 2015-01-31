	//echo $pref['frontpage_news_block2'] ;
	switch ($pref['frontpage_news_block2']) 
	{
		case '0' :
			global $tp, $pref , $ns ;
			$text = $tp->toHTML($pref['frontpage_ads_topside'], FALSE, 'nobreak, retain_nl, no_make_clickable, no_replace, emotes_off, no_hook');
			$ns -> tablerender(LAN_THEME_34, $text);
		break;
		
		case  '1' :	
			echo "1";
			return;
		break;	
		
		case  '2' :
			require_once(e_HANDLER."news_class.php");	
			global $ns , $ix ;
			$ix = new news;
			
			if ($parm == '')
				$limit = 8 ;
			else 
				$limit = $parm ;
			
			$cat = $pref['frontpage_news_block2_sect'] ;
			$nobody_regexp = "'(^|,)(".str_replace(",", "|", e_UC_NOBODY).")(,|$)'";	
			
			$query = "SELECT n.*, u.user_id, u.user_name, u.user_customtitle, nc.category_name, nc.category_icon FROM #news AS n
			LEFT JOIN #user AS u ON n.news_author = u.user_id
			LEFT JOIN #news_category AS nc ON n.news_category = nc.category_id
			WHERE news_category='$cat'  AND n.news_class REGEXP '".e_CLASS_REGEXP."' AND NOT (n.news_class REGEXP ".$nobody_regexp.")
			AND n.news_class IN (".USERCLASS_LIST.") AND n.news_start < ".time()." AND (n.news_end=0 || n.news_end>".time().")  
			ORDER BY n.news_datestamp DESC LIMIT 0,".$limit."";

			if(!$sql->db_Select_gen($query))
			{
				$text = "";
			} 
			else 
			{
				$text = "<ul class='module-posts-4' >";
				
					while($row = $sql -> db_Fetch()){
					extract($row);
					$url = make_url($row);									
					$NEWSLISTSTYLE1 = "
					
								<li class='menu'>
									<div class='nb2_meta'>
										{NEWSSUMMARY}
									</div>							   
									<div class='thumbnail'>
									{NEWSIMAGETHUMB}
									</div>
									<div class='titlema'>
									{NEWSTITLELINK=extend}
									</div>
								</li>
							
					";
					$text .= $ix->render_newsitem($row, 'return', '', $NEWSLISTSTYLE1, $param);
				}
				$text .= "</ul>";
				$text .= "<div class='module-more-post'>
						<a  href='".e_BASE."news.php?cat.$news_category' >".LAN_THEME_33."</a>
					</div>";
				$caption = "<a href='".e_BASE."news.php?cat.$news_category' >".$category_name."</a>";
				$ns -> tablerender($caption, $text ,"newsindex_3col");
			}		
			return;				
		break;			
	}		
	