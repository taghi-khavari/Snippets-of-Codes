<?php
 if(!class_exists("rng_product_view")){ 
  class rng_product_view {
    
    function __construct() {
        add_shortcode( 'product_viewed', array($this,'shortcode_product_viewed') );
        add_action("template_redirect", array($this, "set_product_view"));
        add_action('add_meta_boxes', array($this,'metabox_init'));
        add_action('save_post', array($this,'metabox_save'));
        add_action('wp_footer', array($this,'recent_post_viewed'));
      }
      function set_product_view() {
        if (is_single() and ! is_admin() and ('product' == get_post_type())) {
          global $post;
          $post_id = $post->ID;
          $post_type = $post->post_type;
          $args = array(
            'post_id' => $post_id,
            'post_type' => $post_type
          );
          $is_legal_post_views = $this->is_legal_post_views($args);
          if ($is_legal_post_views ) {
            $cookie_name = 'uc_product_view';
            $this->update_post_views($post_id, $cookie_name);
          }
        }
      }

      function is_legal_post_views($args) {
        if ($args['post_type'] == "product") {
          $meta_key = get_post_meta($args['post_id'], 'rng_is_product', TRUE);
          if ($meta_key == "on") {
            return TRUE;
          } else {
            return FALSE;
          }
        }
      }

      function update_post_views($post_id, $cookie_name) {
        $product_view = $_COOKIE[$cookie_name];
        if (isset($product_view) or  count($product_view) !== 0) {
          $product_view = unserialize($product_view);
          if (is_array($product_view) and !in_array($post_id, $product_view)) {
            $product_view = $this->check_product_view_count($product_view);
            array_unshift($product_view, $post_id);
            $product_view = serialize($product_view);
            setcookie($cookie_name, $product_view, time() + YEAR_IN_SECONDS, "/");
          }
        } else {
          $this->remove_cookie($cookie_name);
          setcookie($cookie_name, '', time() + YEAR_IN_SECONDS, "/");
          $product_view = serialize(array($post_id));
          setcookie($cookie_name, $product_view, time() + YEAR_IN_SECONDS, "/");
        }
      }

      function check_product_view_count($product_view) {
        if (count($product_view) > 9) {
          while (count($product_view) > 9) {
            array_pop($product_view);
          }
        }
        return $product_view;
      }

      function remove_cookie($cookie_name) {
        unset($_COOKIE[$cookie_name]);
        setcookie($cookie_name, '', time() - 3600, '/');
      }
      function metabox_init() {
        add_meta_box("rng-page-product", "فعالسازی بازدید اخیر", array($this,"metabox_input"), array("product") , "side" , "high" );
      }
      function metabox_input($post) {
        wp_nonce_field(basename(__FILE__), 'rng_nonce');
        $is_product = get_post_meta($post->ID,"rng_is_product",TRUE);
        $checked = ($is_product == "on")? 'checked="checked"': '';
        ?>
        <input type="checkbox" name="rng_is_product" <?php echo $checked; ?>>
        <?php
      }
      function metabox_save($post_id) {
        $is_autosave = wp_is_post_autosave($post_id);
        $is_revision = wp_is_post_revision($post_id);
        $is_valid_nonce = (isset($_POST['rng_nonce']) && wp_verify_nonce($_POST['rng_nonce'], basename(__FILE__))) ? TRUE : FALSE;
        //TODO: CHECK HERE IMPORTANT*****
        //if ($is_autosave || $is_revision || !$is_valid_nonce) {
        if ( !$is_valid_nonce) {
          return;
        } else {
          update_post_meta( $post_id, "rng_is_product", $_POST['rng_is_product'] );
        }
      }
      function shortcode_product_viewed() {
        ob_start();
      // The Query
        $product_view = $_COOKIE['uc_product_view'];
        if (isset($product_view) or  count($product_view) !== 0) {
          $product_view = unserialize($product_view);
          if (is_array($product_view)) {
            global $post;
            $current_post_id = $post->ID;
            if(in_array($current_post_id, $product_view)){
              $index = array_search($current_post_id, $product_view);
              unset($product_view[$index]);
            }
          }
        }
        if(isset($product_view) and count($product_view) !== 0){
          $args = array('post__in' => $product_view,'post_type' => 'product','posts_per_page' => 10);
          $posts = get_posts($args);
          if(is_array($posts)){
            echo '<ul class="rng-product-viewed">';
            foreach ($posts as $p) :
              echo '<li class="item-product"><a href="' . get_the_permalink($p->ID) . '" title="' . $p->post_title . '">' . $p->post_title . '</a></li>';
            endforeach;
            echo '</ul>'; //rng-product-viewed
          }
        }
        $outpout = ob_get_clean();
        return $outpout;
      }

      public function recent_post_viewed(){
        ?>
        <div id="uc-recent-postviewed" class="uc-sidenav">
            <h3 class="uc-recent-viewed">محصولات بازدید شده</h3>
          <a href="#" class="uc-close-sidenav" >&times;</a>
          <?php 

          ob_start();
                // The Query
          $product_view = $_COOKIE['uc_product_view'];
          if (isset($product_view) or  count($product_view) !== 0) {
            $product_view = unserialize($product_view);
            if (is_array($product_view)) {
              global $post;
              $current_post_id = $post->ID;
              if(in_array($current_post_id, $product_view)){
                $index = array_search($current_post_id, $product_view);
                unset($product_view[$index]);
              }
            }
          }
          if(isset($product_view) and count($product_view) !== 0){
            $args = array('post__in' => $product_view,'post_type' => 'product','posts_per_page' => 10);
            $posts = get_posts($args);
            if(is_array($posts)){
              echo '<ul class="rng-product-viewed">';
              foreach ($posts as $p) :
                echo '<li class="item-product"><a href="' . get_the_permalink($p->ID) . '" title="' . $p->post_title . '">' . $p->post_title . '</a></li>';
              endforeach;
                      echo '</ul>'; //rng-product-viewed
                    }
                  }
                  $outpout = ob_get_clean();
                  echo $outpout;
                  ?>
        </div>

        <!-- Use any element to open the sidenav -->
        <a href="#" class="uc-open-sidenav">بازدید اخیر</a>
        <div class="uc-black-window"></div>
        <?php
      }
    }
  }

  new rng_product_view();

//add these file to css and js files to load


            /*isuc*/
            
			$(".uc-open-sidenav").on('click',function(e){
				e.preventDefault();
				$(".uc-sidenav").addClass("open");
				$(".uc-black-window").show();
			});
			$(".uc-close-sidenav").on('click',function(e){
				e.preventDefault();
				$(".uc-sidenav").removeClass("open");
				$(".uc-black-window").hide();
			});
			
/*isuc*/
.uc-black-window{
    background: #000;
    cursor: pointer;
    opacity: 0.7;
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    right: 0;
    display: none;
    z-index: 400;
}
.uc-sidenav {
    position: fixed;
    top: 0;
    overflow: hidden;
    overflow-y: auto;
    direction: ltr;
    text-align: right;
    z-index: 9998;
    max-width: 80%;
    padding: 75px 50px;
    height: 100%;
    right: -100%;
    transition: all 1s;
    width: 350px;
}
.uc-sidenav.open {
	transition: all 1s;
	display: block;
	right: 0;
	left: auto;
}
.uc-sidenav {
    background: #FFF;
    color: #334141;
}
.uc-sidenav a {
    color: #334141;
}
.uc-sidenav a.nasa-sidebar-return-shop:hover {
    background-color: #296dc1;
    border-color: #296dc1;
    color: #FFF;
}
.uc-open-sidenav {
    bottom: 0;
    margin-bottom: 75px;
    display: block;
    text-align: center;
    position: fixed;
    z-index: 100;
    top: 65%;
    right: 0;
    border: 1px solid #ddd;
    border-left: none;
    padding: 13px 10px;
    background: #fff;
    color: #334141;
    opacity: 0.3;
    -webkit-border-radius: 0 5px 5px 0;
    -moz-border-radius: 0 5px 5px 0;
    border-radius: 5px 0px 0px 5px;
    -webkit-transition: all 350ms ease;
    -moz-transition: all 350ms ease;
    transition: all 350ms ease;
    -moz-webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.06), 0 2px 10px rgba(0, 0, 0, 0.1);
    -ms-webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.06), 0 2px 10px rgba(0, 0, 0, 0.1);
    -o-webkit-box-shadow: 0 2px 8px rgba(0, 0, 0, 0.09), 0 4px 20px rgba(0, 0, 0, 0.1);
    border-left: 1px solid #d8d8d8;
    vertical-align: middle;
    line-height: 25px;
    height: 50px;
}

.uc-open-sidenav:hover {
    cursor: pointer;
    opacity: 1;
    -moz-webkit-box-shadow: 0 2px 8px rgba(0, 0, 0, 0.09), 0 4px 20px rgba(0, 0, 0, 0.1);
    -ms-webkit-box-shadow: 0 2px 8px rgba(0, 0, 0, 0.09), 0 4px 20px rgba(0, 0, 0, 0.1);
    -o-webkit-box-shadow: 0 2px 8px rgba(0, 0, 0, 0.09), 0 4px 20px rgba(0, 0, 0, 0.1);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.09), 0 4px 20px rgba(0, 0, 0, 0.1);
}
.uc-close-sidenav {
    font-size: 40px;
    position: absolute;
    left: 40px;
    top: 50px;
}
h3.uc-recent-viewed {
    font-size: 20px !important;
    font-weight: normal !important;
}
.rng-product-viewed{
	margin-right: 0;
}
.rng-product-viewed .item-product {
	list-style: none;
	line-height: 30px;
	border-bottom: 1px solid #4d4d4d;
	padding-bottom: 5px;
}
.rng-product-viewed .item-product:before{

}
.product-viewed-wrapper .infinite-footer-wrapper .infinite-widget-title{

}
.rng-product-viewed .item-product a{display: block;}
.rng-product-viewed .item-product a::before {
    content: "\f046";
    font-family: fontawesome;
    float: right;
    margin-left: 10px;
}
