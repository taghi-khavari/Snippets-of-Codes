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



function weblandtk_shortcode_modal( $atts, $content = '' ) {
    //ATTRIBUTE
    global $post;
    $array_atts = shortcode_atts(
        array(
            'id'    => '964',
            'title' => 'Qoutes',
            'btn'   => 'Get Qoute'
        ), $atts, 'modal'
    );

    ?>
    <button class="btn btn-white btn-block text-primary modal-btn-for-click " type="button "  data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><?php echo $array_atts['btn']; ?></button>
    <h2 class="matn " style="color:white"><?php echo $content?></h2>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel"><?php echo $post->post_title?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    echo do_shortcode('[contact-form-7 id="'.$array_atts["id"].'" title="'.$array_atts["title"].'"]');
                    ?>
                </div>
            </div>
        </div>
    </div>



    <?php
    //RETURN VALUE
    ob_start();
    $outpout = ob_get_clean();
    return $outpout;
}
add_shortcode( 'modal', 'weblandtk_shortcode_modal' );



function arz_old_browser(){
   echo "<!--[if lt IE 9]><script type=\"text/javascript\">window.location = \"https://demo.ariazdevs.com/error\";</script><![endif]-->";
}
add_action("wp_head" , "arz_old_browser" , 1);
