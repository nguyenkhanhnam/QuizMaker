$(document).ready(function () {
    getAccounts()
})

var account_global = []
var current_username

function getAccounts() {
    $.ajax({
        type: 'GET',
        url: '/api/accounts',
        dataType: 'json',

        complete: function (res) {
            if (res.status !== 200) {
                console.log(res)
            } else {
                var str = res.responseText.trim()
                var accounts = JSON.parse(str)
                account_global = accounts
                if (account_global.length > 0) {
                    updateTableAccount()
                    current_username= account_global[0].username
                    getAccount(account_global[0].username)
                }
                else {
                    $('#account-table').find("tr:gt(0)").remove()
                    var row = '<tr>'
                    var col = '<td colspan="2" class="text-center"><em style="color:grey!important">No available account</em></td>'
                    row += col
                    row += '</tr>'
                    $('#account-table').append(row)
                }
            }
        }
    })
}

function updateTableAccount() {
    $('#account-table').find("tr:gt(0)").remove()
    account_global.forEach(account => {
        var row = '<tr>'
        var col = '<td onClick=getAccount(\"' + account.username + '\")>' + account.username + '</td>'
        col += '<td onClick=getAccount(\"' + account.username + '\")>' + getStringRole(parseInt(account.role)) + '</td>'
        row += col
        row += '</tr>'
        $('#account-table').append(row)
    })
}