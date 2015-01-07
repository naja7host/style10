   global $pref ;
	
	$breakingnews ="
	<nav class=' navbar navbar-fixed-". ( $pref['frontpage_urgent_position'] ? "top"  : "bottom" ) ." ajil'>
		<div class='container'>
			<div class='row'>
				<div class='col-sm-3'>
					<h1>".LAN_THEME_41."</h1>
				</div>
				<div class='col-sm-9 breaknews'>
					". $pref['frontpage_urgent_news'] ."
				</div>	
		</div>
	</nav>
	<div class='clearfix'></div>";
	
	return ( $pref['frontpage_urgent_news'] ? $breakingnews  : "" ) ;