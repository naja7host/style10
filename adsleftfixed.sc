global $tp, $pref ;

$ads ="	<div class='leftfixed' >
			". $tp->toHTML($pref['frontpage_ads_leftfixed'], FALSE, 'nobreak, retain_nl, no_make_clickable, no_replace, emotes_off, no_hook') ."
		</div>";

return $ads ;