$(document).ready(function(){
    $("#footbar").hover(function(){
	$(this).animate({bottom:"0px"},125)
	    //addClass("barshow");
    },function(){
	$(this).animate({bottom:"-25px"},500)//removeClass("barshow");
    });
});
