/**
 * 
 * Tooltip.js
 * 
 * @author steve
 * @date 1/31/2016
 * 
 */

/* Declare Namespace */
var Tooltip = {};

/* Configuration
-------------------------------------------------------------------------------- */

/* The amount of time before a Tooltip should expire if there is no input
 * that indicates otherwise. */
Tooltip.IdleDetectTime = 500;

/* Style settings that have effects on the UI. */
Tooltip.PaddingLeft = 15;
Tooltip.MarginTop = -20;

/* Utils
-------------------------------------------------------------------------------- */

Tooltip.GetElemTooltipId = function (tooltipid)
{
	return tooltipid + '-tooltip';
}

/* UI Functions
-------------------------------------------------------------------------------- */

/* Whether a Tooltip is currently being displayed. Multiple Tooltips shouldn't
 * be shown on the page at the same time. */
Tooltip.GlobalExists = false; // Set to True for tests.

/* Keep a reference to the expiry timer so we can interrupt it if necessary. */
Tooltip.ExpiryTimeout = null;

/* Reference to the current element being displayed as a Tooltip. */
Tooltip.CurrentElement = null;

Tooltip.Render = function (targetid, tooltipid)
{
	if (Tooltip.CurrentElement != null)
		Tooltip.Expire(Tooltip.CurrentElement);

	var offsetTop = $(targetid).offset().top;
	var offsetLeft = $(targetid).offset().left;

	offsetLeft = offsetLeft + parseInt($(targetid).css('width'), 10) + Tooltip.PaddingLeft;
	offsetTop = offsetTop + Tooltip.MarginTop;

	$(tooltipid).css('display', 'block');
	$(tooltipid).css('top', offsetTop);
	$(tooltipid).css('left', offsetLeft);
	$(tooltipid).css('width', 'auto');

	// Configure Tooltip to be setup.
	Tooltip.GlobalExists = true;
	Tooltip.CurrentElement = tooltipid;
}

Tooltip.Expire = function (tooltipid)
{
	$(tooltipid).css('display', 'none');

	// Set GlobalExists false after expiry.
	Tooltip.GlobalExists = false;
	Tooltip.CurrentElement = null;
}

/* Event Handlers
-------------------------------------------------------------------------------- */

Tooltip.ClearExpireTimeout = function ()
{
	if (Tooltip.ExpiryTimeout != null)
		clearTimeout(Tooltip.ExpiryTimeout);
	Tooltip.ExpiryTimeout = null;
}

Tooltip.SetExpireTimeout = function (tooltipid)
{
	Tooltip.ClearExpireTimeout();
	Tooltip.ExpiryTimeout = setTimeout(Tooltip.OnTimeout, Tooltip.IdleDetectTime, tooltipid);
}

Tooltip.OnTimeout = function (tooltipid)
{
	Tooltip.Expire(tooltipid)
	Tooltip.ExpiryTimeout = null;
}

/**
 * When a Tooltip needs to be displayed for an element the element will refer
 * to this function to initialize the Tooltip. If the cursor leaves thie element,
 * the Tooltip will expire and disappear.
 * 
 * @param {string} selfid - Identifier for element that requires Tooltip.
 */
Tooltip.OnMouseOver = function (selfid)
{
	/* Check for a hashtag symbol in `selfid`. */
	if (selfid != null && selfid.length > 0 && selfid[0] != '#')
		selfid = '#' + selfid;

	/* Clear Expiry Events that may affect a newly rendered Tooltip. */
	Tooltip.ClearExpireTimeout();

	var tooltipID = Tooltip.GetElemTooltipId(selfid);

	/* Render the Tooltip. */
	Tooltip.Render(selfid, tooltipID);

	/* When an element is no longer selected, the Tooltip will expire. */
	$(selfid).mouseleave(function () { Tooltip.SetExpireTimeout(tooltipID); });

	/* If a Tooltip is hovered we want to prevent it from expiring. To accomodate
	 * for this we need to reset expiry if the cursor leaves the Tooltip. */
	$(tooltipID).mouseenter(function () { Tooltip.ClearExpireTimeout(); });
	$(tooltipID).mouseleave(function () { Tooltip.SetExpireTimeout(tooltipID)})
}