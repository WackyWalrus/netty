'use strict';

if (app === undefined) {
    var app = {};
}

(function (app, $) {

    var cache = {};
    app.elems = {};

    function initCache() {
        app.elems.$body = $('body');
        app.elems.$sidebar = app.elems.$body.find('#sidebar');
        app.elems.$main = app.elems.$body.find('#main');
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