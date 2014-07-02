
$(function(){
    $('#login-button').on('click', login );
    $('#login-iframe').on('load', login_error );
    ajax_init();
   

});

/* ajax 設定 */
function ajax_init()
{
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
}

/* 登入動作 */
function login( ) 
{
    // var postData = $(this).serialize();
    $('#login-message').html([
        $('<img/>').attr('src', '/images/login_loading.gif')
        , '登入中 ... '
    ]);
    $('#login-iframe').attr({
        src: $(this).attr('href')
        , 'status': 'loading'
    });
    $('#login-modal').modal('show')
    return false;;
}
function login_error() 
{
    if ( $(this).attr('status') == 'loading' ) {
        $('#login-message').html('登入失敗... 可能是您未登入 Google 帳號 , 或是本系統無您的資料！');
    }
}

function login_success() 
{
    $('#login-message').html('登入成功');
    $('#login-iframe').attr('status','success');
    setTimeout( "$('#login-modal').modal('hide')" , 1000);
    setTimeout( "location.href = '/'" , 1500);
}

function showMsg( msg ) 
{
    msg.show( $('#alert-message') );
}


