$(document).ready(function() {
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  
    // image preview
    $(".image").change(function() {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.image-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }

    });


    /* password show */

    $(".show-pass").hover(function() {

        $(this).removeClass('fa-eye-slash').addClass('fa-eye');

        $('#password').attr("type", "text");

    }, function() {
        $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        $('#password').attr("type", "password");

    });

    /* end password show */
    

   
     
});

   
   /*end of Create Like and disLike in forntend */
   