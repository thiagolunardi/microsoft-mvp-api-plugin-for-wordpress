<?php

function msmvpapi_msoauthscript ( ) {
    // Originaly from https://raw.githubusercontent.com/Azure-Samples/active-directory-javascript-singlepageapp-dotnet-webapi-v2/master/TodoSPA/App/Scripts/app.js
?>
<script src="https://secure.aadcdn.microsoftonline-p.com/lib/0.1.1/js/msal.min.js"></script>
<script class="pre">
debugger;
    var userAgentApplication = new Msal.UserAgentApplication('<?php echo get_option( 'msmvpapi_client_id' ); ?>', null, function (errorDes, token, error, tokenType) {
            // this callback is called after loginRedirect OR acquireTokenRedirect (not used for loginPopup/aquireTokenPopup)
            debugger;
    });

    userAgentApplication.loginPopup(["user.read"]).then( function(token) {
        debugger;
        var user = userAgentApplication.getUser();
        // signin successful
    }, function (error) {
        // handle error
        debugger;
    });
</script>
<?php    
}
?>