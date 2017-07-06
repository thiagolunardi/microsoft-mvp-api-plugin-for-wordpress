<?php

function msmvpapi_msoauthscript ( ) {
?>
<script src="https://secure.aadcdn.microsoftonline-p.com/lib/0.1.1/js/msal.min.js"></script>
<script class="pre">
    var userAgentApplication = new Msal.UserAgentApplication('<?php echo get_option( 'msmvpapi_client_id' ); ?>', null, function (errorDes, token, error, tokenType) {
            // this callback is called after loginRedirect OR acquireTokenRedirect (not used for loginPopup/aquireTokenPopup)
    });

    userAgentApplication.loginPopup(["user.read"]).then( function(token) {
        var user = userAgentApplication.getUser();
        // signin successful
    }, function (error) {
        // handle error
    });
</script>
<?php    
}
?>