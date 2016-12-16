var app = {};

(function (app, $) {
    'use strict';

    var cache = {};
    app.elems = {};

    app.events = {
        threads: [],
        subscribe: function (thread, callback) {
            // thread = element/event
            var t = thread.split('/');

            if (app.events.threads[t[0]] === undefined) {
                app.events.threads[t[0]] = {};
            }

            if (app.events.threads[t[0]][t[1]] === undefined) {
                app.events.threads[t[0]][t[1]] = callback;
            }
        },
        publish: function (thread) {
            var t = thread.split('/');

            if (app.events.threads[t[0]] !== undefined) {
                if (app.events.threads[t[0]][t[1]] !== undefined &&
                        typeof app.events.threads[t[0]][t[1]] === 'function') {
                    app.events.threads[t[0]][t[1]]();
                }
            }
        }
    };

    function initCache() {
        app.elems.$body = $('body');
        app.elems.$sidebar = app.elems.$body.find('#sidebar');
        app.elems.$main = app.elems.$body.find('#main');
    }

    function initDOM() {
        // do nothing for now
    }

    function initEvents() {
        app.events.subscribe('/post-status__textarea', function () {
            console.log('focus');
        });

        app.elems.$body.on('focus', '.post-status textarea', function () {
            app.events.publish('/post-status__textarea/focus');
        });
    }

    app.init = function () {
        initCache();
        initDOM();
        initEvents();
    };

}(app, $));

app.init();