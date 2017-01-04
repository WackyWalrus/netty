'use strict';

if (app === undefined) {
    app = {};
}

(function(app, $){

    var cache = {};

    function initCache() {

    }

    function initDOM() {
        app.elems.$body.find('.comment-button').each(function (i) {
            if ($(this).prev().find('textarea').val().length === 0) {
                $(this).attr('disabled', 'disabled');
            } else {
                $(this).removeAttr('disabled');
            }
        });
    }

    function initEvents() {
        function commentLink_clickHandler(e) {
            $(e.target).parent().next().toggleClass('hidden');
        }

        function check_val(e) {
            e.stopPropagation();
        }

        app.elems.$body.on('click', '.action-comment', commentLink_clickHandler);
        app.elems.$body.on('keyup', '.post__comment-form textarea', check_val);
    }

    app.commentForm = {
        init: function () {
            initCache();
            initDOM();
            initEvents();
        }
    };
}(app, $));
