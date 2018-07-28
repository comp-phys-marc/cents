/**
 * Created by marcusedwards on 2018-07-28.
 */
if (getUrlParameter('code') == null) {
    $('#connect-ynab').on('click', function(){
        loadYnabRegisterConfig(requestYnabPermissions);
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