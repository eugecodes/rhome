window.addEvent('load', function()
{
    //check all
    if( igCheck( document.id('ig_check_all') ) )
    {
        document.id('ig_check_all').addEvent('click', function(event)
        {
            var checkBoxes = document.id('ig_admin_table').getElements('input[class=ig_checkbox]');
            if(document.id('ig_check_all').checked)
            {
                checkBoxes.each(function(el,index)
                {
                   el.set('checked','checked');
                });
            }
            else
            {
                checkBoxes.each(function(el,index)
                {
                   el.set('checked',false);
                });
            }
        });
    }

    //category list
    if( igCheck( document.id('ig_toolbar_cat_pub') ) )
    {
        document.id('ig_toolbar_cat_pub').addEvent('click', function(event)
        {
            event.stop();
            var baseUrl = document.id('ig_toolbar_cat_pub').getProperty('href');

            var fullUrl = igGetUrl(baseUrl, false);
            if(fullUrl == false){return;}
            window.location = fullUrl;
        });
    }

    if( igCheck( document.id('ig_toolbar_cat_unpub') ) )
    {
        document.id('ig_toolbar_cat_unpub').addEvent('click', function(event)
        {
            event.stop();
            var baseUrl = document.id('ig_toolbar_cat_unpub').getProperty('href');

            var fullUrl = igGetUrl(baseUrl, false);
            if(fullUrl == false){return;}
            window.location = fullUrl;
        });
    }

    if( igCheck( document.id('ig_saveorder') ) )
    {
        document.id('ig_saveorder').addEvent('click', function(event)
        {
            event.stop();
            var baseUrl = document.id('ig_saveorder').getProperty('href');

            var fullUrl = igGetUrl(baseUrl, true);
            if(fullUrl == false){return;}
            window.location = fullUrl;
        });
    }

    //category item
    if( igCheck( document.id('ig_toolbar_cat_apply') ) )
    {
        document.id('ig_toolbar_cat_apply').addEvent('click', function(event)
        {
            event.stop();
            document.id('ig_task').set('value', 'icategory.apply');
            document.id('ig_new_cat_form').submit();
        });
    }

    if( igCheck( document.id('ig_toolbar_cat_save') ) )
    {
        document.id('ig_toolbar_cat_save').addEvent('click', function(event)
        {
            event.stop();
            document.id('ig_task').set('value', 'icategory.save');
            document.id('ig_new_cat_form').submit();
        });
    }

    //images list
    if( igCheck( document.id('ig_toolbar_image_pub') ) )
    {
        document.id('ig_toolbar_image_pub').addEvent('click', function(event)
        {
            event.stop();
            var baseUrl = document.id('ig_toolbar_image_pub').getProperty('href');

            var fullUrl = igGetUrl(baseUrl, false);
            if(fullUrl == false){return;}
            window.location = fullUrl;
        });
    }

    if( igCheck( document.id('ig_toolbar_image_unpub') ) )
    {
        document.id('ig_toolbar_image_unpub').addEvent('click', function(event)
        {
            event.stop();
            var baseUrl = document.id('ig_toolbar_image_unpub').getProperty('href');

            var fullUrl = igGetUrl(baseUrl, false);
            if(fullUrl == false){return;}
            window.location = fullUrl;
        });
    }

    if( igCheck( document.id('ig_toolbar_image_delete') ) )
    {

        document.id('ig_toolbar_image_delete').addEvent('click', function(event)
        {
            event.stop();
            var baseUrl = document.id('ig_toolbar_image_delete').getProperty('href');

            var fullUrl = igGetUrl(baseUrl, false);
            if(fullUrl == false){return;}
            window.location = fullUrl;
        });
    }

    if( igCheck( document.id('ig_saveorder') ) )
    {
        document.id('ig_saveorder').addEvent('click', function(event)
        {
            event.stop();
            var baseUrl = document.id('ig_saveorder').getProperty('href');

            var fullUrl = igGetUrl(baseUrl, true);
            if(fullUrl == false){return;}
            window.location = fullUrl;
        });
    }

    //image item
    if( igCheck( document.id('ig_toolbar_image_apply') ) )
    {
        document.id('ig_toolbar_image_apply').addEvent('click', function(event)
        {
            event.stop();
            document.id('ig_task').set('value', 'image.apply');
            document.id('ig_image_form').submit();
        });
    }

    if( igCheck( document.id('ig_toolbar_image_save') ) )
    {
        document.id('ig_toolbar_image_save').addEvent('click', function(event)
        {
            event.stop();
            document.id('ig_task').set('value', 'image.save');
            document.id('ig_image_form').submit();
        });
    }

    if( igCheck( document.id('ig_toolbar_image_savenext') ) )
    {
        document.id('ig_toolbar_image_savenext').addEvent('click', function(event)
        {
            event.stop();
            document.id('ig_task').set('value', 'image.save_and_next');
            document.id('ig_image_form').submit();
        });
    }


});

function igCheck(obj)
{
    return !!(obj || obj === 0);
}

function igGetUrl(baseUrl, addOrder)
{
    var ids = new Array();
    var checkBoxes = document.id('ig_admin_table').getElements('input[class=ig_checkbox]');

    checkBoxes.each(function(el,index)
    {
       if(el.checked || addOrder == true)
       {
            var id = parseInt( el.getProperty('name').replace('ig_check_','') );
            ids.push(id);
       }
    });

    if(addOrder)
    {
        var orderNumbers = new Array();
        var orderBoxes = document.id('ig_admin_table').getElements('input[class=ig_order_box]');

        orderBoxes.each(function(el,index)
        {
            var order = parseInt( el.getProperty('value') );
            orderNumbers.push(order);
        });
    }

    if(ids.length > 0)
    {
        var cidString = '';
        for(var i=0;i<ids.length;i++)
        {
            cidString = i==0 ? cidString + 'cid[]=' + ids[i] : cidString + '&cid[]=' + ids[i];
        }
        var fullUrl = baseUrl.indexOf('?') == -1 ? baseUrl + '?' + cidString : baseUrl + '&' + cidString;

        if(addOrder)
        {
            var orderString = '';
            for(var i=0;i<orderNumbers.length;i++)
            {
                orderString = orderString + '&order[]=' + orderNumbers[i];
            }

            fullUrl = fullUrl + orderString;
        }
        return fullUrl;
    }
    else
    {
        alert('Please select a category');
        return false;
    }
}