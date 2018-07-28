/**
 * Created by marcusedwards on 2018-07-28.
 */
if (getUrlParameter('code') == null) {
    $('#connect-ynab').on('click', function(){
        if (window.location.href.indexOf('login') != -1) {
            loadYnabConfig(requestYnabPermissions);
        }
        else if(window.location.href.indexOf('register') != -1) {
            loadYnabRegisterConfig(requestYnabPermissions);
        }
    });
}
else {
    $('#connect-ynab').attr('disabled', 'disabled');
    $('#ynab-image').attr('src', "/img/YNAB-check.png");
    $('#ynab-tooltip').css('display', 'inline');

    getAccessToken();
}
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});