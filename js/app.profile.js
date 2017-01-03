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

    function rmFriend() {
        cache.overlay = app.utils.overlay("Are you sure you want to remove this friend?");
        cache.overlay.title("Remove Friend");
    }

    function cancelRequest() {
        cache.overlay = app.utils.overlay("Are you sure you want to cancel this friend request?");
        cache.overlay.title("Cancel Request");
    }

    function sendRequest() {
        cache.overlay = app.utils.overlay("Are you sure you want to send this person a friend request?");
        cache.overlay.title("Request Friend");
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
                if (data === "remove friend") {
                    rmFriend();
                } else if (data === "cancel request") {
                    cancelRequest();
                } else if (data === "send request") {
                    sendRequest();
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
