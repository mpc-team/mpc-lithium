<?php
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
    <img src="http://ttv-api.s3.amazonaws.com/assets/connect_dark.png" class="twitch-connect" href="#" />
     <script>
        Twitch.init({clientId: '4fzsmbnkisk18wiuvdq3ds3xzhts31w'}, function(error, status) {
            // the sdk is now loaded
             if (error) {
            // error encountered while loading
            console.log(error);
          }
          // the sdk is now loaded
          if (status.authenticated) {
            // user is currently logged in
            $('.twitch-connect').hide()
          }
        });

            $('.twitch-connect').click(function() {
            Twitch.login({
                scope: ['user_read', 'channel_read']
            });


        })
    </script>
</div>
