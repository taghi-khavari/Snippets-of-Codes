<?php


add_action('wp_enqueue_scripts','weblandtk_enqueue_script');

function weblandtk_enqueue_script(){
    wp_enqueue_script( 'customjs',get_template_directory_uri().'/attach/js/custom.js',array('jquery'),1.0,true );
}


function weblandtk_shortcode_modal( $atts, $content ) {
    global $post;
    //ATTRIBUTE
    $array_atts = shortcode_atts(
        array(
            'id'    => '949',
            'title' => 'فرم تماس',
            'btn'   => 'Contact Us',
            'modal-number'  => '1'
        ), $atts, 'modal'
    );

    ?>
    <button class="fusion-button button-flat fusion-button-round button-xlarge modal-button btn-modal-<?php echo $array_atts['modal-number']; ?>" data-modal="myModal">درخواست مشاوره</button>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-close">&times;</span>
                <h2><?php echo $array_atts['title'] ?></h2>
            </div>


            <div class="modal-body">
                <?php
                echo do_shortcode('[contact-form-7 id="'.$array_atts["id"].'" title="'.$array_atts["title"].'"]');
                ?>
            </div>
<!--            <div class="modal-footer">-->
<!---->
<!--            </div>-->
        </div>

    </div>
    <?php
    //RETURN VALUE
    ob_start();
    $outpout = ob_get_clean();
    return $outpout;
}
add_shortcode( 'modal', 'weblandtk_shortcode_modal' );

?>
<script>
//put this script into the custom js file that you build above
(function($){
    //set variable
    var modal = $(".modal");
    var btn = $(".modal-button");

    if(modal.length){
        //open modal
        btn.on("click" , function(){
            var modal = $(this).data("modal");
            $("#" + modal).show( 0 , function(){
                $(this).addClass("open-modal");
            });
        });
        //close modal
        $(".modal-close").on("click" , function(){
            var modal = $(this).closest(".modal");
            modal.hide();
        });

        $(".modal").click(function(event) {
            var modal_content = $(".modal-content").find("*");
            var target = $( event.target );
            if(!target.is(modal_content)){
                $(this).hide();
            }
        });
    }
})(jQuery);
</script>

<style>

//put this style into the main style

.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 9999; /* Sit on top */
    padding-top: 10%; /* Location of the box */
    right: 300px;
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}


/* Modal Content */
.modal-content {
    position: relative;
    background-color: white;
    border-radius: 5px;
    overflow: hidden;
    z-index: 25;
    width:50%;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

@media(min-width: 1100px){
    /* Modal Content */
    .modal-content {
        /*right:300px;*/
        /*left:300px;*/
    }
}

@media(max-width: 1100px){
    /* Modal Content */
    .modal-content {
        width:75%;
        right:30px;
        left:30px;
    }
}

/* The Close Button */
.modal-close {
    cursor: pointer;
    float: left;
    font-size: 28px;
    font-weight: bold;
}

.modal-body,.modal-footer,.modal-header { padding: 2px 16px; }
</style>
