'use strict';

if (app === undefined) {
    app = {};
}

(function (app, $) {
    var cache = {};

    function initCache() {
    }

    function initDOM() {
    }

    function friendAction(arg, cb) {
        $.ajax({
            'url': app.config.href + '/actions/friend-request-finish.php',
            'method': 'POST',
            'data': {
                'id': cache.id,
                'action': arg
            }
        }).done(function (data) {
            cache.overlay.text(data);
            cb();
        });
    }

    function feedForm() {
        cache.$feedForm = app.elems.$body.find('[data-module="feed-form"]');
        if (cache.$feedForm !== undefined) {
            cache.feedId = cache.$feedForm.attr('class').replace('module module-', '');
            app.utils.refreshModule('feed-form', cache.feedId);
        }
    }

    function rmFriend() {
        function doRemove() {
            friendAction('remove', function () {
                cache.overlay.$().off('click', '.friend-remove', doRemove);
                app.utils.refreshModule('friend-request-button', cache.moduleId, feedForm);
            });
        }

        cache.overlay = app.utils.overlay("Are you sure you want to remove this friend?<br><button type='button' class='btn btn-danger friend-remove'>Remove</button>");
        cache.overlay.title("Remove Friend");
        cache.overlay.$().on('click', '.friend-remove', doRemove);
    }

    function cancelRequest() {
        function doCancel() {
            friendAction('cancel', function () {
                cache.overlay.$().off('click', '.friend-cancel', doCancel);
                app.utils.refreshModule('friend-request-button', cache.moduleId);
            });
        }

        cache.overlay = app.utils.overlay("Are you sure you want to cancel this friend request?<br><button type='button' class='btn btn-danger friend-cancel'>Cancel</button>");
        cache.overlay.title("Cancel Request");
        cache.overlay.$().on('click', '.friend-cancel', doCancel);
    }

    function sendRequest() {
        function doRequest() {
            friendAction('request', function () {
                cache.overlay.$().off('click', '.friend-request', doRequest);
                app.utils.refreshModule('friend-request-button', cache.moduleId);
            });
        }

        cache.overlay = app.utils.overlay("Are you sure you want to send this person a friend request?<br><button type='button' class='btn btn-success friend-request'>Request</button>");
        cache.overlay.title("Request Friend");
        cache.overlay.$().on('click', '.friend-request', doRequest);
    }

    function acceptRequest() {
        function doAccept() {
            friendAction('accept', function () {
                cache.overlay.$().off('click', '.friend-accept', doAccept);
                app.utils.refreshModule('friend-request-button', cache.moduleId, feedForm);
            });
        }

        cache.overlay = app.utils.overlay("Accept this friend request?<br><button type='button' class='btn btn-success friend-accept'>Accept</button>");
        cache.overlay.title("Accept Request");
        cache.overlay.$().on('click', '.friend-accept', doAccept);
    }

    function initEvents() {
        function friendButton_click_handler(e) {
            // get user ID
            cache.id = $(e.target).prev().val();
            cache.moduleId = $(e.target).closest('.module').attr('class').replace('module module-', '');
            // figure out if they're friend's already or what
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
                } else if (data === "accept request") {
                    acceptRequest();
                } else {
                    console.log("something went wrong");
                }
            });
        }

        app.elems.$body.on('click', '.friend-btn', friendButton_click_handler);
    }

    app.friendButton = {
        init: function () {
            initCache();
            initDOM();
            initEvents();
        }
    };
}(app, $));