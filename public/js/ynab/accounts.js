/**
 * Created by marcusedwards on 2018-07-27.
 */


function getAccounts(budgetId, callback) {
    var ynabConfig = getYnabConfig();
    $.get(ynabConfig.baseApiUrl + '/budgets/' + budgetId + '/accounts'
    ).done(function(data){
        if (callback instanceof Function) {
            callback(data.accounts);
        }
    }).fail(function(data) {
        if (data.hasOwnProperty('error')) {
            var error = data.error;
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