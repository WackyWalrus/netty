'use strict';

if (app === undefined) {
    app = {};
}

(function (app, $) {
    var cache = {};

    function initCache() {
        cache.$input = app.elems.$sidebar.find('[name="username"]');
    }

    function initDOM() {
        cache.$input.focus();
        cache.$input.trigger('focus');
    }

    function initEvents() {

    }

    app.homepage = {
        init: function () {
            initCache();
            initDOM();
            initEvents();
        }
    };
}(app, $));
