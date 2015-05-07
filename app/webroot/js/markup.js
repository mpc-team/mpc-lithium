/**
 * markup.js
 *
 *	Forum text markup interpreter.
 *
 *	Text written in post content contain tags like '[b]' and '[/b]' which need
 *	to be rewritten as HTML elements for displaying in format in the page.
 *
 */
 
/**
 * Sample:
 *
 *	[h1]This is a header[/h1]            --->         <h1>This is a header</h1>
 *  [img]http://google.com[/img]         --->         <img src='http://google.com'></img>
 *
 */
 
/**
 * markup()
 *
 *	@param text	- Text to be parsed/converted.
 *
 *	Replaces markup tags such as [b] with their HTML style equivalent,
 *	such as <b> using the same example.
 *
 *	It would be nice to figure a way to parse and extract data rather than
 *	simply replacing static tags.
 *
 */
function markup (text) {
	var regex;
	for (var i = 0; i < tagmap.length; i++) {
		regex = new RegExp(tagmap[i].tag, "g");
		text = text.replace(regex, tagmap[i].mapped);
	}
	return text.replace(/\n/g, '<br>');
}
 
function TagmapEntry (tag, mapped) {
	this.tag = tag;
	this.mapped = mapped;
}

function TagmapTagOpen (tag) { return "\\[" + tag + "\\]"; }
function TagmapTagClose (tag) { return "\\[\\/" + tag + "\\]"; }

function TagmapMappedOpen (tag) { 
	switch (tag) {
		case "quote":
			return "<blockquote>";
		default:
			return "<" + tag + ">"; 
	}
}
function TagmapMappedClose (tag) {
	switch (tag) {
		case "quote":
			return "</blockquote>";
		default:
			return "</" + tag + ">";
	}
}

function TagmapTagLinkOpen (tag) { return "\\[" + tag + "="; }
function TagmapTagLinkContent () { return "\\]"; }
function TagmapTagLinkClose (tag) { return "\\[\\/" + tag + "\\]"; }

var tags = {
	general: [
		"b", "i", "u", "strike", 
		"h1", "h2", "h3", 
		"sup", "sub", 
		"ul", "li", 
		"p", "center", 
		"quote", "img"
	],
	special: {
		link: "link"
	}
};


var tagmap = [];
for (var i = 0; i < tags.general.length; i++) {
	tagmap.push(new TagmapEntry(TagmapTagOpen(tags.general[i]), TagmapMappedOpen(tags.general[i])));
	tagmap.push(new TagmapEntry(TagmapTagClose(tags.general[i]), TagmapMappedClose(tags.general[i])));
}
tagmap.push(new TagmapEntry(TagmapTagLinkOpen(tags.special.link), "<a href=\""));
tagmap.push(new TagmapEntry(TagmapTagLinkClose(tags.special.link), "</a>"));
tagmap.push(new TagmapEntry(TagmapTagLinkContent(), "\">"));
 
console.log(tagmap);