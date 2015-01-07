jQuery(document).ready(function(){
    var scripts = document.getElementsByTagName("script");
    var jsFolder = "";
    for (var i= 0; i< scripts.length; i++)
    {
        if( scripts[i].src && scripts[i].src.match(/initcarousel-1\.js/i))
            jsFolder = scripts[i].src.substr(0, scripts[i].src.lastIndexOf("/") + 1);
    }
    if ( typeof html5Lightbox === "undefined" )
    {
        html5Lightbox = jQuery(".html5lightbox").html5lightbox({
            skinsfoldername:"",
            jsfolder:jsFolder,
            barheight:64,
            thumbwidth:80,
            thumbheight:60,
			thumbtopmargin:12,
            thumbbottommargin:8,
            showtitle:true,
            showdescription:false,
            shownavigation:false,
			previmage:"../images/lightbox-prev.png",
			loadingimage:"../images/lightbox-loading.gif",
			nextimage:"../images/lightbox-next.png",	
			closeimage:"../images/lightbox-close.png",
            titlebottomcss:'{color:#333; font-size:14px; font-family:Armata,sans-serif,Arial; overflow:hidden; text-align:left;}',
            descriptionbottomcss:'{color:#333; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; margin:4px 0px 0px; padding: 0px;}'
        });
    }
    jQuery("#amazingcarousel-1").amazingcarousel({
        jsfolder:jsFolder,
        pauseonmouseover:true,
        showhoveroverlay:true,
        enabletouchswipe:true,	
        circular:true,
		responsive:true,
        showplayvideo:true,
        lightboxshowtitle:true,	
        supportiframe:false,
        autoplay:false,
        usescreenquery:false,
        transparent:false,
        donotcrop:false,
        random:false,
        showitembottomshadow:false,		
        showbottomshadow:false,		
        lightboxshowdescription:false,
        navswitchonmouseover:false,
        showhoveroverlayalways:false,		
        lightboxshownavigation:false,
        showitembackgroundimage:false,		
        showbackgroundimage:false,
        width:200,
        height:140,
        interval:3000,
        itembottomshadowimagetop:100,			
        arrowheight:32,
        bottomshadowimagetop:95,
        transitionduration:1000,
        itembackgroundimagetop:0,
        backgroundimagewidth:110,
        itembackgroundimagewidth:100,
        backgroundimagetop:-40,		
        imageheight:140,
        skinsfoldername:"",			
        skin:"Classic",
        lightboxdescriptionbottomcss:"{color:#333; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; margin:4px 0px 0px; padding: 0px;}",
        lightboxtitlebottomcss:"{color:#333; font-size:14px; font-family:Armata,sans-serif,Arial; overflow:hidden; text-align:left;}",
		direction:"horizontal",
        navdirection:"horizontal",
        backgroundimage:"",
        scrollmode:"page",
        navmode:"page",
        imagefillcolor:"FFFFFF",
        navstyle:"bullets",
        arrowstyle:"always",
        transitioneasing:"easeOutExpo",
        itembackgroundimage:"",
        playvideoimagepos:"center",
        arrowimage:"../images/arrows-32-32-1.png",
        navimage:"../images/bullet-16-16-1.png",		
        playvideoimage:"../images/playvideo.png",		
        hoveroverlayimage:"../images/playvideo_hover.png",
        itembottomshadowimage:"../images/itembottomshadow-100-100-5.png",
		bottomshadowimage:"../images/bottomshadow-110-95-0.png",
		lightboxthumbtopmargin:12,
        lightboxbarheight:64,
        itembottomshadowimagewidth:100,	
        arrowwidth:32,		
        scrollitems:1,		
        spacing:18,
        lightboxthumbwidth:80,
        visibleitems:6,
        imagewidth:200,
        bottomshadowimagewidth:110,
        lightboxthumbbottommargin:8,
        arrowhideonmouseleave:1000,
        lightboxthumbheight:60,
        navspacing:8,
        screenquery:{
			tablet: {
				screenwidth: 900,
				visibleitems: 2
			},
			mobile: {
				screenwidth: 600,
				visibleitems: 1
			}
		},
        navwidth:16,
        loop:0,
        navheight:16
    });
});