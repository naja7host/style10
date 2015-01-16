global $tp, $pref ;

$ads ="	<div class='rightfixed' >
			". $tp->toHTML($pref['frontpage_ads_rightfixed'], FALSE, 'nobreak, retain_nl, no_make_clickable, no_replace, emotes_off, no_hook') ."
		</div>";

return $ads ;