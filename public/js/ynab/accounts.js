/**
 * Created by marcusedwards on 2018-07-27.
 */


function getAccounts(budgetId, callback) {
    var ynabConfig = getLocalYnabConfig();
    $.get(ynabConfig.baseApiUrl + '/budgets/' + budgetId + '/accounts?access_token=' + getLocalAuthToken()
    ).done(function(response) {
        var data = response.data;
        if (callback instanceof Function) {
            callback(data.accounts);
        }
    }).fail(function(data) {
        if (data.responseJSON.hasOwnProperty('error')) {
            var error = data.responseJSON.error;
            if (error.id == '401') {
                refreshAndRetry(function () {
                    getAccounts(budgetId, callback);
                });
            }
            else {
                console.log(error.detail);
            }
        }
    });
}

function setLocalAccounts(accounts) {
    localStorage.setItem('accounts', JSON.stringify(accounts));
}

function getLocalAccounts() {
    return JSON.parse(localStorage.getItem('accounts'));
}