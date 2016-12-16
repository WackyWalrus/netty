'use strict';

if (app === undefined) {
    var app = {};
}

(function (app, $) {

    var cache = {};

    function initCache() {
        cache.$postStatusTextarea = app.elems.$body.find('.post-status textarea');
    }

    function initEvents() {
        app.events.subscribe('post-status__textarea/focusin', function () {
            cache.$postStatusTextarea.addClass('focused');
        });
        app.events.subscribe('post-status__textarea/focusout', function () {
            if (cache.$postStatusTextarea.val().length === 0) {
                cache.$postStatusTextarea.removeClass('focused');
            }
        });
        app.events.subscribe('post-status__textarea/keyup', function () {
            cache.$postStatusTextarea.height(1);
            cache.$postStatusTextarea.height(cache.$postStatusTextarea.prop('scrollHeight') + 25);
        });

        app.elems.$body.on('focus blur keyup', '.post-status textarea', function (e) {
            app.events.publish('post-status__textarea/' + e.type);
        });
    }

    app.feed = {
        init: function () {
            initCache();
            initEvents();
        }
    };

}(app, $));