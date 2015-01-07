	require_once(e_HANDLER."news_class.php");	
	global $tp, $ns , $ix ;
	$ix = new news;
	$pref['shortdate'] = "%H:%M";
	$cat = $pref['frontpage_news_last24'];	
	//$cat = 6 ;	
	$nobody_regexp = "'(^|,)(".str_replace(",", "|", e_UC_NOBODY).")(,|$)'";	
	
	if(!$pref['frontpage_news_last24_limit']){
		$pref['frontpage_news_last24_limit'] = 6 ;
	}	
		
			$query = "SELECT n.*, u.user_id, u.user_name, u.user_customtitle, nc.category_name, nc.category_icon FROM #news AS n
			LEFT JOIN #user AS u ON n.news_author = u.user_id
			LEFT JOIN #news_category AS nc ON n.news_category = nc.category_id
			WHERE n.news_class IN (".USERCLASS_LIST.") 
			AND news_category='$cat'
			AND n.news_start < ".time()." AND (n.news_end=0 || n.news_end>".time().") 
			ORDER BY n.news_datestamp DESC LIMIT 0,".$pref['frontpage_news_last24_limit'];
		
			if(!$sql->db_Select_gen($query))
			{
				$text = '
				<div class="news24">
					<ul>				
						<li class="active-live"><span class="date">00:00</span>'. LAN_THEME_26 .'</li>						
					<ul>
				</div>
				<div class="clearfix"></div>';
			} 
			else 
			{
				$text = '
				<div class="news24" >
					<ul>';
				while($row = $sql -> db_Fetch()){
					extract($row);
					$url = make_url($row);
				
					$NEWSLISTSTYLE1 = '<li class="active-live"><span class="date">{NEWSDATE=short}</span>{NEWSTITLELINK=extend}</li>';
						
					$text .= $ix->render_newsitem($row, 'return', '', $NEWSLISTSTYLE1, $param);
				}
				$text .= "
					</ul>
				</div>
				<div class='clearfix'></div>";
			}
		$caption = "<a href='http://".e_DOMAIN."/news.php?cat.$cat' > ". $category_name ." </a>";
		
	
	$ns -> tablerender($caption, $text , "news24");
