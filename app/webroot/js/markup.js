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
/**
 * TagmapEntry
 *	Basic structure that associates a tag and a mapping.
 */
function TagmapEntry (tag, mapped) {
	this.tag = tag;
	this.mapped = mapped;
}
/**
 * Tag Regex Strings
 *	Builds a regex matching string for a specific tag. The functions
 *	below are designed for single-input tags which the input can
 *	easily be encapsulated in simple open/close tags.
 */
function TagmapTagOpen (tag) { return "\\[" + tag + "\\]"; }
function TagmapTagClose (tag) { return "\\[\\/" + tag + "\\]"; }
/**
 * Mapping Functions
 *	TagmapMappedOpen/Close identify what to map a certain tag to.
 *	Specific cases can be made, by default encapsulates the tag
 *	with "<" and ">" characters.
 */
function TagmapMappedOpen (tag) { 
	switch (tag) {
		case "quote":
			return "<blockquote>";
		case "img":
			return "<img src=\"";
		default:
			return "<" + tag + ">"; 
	}
}
function TagmapMappedClose (tag) {
	switch (tag) {
		case "quote":
			return "</blockquote>";
		case "img":
			return "\"></img>";
		default:
			return "</" + tag + ">";
	}
}
/**
 * Special Tag Operations
 *	Tags that utilize multiple input fields need to be handled
 *	slightly differently. For the "link" tag, input is also included
 *	after an "=" such as "[link=google.com]".
 */
/* Link tags are done slightly differently because there are two 
	possible fields, the URL and the text that is displayed. */
function TagmapTagLinkOpen (tag) { return "\\[" + tag + "="; }
function TagmapTagLinkContent () { return "\\]"; }
function TagmapTagLinkClose (tag) { return "\\[\\/" + tag + "\\]"; }

var tags = {
	/* tags that only utilize a single input field */
	single: [
		"b", "i", "u", "strike", 
		"h1", "h2", "h3", 
		"sup", "sub", 
		"ul", "li", 
		"p", "center", 
		"quote", "img"
	],
	/* tags that utilize many input fields */
	multi: {
		link: "link"
	}
};


var tagmap = [];
for (var i = 0; i < tags.single.length; i++) {
	tagmap.push(new TagmapEntry(TagmapTagOpen(tags.single[i]), TagmapMappedOpen(tags.single[i])));
	tagmap.push(new TagmapEntry(TagmapTagClose(tags.single[i]), TagmapMappedClose(tags.single[i])));
}
tagmap.push(new TagmapEntry(TagmapTagLinkOpen(tags.multi.link), "<a href=\""));
tagmap.push(new TagmapEntry(TagmapTagLinkClose(tags.multi.link), "</a>"));
tagmap.push(new TagmapEntry(TagmapTagLinkContent(), "\">"));