'use strict';

if (app === undefined) {
    var app = {};
}

(function (app, $) {

    var cache = {};

    app.utils = {
        init: function () {
        },
        overlay: function (content) {
            if (content !== undefined) {
                cache.$overlay = $('<div class="overlay-backdrop"><div class="overlay-content">' + content + '</div></div>');
                app.elems.$body.append(cache.$overlay);
                cache.$overlay.find('.overlay-content').css({
                    'margin-left': -(cache.$overlay.find('.overlay-content').width() / 2),
                    'margin-top': -(cache.$overlay.find('.overlay-content').height() / 2)
                });
                return true;
            }
            return false;
        }
    };
}(app, $));