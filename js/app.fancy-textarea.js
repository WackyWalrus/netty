'use strict';

if (app === undefined) {
    app = {};
}

(function (app, $) {

    var cache = {};

    function initCache() {}

    function initDOM() {}

    function initEvents() {
        /** textarea focus */
        app.events.subscribe('fancy-textarea/focusin', function () {
            cache.$textarea.addClass('focused');
        });
        /** textarea blur */
        app.events.subscribe('fancy-textarea/focusout', function () {
            if (cache.$textarea.val().length === 0) {
                cache.$textarea.removeClass('focused');
            }
        });

        app.elems.$body.on('focus blur keyup', 'textarea.fancy', function (e) {
            e.stopPropagation();
            cache.$textarea = $(this);

            if (e.keyCode === 13) {
                app.events.publish('post-status__button/click');
                return;
            }
            app.events.publish('fancy-textarea/' + e.type);
            app.events.publish('post-status__textarea/' + e.type);
        });
    }

    app.fancyTextarea = {
        init: function () {
            initCache();
            initDOM();
            initEvents();
        }
    };
}(app, $));
