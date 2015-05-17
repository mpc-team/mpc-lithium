/**
 * markup.js
 *
 *
 */
function Tag (open, close) {
	this.open = open;
	this.close = close;
}

function TagMarkup (from, to) {
	this.from = from;
	this.to = to;
}
 
var TagMap = [
	new TagMarkup(
		new Tag("[b]", "[/b]"), 
		new Tag("<b>", "</b>") 
	),
	new TagMarkup( 
		new Tag("[i]", "[/i]"), 
		new Tag("<i>", "</i>") 
	),
	new TagMarkup( 
		new Tag("[u]", "[/u]"), 
		new Tag("<u>", "</u>") 
	),
	new TagMarkup( 
		new Tag("[strike]", "[/strike]"), 
		new Tag("<strike>", "</strike>") 
	),
	new TagMarkup( 
		new Tag("[h1]", "[/h1]"), 
		new Tag("<h1>", "</h1>") 
	),
	new TagMarkup( 
		new Tag("[h2]", "[/h2]"), 
		new Tag("<h2>", "</h2>") 
	),
	new TagMarkup( 
		new Tag("[h3]", "[/h3]"), 
		new Tag("<h3>", "</h3>") 
	),
	new TagMarkup( 
		new Tag("[sup]", "[/sup]"), 
		new Tag("<sup>", "</sup>") 
	),
	new TagMarkup( 
		new Tag("[sub]", "[/sub]"), 
		new Tag("<sub>", "</sub>") 
	),
	new TagMarkup( 
		new Tag("[ul]", "[/ul]"), 
		new Tag("<ul>", "</ul>") 
	),
	new TagMarkup( 
		new Tag("[li]", "[/li]"), 
		new Tag("<li>", "</li>") 
	),
	new TagMarkup( 
		new Tag("[p]", "[/p]"), 
		new Tag("<p>", "</p>") 
	),
	new TagMarkup( 
		new Tag("[center]", "[/center]"), 
		new Tag("<center>", "</center>") 
	),
	new TagMarkup( 
		new Tag("[quote]", "[/quote]"), 
		new Tag("<blockquote>", "</blockquote>") 
	),
	new TagMarkup( 
		new Tag("[img]", "[/img]"), 
		new Tag("<img src='", "'></img>") 
	),
	new TagMarkup( 
		new Tag("[link=", "[/link]"), 
		new Tag("<a href='", "</a>") 
	),
	new TagMarkup( 
		new Tag("[video]", "[/video]"), 
		new Tag(
			"<iframe allowfullscreen frameborder='0' height='300' width='500' src='", 
			"'></iframe>"
		) 
	)
]

function compareTextToTag (text, place, tag) {
/**
 * compareTextToTag (text, place, tag):
 *
 * Compares a given text substring with a given tag. Returns the tag that
 * was matched if the comparison is "successful".
 */
	var result = null;
	if (place + tag.length <= text.length) {
		var substr = text.substring(place, place + tag.length);
		if (substr == tag) {
			result = tag;
		}
	}
	return result;
}
 
function buildMarkupList (text) {
/**
 * buildMarkupList (text):
 *
 * Builds a list of elements that can be processed. Markup tags and content are
 * separated in the list by the order in which they appear. This will allow us to
 * verify that the markup is correct as well as build the resulting string.
 */
	var markupList = [];
	var markupContent = "";
	
	for (var i = 0; i < text.length; i++) {
		var markupFound = false;
		for (var m = 0; (m < TagMap.length) && (!markupFound); m++) {
			var tag = compareTextToTag(text, i,TagMap[m].from.open);
			tag = (tag == null) ? compareTextToTag(text, i, TagMap[m].from.close) : tag;
			
			if (tag) {
				if (markupContent) {
					markupList.push(markupContent);
				}
				markupList.push(tag);
				i += tag.length - 1;
				markupFound = true;
				markupContent = "";
			}
		}
		if (!markupFound) {
			markupContent += text[i];
		}
	}
	if (markupContent) {
		markupList.push(markupContent);
	}
	return markupList;
}

function getTagMapElement (data) {
/**
 * getTagMapElement (data):
 *
 * Finds the associated TagMap value for a specified string. Notice that it should
 * return the same object for [b] and [/b] because they are part of the same tag.
 */
	for (var m = 0; m < TagMap.length; m++) {
		var resultObject = new Object();
		
		if (TagMap[m].from.open == data) {
			resultObject.flag = "open";
			resultObject.map = TagMap[m];
			return resultObject;
		} else if (TagMap[m].from.close == data) {
			resultObject.flag = "close";
			resultObject.map = TagMap[m];
			return resultObject;
		}
	}
	return null;
}

function verifyMarkupList (list) {
/**
 * verifyMarkupList (list):
 *
 * Verifies that the markup contained in the Markup List is valid. This
 * means that any open markup tag is closed. The order in which tags
 * are closed is not important.
 */
	var expected = [];
 
	for (var i = 0; i < list.length; i++) {
		var tmap = getTagMapElement(list[i]);
		if (tmap) {
			if (tmap.flag == "open") {
				// we are now expecting a closing tag eventually
				expected.push(tmap.map.from.close);
			} else if (tmap.flag == "close") {
				// remove from the expected array
				var index = expected.indexOf(tmap.map.from.close);
				if (index > -1) { expected.splice(index, 1); }
			}
		}
	}
	return (expected.length == 0);
}

function getMarkupTagContent (list, index) {
/**
 * getMarkupTagContent (list, index):
 *
 * Returns the content (including tags) between a specified open-tag and
 * its corresponding closing tag. Closing tags are determined to be the
 * first closing tag encountered after the open tag.
 */
	var tmap = getTagMapElement(list[index]);
	var content = null;
	
	if (tmap) {
		var i = index + 1;
		content = "";
		while (list[i] != tmap.map.from.close) {
			content += list[i];
			i++;
		}
	}
	return content;
}

function setMarkupTagContent (list, index, content) {
/**
 * setMarkupTagContent (list, index, content):
 *
 * Similar to "getMarkupTagContent" but can be used to modify the contents
 * of a tag. This is necessary for the [video] tag as we see below.
 */
	var tmap = getTagMapElement(list[index]);
	var contentMarkupList = buildMarkupList(content);
	
	if (tmap) {
		var i = index + 1;
		while (list[i] != tmap.map.from.close) {
			list[i] = contentMarkupList[i - index - 1];
			i++;
		}
		return true;
	}
	return false;
}

function swapMarkupList (list) {
/**
 * swapMarkupList (list):
 *
 * Uses the TagMap entry to swap tags in the Markup List from the
 * original markup tag to the new mapped tag.
 */
	for (var i = 0; i < list.length; i++) {
		var tmap = getTagMapElement(list[i]);
		
		if (tmap) {
			if (tmap.map.from[tmap.flag] == "[video]") {
				var content = getMarkupTagContent(list, i);
				content = content.replace("watch?v=", "embed/");
				setMarkupTagContent(list, i, content);
			} else if (tmap.map.from[tmap.flag] == "[link=") {
				var content = getMarkupTagContent(list, i);
				content = content.replace("]", "'>");
				setMarkupTagContent(list, i, content);
			}
			// swap values with the mapped values
			list[i] = tmap.map.to[tmap.flag];
		}
	}
	return list;
}
 
function markup (text) {
	var markupList = buildMarkupList(text);
	var marked = null;
	
	if (verifyMarkupList(markupList)) {
		markupList = swapMarkupList(markupList);
		marked = '';
		for (var i = 0; i < markupList.length; i++) {
			marked += markupList[i];
		}
		return marked.replace(/\n/g, '<br>');
	}
}



