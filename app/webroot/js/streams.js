var streamers = {};

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
/*
    Streamers UI Functions
    ------------------------------------------------------------------
*/
streamers.ui = {};
streamers.ui.twitch = {};
streamers.ui.twitch.api = {};
//OutPut to View/Streams
streamers.ui.elements = {
    twitchCastersTable: "#twitch-casters-table",
    twitchCasterModals: "#twitch-casters-modal",
    count: "#twitch-caster-count",
};
//Index Object
streamers.ui.renderTwitch = function (twitchUsers) {   
    var isMobile = false;
    // device detection
    if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
        || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) isMobile = true;
    //Declare Variables for the Index.
    var twitchCastersTable = "";
    var twitchCasterModals = "";
    var twitchCasterAPIStream = "";
    var twitchCasterAPIUser = "";
    var twitchCasterAPIChannel = "";
    var twitchCasterModalsBS = "";
    //Twitch Users Table in the DB tname = twitch name, tid = twitch id, uid = mpc user id
    for (index in twitchUsers) {

        //Twitch User's Table
        twitchCastersTable += "<tr class='row'>";
        twitchCastersTable += "<td>";
        twitchCastersTable += "<div class='" + twitchUsers[index].tname + "-name' style='color: #88bb88; font-family: Alegreya Sans; font-weight: 700; font-size: 14pt; padding-top: 5px; margin-bottom: -1px; white-space: nowrap; overflow: hidden;'>";
        twitchCastersTable += "</div>";
        twitchCastersTable += "<span class='" + twitchUsers[index].tname + "-status'></span>";
        twitchCastersTable += "</td>";
        twitchCastersTable += "<td>";
        twitchCastersTable += "<div class='row'>";
        //Mobile Render
        if (isMobile == false) {
            //twitchCastersTable += "<div class='col-xs-12'>" + streamers.ui.twitch.buttons.stringify(twitchUsers[index].tname) + "</div>";
            //This just opens up a new tab/serving as an alternative for now.
            twitchCastersTable += "<div class='col-xs-12'>" + streamers.ui.twitch.buttons.mobile.stringify(twitchUsers[index].tname) + "</div>";
        } else if (isMobile == true) {
            twitchCastersTable += "<div class='col-xs-12'>" + streamers.ui.twitch.buttons.mobile.stringify(twitchUsers[index].tname) + "</div>";
        }
        twitchCastersTable += "</div><!--row-->";
        twitchCastersTable += "</td>";
        twitchCastersTable += "</tr>";

        //Twitch User Modals
        twitchCasterModals += streamers.ui.twitch.modals.stringify(twitchUsers[index].tname);
        //Twitch User Modals BootStrap
        twitchCasterModalsBS += streamers.ui.twitch.modals.bootstrap();
        //Twitch API Channel
        twitchCasterAPIChannel += streamers.ui.twitch.api.channel(twitchUsers[index].tname);
        //Twitch API User
        twitchCasterAPIUser += streamers.ui.twitch.api.user(twitchUsers[index].tname);
        //Twitch API Stream
        twitchCasterAPIStream += streamers.ui.twitch.api.stream(twitchUsers[index].tname);        
    }//for iteration    

    //Connections to Elements Object that Transitions to the View/Streams Folder.
    $(streamers.ui.elements.twitchCastersTable).html(twitchCastersTable);
    $(streamers.ui.elements.twitchCasterModals).html(twitchCasterModals);
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
    result += "<div class='embed-responsive embed-responsive-16by9'>";
    //Insert Iframe Here.
    result += "</div><!--div responsive 16by9-->";
    result += "<div class='embed-responsive embed-responsive-16by9'>";
    result += "<iframe frameborder='0' scrolling='no' src='' id='"+ object +"-chat'></iframe>";
    result += "</div><!--div responsive 16by9-->";
    result += "</div><!--modal-body-->";
    result += "<div class='modal-footer " + object + "-banner'>";
    result += "<img class='" + object + "-logo user-avatar-container' />";
    result += "</div>";
    result += "</div><!--modal-footer-->";
    result += "</div><!--modal-content-->";
    result += "</div><!--modal-dialog-->";
    result += '</div><!--modal-->';
    return result;
}
//This is an attempt to have the modal open, insert a src into the iframe, and when the modal is closed, it removes the iframe src code. Ideally, needs to prevent the severe lag on the website.
streamers.ui.twitch.modals.bootstrap = function ( ) {
    $.getJSON('/api/twitchusers/all', null, function (twitchUsers) {
        for (index in twitchUsers) {            
            $('#' + twitchUsers[index].tname + '-modal').on('shown.bs.modal', function (e) {
                //$("#" + twitchUsers[index].tname + "-chat").attr("src", "http://www.twitch.tv/" + twitchUsers[index].tname + "/chat");
                //document.getElementById(twitchUsers[index].tname + '-chat').contentWindow.document.body.innerHTML
            })
        }
    });
}
streamers.ui.twitch.api.stream = function (twitchUser) {
    //console.log(object);
    $.getJSON('https://api.twitch.tv/kraken/streams/' + twitchUser, function (object) {
        //Example of String: https://api.twitch.tv/kraken/streams/mpcacidsnake
        var string = object._links.self;//Get only the name from this object request. "MPCACIDSNAKE" from Example Above.
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
}
streamers.ui.twitch.api.channel = function (twitchUser) {
    $.getJSON('https://api.twitch.tv/kraken/channels/' + twitchUser, function (object) {
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
}
streamers.ui.twitch.api.user = function (twitchUser) {
    $.getJSON('https://api.twitch.tv/kraken/users/' + twitchUser, function (object) {
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
    });
}
//Initialization.
$(function () {
    // Update Community Broadcasters with Twitch (not periodically for now).
    streamers.twitch.update(streamers.ui.renderTwitch);
});