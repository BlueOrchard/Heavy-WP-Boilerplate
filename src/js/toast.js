//Custom toast plugin - Used in email and volunteer AJAX
var update;
function toast(type, message){
    if($('.toast').length){
        $('.toast').remove();
    }

    $('body').append('<div class="toast '+ type +'"><div class="top-border-toast"></div><span class="toast-message">'+ message +'</span></div>');

    setTimeout(function(){
        $('.toast').addClass('show-toast');

        switch(type){
            case "green":
            case "success":
            case "red":
            case "fail":
                fiveClose();
                break;
            default:
                break;
        }
    }, 100);
}

function fiveClose(){
    $('.toast').addClass('five-close');
    update = setTimeout(function(){
        $('.toast').removeClass('show-toast');
        setTimeout(function(){
            $('.toast').remove();  
        }, 500);
    }, 10000);
}

$(document).on({
    mouseenter: function(){
        $('.toast').removeClass('five-close');
        clearTimeout(update);
    },
    mouseleave: function(){
        $('.toast').addClass('five-close');
        update = setTimeout(function(){
            $('.toast').removeClass('show-toast');
            setTimeout(function(){
                $('.toast').remove();  
            }, 500);
        }, 10000);
    }
}, '.red, .green');

//Usage
//toast('red', 'testing');