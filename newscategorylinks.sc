   global $sql ;

	if(function_exists("linkstyle")){
    	$linkstyleset = linkstyle("topnav");
	}
	
   $sql->db_Select("news_category", "*", "order by category_id", "no_where");
		
	$newscategorylinks_text  = "";

	$newscategorylinks_text  .= $linkstyleset['prelink'];

	$newscategorylinks_text  .= $linkstyleset['linkstart'] ."<a href='" . e_BASE . "' >" . LAN_THEME_7 ."</a>" .$linkstyleset['linkend'];
		
   while($row = $sql->db_Fetch() )
   {
	if ($pref['nclm_all'] == 0 ) {
		$newscategorylinks_text .= $linkstyleset['linkstart'] ."<a href='" . e_BASE . "news.php?cat." . $row['category_id'] . "' >" . $row['category_name'] . "</a>". $linkstyleset['linkend'];
	} 
	else {
		if (in_array($row['category_id'], $pref['nclm_cat']))
		{
			$newscategorylinks_text .= $linkstyleset['linkstart'] ."<a href='" . e_BASE . "news.php?cat." . $row['category_id'] . "' >" . $row['category_name'] . "</a>". $linkstyleset['linkend'];
		}
		else 
			$newscategorylinks_text .="";	
		}
	}
	
	$newscategorylinks_text  .= $linkstyleset['postlink'] ;
	
	return $newscategorylinks_text ;