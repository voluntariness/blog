
$(function(){

    $('#login-button').on('click', login );
    $('#login-iframe').on('load', loginError );

    /* 設定 Ajax 動作 */
    ajax_init();

    $('button.back-btn').on('click', function () {
        window.history.back();
    });

    /* 設定載入時的高度 */
    scrollSlider.to = document.body.scrollTop;

    $(document).on('mousewheel', function ( event ) {
        // console.log( event );
        scrollSlider.slider( event.originalEvent.deltaY );
        if ( scrollSlider.to ) {
            $('header').addClass('scrolled');
        } else {
            $('header').removeClass('scrolled');
        }
        return false;
    });

    $(document).on( 'scroll', function ( event ) { });

});
var scrollSlider = {
    to : 0
    , timer : null
    , slider : function ( v ) {
        var max = document.body.scrollHeight - window.innerHeight;
        this.to += v;
        this.to = (this.to < 0 ? 0 : ( this.to > max ? max : this.to ));
        this.start();
    }
    , start : function () {
        if ( this.timer == null ) {
            var _this = this;
            this.timer = setInterval( function () { _this.run.apply(_this,[]); }, 1 );
        }
    }
    , stop : function () {
        clearInterval( this.timer );
        this.timer = null;
    }
    , run : function () {
        if ( Math.abs(sub = this.to - document.body.scrollTop) < 10) {
            document.body.scrollTop = this.to;
            this.stop();
        } else {
            document.body.scrollTop += Math.floor( sub / 15 );
        }
    }

}
function scrollSlider( to ) 
{

}

/* ajax 設定 */
function ajax_init()
{
    $( document ).ajaxSend( function( event, jqXHR, options ) 
        {
            if( ! options.ajaxLock ) return;
            var form = $(event.currentTarget.activeElement.form);
            if (form.hasClass('run-ajax')) {
                options.isCancel = true;
                jqXHR.abort();
            }
            options.activeForm = form;
            form.addClass('run-ajax');
            form.find('[type=submit]').addClass('disabled');
        }
    );
    $( document ).ajaxComplete( function( event, jqXHR, options )
        {
            if( options.isCancel || ! options.ajaxLock ) return ;
            var form = options.activeForm;
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

/* 登入失敗 */
function loginError() 
{
    if ( $(this).attr('status') == 'loading' ) {
        $('#login-message').html('登入失敗... 可能是您未登入 Google 帳號 , 或是本系統無您的資料！');
    }
}

/* 登入成功 */
function loginSuccess() 
{
    $('#login-message').html('登入成功');
    $('#login-iframe').attr('status','success');
    setTimeout( "$('#login-modal').modal('hide')" , 1000);
    setTimeout( "location.href = '/'" , 1500);
}

function showMsg( msg, sec ) 
{
    // msg.show( $('#alert-message') );
    $('#alert-modal').modal('hide');
    $('#message-content').html( msg );
    $('#alert-modal').modal('show');

    setTimeout( function() {
        $('#alert-modal').modal('hide');
    }, sec || 1500 );


}

function removeDom( dom , sec )
{
    sec = sec || 500;
    dom = $(dom);
    dom.animate({ opacity: 0}, sec);
    var rmTime = sec + Number(new Date());
    dom.addClass('rm-time-' + rmTime );
    setTimeout( function () { 
        $('.rm-time-' + rmTime ).remove(); 
    }, sec );

}

var Alert = function () {

    var _this = this
        , second = 0
        , type = 'default'
        , url = null
        , content = '';
    this.sec = function ( sec ) 
    {
        second = sec || 1500;
        return this;
    }
    this.redirect = function ( u ) 
    {
        url = u;
        return this;
    }
    this.msg = function ( t )
    {
        type = t || 'default';
        return this;
    }
    this.info = function ( cont, sec) 
    {
        type = 'info';
        this.show( cont, sec );
    }
    this.primary = function ( cont, sec) 
    {
        type = 'primary';
        this.show( cont, sec );
    }

    this.danger = function ( cont, sec) 
    {
        type = 'danger';
        this.show( cont, sec );
    }
    this.warning = function ( cont, sec) 
    {
        type = 'warning';
        this.show( cont, sec );
    }
    this.success = function ( cont, sec) 
    {
        type = 'success';
        this.show( cont, sec );
    }
    this.show = function ( cont, sec )
    {
        this.sec( sec );
        $('#alert-modal .modal-dialog').attr('class', 'modal-dialog my-alert-' + type )
        $('#message-content').html( cont );
        $('#alert-modal').modal('show');

        setTimeout( function() {
            $('#alert-modal').modal('hide');
            if ( url !== null ) location.href = url;
        }, second );
    }

}
