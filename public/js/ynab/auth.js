/**
 * Created by marcusedwards on 2018-07-27.
 */

var ynabConfig = {};

function getUrlParameter(name) {
    var url = window.location.href;
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function refreshAndRetry(callback) {
    return refreshAccessToken(
        function(attempts) {
            if (attempts < 5) {
                callback();
            }
        }, attempts
    );
}

function loadYnabConfigAndExecute(callback) {
    var ynabConfig = getYnabConfig();
    if (ynabConfig == {}) {
        $.getJSON('./config.json', function (config) {
            ynabConfig = {
                baseApiUrl: config.baseApiUrl,
                clientId: config.clientId,
                clientSecret: config.clientSecret,
                redirectUri: config.redirectUri
            };
            setYnabConfig(ynabConfig);
            if (callback instanceof Function){
                callback();
            }
        });
    }
    else if (callback instanceof Function){
        callback();
    }
}

function requestYnabPermissions() {
    var ynabConfig = getYnabConfig();
    window.location = 'https://app.youneedabudget.com/oauth/authorize?client_id='
        + ynabConfig['clientId']
        + '&redirect_uri='
        + ynabConfig['redirectUrl']
        + '&response_type=code';
}

function getAccessToken(attempts) {
    var ynabConfig = getYnabConfig();
    if (attempts < 5) {
        setTimeout( $.post(
            'https://app.youneedabudget.com/oauth/token?client_id='
            + ynabConfig['clientId']
            + '&client_secret='
            + ynabConfig['clientSecret']
            + '&redirect_uri='
            + ynabConfig['redirectUrl']
            + '&grant_type=authorization_code&code='
            + getUrlParameter('code')

        ).done(function (data) {
            setAuthToken(data.access_token);
            setRefreshToken(data.refresh_token);
            setRefreshTime(now() + data.expires_in);
        }).fail(function (data) {
            if (data.hasOwnProperty('error')) {
                error = data.error;
                if (error.id == '401') {
                    refreshAccessToken(getAccessToken(), attempts);
                }
                else {
                    console.log(error.detail);
                }
            }
        }), 100);
    }
}

function refreshAccessToken(callback, attempts) {
    var ynabConfig = getYnabConfig();
    $.post('https://app.youneedabudget.com/oauth/token?client_id='
        + ynabConfig['clientId']
        +'&client_secret='
        + ynabConfig['clientSecret']
        + '&grant_type=refresh_token&refresh_token='
        + getRefreshToken()
    ).success(function(data) {
        setAuthToken(data.access_token);
        setRefreshToken(data.refresh_token);
        setRefreshTime(now() + data.expires_in);
        callback(attempts + 1);
    });
}

function setAuthToken(auth_token) {
    localStorage.setItem('auth_token', auth_token);
}

function setYnabConfig(config) {
    localStorage.setItem('ynab_config', JSON.stringify(config));
}

function setRefreshToken(refresh_token) {
    localStorage.setItem('refresh_token', refresh_token);
}

function setRefreshTime(refresh_time) {
    localStorage.setItem('refresh_time', refresh_time);
}

function getAuthToken(auth_token) {
    return localStorage.getItem('auth_token');
}

function getYnabConfig() {
    return JSON.parse(localStorage.getItem('ynab_config'));
}

function getRefreshToken(refresh_token) {
    return localStorage.getItem('refresh_token');
}

function getRefreshTime(refresh_time) {
    return localStorage.getItem('refresh_time');
}

function now() {
    return new Date().getTime() / 1000;
}