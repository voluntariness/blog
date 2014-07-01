
$(function(){
    $('#login-form').on('submit', login );
    $( document ).ajaxSend( function( event, jqXHR, options ) 
        {
            var form = $(event.currentTarget.forms[0]); 
            if (form.hasClass('run-ajax')) {
                options.isCancel = true;
                jqXHR.abort();
            }
            form.addClass('run-ajax');
            form.find('[type=submit]').addClass('disabled');
        }
    );
    $( document ).ajaxComplete( function( event, jqXHR, options )
        {
            if( options.isCancel ) return ;
            var form = $(event.currentTarget.forms[0]); 
            var button = $(event.currentTarget.activeElement);
            form.removeClass('run-ajax');
            form.find('[type=submit]').removeClass('disabled');
        }
    );

});

/* 登入動作 */
function login( ) 
{
    var postData = $(this).serialize();
    var url = $(this).attr('action');
    $.ajax( url , {data: postData, type: 'post', dataType: 'json'} )
        .done( function( request ) {
            if (request.status) {
                // showMsg( (new Message()).success(request.msg,3000) );
                location.href = '/';
            }
            else
            {
                showMsg( (new Message()).warning(request.msg,3000) );

            }
        });
    return false;;
}

function showMsg( msg ) 
{
    msg.show( $('#alert-message') );
}


