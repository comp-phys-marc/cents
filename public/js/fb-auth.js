/**
 * Created by marcusedwards on 2018-07-28.
 */

function fbAuthUser() {
    FB.login(function (response) {
        statusChangeCallback(response);
    }, {scope: 'public_profile,email'});
}
function statusChangeCallback(response) {
    if (response.status === 'connected') {
        // Logged into your app and Facebook.
        $('.panel').hide();
        $('.wrapper').show();
        callAPI();
    }
}

window.fbAsyncInit = function() {
    FB.init({
        appId      : '1897034183863604',
        xfbml      : true,
        version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
function callAPI() {
    FB.api('/me', {fields: 'email'}, function(response) {
        $('#email').val('noemail@cents.ca');
        $('#password').val('nopassword');
        $('#facebook_email').val(response.email);
        $('#facebook_id').val(response.id);
        $('#login-button').click();
    });
}