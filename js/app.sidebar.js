'use strict';

if (app === undefined) {
    app = {};
}

(function (app, $) {

    var cache = {};

    function initEvents() {
        app.events.subscribe('sidebar/toggle', function () {
            app.elems.$sidebar.toggleClass('visible');
        });

        function toggle(e) {
            e.preventDefault();
            app.events.publish('sidebar/toggle');
        }

        app.elems.$sidebarOpen.on('click', 'a', toggle);
        app.elems.$sidebar.on('click', '#close-sidebar a', toggle);
    }

    app.sidebar = {
        init: function () {
            initEvents();
        }
    };
}(app, $));