$(function(){
	$('.image-teaser').each(function(i,val){
		var parent = $(val).parent().parent();
		$(val).css('width',$(parent).css('width'));
		$(val).css('height',$(parent).css('height'));
	})
})