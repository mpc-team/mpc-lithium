

var twitch = {};

/*

Twitch API

 Twitch Documentation: https://github.com/justintv/Twitch-API

*/
twitch.index = function () {
    //Initiate Twitch -> load the SDK and grant access to Twitch's API with MPC's Client ID this should not be shared with anyone!
    Twitch.init({ clientId: '4fzsmbnkisk18wiuvdq3ds3xzhts31w', redirect_uri: 'http://www.mpcgaming.com/connect' }, function (error, status) { });
    //Check Authentication and Control UI Buttons Accordingly.
    twitch.auth.mpc();
}
//Twitch Authentication
twitch.auth = {};
twitch.auth.mpc = function () {
    //Phase 1: Checks if User is Logged into MPCgaming.com
    $.get('/api/users/auth', null, function (authorized) {
        if (Object.keys(authorized).length > 0) {
            // User is authenticated to MPCgaming.com
            $('.twitch-connect').removeClass('disabled');
            //Set Values with the Twitch API for Submission after Connecting to Twitch and MPCGaming.com
            Twitch.api({ method: 'user' }, function (error, user) {
                if (error) {
                    //If the API fails, Login Fails, User Decides to Log out of Twitch = NULL Values to PHP Can Stop the Processes.
                    $('#twitch-userid', '#twitch-username', '#deletetwitch-userid', '#deletetwitch-username').val(null);
                } else if (!error){
                    $('#twitch-userid').val(user._id);
                    $('#twitch-username').val(user.name);
                    $('#deletetwitch-userid').val(user._id);
                    $('#deletetwitch-username').val(user.name);
                }                
            });//Twitch API
            //Phase 2: Check if the User is logged into Twitch.tv while on MPCgaming.com
            Twitch.getStatus(function (error, status) {
                //If the User is Logged Into Twitch.
                if (status.authenticated) {
                    $('#navbar-twitch').show();
                    $('#profile-twitch').show();
                    $('.twitch-connect').addClass('disabled');
                    $('.twitch-disconnect').removeClass('disabled');
                    //Phase 3: Check if the User is logged in to Twitch and MPCgaming.com and if They Exists as a Twitch User(db table).
                    $.getJSON('/api/twitchusers/all', null, function (twitchUsers) {
                        for (index in twitchUsers) {
                            //Checks if the MPC ID is in the Twitch User's DB TAble.
                            if (authorized.id != twitchUsers[index].uid) {
                                //User is NOT on the Table and Has Permission to Subscribe to it. Add Caster
                                $('#twitch-unsubscribe').addClass('disabled');
                                $('#twitch-subscribe').removeClass('disabled');
                            } else {
                                //User is in the Table and Has the Permission to Unsubscribe from it. Remove Caster
                                $('#twitch-unsubscribe').removeClass('disabled');
                                $('#twitch-subscribe').addClass('disabled');
                            }
                        }//For Iteration.
                    });//Twitch Users JSON.
                } else {
                    //If Somehow the User Logged Out of Twitch outisde MPCgaming.com Fail Safe after Phase 1.
                    $('#twitch-subscribe', '#twitch-unsubscribe', '.twitch-connect', '.twitch-disconnect').addClass('disabled');
                }
            });//Twitch Status
        } else {
            // User is not authenticated with MPCgaming.com and disables Interface. Default Setting.
            $('#twitch-subscribe','#twitch-unsubscribe','.twitch-connect','.twitch-disconnect').addClass('disabled');
        }
    });//Get Request from MPCgaming.com Users Table
}//Authentication Phase

$(function () {
    //Inititation.
    twitch.index();

    //Twitch API Controls to intiate Login / Log out Process for Twitch.tv
    $('.twitch-connect').click(function () {
        //Initiates the Authentication Process with Twitch.
        Twitch.login({
            scope: ['user_read', 'channel_read', 'user_follows_edit']
        });
    });
    $('.twitch-disconnect').click(function () {
        //Closes the Connection between the user and Twitch.
        Twitch.logout(function (error) {
            return window.location = "/connect";
        });
    });


});
