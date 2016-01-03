
/**
 * Forum UI components that are dynamically manipulated client-side.
 */
var UI_TOGGLED 	= 'edit-content-toggle';
var UI_TOGGLED_CONTENT = 'edit-content-toggle textarea';
var UI_CONTENT 	= 'edit-content';
var UI_AUTHOR = 'author';
var UI_BTN_CANCEL = 'btn-edit-cancel';
var UI_BTN_EDIT = 'btn-edit-edit';
var UI_BTN_UPDATE = 'btn-edit-update';
var UI_BTN_DELETE = 'btn-edit-delete';
var UI_BTN_QUOT	= 'btn-edit-quote';
var UI_FORM_UPDATE = 'edit-content-form';
var UI_HIDDEN_UPDATE_CONTENT = 'edit-content-hidden';
var UI_HIDDEN_UPDATE_TITLE = 'edit-content-rename-hidden';
var UI_UPDATE_TITLE = 'edit-content-rename';
var UI_UPDATE_CONTENT = 'edit-content-text';

var UI_HIT = 'post-hit';
var UI_HITS_TEXT = ['hit', 'text', 'hits'];

/**
 * Converts tabs and HTML <br> tags to spaces and new-line characters.
 * @param {string} html - the HTML string to convert.
 * @returns {string} - the converted text. 
 */
function html2text(html)
{
	var text = html.trim( );
	text = text.replace(/\\t/g, "");
	text = text.replace(/<br>/g, "\n");
	return text;
}

forum = {};
forum.hits = {};

/**
 * Refreshes the Hit counter on a list of Post IDs.
 * @param {list} postids - the list of identifiers.
 */
forum.hits.refresh = function (postids)
{
	var matcher = '.' + UI_HITS_TEXT[0] + ' .' + UI_HITS_TEXT[1] + ' .' + UI_HITS_TEXT[2];
	for (i = 0; i < postids.length; i++)
	{
		var data = { pid: postids[i] }
				
		$.post("/post/hits/" + postids[i], data, function (data)
		{
			data = JSON.parse(data);
			if (data.status)
			{
				$(matcher).filter('[data-id=' + data.id + ']').html(
					'<h5><b>' + data.value + '</h5></b> ' + ((data.value == 1) ? 'Hit' : 'Hits')
				);
			}
		});
	}
}

/**
 * Initializes the Click event for the Hit buttons.
 */
forum.hits.init = function ()
{
	var postids = [];
	var elements = $('.' + UI_HIT).each(function (index)
	{
		postids[index] = $(this).attr('data-id');
	});
	forum.hits.refresh(postids);
	setInterval(function () { forum.hits.refresh(postids); }, 4000);
	
	$("." + UI_HIT).click(function ()
	{
		var postid = $(this).data("id");
		var data = { pid: postid };
				
		$.post("/post/hit/" + postid, data, function (data)
		{
			data = JSON.parse(data);
			if (data.status)
			{
				var hitButton = $("." + UI_HIT).filter("[data-id=" + postid + "]");
				hitButton.prop('disabled', true);
				hitButton.addClass('post-hit-hit');
				forum.hits.refresh([postid]);
			}
		});
	});
};

$(document).ready( function () {

	texttags.init(UI_UPDATE_CONTENT);

	forum.hits.init( );

	$("." + UI_BTN_UPDATE).hide();
	$("." + UI_BTN_CANCEL).hide();
	$("." + UI_TOGGLED).hide();
	
	$("." + UI_BTN_QUOT).click(function ()
	{
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid +"]");
		var text = $elems.filter("." + UI_TOGGLED_CONTENT).text();
		var author = $elems.filter("." + UI_AUTHOR).text();
		cleaned = text.trim();
		
		$("#thread-reply-text").fieldSelection(
			texttags.tags.quote[0] + author.trim() + "]" + cleaned + texttags.tags.quote[1]
		);
		$("#thread-reply").gotoSection();
	});
	
	$("." + UI_BTN_EDIT).click(function ()
	{
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		var html = $elems.filter("." + UI_UPDATE_CONTENT).val();
		var text = html2text(html);
		
		$elem.attr('disabled','disabled');
		$elems.filter("." + UI_CONTENT).hide();
		$elems.filter("." + UI_BTN_QUOT).hide();
		$elems.filter("." + UI_TOGGLED).show();
		$elems.filter("." + UI_BTN_CANCEL).show();
		$elems.filter("." + UI_BTN_UPDATE).show();
		$elems.filter("." + UI_UPDATE_CONTENT).html(text);
		$("#post" + msgid).gotoSection();
	});
	
	$("." + UI_BTN_CANCEL).click(function ()
	{
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		
		$elems.filter("." + UI_BTN_EDIT).removeAttr('disabled');
		$elems.filter("." + UI_TOGGLED).hide();
		$elems.filter("." + UI_BTN_CANCEL).hide();
		$elems.filter("." + UI_BTN_UPDATE).hide();
		$elems.filter("." + UI_CONTENT).show();
		$elems.filter("." + UI_BTN_QUOT).show();
	});
	
	$("." + UI_BTN_UPDATE).click(function ()
	{
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		
		$elems.filter("." + UI_BTN_DELETE).attr('disabled','disabled');
		$elems.filter("." + UI_TOGGLED).hide();
		$elems.filter("." + UI_BTN_CANCEL).hide();
		$elems.filter("." + UI_BTN_UPDATE).hide();
		$elems.filter("." + UI_CONTENT).show();
		
		$elems.filter("." + UI_HIDDEN_UPDATE_TITLE).val( $elems.filter("." + UI_UPDATE_TITLE).val() );
		$elems.filter("." + UI_HIDDEN_UPDATE_CONTENT).val( $elems.filter("." + UI_UPDATE_CONTENT).val() );
		$elems.filter("." + UI_FORM_UPDATE).submit();
	});
});