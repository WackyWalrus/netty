var app = {};

(function (app, $) {
    'use strict';

    var cache = {};
    app.elems = {};

    function initDOM() {
    	app.elems.$body = $('body');
    	app.elems.$sidebar = app.elems.$body.find('#sidebar');
    	app.elems.$main = app.elems.$body.find('#main');
    }

    app.init = function () {
        initDOM();

        console.log(app);
    };

}(app, $));

app.init();