WY = window.WY || {};
WY.window = {
    addLoadEvent: function(f) {
        var oldonload = window.onload;
        if (typeof window.onload != 'function') {
            window.onload = f;
        } else {
            window.onload = function() {
                oldonload();
                f();
            }
        }
    },
    getSize: function() {
        var w = 0, h = 0;
        if (window.innerWidth) {
            w = window.innerWidth;
            h = window.innerHeight;
        } else if (window.outerWidth) {
            w = window.outerWidth;
            h = window.outerHeight;
        } else if (document.documentElement && document.documentElement.clientWidth) {
            w = document.documentElement.clientWidth;
            h = document.documentElement.clientHeight;
        } else if (document.body.clientWidth) {
            w = document.body.clientWidth;
            h = document.body.clientHeight;
        }
        return {width: w, height: h};
    },
    saveSize: function() {
        var win = this.getSize();
        WY.cookie.set('menu_php_w', win.width);
        WY.cookie.set('menu_php_h', win.height);
    },
    restoreSize: function() {
        var win, w, h;
        w = WY.cookie.get('menu_php_w');
        h = WY.cookie.get('menu_php_h');
        if (w > 0 && h > 0) {
            win = this.getSize();
            window.resizeBy(w - win.width, h - win.height);
        }
    }
}
//WY.window.restoreSize();
