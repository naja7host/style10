if (ADMINS) {
	$comments_pending = $sql -> db_Count("comments", "(*)", "WHERE comment_blocked = 2 ");
	
	$code = "
		<ul class='admin-side' >
			<li><a href='".e_HTTP."' id='ta-home'><span>الرئيسية</span></a></li>
			<li><a href='".THEME_ABS."admin_theme.php' id='ta-Settings'><span>لوحةالتحكم</span></a></li>
			<li><a href='".e_ADMIN_ABS."modcomment.php'  id='ta-comments'><span>التعليقات</span><span class='notification'>$comments_pending</span></a></li>
			<li><a href='#'  id='ta-messages'><span>الرسائل</span><span class='notification'>4</span></a></li>
			<li><a href='#'  id='ta-news'><span>الأخبار</span></a></li>
			<li><a href='#'  id='ta-video'><span>المرئيات</span></a></li>
			<li><a href='#'  id='ta-refresh'><span>تحديث الصفحة</span></a></li>
			<li><a href='#'  id='ta-update'><span>إصدار جديد</span></a></li>
		</ul>";
}		
else 
	$code = "";

return $code ;