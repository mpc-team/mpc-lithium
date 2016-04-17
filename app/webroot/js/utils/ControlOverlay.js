/**
 * ControlOverlay.js
 * 
 * ControlOverlay shows a set of controls when a "control-container" is moused over.
 * The controls that are displayed can be specified by appending a class of the
 * appropriate name to the container <div>. 
 * 
 * When controls are queued/clicked, rather than hard-coding any functionality we
 * simply trigger some events that can be hooked by our application. This way allows
 * us to define the logic for our controls separately. 
 * 
 * Valid control labels include:
 *	- edit		: Displays a pencil icon.
 *	- delete	: Displays a trash-can icon.
 */

/* Namespace */
var ControlOverlay = {};

/* UI Elements
---------------------------------------------------------------------------------------- */
ControlOverlay.UI = {};
ControlOverlay.UI.Elements = {};
ControlOverlay.UI.Elements.Container = ".control-container";
ControlOverlay.UI.Elements.Overlay = ".control-overlay";
ControlOverlay.UI.Elements.EditButton = ".btn-control-edit";
ControlOverlay.UI.Elements.DeleteButton = ".btn-control-del";

ControlOverlay.UI.HTML = {};
ControlOverlay.UI.HTML.Controls = function (options) {
	if (!options.length) return "";
	return "" +
	"<div class='control-overlay'>" +
		"<div class='control-overlay-panel'>" +

			// Edit Button
			((options.indexOf('edit') > -1) ? (
			"<button title='Delete' class='btn btn-edit btn-control-del pull-right'>" +
				"<i class='fa fa-trash fa-2x'> </i>" +
			"</button>") : "") +

			// Delete Button
			((options.indexOf('delete') > -1) ? (
			"<button title='Edit' class='btn btn-edit btn-control-edit pull-right'>" +
				"<i class='fa fa-pencil fa-2x'> </i>" +
			"</button>") : "") +

		"</div>" +
	"</div>";
}

/* Event Handlers
---------------------------------------------------------------------------------------- */
/* 
 
   If the Mouse is being Dragged we do not want to trigger a Click action. 
   To accomplish this we detect when the Mouse is being Dragged via 
   'mousedown', 'mouseup', and 'mousemove' events and disable the "OnClick" 
   actions.
   
 */
ControlOverlay.IsMouseDown = false;
ControlOverlay.IsClickDisabled = false;

ControlOverlay.OnMouseDown = function () {
	ControlOverlay.IsMouseDown = true;
	ControlOverlay.IsClickDisabled = false;
}
ControlOverlay.OnMouseUp = function () {
	ControlOverlay.IsMouseDown = false;
}
ControlOverlay.OnMouseMove = function () {
	if (ControlOverlay.IsMouseDown)
		ControlOverlay.IsClickDisabled = true;
}
/*

	Standard desktop functionality. Mouse "hovering" will prompt the 
	Control Container to become visible, and leaving the area will prompt
	the Container to become hidden again.

 */
ControlOverlay.OnMouseEnter = function () {
	$(this).find(ControlOverlay.UI.Elements.Overlay).css("display", "block");
};

ControlOverlay.OnMouseLeave = function () {
	$(this).find(ControlOverlay.UI.Elements.Overlay).css("display", "none");
};
/*
 
	On Mobile devices there is no ability to "hover", and as such the
	ability to display these Controls is done through a "Click" on the
	Control Container. This can also be used on desktops to pin the menu
	as it would be done on Mobile devices.

 */
ControlOverlay.OnClick = function () {
	if (!ControlOverlay.IsClickDisabled)
		if ($(this).find(ControlOverlay.UI.Elements.Overlay).css("display") == "none") {
			$(this).find(ControlOverlay.UI.Elements.Overlay).css("display", "block");
			$(this).unbind('mouseenter', ControlOverlay.OnMouseEnter);
			$(this).unbind('mouseleave', ControlOverlay.OnMouseLeave);
		}
		else {
			$(this).find(ControlOverlay.UI.Elements.Overlay).css("display", "none");
			$(this).mouseenter(ControlOverlay.OnMouseEnter);
			$(this).mouseleave(ControlOverlay.OnMouseLeave);
		}
}

/* Initialization
---------------------------------------------------------------------------------------- */
$(function () {
	// Wait for Upcoming Events to Render before Controls are Initialized.
	$(document).on("UpcomingEventsRendered", function () {

		// Render Control Elements.
		var options = [];
		if ($(ControlOverlay.UI.Elements.Container).hasClass("edit")) options.push("edit");
		if ($(ControlOverlay.UI.Elements.Container).hasClass("delete")) options.push("delete");

		$(ControlOverlay.UI.Elements.Container).append(ControlOverlay.UI.HTML.Controls(options));
		$(ControlOverlay.UI.Elements.Container).find(ControlOverlay.UI.Elements.Overlay).css("display", "none");

		// Register Control Event Triggers.
		$(ControlOverlay.UI.Elements.Container).find(ControlOverlay.UI.Elements.EditButton).click(function () {
			$.event.trigger({ type: "ControlOverlayEditClicked", eventid: $(this).data('id') })
		});
		$(ControlOverlay.UI.Elements.Container).find(ControlOverlay.UI.Elements.DeleteButton).click(function () {
			$.event.trigger({ type: "ControlOverlayDeleteClicked", eventid: $(this).data('id') })
		});

		$(ControlOverlay.UI.Elements.Container).click(ControlOverlay.OnClick);
		$(ControlOverlay.UI.Elements.Container).mousedown(ControlOverlay.OnMouseDown);
		$(ControlOverlay.UI.Elements.Container).mouseup(ControlOverlay.OnMouseUp);
		$(ControlOverlay.UI.Elements.Container).mousemove(ControlOverlay.OnMouseMove);

		$(ControlOverlay.UI.Elements.Container).mouseenter(ControlOverlay.OnMouseEnter);
		$(ControlOverlay.UI.Elements.Container).mouseleave(ControlOverlay.OnMouseLeave);
	});
});