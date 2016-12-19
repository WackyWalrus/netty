'use strict';

if (app === undefined) {
    var app = {};
}

(function (app, $) {

    var cache = {};

    function initCache() {
        cache.$posts = app.elems.$body.find('.posts');
        cache.$postStatus = app.elems.$body.find('.post-status');
        cache.$textarea = cache.$postStatus.find('textarea');
        cache.$button =  cache.$postStatus.find('button');
    }

    function initDOM() {
        if (cache.$textarea.val() === '') {
            cache.$button.attr('disabled', 'disabled');
        }
    }

    function getFirstPostId() {
        return cache.$posts.children().first().prop('id').replace('post-', '');
    }

    function loadFeed() {
        cache.firstPostId = getFirstPostId();
        $.ajax({
            'url': app.config.href + 'actions/load-new-posts.php',
            'method': 'GET',
            'data': {
                'page': 'newsfeed',
                'id': cache.firstPostId
            }
        }).done(function (data) {
            cache.$posts.prepend(data);
        });
    }

    function initEvents() {
        /** textarea focus */
        app.events.subscribe('post-status__textarea/focusin', function () {
            cache.$textarea.addClass('focused');
        });
        /** textarea blur */
        app.events.subscribe('post-status__textarea/focusout', function () {
            if (cache.$textarea.val().length === 0) {
                cache.$textarea.removeClass('focused');
            }
        });
        /** textarea keyup */
        app.events.subscribe('post-status__textarea/keyup', function () {
            cache.$textarea.height(1);
            cache.$textarea.height(cache.$textarea.prop('scrollHeight') + 25);

            if (cache.$textarea.val() === '') {
                cache.$button.attr('disabled', 'disabled');
            } else {
                cache.$button.removeAttr('disabled', 'disabled');
            }
        });
        /** post-status form submit */
        app.events.subscribe('post-status__button/click', function () {
            if (cache.$textarea.val().length !== 0) {
                $.ajax({
                    'url': app.config.href + 'actions/post.php',
                    'method': 'POST',
                    'data': {
                        'msg': cache.$textarea.val()
                    }
                }).done(function () {
                    loadFeed();
                });
            }
        });

        app.elems.$body.on('focus blur keyup', '.post-status textarea', function (e) {
            app.events.publish('post-status__textarea/' + e.type);
        });
        app.elems.$body.on('click', '.post-status button', function (e) {
            app.events.publish('post-status__button/' + e.type);
        });
    }

    app.feed = {
        init: function () {
            initCache();
            initDOM();
            initEvents();
        }
    };

}(app, $));