//Example Slick Slider config. Works for most use cases.
/* $(document).ready(function(){
    $('.slick-slider').slick({
        autoplay: true,
        autoplaySpeed: 5000,
        adaptiveHeight: true 
    }); 
}); */

$('.mobile-nav-button').on('click', function(){
    $(this).toggleClass('active-nav');
    $('.main-navigation').toggleClass('active-main');
});

function scrollTo(element){
    $(element).on('click', function(){
        $('html, body').animate({
            scrollTop: $(element).offset().top
        }, 500);
    })
}

function postRegistration(){
    //For Facebook remarketing if used
    //fbq('track', 'CompleteRegistration');
}