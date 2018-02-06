$(document).ready(function(){
    if($('.email-form').length){
        $.ajax({
            url : globalVars.templateDirectory + '/email-component/signup-form.html'
        }).done(function(form){
            $('.email-form').html(form);
        })
    }

    var submit = false;
    $(document).on('submit', '.submit-email', function(e){
        e.preventDefault();
        if(submit == false){
            var formData = $(this).serialize();
            $('.join-submit').attr("disabled", true);
            /* if($('.submit-status').length){
                $('.submit-status').text('Submitting...');
            } else {
                $('.submit-email').append('<h3 class="submit-status">Submitting...</h3>');
            } */
            toast('yellow', 'Submitting Your Information...');
    
            $.ajax({
                data	 : formData,
                url		 : globalVars.templateDirectory + '/email-component/user-signup.php',
                method	 : 'POST',
                dataType : 'json'
            }).done(function(response){
                if(response.error){
                    //$('.submit-status').text('Please Fill in Required Fields.');
                    toast('red', 'Please Fill in Required Fields.');
                    $('.join-submit').attr("disabled", false);
                } else {
                    //$('.submit-status').text('Thanks for Joining!');

                    //Post registration functions (in custom.js)
                    postRegistration();
                    
                    toast('green', 'Thanks for Joining!');
                    $('.join-submit').attr("disabled", true);
                    submit = true;
                }
            });
        }
    });
});