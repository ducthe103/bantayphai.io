!function($, window, document, _undefined)
{
    "use strict";

    XF.UserTagClick = XF.Event.newHandler({
        eventType: 'click',
        eventNameSpace: 'XFUserTagClick',

        options: {
            username: null
        },

        init: function()
        {
            if (!this.options.username)
            {
                console.error('Must be initialized with a data-user attribute.');
            }
        },

        click: function(e)
        {
            e.preventDefault();

            var username = '@' +  $(e.target).data('username') + ', ';

            XF.insertIntoEditor($('.js-editor').parent(), username, username);
        },
    });

    XF.Event.register('click', 'userTag', 'XF.UserTagClick');
} (jQuery, window, document);