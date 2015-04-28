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
 *	[h1]This is a header[/h1]             --->         <h1>This is a header</h1>
 * [img]http://google.com[/img]        --->         <img src='http://google.com'></img>
 *
 */
 
function TagMapEntry (open_tag, open_mapped, close_tag, close_mapped) {
	this.open_tag = open_tag;
	this.open_mapped = open_mapped;
	this.close_tag = close_tag;
	this.close_mapped = close_mapped;
}
 
var tagmap = [
	new TagMapEntry('\\[b\\]', '<b>', '\\[\\/b\\]', '</b>'),
	new TagMapEntry('\\[i\\]', '<i>', '\\[\\/i\\]', '</i>'),
	new TagMapEntry('\\[u\\]', '<u>', '\\[\\/u\\]', '</u>'),
	new TagMapEntry('\\[strike\\]', '<strike>', '\\[\\/strike\\]', '</strike>'),
	new TagMapEntry('\\[h1\\]', '<h1>', '\\[\\/h1\\]', '</h1>'),
	new TagMapEntry('\\[h2\\]', '<h2>', '\\[\\/h2\\]', '</h2>'),
	new TagMapEntry('\\[h3\\]', '<h3>', '\\[\\/h3\\]', '</h3>'),
	new TagMapEntry('\\[sup\\]', '<sup>', '\\[\\/sup\\]', '</sup>'),
	new TagMapEntry('\\[sub\\]', '<sub>', '\\[\\/sub\\]', '</sub>'),
	new TagMapEntry('\\[ul\\]', '<ul>', '\\[\\/ul\\]', '</ul>'),
	new TagMapEntry('\\[li\\]', '<li>', '\\[\\/li\\]', '</li>'),
	new TagMapEntry('\\[p\\]', '<p>', '\\[\\/p\\]', '</p>'),
	new TagMapEntry('\\[center\\]', '<center>', '\\[\\/center\\]', '</center>'),
	new TagMapEntry('\\[a\\]', '<a>', '\\[\\/a\\]', '</a>'),
	new TagMapEntry('\\[img\\]', '<img src="', '\\[\\/img\\]', '"></img>')
];
 
function markup (text) {
	var regex;
	
	for (var i = 0; i < tagmap.length; i++) {
		regex = new RegExp(tagmap[i].open_tag, "g");
		if (text.match(regex)) {
			console.log(text.match(regex));
			text = text.replace(regex, tagmap[i].open_mapped);
			regex = new RegExp(tagmap[i].close_tag, "g");
			text = text.replace(regex, tagmap[i].close_mapped);
		}
	}
	return text;
}