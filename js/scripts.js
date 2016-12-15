var app = {};

(function (app, $) {
    'use strict';

    var cache = {};
    app.elems = {};

    function initCache() {
        app.elems.$body = $('body');
        app.elems.$sidebar = app.elems.$body.find('#sidebar');
        app.elems.$main = app.elems.$body.find('#main');
    }

    function initDOM() {
        // do nothing for now
    }

    app.init = function () {
        initCache();
        initDOM();
    };

}(app, $));

app.init();