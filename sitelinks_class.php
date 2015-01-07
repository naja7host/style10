<?php
if (!defined('e107_INIT')) { exit; }
include_lan(e_LANGUAGEDIR.e_LANGUAGE.'/lan_sitelinks.php');

class sitelinks
{

	//---------------------------------------------------------------------------------------
	function hilite($link,$enabled=''){
		global $PLUGINS_DIRECTORY,$tp,$pref;
		if(!$enabled){ return FALSE; }

		$link = $tp->replaceConstants($link,TRUE);
		$tmp = explode("?",$link);
		$link_qry = (isset($tmp[1])) ? $tmp[1] : "";
		$link_slf = (isset($tmp[0])) ? $tmp[0] : "";
		$link_pge = basename($link_slf);
		$link_match = strpos(e_SELF,$tmp[0]);

		if(e_MENU == "debug" && getperms('0')) {
			echo "<br />link= ".$link;
			echo "<br />link_q= ".$link_qry;
			echo "<br />url= ".e_PAGE;
			echo "<br />url_query= ".e_QUERY."<br />";
		}

	// ----------- highlight overriding - set the link matching in the page itself.

		if(defined("HILITE")) {
			if(strpos($link,HILITE)) {
				return TRUE;
			}
		}


	// --------------- highlighting for 'HOME'. ----------------
		global $pref;
		list($fp,$fp_q) = explode("?",$pref['frontpage']['all']."?");
		if(strpos(e_SELF,"/".$pref['frontpage']['all'])!== FALSE && $fp_q == $tmp[1] && $link == e_HTTP."index.php"){
			
			return TRUE;
		}

	// --------------- highlighting for plugins. ----------------
			if(stristr($link, $PLUGINS_DIRECTORY) !== FALSE && stristr($link, "custompages") === FALSE){

				if($link_qry)
				{  // plugin links with queries
					$subq = explode("?",$link);
					if(strpos(e_SELF,$subq[0]) && e_QUERY == $subq[1]){
						return TRUE;
					}else{
						return FALSE;
					}
				}
				else
				{  // plugin links without queries
					$link = str_replace("../", "", $link);
					if(stristr(dirname(e_SELF), dirname($link)) !== FALSE){
						return TRUE;
					}
				}
				return FALSE;
			}

	// --------------- highlight for news items.----------------
	// eg. news.php, news.php?list.1 or news.php?cat.2 etc
		if(substr(basename($link),0,8) == "news.php")
		{

			if (strpos($link, "news.php?") !== FALSE && strpos(e_SELF,"/news.php")!==FALSE) {

				$lnk = explode(".",$link_qry); // link queries.
				$qry = explode(".",e_QUERY); // current page queries.

				if($qry[0] == "item")
				{
					return ($qry[2] == $lnk[1]) ? TRUE : FALSE;
				}

				if($qry[0] == "all" && $lnk[0] == "all")
				{
					return TRUE;
				}

				if($lnk[0] == $qry[0] && $lnk[1] == $qry[1])
				{
					return TRUE;
				}

				if($qry[1] == "list" && $lnk[0] == "list" && $lnk[1] == $qry[2])
				{
					return TRUE;
				}

			}
			elseif (!e_QUERY && e_PAGE == "news.php")
			{

				return TRUE;
			}
				return FALSE;

		}
	// --------------- highlight for Custom Pages.----------------
	// eg. page.php?1

			if (strpos($link, "page.php?") !== FALSE && strpos(e_SELF,"/page.php")) {
				list($custom,$page) = explode(".",$link_qry);
				list($q_custom,$q_page) = explode(".",e_QUERY);
				if($custom == $q_custom){
					return TRUE;
				}else{
					return FALSE;
				}
			}

	// --------------- highlight default ----------------
			if(strpos($link, "?") !== FALSE){

				$thelink = str_replace("../", "", $link);
				if((strpos(e_SELF,$thelink) !== false) && (strpos(e_QUERY,$link_qry) !== false)){
					return true;
				}
			}
			if(!preg_match("/all|item|cat|list/", e_QUERY) && (strpos(e_SELF, str_replace("../", "",$link)) !== false)){
				return true;
			}

			if((!$link_qry && !e_QUERY) && (strpos(e_SELF,$link) !== FALSE)){
				return TRUE;
			}

			if(($link_slf == e_SELF && !link_qry) || (e_QUERY && strpos(e_SELF."?".e_QUERY,$link)!== FALSE) ){
				return TRUE;
			}

		return FALSE;
	}
	// ----------------------------------------------------

	function adnav_cat($cat_title, $cat_link, $cat_id=FALSE, $cat_open=FALSE , $style) {
		global $tp;

		$cat_link = (strpos($cat_link, '://') === FALSE && strpos($cat_link, 'mailto:') !== 0 ? e_HTTP.$cat_link : $cat_link);
		
		if ($cat_open == 4 || $cat_open == 5){
			$dimen = ($cat_open == 4) ? "600,400" : "800,600";
			$href = " href=\"javascript:open_window('".$cat_link."',".$dimen.")\"";
		} else {
			$href = "href='".$cat_link."'";
		}

		$text = "<a ".$href." ";
		
		if ($cat_open == 1){
			$text .= " rel='external' ";
		}
		
		if ($cat_id) {
			$text .= $style['linkstart_dropdown_prefix'] .">".$tp->toHTML($cat_title,"","defs, no_hook"). $style['linkstart_dropdown_suffix'] ."</a>"; //<i class='fa fa-angle-down'></i>
		} else {
			$text .= ">".$tp->toHTML($cat_title,"","defs, no_hook")."</a>";
		}
		
		return $text;
	}
		
	function render_sub($linklist, $id, $style='') {
		$text = "";
		foreach ($linklist['sub_'.$id] as $sub) {
		
			// Filter title for backwards compatibility ---->
			if(substr($sub['link_name'],0,8) == "submenu.") {
				$tmp = explode(".",$sub['link_name']);
				$subname = $tmp[2];
			} else {
				$subname = $sub['link_name'];
			}
				
			if (isset($linklist['sub_'.$sub['link_id']])) {  // Has Children.
				$sub_ids[] = $sub['link_id'];
				
				$text .= $style['subsublinkstart'] .$this->adnav_main($subname, $sub['link_url'], $sub['link_id'],$sub['link_open']);
				
				$text .= $style['subprelink'] ;
						
				$temp = $linklist['sub_'.$sub['link_id']];
				foreach ($temp as $bla) {
					if (isset($linklist['sub_'.$bla['link_id']])) {
						$text .= $style['subsublinkstart'] .$this->adnav_main($bla['link_name'], $bla['link_url'], $bla['link_id'], $bla['link_open']);
						$text .= $style['subprelink'];
						$text .= $this->render_sub($linklist, $bla['link_id']);
						$text .= $style['subpostlink'] . $style['subsublinkend'];
					} else {
						$text .= "<li class='dropdown-submenu111'>".$this->adnav_main($bla['link_name'], $bla['link_url'], null, $bla['link_open']).'</li>';
					}
				}
					
				$text .= $style['subpostlink'];
				$text .= $style['sublinkend'];
			} else {
				$text .= $style['sublinkstart'] . $this->adnav_main($subname, $sub['link_url'], null, $sub['link_open']). $style['sublinkend'];
			}
		}
		
		return $text;
	}
		
	function adnav_main($cat_title, $cat_link, $cat_id=FALSE, $cat_open=FALSE) {
		global $tp;
		
		$cat_link = (strpos($cat_link, '://') === FALSE) ? e_HTTP.$cat_link : $cat_link;
		$cat_link = $tp->replaceConstants($cat_link,TRUE);

		if ($cat_open == 4 || $cat_open == 5){
			$dimen = ($cat_open == 4) ? "600,400" : "800,600";
			$href = " href=\"javascript:open_window('".$cat_link."',".$dimen.")\"";
		} else {
			$href = "href='".$cat_link."'";
		}

		$text = "<a ".$href." ";
				
		if ($cat_id) {
			$text .= "class=''  tabindex='-1'";
		}
		if ($cat_open == 1) {
			$text .= " rel='external' ";
		}
		$text .= ">".$tp->toHTML($cat_title,"","defs, no_hook")."</a>";
		
		return $text;
	}
	
	function get($cat=1, $style='', $css_class = false) {	
		global $sql, $pref;
		$text .= "";
		
		
        // where did link alignment go?
        if (!defined('LINKALIGN')) { define('LINKALIGN', ''); }

        if(!$style)
		{
			$style['linkdisplay'] = defined('LINKDISPLAY') ? LINKDISPLAY : '';			
            $style['prelink'] = defined('PRELINK') ? PRELINK : '';
            $style['postlink'] = defined('POSTLINK') ? POSTLINK : '';			

            $style['linkstart'] = defined('LINKSTART') ? LINKSTART : '';
            $style['linkstart_hilite'] = defined('LINKSTART_HILITE') ? LINKSTART_HILITE : "";				
			$style['linkend'] = defined('LINKEND') ? LINKEND : '';
			
            $style['linkstart_dropdown'] = defined('LINKSTART_DROPDOWN') ? LINKSTART_DROPDOWN : '';
            $style['linkstart_dropdown_hilite'] = defined('LINKSTART_DROPDOWN_HILITE') ? LINKSTART_DROPDOWN_HILITE : '';
            $style['linkstart_dropdown_prefix'] = defined('LINKSTART_DROPDOWN_PREFIX') ? LINKSTART_DROPDOWN_PREFIX : '';
            $style['linkstart_dropdown_suffix'] = defined('LINKSTART_DROPDOWN_SUFFIX') ? LINKSTART_DROPDOWN_SUFFIX : '';
            $style['linkstart_dropdown_end'] = defined('LINKSTART_DROPDOWN_END') ? LINKSTART_DROPDOWN_END : '';
            
			$style['linkseparator'] = defined('LINKSEPARATOR') ? LINKSEPARATOR : '';
		
			$style['subprelink'] = defined('SUBPRELINK') ? SUBPRELINK : '';
			$style['subpostlink'] = defined('SUBPOSTLINK') ? SUBPOSTLINK : '';
			$style['sublinkstart'] = defined('SUBLINKSTART') ? SUBLINKSTART : '';
			$style['sublinkend'] = defined('SUBLINKEND') ? SUBLINKEND : '';

			$style['subsublinkstart'] = defined('SUBSUBLINKSTART') ? SUBSUBLINKSTART : '';
			$style['subsublinkend'] = defined('SUBSUBLINKEND') ? SUBSUBLINKEND : '';
			
			
			
        }
		
		if(!varset($style['linkseparator']))
		{
			$style['linkseparator'] = '';
		}


		// Setup Parent/Child Arrays ---->

		$link_total = $sql->db_Select('links', '*', 'link_category = '.intval($cat).' and link_class IN ('.USERCLASS_LIST.') ORDER BY link_order ASC');
		while ($row = $sql->db_Fetch()) {
			if($row['link_parent'] == 0) {
				$linklist['head_menu'][] = $row;
				$parents[] = $row['link_id'];
			} else {
				$pid = $row['link_parent'];
				$linklist['sub_'.$pid][] = $row;
			}
		}

		$text .= $style['prelink']  ;
		// Loops thru parents.--------->
		
		
		global $tp;
		$sepBr = 1;
		$sepCount = count($linklist['head_menu']);
		foreach ($linklist['head_menu'] as $lk) {
			$lk['link_url'] = $tp -> replaceConstants($lk['link_url'],TRUE);
			$main_linkid = $lk['link_id'];
			
			//if (hilite($lk['link_url'],TRUE)) { echo $lk['link_name']; }

			
			if (isset($linklist['sub_'.$main_linkid])) {  // Has Children.
				if ($this->hilite($lk['link_url'],TRUE)) { $hilite_style = $style['linkstart_dropdown_hilite'] ; } else {  $hilite_style = $style['linkstart_dropdown'] ; }

				$text .= $hilite_style . $this->adnav_cat($lk['link_name'], e_SELF.'?'.e_QUERY.'#', $main_linkid , "" , $style)."";
			
				$text .= $style['subprelink'] . $this->render_sub($linklist, $main_linkid ,$style) . $style['subpostlink'] . $style['linkstart_dropdown_end'] ;

			} else {
				if ($this->hilite($lk['link_url'],TRUE)) { $hilite_style = $style['linkstart_hilite'] ; } else {  $hilite_style = $style['linkstart'] ; }

				// Display Parent only.
				$text .= $hilite_style . $this->adnav_cat($lk['link_name'], $lk['link_url'], FALSE, $lk['link_open'], $style). $style['linkend'];
			}
			
			if (defined('LINKSEPARATOR')) {
				if ($sepBr < $sepCount) {
					$text .= $style['linkseparator'];
				}
			}
			$text .= $style['linkseparator'];
			$sepBr++;
		}

		if (defined('FS_END_SEPARATOR') && FS_END_SEPARATOR != false) {
			$text .= $style['linkseparator'];
		}

		$text .= "";
		$text .= $style['postlink']."\n";
		return $text;
	}

}	
?>