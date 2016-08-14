/**
 * community.js
 *
 * Everything on the /community Page is managed here. Currently supports a list of Clans as well 
 * as a list of Members which are organized by Clan. There should be support on this page for
 * registering a new Clan with selected Members. 
 * 
 */
var community = {};
var members = {};
var streamers = {};
/* Network Updates
------------------------------------------------------------------------------------------------------------ */

community.clans = {};
community.clans.list = [];
community.clans.updated = false;
community.clans.update = function (additionalCallback) {
	$.get('/api/clans/all', null, function (clans) {
		community.clans.list = [];
		for (index in clans)
			community.clans.list.push(clans[index]);
		community.clans.updated = true;
		if (typeof (additionalCallback) == "function")
			additionalCallback(clans);
	});
}

members.games = {};
members.games.list = [];
members.games.updated = false;
members.games.update = function (additionalCallback) {
	$.get('/api/games/all', null, function (games) {
		members.games.list = [];
		for (index in games)
			members.games.list.push(games[index]);
		members.games.updated = true;
		if (typeof (additionalCallback) == "function")
			additionalCallback(games);
	});
}

members.users = {};
members.users.list = [];
members.users.updated = false;
members.users.update = function (additionalCallback) {
	$.get('/api/users/all?ext=true', null, function (users) {
		members.users.list = [];
		for (index in users)
			members.users.list.push(users[index]);
		members.users.updated = true;
		if (typeof (additionalCallback) == "function")
			additionalCallback(users);
	});
}

streamers.twitch = {};
streamers.twitch.list = [];
streamers.twitch.updated = false;
streamers.twitch.update = function (additionalCallback) {
    $.get('/api/twitchusers/all', null, function (twitchUsers) {
        streamers.twitch.list = [];
        for (index in twitchUsers)
            streamers.twitch.list.push(twitchUsers[index].tname);
        streamers.twitch.updated = true;
        if (typeof (additionalCallback) == "function")
            additionalCallback(twitchUsers);
    });
}
/* Community UI Functions
------------------------------------------------------------------------------------------------------------ */

community.ui = {};

community.ui.elements = {
	container: "#community-container",
	count: '#clans-count',
	register: {
		button: "#clan-register-button",
		feedback: "#clan-register-feedback",
		modal: "#clan-register-modal",
		modalClose: '#clan-register-modal .modal-header > button.close',
		name: '#clan-register-name',
		shortname: '#clan-register-shortname',
		members: "#clan-register-users",
		accept: "#clan-register-accept",
	}
}

community.ui.renderCommunity = function (clans) {
	var html = ""
	for (index in clans) {
		html += "<div class='col-md-4'>";
		html += "<div class='padded-tile-sm'>"
		html += "<div class='panel panel-default padded-panel-med'>";
		html += "<div class='clan'>"
		html += "<h2>" + clans[index].name + "</h2>";
		html += "<h2><small>" + clans[index].shortname + "</small></h2>";
		html += "</div>";
		html += "</div>";
		html += "</div>";
		html += "</div>";
	}
	$(community.ui.elements.container).html(html);
	$(community.ui.elements.count).html(community.clans.list.length);
}

/**
 * Renders the Clan Member selection UI for Clan Registration.
 * 
 * @param {array} users: List of User objects to stringify.
 */
community.ui.renderClanMembers = function (users) {
	user.auth.check(function (authenticated) {
		var html = "<div class='nano-content'>";
		html += "<div class='selectable-container ui-selectable'>";
		for (index in users) {
			if (users[index].clan == null && users[index].id != authenticated.id)
				html += community.ui.register.member.stringify(users[index]);
		}
		html += "</div>";
		html += "</div>";
		$(community.ui.elements.register.members).html(html);
		$(community.ui.elements.register.members + ' .selectable-container').selectable();
		$(community.ui.elements.register.members).addClass('nano');
		$(community.ui.elements.register.members).nanoScroller({ preventPageScrolling: true, alwaysVisible: true });
	});
}

community.ui.register = {};
community.ui.register.member = {};
community.ui.register.member.stringify = function (user) {
	var date = moment(user['tstamp']);
	var html = "<div class='row ui-widget-content' style='padding: 5px;' data-id='" + user.id + "'>";
	html += "<div class='row'>";
	html += "<div class='col-xs-2'>";
	html += "<div class='user-avatar-container' " +
		"style='background-image: url(\"" + user.avatar + "\");'>";
	html += "</div>";
	html += "</div>";
	html += "<div class='col-xs-10'>";
	html += "<h4>" + user.alias + "</h4>";
	html += "<h4><small>" + date.format("MMM DD YYYY") + "</small></h4>";
	html += "</div>";
	html += "</div>";
	html += "</div>";
	return html;
}

/* Members UI Functions
------------------------------------------------------------------------------------------------------------ */

members.ui = {};

/**
 * Input/Output HTML Elements.
 */
members.ui.elements = {
	result: "#members-results",
	count: '#members-count',
	clear: "#members-clear-filter",
	inputs: {
		email: '#email',
		alias: '#alias',
		games: '#members-games',
		game: '.game input',
	},
};

/**
 * Sort criteria for Members (initially).
 * @param {User} a: First User.
 * @param {User} b: Second User.
 * @returns {Integer}: 1, 0, or -1 depending on sort order.
 */
members.ui.renderMembersSort = function (a, b) {
	// Comparison attributes.
	var attrs = {
		'dates': {
			'a': new Date(a['last_logged']),
			'b': new Date(b['last_logged'])
		},
		'alias': {
			'a': b['alias'].toLowerCase(),	// These are swapped to reverse the sort-order, since the
			'b': a['alias'].toLowerCase()	// same operation is applied to all comparison attributes.
		}
	};
	// Apply comparisons attributes.
	for (var attr in attrs) {
		if (attrs[attr].a > attrs[attr].b)
			return -1;
		else if (attrs[attr].a < attrs[attr].b)
			return 1;
	}
	return 1; // Default.
};

/**
 * Renders a specified list of Users into the result table.
 * 
 * @param {array} users: List of Users/Members.
 */
members.ui.renderMembers = function (users) {
	var html = "";
	var alternate = true;

	// Map the `users` object to an array so we can sort it.
	users = $.map(users, function (property) { return property; });
	users.sort(members.ui.renderMembersSort);

	for (index in users) {
		html += "<tr class='row";
		if (alternate) html += " alt";
		if (users[index].newuser) html += " new";
		html += "'>";
		alternate = !alternate;
		html += members.ui.alias.stringify(users[index]);
		if ('email' in users[index])
			html += members.ui.email.stringify(users[index]);
		html += members.ui.games.stringify(users[index]);
		html += "</tr>";
	}
	$(members.ui.elements.result).html(html);
	$(members.ui.elements.count).html(members.users.list.length);
}

members.ui.renderGameInputs = function (games) {
	var html = "";
	var counter = 0;
	for (index in games) {
		if (counter % 4 == 0)
			html += "<div class='row'>";
		html += members.ui.input.game.stringify(games[index]);
		if (counter % 4 == 3)
			html += "</div>";
		counter++;
	}
	$(members.ui.elements.inputs.games).html(html);
	$(members.ui.elements.inputs.game).change(members.updateMembers);
}

members.ui.input = {};
members.ui.input.clear = function () {
	$(members.ui.elements.inputs.email).val('');
	$(members.ui.elements.inputs.alias).val('');
	$(members.ui.elements.inputs.game).each(function () { $(this).attr('checked', false) });
}

members.ui.input.game = {};
members.ui.input.game.stringify = function (game) {
	var html = "<div class='col-md-3'>";
	html += "<div class='game'>";
	html += "<label>";
	html += "<input type='checkbox' id='" + game.realname + "' />";
	html += "<span style='font-size: 9pt; font-weight: normal; padding-left:5px;'>";
	html += game.name;
	html += "</span>";
	html += "</label>";
	html += "</div>";
	html += "</div>";
	return html;
}

members.ui.email = {};
members.ui.email.stringify = function (object) {
	var result = "<td>";
	result += "<div class='email'>";
	result += object.email;
	result += "</div>";
	result += "</td>";
	return result;
}

members.ui.alias = {};
members.ui.alias.stringify = function (object) {
	var memberSince = moment(object.tstamp).format('MMMM Do YYYY');
	var lastLogged = moment(object.last_logged).format('MMMM Do YYYY')
	var lastLoggedToday = moment().format("DDMMYYYY") == moment(object.last_logged).format("DDMMYYYY");;

	if (lastLoggedToday)
		lastLogged += ", " + moment(object.last_logged).format("h:mm A");

	var result = "<td>";
	//result += "<a id='member-" + object.id + "' href='/user/view/" + object.id + "' onmouseover='tooltip.pop(this, \"#tooltip" + object.id + "\")'>";
	result += "<a href='/user/view/" + object.id + "'>";
	result += "<div id='member-" + object.id + "' class='name' onmouseover='Tooltip.OnMouseOver(this.id)'>";
	result += "<span class='glyphicon glyphicon-user'></span> ";
	result += object.alias;

	if (object.clan != null)
		result += ' <small class="pull-right" style="padding-top: 3px;">' + object.clan.shortname + '</small>';
	if (object.newuser)
		result += "<span class='badge'>New Member</span>";

	result += "</div>";
	result += "</a>";

	result += "<div id='member-" + object.id + "-tooltip' class='user-tooltip'>"
	result += "<div class='panel panel-default'>";

	result += "<div class='row'>";
	result += "<a href='/user/view/" + object.id + "'>";
	result += "<h2>" + object.alias;
	if (object.clan != null)
		result += " <div class='badge'>" + object.clan.shortname + "</div>";
	result += "</h2></a>";
	if ('email' in object)
		result += "<h2><small>" + object.email + "</small></h2>";
	result += "</div>";

	result += "<div class='row'>";
	result += "Member since <b>" + memberSince + "</b> <br />";
	result += "Last signed in <b>" + lastLogged + "</b>";
	result += "</div>";

	result += "<div class='row'>";
	result += "<div class='user-avatar-container' " +
		"style='background-image: url(\"" + object.avatar + "\"); padding:0'>";
	result += "</div>";
	result += "</div>";

	result += "</div>";
	result += "</div>";
	result += "</td>";

	return result;
}

members.ui.games = {};
members.ui.games.stringify = function (object) {
	var result = "<td>";
	result += "<div class='games'>";
	for (var index in object.games) {
		if ('icon' in object.games[index] && object.games[index].icon) {
			result += "<span class='icon'>";
			result += "<img src='" + object.games[index].icon + "'></img>";
			result += "</span>";
		}
	}
	result += "</div>";
	result += "</td>";
	return result;
}
/*
    Streamers UI Functions
    ------------------------------------------------------------------
*/
streamers.ui = {};
streamers.ui.twitch = {};
streamers.ui.elements = {
    html: "#twitch-casters-table",
    html2: "#twitch-casters-modal",
    count: "#twitch-caster-count",
};
//Parent Rendering for records in the database.
streamers.ui.renderTwitch = function (twitchUsers) {
//If Browser is a Mobile Device.
var isMobile = false; //initiate as false
// device detection
if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) isMobile = true;
    //Table Data.
    var html = "";
    //Modals. Disabled Few lines Below.
    var html2 = "";
    for (index in twitchUsers) {
        html += "<tr class='row'>";
        html += "<td>";
        html += "<div class='" + twitchUsers[index].tname + "-name' style='color: #88bb88; font-family: Alegreya Sans; font-weight: 700; font-size: 14pt; padding-top: 5px; margin-bottom: -1px; white-space: nowrap; overflow: hidden;'>";
        html += "</div>";
        html += "<span class='" + twitchUsers[index].tname + "-status'></span>";
        html += "</td>";
        html += "<td>";
        html += "<div class='row'>";
        if (isMobile == false) {
            html += "<div class='col-xs-12'>" + streamers.ui.twitch.buttons.stringify(twitchUsers[index].tname) + "</div>";
        } else if (isMobile == true) {
            html += "<div class='col-xs-12'>" + streamers.ui.twitch.buttons.mobile.stringify(twitchUsers[index].tname) + "</div>";
        }        
        html += "</div><!--row-->";
        html += "</td>";
        html += "</tr>";
        //Modals
        html2 += streamers.ui.twitch.modals.stringify(twitchUsers[index].tname);
        //console.log(twitchUsers[index].tname);
        $.getJSON('https://api.twitch.tv/kraken/users/' + twitchUsers[index].tname, function (object) {
            //console.log(object);
            //set user's name by class, and extracting the name of the user from the database -- using json to grab records from twitch.tv.
            $('.' + object.name + '-name').html('<span class="glyphicon glyphicon-user"></span>' + object.display_name);
            //If user.biography = null, else string text from json.
            if (object.bio == null) {
                //write and set by default if not biography is presented in JSON.
                $('.' + object.name + '-bio').html('No Biography');
            } else {
                //set biography if available.
                $('.' + object.name + '-bio').html(object.bio);
            }
            //user.logo was not uploaded on twitch.t.v. by the user.
            if (object.logo == null) {
                $('.' + object.name + '-logo').attr('src', '/users/avatars/noprofile.png');
            } else {
            //user.logo is available / uploaded on twitch.t.v by the user.
                $('.' + object.name + '-logo').attr('src', object.logo);
            }
            //console.log(object);
        });
        //Calling an object for the User's Channel API.
        $.getJSON('https://api.twitch.tv/kraken/channels/' + twitchUsers[index].tname, function (object) {
            //Banner on the Profile Page
            $('.' + object.name + '-banner').css('background', 'url("' + object.profile_banner + '") no-repeat center').css('background-size', '100% 100%');
            //Title of the Stream.
            $('.' + object.name + '-title').html(object.status);
            //Title of the Game.
            $('.' + object.name + '-game').html(object.game);
            //Streamer's Follower Count (Numeric).
            $('.' + object.name + '-followers').html(' Followers: ' + object.followers + ' ');
            //Streamer's Viewers Total (Numeric).
            $('.' + object.name + '-views').html(' Viewers: ' + object.views + ' ');
            //Streamer's Broadcast Language.
            //$('.' + object.name + '-twitchlanguage').html('Language: ' + object.broadcaster_language);
            //Maturity Level for the Streamer's Cast. object.mature = Returns Boolean.
            if (object.mature == false) {
                $('.' + object.name + '-maturerating').html("<span class='fa fa-exclamation-circle'>  Rated Mature</span>");
            }
        });
        //Twitch sends the status of NULL instead of omitting the user's stream value from JSON Return Data.
        $.getJSON('https://api.twitch.tv/kraken/streams/' + twitchUsers[index].tname, function (object) {
            //Example of String: https://api.twitch.tv/kraken/streams/mpcacidsnake
            var string = object._links.self;
            //Find Position of the Last / in String(URL example above) returns numeric.
            var searchString = string.lastIndexOf('/');//36 is the number, and static for this scenario.
            var subString = string.substring(searchString + 1);//Search with the numeric and extract what ever is after the / in the URL
            //If the stream is placed with NULL(offline) status...
            if (object["stream"] == null) {
                $('.' + subString + '-status').html('<span class="glyphicon glyphicon-remove-sign label label-default">Offline</span>');
                //console.log(subString);
            } else {
                $('.' + subString + '-status').html('<span class="glyphicon glyphicon-ok-sign label label-success">Online</span>');
            }
        });
    }//for iteration
    $(streamers.ui.elements.html).html(html);
    $(streamers.ui.elements.html2).html(html2);
    $(streamers.ui.elements.count).html(streamers.twitch.list.length);
}
streamers.ui.twitch.buttons = {};
streamers.ui.twitch.buttons.stringify = function (object) {
    var result = "";
    result += "<div class'btn-group'>";
    result += "<button type='button' class='btn btn-default pull-right' data-toggle='modal' data-target='#" + object + "-modal' style='text-align: center;'>";
    result += "<span class='glyphicon glyphicon-eye-open'></span>";
    result += "</button>";
    result += "</div><!--btn-group-->";    
    return result;    
}
streamers.ui.twitch.buttons.mobile = {};
streamers.ui.twitch.buttons.mobile.stringify = function (object) {
    var result = "";
    result += "<div class'btn-group'>";
    result += "<a href='https://www.twitch.tv/" + object + "' target='_blank'>";
    result += "<button type='button' class='btn btn-default pull-right' style='text-align: center;'>";
    result += "<span class='glyphicon glyphicon-new-window'></span>";
    result += "</button>";
    result += "</a>";
    result += "</div><!--btn-group-->";
    return result;
}
streamers.ui.twitch.modals = {};
streamers.ui.twitch.modals.stringify = function (object) {
    var result = "";
    result += "<div class='modal fade' tabindex='-1' role='dialog' id='" + object + "-modal'>";
    result += "<div class='modal-dialog modal-lg' role='document'>";
    result += "<div class='modal-content'>";
    result += "<div class='modal-header text-center'>";
    result += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
    result += "<p class='modal-title " + object + "-title'></p>";
    result += "<p class='modal-title " + object + "-game'></p>";
    result += "<p class='" + object + "-followers' style='display: inline;'></p>";
    result += "<p class='" + object + "-views' style='display: inline;'></p>";
    result += "<p class='" + object + "-maturerating' style='display: inline;'></p>";
    result += "</div><!--modal-header-->";
    result += "<div class='modal-body'>";
    //result += "<div class='embed-responsive embed-responsive-16by9'>";
    //result += "<iframe src='http://player.twitch.tv/?channel=" + object + "' scrolling='no' allowfullscreen='true' class='embed-responsive-item' id='"+ object +"-video'></iframe>";
    //result += "</div><!--div responsive 16by9-->";
    //result += "<div class='embed-responsive embed-responsive-16by9'>";
    //result += "<iframe src='http://twitch.tv/" + object + "/chat' scrolling='no' allowfullscreen='true' class='embed-responsive-item'></iframe>";
    //result += "</div><!--div responsive 16by9-->";
    result += "</div><!--modal-body-->";
    result += "<div class='modal-footer "+ object +"-banner'>";
    result += "<img class='" + object + "-logo user-avatar-container' />";
    result += "</div>";
    result += "</div><!--modal-footer-->";
    result += "</div><!--modal-content-->";
    result += "</div><!--modal-dialog-->";
    result += '</div><!--modal-->';
    return result;
}
/* List Filtering Functions
------------------------------------------------------------------------------------------------------------ */

members.list = {};
members.list.filtertypes = {};
members.list.filtertypes.ALIAS = 0;
members.list.filtertypes.EMAIL = 1;

/**
 * Checks if a User "has" a Game.
 * 
 * @param {object} user: User object.
 * @param {string} game: Name (realname) of the Game.
 * 
 * @return {bool}: True if the User "has" the Game.
 */
members.list.isGamePlayed = function (user, game) {
	for (index in user.games) {
		if (user.games[index].realname == game)
			return true;
	}
	return false;
}

/**
 * Filters Userlist based on Name/Alias and Email.
 * 
 * @param {array} users: List of Users.
 * @param {string} criteria: Filter criteria.
 * @param {int} filterBy: Specifies the property to filter by.
 * 
 * @returns {array}: Filtered list of Users.
 */
members.list.filter = function (users, criteria, filterBy) {
	var regex = new RegExp(criteria.toLowerCase().replace(/[.?*+^$[\]\\(){}|-]/g, "\\$&"));
	var filtered = [];
	var len = users.length;
	for (var i = 0; i < len; i++) {
		var matched = null;
		switch (filterBy) {
			// Filter by specified Alias.	
			case members.list.filtertypes.ALIAS:
				matched = users[i].alias.toLowerCase().match(regex);
				break;

				// Filter by specified Email.
			case members.list.filtertypes.EMAIL:
				matched = users[i].email.toLowerCase().match(regex);
				break;
		}
		if (matched) {
			filtered.push(users[i]);
		}
	}
	return filtered;
}

/**
 * Filters list of Users based on Games. 
 * 
 * @param {array} user: List of Users.
 * @param {array} games: List of Games to filter by.
 * 
 * @returns {array}: Filtered list of Users.
 */
members.list.filterByGames = function (users, games) {
	var filtered = [];
	var passed;

	for (u in users) {
		passed = true;
		for (g in games) {
			if (!members.list.isGamePlayed(users[u], games[g]))
				passed = false;
		}
		if (passed)
			filtered.push(users[u]);
	}
	return filtered;
}

/* Clan Registration
------------------------------------------------------------------------------------------------------------ */

/**
 * Dictionary of the possible Error messages and a more User-friendly version to
 * display in a `feedback` widget. Use the dictionary such that you are searching
 * for keys that are within your Error message in the response object. 
 * 
 * For example, if the response contains an Error with the text `Specified name error.`,
 * we are going to first look for `Message_A` in that response, moving onto `Message_B`
 * if the former could not be found.
 */
var ErrorFeedbackMessages =
{
	'Specified name error.':
	{
		'Message_A':
		{
			'NoError': 'Successful',
			'NullName': 'You must specify a Clan Name',
			'NameTaken': 'The specified Clan Name is already taken',
		},
		'Message_B':
		{
			'NoError': 'Successful',
			'NullName': 'You must specify a letter abbreviation for the Clan',
			'TooLong': 'The specified abbreviation is too long',
			'InvalidCharacters': 'The specified abbreviation contains invalid characters',
		}
	},
	'Member specification error.':
	{
		'Message':
		{
			'NoError': 'Successful',
			'NullList': 'Specified list of Members cannot be Null',
			'NotEnoughUsers': 'Not enough Members were specified',
			'UserNotFound': 'One of the specified Users does not exist',
			'UserInClan': 'One of the specified Users is already in a Clan',
			'SelfInvite': 'You cannot invite yourself to the Clan',
		}
	}
}

community.ui.updateFeedback = function (response) {
	var error = ErrorFeedbackMessages[response.Error];
	var message = null;
	for (key in response)
		if (key in error) {
			message = error[key][response[key]];
			break;
		}
	$(community.ui.elements.register.feedback).html(
		"<div class='alert alert-danger'>" + message + "</div>"
	);
}

community.registerClan = function () {
	var selectedUserIds = [];
	$('.ui-widget-content.ui-selected', '.selectable-container').each(function () {
		selectedUserIds.push($(this).data('id'));
	});
	var body = {};
	body.name = $(community.ui.elements.register.name).val(),
	body.shortname = $(community.ui.elements.register.shortname).val(),
	body.users = selectedUserIds;
	$.post('/api/clans/create', body, function (response) {
		if ('Error' in response)
			community.ui.updateFeedback(response);
		else {
			$(community.ui.elements.register.feedback).html('');
			$(community.ui.elements.register.name).val('');
			$(community.ui.elements.register.shortname).val('');
			$(community.ui.elements.register.modal).modal('hide');
			$(community.ui.elements.register.button).attr('disabled', 'disabled');
		}
	});
}

/* Members Update
------------------------------------------------------------------------------------------------------------ */

/**
 * Updates the Members UI to reflect the controls applied by the User. We don't need to actually
 * request all of the Users and additional information each time the search filter is changed. 
 * Instead, we populate/update these lists periodically and use them whenever a UI control is applied.
 */
members.updateMembers = function () {
	if (!members.users.updated || !members.games.updated)
		// We need the above components in order to actually process anything.
		return;

	if (members.users.list.length == 0)
		// Unnecessary to process on an empty list.
		return;

	var filterAlias = $(members.ui.elements.inputs.alias).val();
	var filteredUsers = members.list.filter(members.users.list, filterAlias, members.list.filtertypes.ALIAS);

	if ('email' in members.users.list[0]) {
		var filterEmail = $(members.ui.elements.inputs.email).val();
		filteredUsers = members.list.filter(filteredUsers, filterEmail, members.list.filtertypes.EMAIL);
	}

	var filterGames = [];
	$(members.ui.elements.inputs.game).each(function () {
		if ($(this).context.checked)
			filterGames.push($(this).attr('id'));
	});
	filteredUsers = members.list.filterByGames(filteredUsers, filterGames);

	members.ui.renderMembers(filteredUsers);
}

/* Shared Functions
------------------------------------------------------------------------------------------------------------ */

/**
 * Renders components that require a list of Members.
 * 
 * @param {array} users List of Users.
 */
function RenderElementsWithMembers(users) {
	members.ui.renderMembers(users);
	community.ui.renderClanMembers(users);
}

/* Initialization
------------------------------------------------------------------------------------------------------------ */

//Initialization.
$(function () {    
	// Update Community section immediately (not periodically for now).
	community.clans.update(community.ui.renderCommunity);

	// Update Games immediately and periodically.
	members.games.update(members.ui.renderGameInputs);
	setInterval(function () { members.games.update(members.ui.renderGameInputs); }, 60000);

	// Update Users immediately and periodically.
	members.users.update(RenderElementsWithMembers);
	setInterval(function () { members.users.update(); }, 10000);

    // Update Community Broadcasters with Twitch (not periodically for now).
	streamers.twitch.update(streamers.ui.renderTwitch);

	// Setup Event Callbacks.
	$(community.ui.elements.register.accept).click(community.registerClan);
	$(community.ui.elements.register.modalClose).click(function () { $(community.ui.elements.register.modal).modal('hide'); })
	$(members.ui.elements.inputs.alias).keyup(members.updateMembers);
	$(members.ui.elements.inputs.email).keyup(members.updateMembers);
	$(members.ui.elements.inputs.alias).change(members.updateMembers);
	$(members.ui.elements.inputs.email).change(members.updateMembers);
	$(members.ui.elements.clear).click(function () {
		members.ui.input.clear();
		members.updateMembers();
	});
});