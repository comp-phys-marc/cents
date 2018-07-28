/**
 * Created by marcusedwards on 2018-07-27.
 */

function getBudgets(callback) {
    var ynabConfig = getYnabConfig();
    $.get(ynabConfig.baseApiUrl + '/budgets'
    ).done(function(data) {
        var ynabBudgets = data.budgets;
        if (callback instanceof Function){
            callback(ynabBudgets);
        }
    }).fail(function(data){
        if (data.hasOwnProperty('error')) {
            var error = data.error;
            if (error.id == '401') {
                refreshAndRetry(function () {
                    getBudgets(callback);
                });
            }
            else {
                console.log(error.detail);
            }
        }
    });
}

function getBudgetMonths(budgetId, callback) {
    var ynabConfig = getYnabConfig();
    $.get(ynabConfig.baseApiUrl + '/budgets/' + budgetId + '/months'
    ).done(function(data) {
        var ynabBudgetMonths = data.months;
        if (callback instanceof Function){
            callback(ynabBudgetMonths);
        }
    }).fail(function(data){
        if (data.hasOwnProperty('error')) {
            var error = data.error;
            if (error.id == '401') {
                refreshAndRetry(function () {
                    getBudgetMonths(budgetId, callback);
                });
            }
            else {
                console.log(error.detail);
            }
        }
    });
}