//Create new cookies
function createCookie(name, value, expires, path, domain) {
    var cookie = name + "=" + escape(value) + ";";

    if (expires) {
        // If it's a date
        if(expires instanceof Date) {
            // If it isn't a valid date
            if (isNaN(expires.getTime()))
                expires = new Date();
        }
        else
            expires = new Date(new Date().getTime() + parseInt(expires) * 1000 * 60 * 60 * 24);

        cookie += "expires=" + expires.toGMTString() + ";";
    }

    if (path)
        cookie += "path=" + path + ";";
    if (domain)
        cookie += "domain=" + domain + ";";

    document.cookie = cookie;
}

//Get value from cookies
function getCookie(name) {
    var regexp = new RegExp("(?:^" + name + "|;\s*"+ name + ")=(.*?)(?:;|$)", "g");
    var result = regexp.exec(document.cookie);
    return (result === null) ? null : result[1];
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
//Delete value from cookies
function deleteCookie(name, path, domain) {
    // If the cookie exists
    if (getCookie(name))
        createCookie(name, "", -1, path, domain);
}

var delete_cookie = function(name) {
    document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
};



function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        if(name == 'laravel_session' || name == 'XSRF-TOKEN' || name == 'PHPSESSID' || name == ' laravel_session' || name == ' XSRF-TOKEN' || name == ' PHPSESSID')
        {
            continue;
        }
        else
        {
            name = name.trim();
            console.log('name:'+name);
            document.cookie = name+"=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            // document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }


    }
}
