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
            function realign() {
                cache.$overlay.find('.overlay-content').css({
                    'margin-left': -(cache.$overlay.find('.overlay-content').width() / 2),
                    'margin-top': -(cache.$overlay.find('.overlay-content').height() * 2)
                });
            }

            var overlay = {
                'remove': function () {
                    cache.$overlay.off('click', '.overlay-close', overlay.remove);
                    cache.$overlay.remove();
                },
                'realign': function () {
                    realign();
                },
                'title': function (arg) {
                    cache.$overlay.find('.overlay-title').html(arg);
                },
                'text': function (arg) {
                    cache.$overlay.find('.overlay-text').html(arg);
                    realign();
                },
                '$': function () {
                    return cache.$overlay;
                }
            };

            if (content !== undefined) {
                cache.$overlay = $('<div class="overlay-backdrop"><div class="overlay-content"><div class="overlay-close">X</div><div class="overlay-title"></div><div class="overlay-text">' + content + '</div></div></div>');
                app.elems.$body.append(cache.$overlay);
                realign();
                cache.$overlay.on('click', '.overlay-close', overlay.remove);
                return overlay;
            }
            return false;
        }
    };
}(app, $));
