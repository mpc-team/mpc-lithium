

var UI_UPDATE_CONTENT = 'edit-content-text';

var texttags = {};

texttags.buttonClasses = {
	bold: 'edit-tag-bold',
	italic: 'edit-tag-italic',
	underline: 'edit-tag-underline',
	strike: 'edit-tag-strike',
	header1: 'edit-tag-header1',
	header2: 'edit-tag-header2',
	header3: 'edit-tag-header3',
	superscript: 'edit-tag-superscript',
	subscript: 'edit-tag-subscript',
	ulist: 'edit-tag-ulist',
	listitem: 'edit-tag-ulist-item',
	paragraph: 'edit-tag-paragraph',
	center: 'edit-tag-center',
	link: 'edit-tag-link',
	image: 'edit-tag-image',
	video: 'edit-tag-video',
};

texttags.tags = 
{
	bold: ["[b]", "[/b]"],
	italic: ["[i]", "[/i]"],
	underline: ["[u]", "[/u]"],
	strike: ["[strike]", "[/strike]"],
	header1: ["[h1]", "[/h1]"],
	header2: ["[h2]", "[/h2]"],
	header3: ["[h3]", "[/h3]"],
	superscript: ["[sup]", "[/sup]"],
	subscript: ["[sub]", "[/sub]"],
	ulist: ["[ul]", "[/ul]"],
	listitem: ["[li]", "[/li]"],
	paragraph: ["[p]", "[/p]"],
	center: ["[center]", "[/center]"],
	link: ['[link]', '[/link]'],
	image: ["[img]", "[/img]"],
	video: ["[video]", "[/video]"],

	// The quote tag is used by `forum.js` but makes sense to be here.
	quote: ["[quote=", "[/quote]"],
};


/**
 * Filters space-separated classes and filters the one applicable to
 * text-tags. This can then be used to reverse-map to a type of tag.
 * @param {string} buttonClass - The HTML-style classes of an element.
 * @returns {string} - The filtered class, or null if not found.
 */
texttags.filterButtonClass = function (buttonClass)
{
	var classes = buttonClass.split(' ');
	for (entry in classes)
	{
		if (classes[entry].length >= 5 && classes[entry].substr(0, 5) == 'edit-')
		{
			return classes[entry];
		}
	}
	return null;
}

/**
 * Returns the Type of button by reverse mapping the dictionary
 * `texttags.buttonClasses`.
 * @param {string} buttonClass - The button class to search for.
 * @returns {string} - The type of button corresponding to the class.
 */
texttags.findButtonType = function (buttonClass)
{
	buttonClass = texttags.filterButtonClass(buttonClass);
	for (type in texttags.buttonClasses)
	{
		if (buttonClass == texttags.buttonClasses[type])
		{
			return type;
		}
	}
	return null;
}

texttags.init = function (inputToUpdate)
{
	classes = texttags.buttonClasses;
	for (type in classes)
	{
		$('.' + classes[type]).click(function ()
		{
			var id = $(this).data('id');
			var elements = $('[data-id=' + id + ']');
			var inputElement = elements.filter('.' + inputToUpdate);
			var typeInstance = texttags.findButtonType($(this).attr('class'));

			console.log(typeInstance);

			inputElement.fieldSelection(
				texttags.tags[typeInstance][0] 
				+ inputElement.fieldSelection().text 
				+ texttags.tags[typeInstance][1]
			);
		});
	}
}