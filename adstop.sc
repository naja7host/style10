global $tp, $pref ;

$ads = $tp->toHTML($pref['frontpage_ads_top'], FALSE, 'nobreak, retain_nl, no_make_clickable, no_replace, emotes_off, no_hook') ;

return $ads ;