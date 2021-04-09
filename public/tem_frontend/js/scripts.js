/*
* @Created 2017-11-10 JGI 2291
*/

function setTarget(elementId, url) 
{ 
	var currentQueryString = location.search.substring(1, location.search.length); 
	
	if(currentQueryString) { var newURL = (url.indexOf('?') != -1) ? url + "&" + currentQueryString : url + "?" + currentQueryString; }
	else { var newURL = url; } 
	
	if(newURL.indexOf('#') != -1) 
	{
		var url_without_tag = newURL.substring(0,newURL.indexOf('#'));
		var query_param = newURL.substring(newURL.indexOf('#'));
		var hashtag = query_param.substring(0,query_param.indexOf('?'));
		var new_query_param = query_param.substring(query_param.indexOf('?'));
		newURL = url_without_tag + new_query_param + hashtag;
	}

	$('#'+elementId).attr('href', newURL);
	
	return;
}

(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';

		var lang = $('body').attr('lang');

		$.each(window[lang], function(k, v){
			setTarget(k, v); 
		});
		
		$('.game-list-item').hover(
			function() {
				$(this).children('.game-hover').removeClass('hide').addClass('show');
			}, function() {
				$(this).children('.game-hover').removeClass('show').addClass('hide');
				$(this).children('.game-info').removeClass('gi-show').addClass('gi-hide');
			}
		);
		
		$('.game-hover-info').click(function(e){
			e.preventDefault();
			$(this).parents('.game-list-item').children('.game-info').removeClass('gi-hide').addClass('gi-show');
			//alert('1');
		});
		
		$('.game-info-close').click(function(){
			$(this).parents('.game-info').removeClass('gi-show').addClass('gi-hide');
		});
		
		$('.language-switcher').click(function(){
			
			var langHeight = '';
			
			if ($('body').attr('lang') == 'en') { langHeight = '520px'; }				
			if ($('body').attr('lang') == 'eu') { langHeight = '520px'; }				
			if ($('body').attr('lang') == 'sc') { langHeight = '520px'; }				
			if ($('body').attr('lang') == 'ch') { langHeight = '520px'; }				
			if ($('body').attr('lang') == 'th') { langHeight = '520px'; }				
			if ($('body').attr('lang') == 'vn') { langHeight = '520px'; }				
			if ($('body').attr('lang') == 'id') { langHeight = '520px'; }				
			if ($('body').attr('lang') == 'jp') { langHeight = '520px'; }				
			if ($('body').attr('lang') == 'kr') { langHeight = '520px'; }				
			if ($('body').attr('lang') == 'ind') { langHeight = '520px'; }				
			if ($('body').attr('lang') == 'gr') { langHeight = '520px'; }				
			if ($('body').attr('lang') == 'pl') { langHeight = '520px'; }				
			
			if ($(this).children('ul').css('height') == langHeight) {
				$(this).children('ul').css('height', '0px');
			} else {
				$(this).children('ul').css('height', langHeight);	
			}
		});
		
		$('.float-left-connect').click(function(e){
			e.preventDefault();
			$('.modal#floating-banner-left-lightbox--3').addClass('modal-active')
		});
		
		$('.modal-close-button, .modal-overlay').click(function(){
			$('.modal').removeClass('modal-active');
		});
		
		$('#float-right-chat').click(function(event){
			var url = $(this).attr('href');
			event.preventDefault();
			PopupCenter(url,'','360','760');   
		});
		
		$('#float-right-wechat, #float-right-line, #float-right-talk, #float-right-zalo').click(function(event){
			var url = $(this).attr('href');
			event.preventDefault();
			PopupCenter(url,'','822','427');   
		});
		
		$('.show-video').click(function(event){
			var url = $(this).attr('href');
			event.preventDefault();
			PopupCenter(url,'','760','400');   
		});

	});
	
})(jQuery, this);

function PopupCenter(url, title, w, h) 
{
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    if (window.focus) {
        newWindow.focus();
    }
}
