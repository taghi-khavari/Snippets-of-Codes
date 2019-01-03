<style>
//put these style in the main stylesheet



/* The Modal (background) */
.weblandtk_modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 3 !important; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    /*overflow: auto; !* Enable scroll if needed *!*/
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.6); /* Black w/ opacity */
}

/* The Close Button */
.weblandtk_modal_close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.weblandtk_modal_close:hover,
.weblandtk_modal_close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.weblandtk_modal_btn{
    margin: 0 auto;
    cursor:pointer;
}


/* Modal Header */
.weblandtk_modal-header {
    padding: 2px 16px;
    background-color: #ddd;
    color: #333;
}

/* Modal Body */
.weblandtk_modal-body {padding: 20px 16px;}

/* Modal Footer */
.weblandtk_modal-footer {
    padding: 2px 16px;
    background-color: #ddd;
    color: #333;
}

/* Modal Content */
.weblandtk_modal-content {
    position: relative;
    background-color: #fefefe;
    border: 1px solid #888;
    width: 50%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    animation-name: animatetop;
    animation-duration: 0.4s;

    margin: 5% auto; /* 5% from the top and centered */
    padding: 20px;
}

/* Add Animation */
@keyframes animatetop {
    from {top: -100px; opacity: 0}
    to {top: 0; opacity: 1}
}

</style>



function weblandtk_shortcode_modal( $atts, $content = '' ) {
    //ATTRIBUTE
    global $post;
    $array_atts = shortcode_atts(
        array(
            'id'    => '71234',
            'title' => 'Qoutes',
            'btn'   => 'Get Qoute'
        ), $atts, 'modal'
    );

    ?>


    <!-- Trigger/Open The Modal -->
    <button class="weblandtk_modal_btn"><?php echo $array_atts['btn']; ?></button>
    <h2 class="matn " style="color:white"><?php echo $content?></h2>
    <!-- The Modal -->
    <div class="weblandtk_modal" >

        <!-- Modal content -->
        <div class="weblandtk_modal-content">
            <div class="weblandtk_modal-header">
                <span class="weblandtk_modal_close">&times;</span>
                <h2><?php echo $post->post_title?></h2>
            </div>
            <div class="weblandtk_modal-body">
                <?php
                     echo do_shortcode('[contact-form-7 id="'.$array_atts["id"].'" title="'.$array_atts["title"].'"]');
                ?>
            </div>
            <div class="weblandtk_modal-footer">
                <h3>Modal Footer</h3>
            </div>
        </div>

    </div>

    <script type="text/javascript">

        (function ($) {
            // Get the modal
            var modal = $('.weblandtk_modal');

            // Get the button that opens the modal
            var btn = $('.weblandtk_modal_btn');

            // Get the <span> element that closes the modal
            var span = $('.weblandtk_modal_close');

            // When the user clicks on the button, open the modal
            btn.click(function() {
                modal.css('display','block');
            });

            // When the user clicks on <span> (x), close the modal
            span.click(function() {
                modal.css('display','none');
            });



        })(jQuery);

        // When the user clicks anywhere outside of the modal, close it just remember to use it outside jquery
        var wt_modal = document.getElementsByClassName('weblandtk_modal')[0];

        window.onclick = function(event) {
            if (event.target == wt_modal) {
                wt_modal.style.display = "none";
            }
        }
    </script>


    <?php
    //RETURN VALUE
    ob_start();
    $outpout = ob_get_clean();
    return $outpout;
}
add_shortcode( 'modal', 'weblandtk_shortcode_modal' );

