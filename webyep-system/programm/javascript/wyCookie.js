WY = window.WY || {};
WY.cookie = {
    defaultPath: '/',
    get: function (name) {
        var a =  document.cookie.indexOf( name + "=" );
        var l = a + name.length + 1;
        if ((!a) && (name !=  document.cookie.substring(0, name.length)) || a == -1) {
            return null;
        }
        var z = document.cookie.indexOf( ';', l);
        if (z == -1) z =  document.cookie.length;
        return unescape( document.cookie.substring(l, z));
    },
    set: function(name, value, expires, path, domain, secure) {
        var today = new Date();
        today.setTime(today.getTime());
        expires = expires ? expires * 86400000 : 86400000;
        var expires_date = new Date(today.getTime() + expires);
        document.cookie = name + '=' + escape(value) +
                        (';expires=' + expires_date.toGMTString()) +
                        (';path=' + (path) ? path : this.defaultPath) +
                        ((domain) ? ';domain=' + domain : '') +
                        ((secure) ? ';secure' : '');
    },
    del: function (name, path, domain) {
        if (this.get(name)) {
            document.cookie = name + '=' +
                        (';path=' + (path) ? path : this.defaultPath) +
                        ((domain) ? ';domain=' + domain : '' ) +
                        ';expires=Thu, 01-Jan-1970 00:00:01 GMT';
        }
    }
}
/*
    WY.cookie.set('name', value); // WY.cookie.set('name', value, daysToExpire, path, domain, secure);
    WY.cookie.get('name');
    WY.cookie.del('name');        // WY.cookie.del('name', path, domain);
*/