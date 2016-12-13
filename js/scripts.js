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

    app.events = {
        topics: {},
        subscribe: function (topic, listener) {
            if (!app.events.topics.hasOwnProperty(topic)) {
                app.events.topics[topic] = [];
            }

            cache.index = app.events.topics[topic].push(listener) -1;

            return {
                remove: function () {
                    delete app.events.topics[topic][cache.index];
                }
            };
        },
        publish: function (topic, info) {
            if (!app.events.topics.hasOwnProperty(topic)) {
                return;
            }

            app.events.topics[topic].forEach(function (item) {
                item(info !== undefined ? info : {});
            });
        }
    };

    app.init = function () {
        initCache();
        initDOM();

        console.log(app);
    };

}(app, $));

app.init();