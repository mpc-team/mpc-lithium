	/**
 * markup.js
 *
 * Markup is the processing and preparing of text. This markup library will take a string of text
 * and prepare it for viewing with HTML styling. Simple tags, such as [b] and [i], convert almost
 * directly into HTML <b> and <i>.
 *
 * Image reference tags [image][/image] map to <img src=''></img>. In this case, we simply map the
 * opening tag [image] to <img src=' and the closing tag [/image] to '></img>. The tags and their
 * mappings are identified first below. 
 */
var markup = {};

/* Markup Mode Constants */
markup.NORMAL = 1;
markup.PREVIEW = 2;
markup.MARKDOWN = 4;

markup.MAP_NORMAL = "standard";
markup.MAP_PREVIEW = "preview";

/**
 * Constructor for `class Tag` (implicit).
 * 
 * @param {string} open - a string that marks the beginning of a "Tag".
 * @param {string} close - a string that marks the ending of a "Tag".
 */
markup.Tag = function (open, close)
{
	this.open = open;
	this.close = close;
};

/**
 * Constructor for `class TagMarkup` (implicit).
 * 
 * @param {Tag} from - the Tag that is converted into another Tag format.
 * @param {Tag} to - the Tag format being converted to.
 */
markup.TagMarkup = function (from, to)
{
	this.from = from;
	this.to = to;
};

/**
 * markup.TagMap
 * 
 * We actually need multiple TagMap lists because we want to support different modes of
 * markup that can potentially support different features. It may also be a good idea to have
 * a standard list of tag-mappings that are included in *all* mode-specific lists.
 */
markup.TagMap = {
	"standard": [
		new markup.TagMarkup(
			new markup.Tag("[b]", "[/b]"),
			new markup.Tag("<b>", "</b>")
		),
		new markup.TagMarkup(
			new markup.Tag("[i]", "[/i]"),
			new markup.Tag("<i>", "</i>")
		),
		new markup.TagMarkup(
			new markup.Tag("[u]", "[/u]"),
			new markup.Tag("<u>", "</u>")
		),
		new markup.TagMarkup(
			new markup.Tag("[strike]", "[/strike]"),
			new markup.Tag("<strike>", "</strike>")
		),
		new markup.TagMarkup(
			new markup.Tag("[img]", "[/img]"),
			new markup.Tag("<img src='", "'></img>")
		),
		new markup.TagMarkup(
			new markup.Tag("[link=", "[/link]"),
			new markup.Tag("<a href='", "</a>")
		),
		new markup.TagMarkup(
			new markup.Tag("[link]", "[/link]"),
			new markup.Tag("<a href='", "</a>")
		),
		new markup.TagMarkup(
			new markup.Tag("[strike]", "[/strike]"),
			new markup.Tag("<strike>", "</strike>")
		),
		new markup.TagMarkup(
			new markup.Tag("[h1]", "[/h1]"),
			new markup.Tag("<h1>", "</h1>")
		),
		new markup.TagMarkup(
			new markup.Tag("[h2]", "[/h2]"),
			new markup.Tag("<h2>", "</h2>")
		),
		new markup.TagMarkup(
			new markup.Tag("[h3]", "[/h3]"),
			new markup.Tag("<h3>", "</h3>")
		),
		new markup.TagMarkup(
			new markup.Tag("[sup]", "[/sup]"),
			new markup.Tag("<sup>", "</sup>")
		),
		new markup.TagMarkup(
			new markup.Tag("[sub]", "[/sub]"),
			new markup.Tag("<sub>", "</sub>")
		),
		new markup.TagMarkup(
			new markup.Tag("[ul]", "[/ul]"),
			new markup.Tag("<ul>", "</ul>")
		),
		new markup.TagMarkup(
			new markup.Tag("[li]", "[/li]"),
			new markup.Tag("<li>", "</li>")
		),
		new markup.TagMarkup(
			new markup.Tag("[p]", "[/p]"),
			new markup.Tag("<p>", "</p>")
		),
		new markup.TagMarkup(
			new markup.Tag("[center]", "[/center]"),
			new markup.Tag("<center>", "</center>")
		),
		new markup.TagMarkup(
			new markup.Tag("[quote]", "[/quote]"),
			new markup.Tag("<blockquote>", "</blockquote>")
		),
		new markup.TagMarkup(
			new markup.Tag("[quote=", "[/quote]"),
			new markup.Tag("<blockquote>", "</blockquote>")
		),
	],
	"extended": [
		new markup.TagMarkup(
			new markup.Tag("[video]", "[/video]"),
			new markup.Tag(
				"<iframe allowfullscreen height='300' width='500' frameborder='0' src='",
				"'></iframe>"
			)
		),
	],
	"extended-preview": [
		new markup.TagMarkup(
			new markup.Tag("[video]", "[/video]"),
			new markup.Tag("<div class='video'><img class='playbutton' src='/img/youtube_playbutton.png'></img><img height='150' width='300' src='", "'></img></div>")
		),
	],
}

/**
 * Outlines the whole markup procses. The tag-mapping used is able to 
 * differ based on the `mode` to provide customizeable results in
 * a variety of situations.
 * 
 * @param {string} text - string to perform markup on.
 * @param {int} mode - markup mode, defaults to NORMAL (expects markup.NORMAL or markup.PREVIEW).
 * 
 * @returns {string} - The end-result of the markup process, in a form that can be printed.
 */
markup.process = function (text, mode)
{
	var mappings = this.TagMap["standard"];
	var list = null;
	var result = text;

	if (mode & this.MARKDOWN)
		result = markdown.toHTML(result);

	switch (mode)
	{
		case this.MARKDOWN:
			mappings = null;
			break;
		case (this.MARKDOWN | this.PREVIEW):
		case this.PREVIEW:
			mappings = mappings.concat(this.TagMap["extended-preview"]);
			break;
		case (this.MARKDOWN | this.NORMAL):
		default:
			mappings = mappings.concat(this.TagMap["extended"]);
			break;
	}

	if (mappings != null)	
	{
		list = this.prepare(result, mappings);
		if (this.verify(list, mappings))
		{
			list = this.swap(list, mappings, mode);
			result = '';
			for (var i = 0; i < list.length; i++)
			{
				result += list[i];
			}
			//result = result.replace(/\n/g, '<br>');
		}
	}

	return result;
};

/**
 * Builds the list of markup components.
 * 
 * @param {string} text - build markup components from this string.
 * @param {list} map - the TagMarkup mappings to consider.
 * 
 * @returns {list} - markup components in list form.
 */
markup.prepare = function (text, map)
{
	var list = [];
	var prepared = "";
	for (var i = 0; i < text.length; i++)
	{
		var found = false;
		for (var m = 0; (m < map.length) && (!found) ; m++)
		{
			var tag = this.compare(text, i, map[m].from.open);
			tag = (tag == null) ? this.compare(text, i, map[m].from.close) : tag;
			if (tag)
			{
				if (prepared)
				{
					list.push(prepared);
				}
				list.push(tag);
				i += tag.length - 1;
				found = true;
				prepared = "";
			}
		}
		if (!found)
		{
			prepared += text[i];
		}
	}
	if (prepared)
	{
		list.push(prepared);
	}
	return list;
};

/**
 * Verifies that a list of markup components is properly constructed.
 * 
 * @param {array} list - list of markup components.
 * 
 * @returns {bool} True if the markup list is valid. 
 */
markup.verify = function (list, map)
{
	var expected = [];
	for (var i = 0; i < list.length; i++)
	{
		var tmap = this.tagmap(list[i], map);
		if (tmap)
		{
			if (tmap.flag == "open")
			{
				expected.push(tmap.map.from.close);
			}
			else if (tmap.flag == "close")
			{
				var index = expected.indexOf(tmap.map.from.close);
				if (index > -1)
				{
					expected.splice(index, 1);
				}
			}
		}
	}
	return (expected.length == 0);
};

/**
 * Swaps the markup components with the corresponding "to" TagMarkup.
 * 
 * @param {list} list - list of markup components.
 * @param {list} map - list of TagMarkup entries used to corresponding entries.
 * @param {int} mode - the markup mode, for specific processing of certain tags.
 * 
 * @returns {list} - markup component list with corresponding tags swapped. 
 */
markup.swap = function (list, map, mode)
{
	for (var i = 0; i < list.length; i++)
	{
		var tmap = this.tagmap(list[i], map);
		if (tmap)
		{
			switch (tmap.map.from[tmap.flag])
			{
				case "[video]":
					var stuff = this.getContent(list, i, map);

					/* If we're in Preview mode then we only need a thumbnail of a video. */
					if (mode & markup.PREVIEW)
					{
						stuff = stuff.replace("watch?v=", "vi/");
						stuff = stuff.replace("https://www", "http://img");
						stuff = stuff.trim();
						stuff = stuff.split("#")[0];
						stuff += "/0.jpg";
					}
					else
						stuff = stuff.replace("watch?v=", "embed/");

					this.setContent(list, i, stuff, map);
					break;

				case "[quote]":
					var quoteMessage = this.getContent(list, i, map);
					quoteMessage = "<div class='quote-content'>" + quoteMessage + "</div>";
					this.setContent(list, i,quoteMessage, map);
					break;

				case "[quote=":
					var stuff = this.getContent(list, i, map);
					stuff = "Originally posted by <h4 style='display:inline'>" + stuff;
					stuff = stuff.replace("]", "</h4> <div class='quote-content'>");
					this.setContent(list, i, stuff + "</div>", map);
					break;

				case "[link=":
					var stuff = this.getContent(list, i, map);
					var hasHttp = stuff.indexOf("http://") > -1;
					var hasHttps = stuff.indexOf("https://") > -1;
					var url = (hasHttp || hasHttps) ? stuff : "http://" + stuff;
					stuff = url.replace("]", "'>");
					this.setContent(list, i, stuff, map);
					break;

				case "[link]":
					var stuff = this.getContent(list, i, map);
					var hasHttp = stuff.indexOf("http://") > -1;
					var hasHttps = stuff.indexOf("https://") > -1;
					var url = (hasHttp || hasHttps) ? stuff : "http://" + stuff;
					stuff = url + "'>" + stuff;
					this.setContent(list, i, stuff, map);
					break;
			}
			list[i] = tmap.map.to[tmap.flag];
		}
	}
	return list;
};

markup.compare = function (text, place, tag)
{
	var result = null;
	if (place + tag.length <= text.length)
	{
		var substr = text.substring(place, place + tag.length);
		if (substr == tag)
		{
			result = tag;
		}
	}
	return result;
};


/**
 * Maps a given string to a TagMap entry in the specified tag-mapping list.
 * 
 * @param {string} str - the string to find a mapping for.
 * @param {list} map - the list of tag mapping entries.
 * 
 * @returns {TagMarkup} - the TagMarkup object corresponding to `str` in the given list.
 */
markup.tagmap = function (str, map)
{
	for (var m = 0; m < map.length; m++)
	{
		var result = new Object();
		if (map[m].from.open == str)
		{
			result.flag = "open";
			result.map = map[m];
			return result;
		}
		else if (map[m].from.close == str)
		{
			result.flag = "close";
			result.map = map[m];
			return result;
		}
	}
	return null;
};

/**
 * Obtains string content that falls between an opening tag at the specified
 * index and the next corresponding closing tag.
 */
markup.getContent = function (list, index, map)
{
	var tmap = this.tagmap(list[index], map);
	var content = null;
	if (tmap)
	{
		var i = index + 1;
		content = "";
		while (list[i] != tmap.map.from.close)
		{
			content += list[i];
			i++;
		}
	}
	return content;
};

/**
 * Clears content between a specified set of tags. The opening tag location
 * is specified with `list[index]`. The new content is inserted between the
 * specified "open" tag and its corresponding "close" tag.
 * 
 * @param {list} list - markup component list.
 * @param {int} index - index of the opening tag in the markup component list.
 * @param {string} content - new content to be inserted.
 * @param {list} map - the tag-mapping that is being used for markup.
 * 
 * @returns {bool} - True if successful, false if the tag couldn't be found.
 */
markup.setContent = function (list, index, content, map)
{
	var tmap = this.tagmap(list[index], map);
	var contentList = this.prepare(content, map);
	if (tmap)
	{
		// remove content that was previously there
		var i = index + 1;
		while (list[i] != tmap.map.from.close)
		{
			i++;
		}
		list.splice(index + 1, i - index - 1);
		// put new content into the list traversing backwards
		for (i = contentList.length - 1; i > -1; i--)
		{
			list.splice(index + 1, 0, contentList[i]);
		}
		return true;
	}
	return false;
};












