/**
 * File selection looks pretty ugly when done through Form submission
 * because there is very little feedback to the User as to what is going on.
 * 
 * By implementing a File Selection utility we can provide feedback immediately
 * with JavaScript, such as whether the image File is too large/small or if a
 * non-image File was selected.
 * 
 * @author: Steve
 */
var fileselect = {};
fileselect.extensions = {};

fileselect.CONTAINER = ".fs-container";
fileselect.MODAL = ".fs-conf-modal";
fileselect.BTN_MODIFY = ".fs-btn-modify";
fileselect.BTN_CONFIRM = ".fs-btn-confirm";
fileselect.BTN_CANCEL = ".fs-btn-cancel";
fileselect.IMG_PREVIEW = ".fs-img-preview";

fileselect.FORM = 'input-file-select';
fileselect.INPUT_FILE = 'input[type=file]';
fileselect.INPUT_SUBMIT = 'input[type=submit]';

fileselect.FORM_INPUT_FILE = '.' + fileselect.FORM + ' ' + fileselect.INPUT_FILE;
fileselect.FORM_INPUT_SUBMIT = '.' + fileselect.FORM + ' ' + fileselect.INPUT_SUBMIT;

fileselect.extensions.AVATARS = ['png', 'jpg', 'gif', 'jpeg'];

/**
 * Returns an HTML element of a specified class with a specified data-id attribute.
 * @param {string} htmlclass - the class of the elements to filter.
 * @param {string} dataid - the data-id attribute to filter.
 * @returns {JQueryObject} 
 */
fileselect.filterDataId = function (htmlclass, dataid)
{
	return $(htmlclass).filter('[data-id="' + dataid + '"]');
}
fileselect.htmlForm = function (dataid)
{
	var style = "style='position: fixed; left: 0; top: 0; height: 0; width: 0;'";
	return	"<form action='/user/profile/edit' method='POST' data-id='" + dataid +
				"' enctype='multipart/form-data' class='" + fileselect.FORM + "' " + style + ">"
				+ "<input type='file' name='avatarfile' data-id='" + dataid + "' " + style + "/>"
				+ "<input type='submit' data-id='" + dataid + "' " + style + ">"
			+ "</form>";``
}

/**
 *
 * 
 */
$(document).ready(function ()
{
	if (!window.File || !window.FileReader || !window.FileList || !window.Blob)
		throw "Dependency issue.";

	/* Add an HTML file input form to all the `fileselect` Containers. These
	 * are used to service requests made to select a File or submit a selected File. */
	$(fileselect.CONTAINER).each(function ()
	{
		$(this).html($(this).html() + fileselect.htmlForm($(this).attr('data-id')));
	});

	/* When the `Change Avatar` button is clicked we force a click on the 
	 * auto-generated file-input button to bring up the File browser dialog. */
	$(fileselect.BTN_MODIFY).click(function ()
	{
		var dataid = $(this).attr('data-id');
		fileselect.filterDataId(fileselect.FORM_INPUT_FILE, dataid).val('');
		fileselect.filterDataId(fileselect.MODAL, dataid).modal('show');
		fileselect.filterDataId(fileselect.MODAL + ' .pending', dataid).show();
		fileselect.filterDataId(fileselect.MODAL + ' .selected', dataid).hide();
		fileselect.filterDataId(fileselect.MODAL + ' .error', dataid).hide();
		fileselect.filterDataId(fileselect.FORM_INPUT_FILE, dataid).click();
	});

	/* When a File has been selected we display the Image that was selected
	 * in a preview and allow the User to either Confirm or Cancel the process. 
	 * If there was no File selected then just Cancel the process. */
	$(fileselect.FORM_INPUT_FILE).change(function ()
	{
		var dataid = $(this).attr('data-id');

		var files = $(this).prop('files');
		if (files == null || files[0] == null)
		{
			fileselect.filterDataId(fileselect.MODAL, dataid).modal('hide');
			return;
		}

		var pieces = files[0].name.split('.');
		var ext = pieces[pieces.length - 1].toLowerCase();

		if (fileselect.extensions.AVATARS.indexOf(ext) == -1)
		{
			fileselect.filterDataId(fileselect.MODAL + ' .pending', dataid).hide();
			fileselect.filterDataId(fileselect.MODAL + ' .selected', dataid).hide();
			fileselect.filterDataId(fileselect.MODAL + ' .error', dataid).show();
		}

		if (fileselect.extensions.AVATARS.indexOf(ext) != -1)
		{
			var reader = new FileReader();
			reader.onload = function (e)
			{
				fileselect.filterDataId(fileselect.MODAL + ' .error', dataid).hide();
				fileselect.filterDataId(fileselect.MODAL + ' .pending', dataid).hide();
				fileselect.filterDataId(fileselect.MODAL + ' .selected', dataid).show();
				fileselect.filterDataId(fileselect.IMG_PREVIEW, dataid).css('background-image', "url('" + e.target.result + "')");
			}
			reader.readAsDataURL(files[0]);
		}
	});

	/* After the Preview process a User can Confirm the changes which will
	 * prompt a submission of the selected file by forcing a click on the 
	 * auto-generated input form submission. */
	$(fileselect.BTN_CONFIRM).click(function ()
	{
		var dataid = $(this).attr('data-id');
		fileselect.filterDataId(fileselect.MODAL, dataid).modal('hide');
		fileselect.filterDataId(fileselect.FORM_INPUT_SUBMIT, dataid).click();
	});

	/* Alternatively, the User may Cancel the chanegs which should do nothing
	 * and simply return the User to his/her Profile (hide the UI stuff). */
	$(fileselect.BTN_CANCEL).click(function ()
	{
		var dataid = $(this).attr('data-id');
		fileselect.filterDataId(fileselect.MODAL, dataid).modal('hide');
	});
});