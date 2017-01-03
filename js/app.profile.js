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
        cache.overlay = app.utils.overlay("Are you sure you want to remove this friend?<br><button type='button' class='btn btn-danger friend-remove'>Remove</button>");
        cache.overlay.title("Remove Friend");
    }

    function cancelRequest() {
        cache.overlay = app.utils.overlay("Are you sure you want to cancel this friend request?<br><button type='button' class='btn btn-danger friend-cancel'>Cancel</button>");
        cache.overlay.title("Cancel Request");
    }

    function sendRequest() {
        function doRequest() {
            $.ajax({
                'url': app.config.href + '/actions/friend-request-finish.php',
                'method': 'POST',
                'data': {
                    'id': cache.id,
                    'action': 'request'
                }
            }).done(function (data) {
                cache.overlay.text(data);
            });
        }

        cache.overlay = app.utils.overlay("Are you sure you want to send this person a friend request?<br><button type='button' class='btn btn-success friend-request'>Request</button>");
        cache.overlay.title("Request Friend");
        cache.overlay.$().on('click', '.friend-request', doRequest);
    }

    function initEvents() {
        function friendButton() {
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
        }

        app.events.subscribe('profile/friend-button', friendButton);

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
