<div class="row">
        <div class="col-md-6">[text* your-name placeholder "Your Name "] </div>
        <div class="col-md-6">[email* your-email placeholder "Your Email "] </div>
        <div class="col-md-12">[tel* your-phone placeholder "Your Phone"] </div>
        <div class="col-md-12"><div>[textarea* your-message placeholder "Your Message"]</div></div>
        <div class="col-md-12">[submit class:btn class:btn-success "Submit Form"]</div>
[hidden your-product class:hidden-product-title]
</div>


  //Custom modal js code 
    $('.modal-btn-for-click').click(function(){
        var title = $('#subheader h1').text();
        $('.modal .wpcf7 input.hidden-product-title').val(title);
      })



