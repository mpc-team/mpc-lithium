
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

var UI_PUNCH = 'punch';
var UI_KICK  = 'kick';
var UI_HITS_TEXT = ['hit', 'text', 'hits'];

/**
 * Button classes that correspond to specific Forum text-tag helpers.
 */
var BTN_TAGS_BOLD = 'edit-tag-bold';
var BTN_TAGS_ITALIC = 'edit-tag-italic';
var BTN_TAGS_UNDERLINE	= 'edit-tag-underline';
var BTN_TAGS_STRIKE = 'edit-tag-strike';
var BTN_TAGS_HEAD_1 = 'edit-tag-header1';
var BTN_TAGS_HEAD_2 = 'edit-tag-header2';
var BTN_TAGS_HEAD_3 = 'edit-tag-header3';
var BTN_TAGS_SUP	= 'edit-tag-superscript';
var BTN_TAGS_SUB = 'edit-tag-subscript';
var BTN_TAGS_ULIST	= 'edit-tag-ulist';
var BTN_TAGS_LISTITEM = 'edit-tag-ulist-item';
var BTN_TAGS_PARAGRAPH	= 'edit-tag-paragraph';
var BTN_TAGS_CENTER = 'edit-tag-center';
var BTN_TAGS_LINK = 'edit-tag-link';
var BTN_TAGS_IMAGE = 'edit-tag-image';
var BTN_TAGS_VIDEO	= 'edit-tag-video';

/**
 * Markup tags applied to text when helpers are clicked.
 */
var TAGS_BOLD	= ["[b]", "[/b]"];
var TAGS_ITALIC = ["[i]", "[/i]"];
var TAGS_UNDERLINE = ["[u]", "[/u]"];
var TAGS_STRIKE	= ["[strike]", "[/strike]"];
var TAGS_HEADER1 = ["[h1]", "[/h1]"];
var TAGS_HEADER2 = ["[h2]", "[/h2]"];
var TAGS_HEADER3 = ["[h3]", "[/h3]"];
var TAGS_SUP = ["[sup]", "[/sup]"];
var TAGS_SUB = ["[sub]", "[/sub]"];
var TAGS_ULIST = ["[ul]", "[/ul]"];
var TAGS_LISTITEM = ["[li]", "[/li]"];
var TAGS_PARAGRAPH = ["[p]", "[/p]"];
var TAGS_CENTER = ["[center]", "[/center]"];
var TAGS_LINK = ['[link]', '[/link]'];
var TAGS_IMAGE = ["[img]", "[/img]"];
var TAGS_VIDEO = ["[video]", "[/video]"];
var TAGS_QUOTE = ["[quote=", "[/quote]"];

function html2text(html) {
	var text = html.trim( );
	text = text.replace(/\\t/g, "");
	text = text.replace(/<br>/g, "\n");
	return text;
}

var forum = {
	hits: {
		refresh: function (postids) {
			var matcher = '.' + UI_HITS_TEXT[0] + ' .' + UI_HITS_TEXT[1] + ' .' + UI_HITS_TEXT[2];
			for (i = 0; i < postids.length; i++) {
				var data = { pid: postids[i] }
				
				$.post("/post/getHits/" + postids[i], data, function (data) {
					data = JSON.parse(data);
					if (data.status) {
						$(matcher).filter('[data-id=' + data.id + ']').html(
							'<h5><b>' + data.value + '</h5></b> ' + ((data.value == 1) ? 'Hit' : 'Hits')
						);
					}
				});
			}
		},
		init: function () {
			// To find post IDs just look for all punch buttons and get the data-id
			// associated with it, which will yield a list of IDs for posts that we can
			// currently use/see.
			var postids = [];
			var elements = $('.' + UI_PUNCH).each(function (index) {
				postids[index] = $(this).attr('data-id');
			});
			forum.hits.refresh(postids);
			setInterval(function () { forum.hits.refresh(postids); }, 4000);
	
			$("." + UI_PUNCH).click( function ( ) {
				var postid = $(this).data("id");
				var data = { pid: postid };
				
				$.post("/post/hit/" + postid, data, function (data) {
					data = JSON.parse(data);
					console.log( data );
					if (data.status) {
						var punchButton = $("." + UI_PUNCH).filter("[data-id=" + postid + "]");
						var kickButton = $("." + UI_KICK).filter("[data-id=" + postid + "]");
						punchButton.prop('disabled', true);
						kickButton.prop('disabled', true);
						forum.hits.refresh([postid]);
					}
				});
			});
			
			$("." + UI_KICK).click( function ( ) {
				var postid = $(this).data("id");
				var data = { pid: postid }
				
				$.post("/post/hit/" + postid, data, function (data) {
					data = JSON.parse(data);
					if (data.status) {
						var punchButton = $("." + UI_PUNCH).filter("[data-id=" + postid + "]");
						var kickButton = $("." + UI_KICK).filter("[data-id=" + postid + "]");
						punchButton.prop('disabled', true);
						kickButton.prop('disabled', true);
						forum.hits.refresh([postid]);
					}
				});
			});
		}
	}
};

$(document).ready( function () {

	forum.hits.init( );

	$("." + UI_BTN_UPDATE).hide();
	$("." + UI_BTN_CANCEL).hide();
	$("." + UI_TOGGLED).hide();
	
	$("." + UI_BTN_QUOT).click( function () {
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid +"]");
		var text = $elems.filter("." + UI_TOGGLED_CONTENT).text();
		var author = $elems.filter("." + UI_AUTHOR).text();
		cleaned = text.trim();
		
		$("#thread-reply-text").fieldSelection(
			TAGS_QUOTE[0] + author.trim() + "]" + cleaned + TAGS_QUOTE[1]
		);
		$("#thread-reply").gotoSection();
	});
	
	$("." + UI_BTN_EDIT).click( function () {
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
	
	$("." + UI_BTN_CANCEL).click( function () {
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
	
	$("." + UI_BTN_UPDATE).click( function () {
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
	
	$("." + BTN_TAGS_BOLD).click( function () {
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		var text = $elems.filter("." + UI_UPDATE_CONTENT);
		text.fieldSelection(TAGS_BOLD[0] + text.fieldSelection().text + TAGS_BOLD[1]);
	});
	
	$("." + BTN_TAGS_ITALIC).click( function (){
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		var text = $elems.filter("." + UI_UPDATE_CONTENT);
		text.fieldSelection(TAGS_ITALIC[0] + text.fieldSelection().text + TAGS_ITALIC[1]);
	});
	
	$("." + BTN_TAGS_UNDERLINE).click( function (){
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		var text = $elems.filter("." + UI_UPDATE_CONTENT);
		text.fieldSelection(TAGS_UNDERLINE[0] + text.fieldSelection().text + TAGS_UNDERLINE[1]);
	});
	
	$("." + BTN_TAGS_STRIKE).click( function (){
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		var text = $elems.filter("." + UI_UPDATE_CONTENT);
		text.fieldSelection(TAGS_STRIKE[0] + text.fieldSelection().text + TAGS_STRIKE[1]);
	});
	
	$("." + BTN_TAGS_HEAD_1).click( function () {
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		var text = $elems.filter("." + UI_UPDATE_CONTENT);
		text.fieldSelection(TAGS_HEADER1[0] + text.fieldSelection().text + TAGS_HEADER1[1]);
	});
	
	$("." + BTN_TAGS_HEAD_2).click( function () {
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		var text = $elems.filter("." + UI_UPDATE_CONTENT);
		text.fieldSelection(TAGS_HEADER2[0] + text.fieldSelection().text + TAGS_HEADER2[1]);
	});
	
	$("." + BTN_TAGS_HEAD_3).click( function () {
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		var text = $elems.filter("." + UI_UPDATE_CONTENT);
		text.fieldSelection(TAGS_HEADER3[0] + text.fieldSelection().text + TAGS_HEADER3[1]);
	});
	
	$("." + BTN_TAGS_SUP).click( function () {
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		var text = $elems.filter("." + UI_UPDATE_CONTENT);
		text.fieldSelection(TAGS_SUP[0] + text.fieldSelection().text + TAGS_SUP[1]);
	});
	
	$("." + BTN_TAGS_SUB).click( function () {
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		var text = $elems.filter("." + UI_UPDATE_CONTENT);
		text.fieldSelection(TAGS_SUB[0] + text.fieldSelection().text + TAGS_SUB[1]);
	});
	
	$("." + BTN_TAGS_ULIST).click( function () {
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		var text = $elems.filter("." + UI_UPDATE_CONTENT);
		text.fieldSelection(TAGS_ULIST[0] + text.fieldSelection().text + TAGS_ULIST[1]);
	});
	
	$("." + BTN_TAGS_LISTITEM).click( function () {
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		var text = $elems.filter("." + UI_UPDATE_CONTENT);
		text.fieldSelection(TAGS_LISTITEM[0] + text.fieldSelection().text + TAGS_LISTITEM[1]);
	});
	
	$("." + BTN_TAGS_PARAGRAPH).click( function () {
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		var text = $elems.filter("." + UI_UPDATE_CONTENT);
		text.fieldSelection(TAGS_PARAGRAPH[0] + text.fieldSelection().text + TAGS_PARAGRAPH[1]);
	});
	
	$("." + BTN_TAGS_CENTER).click( function () {
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		var text = $elems.filter("." + UI_UPDATE_CONTENT);
		text.fieldSelection(TAGS_CENTER[0] + text.fieldSelection().text + TAGS_CENTER[1]);
	});
	
	$("." + BTN_TAGS_LINK).click( function () {
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		var text = $elems.filter("." + UI_UPDATE_CONTENT);
		text.fieldSelection(TAGS_LINK[0] + text.fieldSelection().text + TAGS_LINK[1]);
	});
	
	$("." + BTN_TAGS_IMAGE).click( function () {
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		var text = $elems.filter("." + UI_UPDATE_CONTENT);
		text.fieldSelection(TAGS_IMAGE[0] + text.fieldSelection().text + TAGS_IMAGE[1]);
	});
	
	$("." + BTN_TAGS_VIDEO).click( function () {
		var $elem = $(this);
		var msgid = $elem.data("id");
		var $elems = $("[data-id=" + msgid + "]");
		var text = $elems.filter("." + UI_UPDATE_CONTENT);
		text.fieldSelection(TAGS_VIDEO[0] + text.fieldSelection().text + TAGS_VIDEO[1]);
	});
});