/**
 * Created by marcusedwards on 2018-07-28.
 */

function renderAccountsForm() {
    var localAccounts = getLocalAccounts();
    for (var i in localAccounts) {
        $('#account-rows').append(accountRow(localAccounts[i].name,
            formatType(localAccounts[i].type),
            formatBalance(localAccounts[i].balance),
            localAccounts[i].deleted)
        );
    }
    $('#account-rows').find('tr').each(function(index, row) {
        $(row).on('click', function() {
            $('#ynab_id').val(getLocalAccounts()[index].id);
            $('#account-rows').find('tr').removeClass('active');
            $(row).addClass('active');
        });
    });
}

function accountRow(name, type, balance, deleted) {

    var row = '<tr class="clickable-row">'
    + '<td>' + name + '</td>'
    + '<td class="right hidden-xs">' + type + '</td>'
    + '<td class="right hidden-xs">' + balance + '</td>';

    if (deleted == true){
        row += '<td><span class="badge badge-warning badge-icon"><i class="fa fa-xing" aria-hidden="true"></i><span>Deleted from YNAB</span></span></td>';
    }
    else {
        row += '<td><span class="badge badge-success badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>Active in YNAB</span></span></td>';
    }

    row += '</tr>';

    return row;
}

$(document).ready(function() {
    if(getLocalAuthToken() != null && getLocalAccounts() == null) {
        getBudgets(
            function(budgets) {
                var allAccounts = [];
                for (var i in budgets) {
                    getAccounts(budgets[i].id, function(accounts) {
                        for (var j in accounts) {
                            allAccounts[allAccounts.length] = accounts[j];
                        }
                        setLocalAccounts(allAccounts);
                        renderAccountsForm();
                    });
                }
            }
        );
    }
    else if(getLocalAuthToken() != null) {
        renderAccountsForm();
    }
});