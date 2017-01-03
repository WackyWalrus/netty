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
            var overlay = {
                'remove': function () {
                    cache.$overlay.off('click', '.overlay-close', overlay.remove);
                    cache.$overlay.remove();
                },
                'title': function (arg) {
                    cache.$overlay.find('.overlay-title').html(arg);
                }
            };

            if (content !== undefined) {
                cache.$overlay = $('<div class="overlay-backdrop"><div class="overlay-content"><div class="overlay-close">X</div><div class="overlay-title"></div>' + content + '</div></div>');
                app.elems.$body.append(cache.$overlay);
                cache.$overlay.find('.overlay-content').css({
                    'margin-left': -(cache.$overlay.find('.overlay-content').width() / 2),
                    'margin-top': -(cache.$overlay.find('.overlay-content').height() * 2)
                });
                cache.$overlay.on('click', '.overlay-close', overlay.remove);
                return overlay;
            }
            return false;
        }
    };
}(app, $));
