$(document).ready(function(){
    $.ajax({
        url : templateDirectory + '/email-component/signup-form.html'
    }).done(function(form){
        $('.email-form').html(form);
    })

    var submit = false;
    $(document).on('submit', '.submit-email', function(e){
        e.preventDefault();
        if(submit == false){
            var formData = $(this).serialize();
            $('.join-submit').attr("disabled", true);
            if($('.submit-status').length){
                $('.submit-status').text('Submitting...');
            } else {
                $('.submit-email').append('<h3 class="submit-status">Submitting...</h3>');
            }
    
            $.ajax({
                data	 : formData,
                url		 : templateDirectory + '/email-component/user-signup.php',
                method	 : 'POST',
                dataType : 'json'
            }).done(function(response){
                if(response.error){
                    $('.submit-status').text('Please Fill in Required Fields.');
                    $('.join-submit').attr("disabled", false);
                } else {
                    $('.submit-status').text('Thanks for Joining!');
                    $('.join-submit').attr("disabled", true);
                    submit = true;
                }
            });
        }
    });
});