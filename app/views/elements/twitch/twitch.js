

function initiateTwitch() {

    


}




//Init Twitch
Twitch.init({clientId: '4fzsmbnkisk18wiuvdq3ds3xzhts31w'}, function(error, status) {
    // the sdk is now loaded
    if (error) {
        // error encountered while loading
        console.log(error);
    }
});
//end init



//
//Login into Twitch
//

$('.twitch-connect').click(function() {
    Twitch.login({
        scope: ['user_read', 'channel_read']
    });
    //If login is successful, then change button TEXT to display "Logged IN"   
})
if (status.authenticated) {

    $('.twitch-connet p').text('Logged IN');
    $('#twitch-alertdiv').show();
    $('#twitch-alertdiv').addClass('alert-success');
    $('#twitch-alertdiv span').addClass('glyphicon-exclamation-sign');
    $('#twitch-alertdiv p').text('Logged into Twitch!');

}
//
//End of login
//


//
//Log out of Twitch
//

//Message Response if Logged out is successful. 

$('.twitch-disconnect').click(function () {

    Twitch.logout(function (error) {
    });
    $('#twitch-alertdiv').show();
    $('#twitch-alertdiv').addClass('alert-success');
    $('#twitch-alertdiv span').addClass('glyphicon-exclamation-sign');
    $('#twitch-alertdiv p').text('Logged Out Successfully!');
});

    //
    //      End of logout
    //


    //
    //      Error Messages
    //

    //Check URL for a keyword "Redirect" to confirm the user is logged in successfully with their twitch account.

if (window.location.href.indexOf("Redirect") > -1) {
    $('#twitch-alertdiv').show();
    $('#twitch-alertdiv').addClass('alert-danger');
    $('#twitch-alertdiv span').addClass('glyphicon-exclamation-sign');
    $('#twitch-alertdiv p').text('Error: Redirect does not Match URI!');
}

//
//End of Error Messages for Redirect URI
//

//Get the User's Channel
Twitch.api({method: 'channel'}, function(error, channel) {
    console.log(channel.stream_key);
});//End of Twitch API


