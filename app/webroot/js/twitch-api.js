

/*

Twitch API

 Twitch Documentation: https://github.com/justintv/Twitch-API

*/

//Initiate Twitch -> load the SDK and grant access to Twitch's API with MPC's Client ID this should not be shared with anyone!
Twitch.init({clientId:'4fzsmbnkisk18wiuvdq3ds3xzhts31w', redirect_uri: 'http://www.mpcgaming.com/connect'}, function (error, status) { });
Twitch.api({ method: 'user' }, function (error, user) {
    $('#twitch-userid').val(user._id);
    $('#twitch-username').val(user.name);
    //Check if the user is logged into the current web browser.
    if (user._id != null) {
        //add disable class the login/logout buttons on the connect page.
        $('.twitch-connect').addClass('disabled');
        $('.twitch-disconnect').removeClass('disabled');
        $('#twitch-subscribe').removeClass('disabled');
        $('#twitch-unsubscribe').removeClass('disabled');
    }
});

