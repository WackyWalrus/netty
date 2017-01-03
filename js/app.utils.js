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
            function closeOverlay() {
                cache.$overlay.off('click', '.overlay-close', closeOverlay);
                cache.$overlay.remove();
            }

            if (content !== undefined) {
                cache.$overlay = $('<div class="overlay-backdrop"><div class="overlay-content"><div class="overlay-close">X</div>' + content + '</div></div>');
                app.elems.$body.append(cache.$overlay);
                cache.$overlay.find('.overlay-content').css({
                    'margin-left': -(cache.$overlay.find('.overlay-content').width() / 2),
                    'margin-top': -(cache.$overlay.find('.overlay-content').height() / 2)
                });
                cache.$overlay.on('click', '.overlay-close', closeOverlay);
                return true;
            }
            return false;
        }
    };
}(app, $));
