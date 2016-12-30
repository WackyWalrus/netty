'use strict';

if (app === undefined) {
    var app = {};
}

(function (app, $) {

    var cache = {};
    app.elems = {};
    app.config = {};

    function initCache() {
        app.config.href = window.location.href.replace(window.location.pathname, '').replace(':/', '://');
        app.elems.$body = $('body');
        app.elems.$sidebar = app.elems.$body.find('#sidebar');
        app.elems.$main = app.elems.$body.find('#main');
        app.elems.$sidebarOpen = app.elems.$body.find('#open-sidebar');
    }

    app.init = function () {
        var i;
        initCache();

        for (i in app) {
            if (app.hasOwnProperty(i)) {
                if (app[i].hasOwnProperty('init')) {
                    app[i].init();
                }
            }
        }
    };

}(app, $));

app.init();