<?php
//first I will put the function here

function rng_random_string() {
    $characters = "QWERTYUIOPQASDFGHJKLZXCVBNM";
    $characters .= "qwertyuiopasdfghjklzxcvbnm";
    $characters .= "1234567890";
    $characters_length = strlen($characters);
    $random_string = '';
    for ($i = 0; $i < 7; $i++) {
        $random_string .= $characters[rand(0, $characters_length - 1)];
    }
    return $random_string;
}


function weblandtk_shortcode_modal( $atts ) {
    //ATTRIBUTE
    global $post;
    $array_atts = shortcode_atts(
        array(
            'id'    => '5921',
            'title' => 'ثبت سفارش محصول',
            'btn'   => 'سفارش آنلاین' ,
            'type'  => 'normal'
        ), $atts, 'modal'
    );
ob_start();

    $idSalt = rng_random_string();
    ?>
    <!-- Trigger/Open The Modal -->
    <button class="weblandtk_modal_btn btn" data-modal="weblandtk_modal<?php echo $idSalt; ?>"><?php echo $array_atts['btn']; ?></button>

    <!-- The Modal -->
    <div class="weblandtk_modal" id="weblandtk_modal<?php echo $idSalt; ?>">

        <!-- Modal content -->
        <div class="weblandtk_modal-content">
            <div class="weblandtk_modal-header">
                <span class="weblandtk_modal_close">&times;</span>
                <h2 class="product-order-name"><?php if($array_atts['type'] == 'normal'){ echo $post->post_title; }else{ echo 'ثبت سفارش آنلاین'; } ?></h2>
            </div>
            <div class="weblandtk_modal-body">
                <?php
                echo do_shortcode('[contact-form-7 id="'.$array_atts["id"].'" title="'.$array_atts["title"].'"]');
                ?>
            </div>
        </div>

    </div>


    <?php
    //RETURN VALUE
    
    $outpout = ob_get_clean();
    return $outpout;
}
add_shortcode( 'modal', 'weblandtk_shortcode_modal' );
add_action('wp_enqueue_scripts','wt_enqueue');
function wt_enqueue(){
    wp_enqueue_script('wt_modal',get_template_directory_uri().'/javascript/bts-modal.js',false,false);
}



/*
=============================================Second Modal for Images========================================================
*/

function weblandtk_shortcode_image_modal( $atts ) {
    //ATTRIBUTE
    global $post;
    $array_atts = shortcode_atts(
        array(
            'url'    => '',
            'type'  => 'normal'
        ), $atts, 'modal'
    );
ob_start();

    $idSalt = rng_random_string();
    ?>
    <!-- Trigger/Open The Modal -->
    <img class="wtk_modal_img_btn" data-img="wtk_img_modal<?php echo $idSalt; ?>" src="<?php echo $array_atts['url']; ?>"/>
    
    <!-- The Modal -->
    <div class="wtk_modal_img" id="wtk_img_modal<?php echo $idSalt; ?>">

        <!-- Modal content -->
        <div class="wtk_modal-img-content">
           <img src="<?php echo $array_atts['url']; ?>"/>
            
        </div>

    </div>


    <?php
    //RETURN VALUE
    
    $outpout = ob_get_clean();
    return $outpout;
}
add_shortcode( 'image-modal', 'weblandtk_shortcode_image_modal' );

/*
====================================here is jquery stuff =======================================
*/
jQuery(document).ready(function($){
    // Get the modal
    var modal = $('.weblandtk_modal');
    
    // Get the button that opens the modal
    var btn = $('.weblandtk_modal_btn');

  if(modal.length){
    //open modal
    btn.on("click" , function(){
      var modal = $(this).data("modal");
      $("#" + modal).show( 0 , function(){
        $(this).addClass("open-modal");
      });
    });
    //close modal
    $(".weblandtk_modal_close").on("click" , function(){
      var modal = $(this).closest(".weblandtk_modal");
      modal.hide();
    });

    $(".weblandtk_modal").click(function(event) {
      var modal_content = $(".weblandtk_modal-content").find("*");
      var target = $( event.target );
        if(!target.is(modal_content)){
          $(this).hide();
        }
    });
  }
    var orderForm = $(".weblandtk_modal .wpcf7");
    orderForm.find('textarea').attr('rows',4);
    if(orderForm.length)
    { 
        $(".product-order-name").each(function(i,obj){
            var input = $(this);
            var productOrderName = input.closest("tr").find("td.column-2").text();
            if(productOrderName.length){
                input.text(productOrderName);    
            }
            
            var productName = input.text();
            orderForm.find('input.hidden-product-title').val(productName);
        });
    };
    
     //Custom modal js code 
    $('.weblandtk_modal_btn').click(function(){
        var title = $('#subheader h1').text();
        $(this).closest('').find('.modal .wpcf7 input.hidden-product-title').val(title);
      })



    //===================image Modal ================================

    // Get the modal
    var imageModal = $('.wtk_modal_img');
    
    // Get the button that opens the modal
    var btn = $('.wtk_modal_img_btn');

    //open modal
    btn.on("click" , function(){
      var modalData = $(this).data("img");
      $("#" + modalData).show( 0 , function(){
          
        $(this).addClass("img-open-modal");
      });
    });
    //close modal
    $(".wtk_modal_img_close").on("click" , function(){
       $(this).closest(".wtk_modal_img").hide();
    });

    $(".wtk_modal_img").click(function(event) {
      var img_modal_content = $(".wtk_modal-img-content").find("*");
      var target = $( event.target );
        if(!target.is(img_modal_content)){
          $(this).hide();
        }
    });
  
    var orderForm1 = $(".wtk_modal_img .wpcf7");
    if(orderForm1.length)
    { 
        $(".product-order-name").each(function(i,obj){
            var input = $(this);
            var productOrderName = input.closest("tr").find("td.column-2").text();
            if(productOrderName.length){
                input.text(productOrderName);    
            }
            
        });
    }


});

 
 
 /*
 ===========================Here is the stylesheet==============================================
 */
 
 

/* The Modal (background) */
.weblandtk_modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 99999 !important; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    /*overflow: auto; !* Enable scroll if needed *!*/
    background-color: rgba(0,0,0,0.6); /* Black w/ opacity */
}

/* The Close Button */
.weblandtk_modal_close {
    color: #aaa;
    float: left;
    font-size: 28px;
    margin-top: 5px;
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
    margin-top: 20px !important;
    padding: 10px;
    background: #36bddb;
    color: #fff;
    border: 1px solid #fff;
    border-radius:20px ;
}



/* Modal Header */
.weblandtk_modal-header {
    padding: 2px 16px;
    background-color: #ddd;
    color: #333;
}

/* Modal Body */
.weblandtk_modal-body {padding: 10px 3px;}

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
    width: 40%;
    height:325px;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    animation-name: animatetop;
    animation-duration: 0.4s;
    box-sizing:border-box;
    margin: 125px auto; /* 5% from the top and centered */
    padding: 20px;
    z-index:99999999;
    
}


.weblandtk_modal-content h2{
    font-size:22px !important;
    margin:7px 10px !important;
}

/* Add Animation */
@keyframes animatetop {
    from {top: -100px; opacity: 0}
    to {top: 0px; opacity: 1}
}

/*
=================image modal ====================
*/


/* The Modal (background) */
.wtk_modal_img {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 99999 !important; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    /*overflow: auto; !* Enable scroll if needed *!*/
    background-color: rgba(0,0,0,0.6); /* Black w/ opacity */
}

/* The Close Button */
.wtk_modal_img_close {
    color: #aaa;
    float: left;
    font-size: 28px;
    margin-top: 5px;
    font-weight: bold;
}

.wtk_modal_img_close:hover,
.wtk_modal_img_close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.wtk_modal_img_btn{
    margin: 0 auto;
    cursor:pointer;
    width:80px !important;
    height:80px !important;
    border-radius:5px;
}


/* Modal Header */
.wtk_modal-img-header {
    padding: 2px 16px;
    background-color: #ddd;
    color: #333;
}

/* Modal Body */
.wtk_modal-body {
    padding: 10px 3px;
    text-align:center;
}

/* Modal Content */
.wtk_modal-img-content {
    position: relative;
    max-width: 60% !important;
    animation-name: animatetop;
    animation-duration: 0.4s;
    box-sizing:border-box;
    margin: 125px auto; /* 5% from the top and centered */
    z-index:99999999;
    text-align:center;
    
}

.wtk_modal-img-content img{
    max-width: 100% !important;
    height:auto !important;
}

