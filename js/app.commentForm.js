'use strict';

if (app === undefined) {
    app = {};
}

(function (app, $) {

    var cache = {};

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
            cache.$button = $(e.target).closest('[data-module="comment-form"]').next();
            if ($(e.target).val().length === 0) {
                cache.$button.attr('disabled', 'disabled');
            } else {
                cache.$button.removeAttr('disabled');
            }
        }

        function commentButton_clickHandler(e) {
            cache.$module = $(e.target).prev();
            cache.post_id = cache.$module.find('[name="post_id"]').val();
            cache.comment = cache.$module.find('textarea').val();

            $.ajax({
                'url': app.config.href + '/actions/comment.php',
                'method': 'POST',
                'data': {
                    'post_id': cache.post_id,
                    'comment': cache.comment
                }
            }).done(function (data) {
                console.log('comment posted');
            });
        }

        app.elems.$body.on('click', '.action-comment', commentLink_clickHandler);
        app.elems.$body.on('keyup', '.post__comment-form textarea', check_val);
        app.elems.$body.on('click', '.comment-button', commentButton_clickHandler);
    }

    app.commentForm = {
        init: function () {
            initDOM();
            initEvents();
        }
    };
}(app, $));
