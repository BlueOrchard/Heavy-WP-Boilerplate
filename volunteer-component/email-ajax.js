$(document).ready(function(){
    if($('.volunteer-form').length){
        $.ajax({
            url : globalVars.templateDirectory + '/volunteer-component/signup-form.html'
        }).done(function(form){
            $('.volunteer-form').html(form);
        })
    }

    var vSubmit = false;
    $(document).on('submit', '.submit-volunteer', function(e){
        e.preventDefault();
        if(vSubmit == false){
            var formData = $(this).serialize();

            $('.volunteer-submit').attr("disabled", true);
            /* if($('.submit-status').length){
                $('.submit-status').text('Submitting...');
            } else {
                $('.submit-email').append('<h3 class="submit-status">Submitting...</h3>');
            } */
            toast('yellow', 'Submitting Your Information...');
    
            $.ajax({
                data	 : formData,
                url		 : globalVars.templateDirectory + '/volunteer-component/user-signup.php',
                method	 : 'POST',
                dataType : 'json'
            }).done(function(response){
                //console.log(response);

                if(response.error){
                    //$('.submit-status').text('Please Fill in Required Fields.');
                    toast('red', 'Please Fill in Required Fields.');
                    $('.volunteer-submit').attr("disabled", false);
                } else {
                    //$('.submit-status').text('Thanks for Joining!');
                    toast('green', 'Thanks for Joining!');
                    $('.volunteer-submit').attr("disabled", false);
                    vSubmit = true;
                }
            });
        }
    });
});