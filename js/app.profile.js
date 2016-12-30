'use strict';

if (app === undefined) {
    var app = {};
}

(function (app, $) {

    var cache = {};

    function initDOM() {
        cache.$profile = app.elems.$body.find('.profile');
        cache.id = cache.$profile.attr('id').replace('profile-', '');
    }

    function initEvents() {
        app.events.subscribe('profile/friend-button', function () {
            $.ajax({
                'url': app.config.href + '/actions/friend-request-start.php',
                'method': 'POST',
                'data': {
                    'id': cache.id
                }
            }).done(function (data) {
                console.log(data);
                if (data === "remove friend") {
                } else if (data === "cancel request") {
                } else if (data === "send request") {
                } else {
                    console.log("something went wrong");
                }
            });
        });

        cache.$profile.on('click', '.friend-btn', function () {
            app.events.publish('profile/friend-button');
        });
    }

    app.profile = {
        init: function () {
            initDOM();
            initEvents();
        }
    };
}(app, $));
