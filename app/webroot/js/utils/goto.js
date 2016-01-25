(function ($)
{
	$.fn.goTo = function ()
	{
		$('html, body').animate({
			scrollTop: $(this).offset().top + 'px'
		}, 'fast');
		return this; // for chaining...
	}
})(jQuery);