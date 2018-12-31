


function weblandtk_shortcode_modal( $atts, $content ) {
    //ATTRIBUTE
    $array_atts = shortcode_atts(
        array(
            'my_id'    => '949',
            'my_title' => 'فرم تماس',
            'my_btn'   => 'Contact Us'
        ), $atts, 'modal'
    );

    ?>
    <button type="button " class="btn btn-white text-primary dokme" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><?php echo $array_atts['my_btn']; ?></button>
    <h2 class="matn " style="color:white"><?php echo $content?></h2>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تماس با ما</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                        echo do_shortcode('[contact-form-7 id="'.$array_atts["my_id"].'" title="'.$array_atts["my_title"].'"]');
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                    <button type="button" class="btn btn-primary">ارسال پیام</button>
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




