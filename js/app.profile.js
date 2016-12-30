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
                'url': app.config.href + 'actions/friendship.php',
                'method': 'POST',
                'data': {
                    'id': cache.id
                }
            }).done(function (data) {
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