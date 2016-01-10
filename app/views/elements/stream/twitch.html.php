<?php

$var = 0;
/*

/twitch.tv/kraken/oauth2/clients
managed application: mpc-lithium

Name: mpc-lithium

Displayed to users when authorizing your application.

Redirect URI: http://www.mpcgaming.com/stream

Will receive the result of all client authorizations: either an access token or a failure message. This must exactly match the redirect_uri parameter passed to the authorization endpoint. When testing locally, you can set this to http://localhost.

Client ID: 4fzsmbnkisk18wiuvdq3ds3xzhts31w

Passed to authorization endpoints to identify your application. You cannot change your application's client id.

Client Secret: stt529r7v4yie1pv703krv0cvy1rqhm

 
*/
/**/

?>
<div id="twitch-div">  
    <!--Buttons for USER to USE-->
    <div class="row">
        <h3>Login to Twitch</h3>
        <div class="btn-group" role="group" aria-label="twitch-btngroup">
            <button type="button" class="btn btn-edit twitch-connect" href="#"><p>Log IN</p></button>
            <button type="button" class="btn btn-edit twitch-disconnect" href="#" ><p>Log OUT</p></button>
        </div>    
        <div class="alert" role="alert" id="twitch-alertdiv" style="display: none">
            <span class="glyphicon" aria-hidden="true"></span>
            <span class="sr-only">twitch-msg-response:</span>
            <!--JS Reponse Message-->
            <p></p>
            <!--End JS response Message-->
        </div>
    </div>
    <!--End of Buttons for USER-->
</div>
<script>
  




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






</script>