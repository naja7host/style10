<?php
if (!defined('e107_INIT')) { exit; }

$raw_response =  simplexml_load_file('http://naja7host.com/mods/rss_menu/rss.php?news.2');

if ($raw_response) {

	$items = "<ul class='list-group'>";
	foreach($raw_response as $entry) {
		foreach($entry->item as $item) {
			$date = new DateTime($item->pubDate);
			$items .= "<li class='list-group-item'><a href='$item->link'  rel='tooltip'  data-toggle='tooltip' title='". (string) $item->description ."' >". (string) $item->title ."</a> - " . LAN_THEME_PROMOTION_02 . $date->format('Y-m-d') ."</li>";
			// $items .= (string) $item->description;
			// $items = (string) $item->link;
			// $parsed_results_array[] = $items;
		}
	}
	$items .= "</ul>";


}
// ===========================================================================
	
	$text .= "	<li class='active'>". LAN_THEME_ADMIN_SIDE_15 ."</li>
			</ol><!--.breadcrumb-->
			<!--PAGE CONTENT BEGINS HERE-->	
			<div class='panel panel-primary'>
				<div class='panel-heading'><i class='icon-star orange'></i> ". LAN_THEME_ADMIN_SIDE_15 ."</div>							
				<div class='panel-body'>				
					<p>".( $raw_response ? nl2br ($items)  : LAN_THEME_PROMOTION_01 )."</p>					
					</div><!-- end table respo -->											
				</div><!-- end panel body -->
			</div><!-- end panel -->
			<script type='text/javascript'>
			$(document).ready(function(){
				$('[rel=\"tooltip\"]').tooltip();
			});	
			</script>			
			";