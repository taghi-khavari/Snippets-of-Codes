<?php

//adding custom element to visual composer

function create_wtsectiontitle_shortcode($atts) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'parameter_name' => '',
		),
		$atts,
		'wt_section_title'
	);
	// Attributes in var
	$parameter_name = $atts['parameter_name'];	
	
	// Output Code
	$output = '<div class="section">';
    $output .= '<div class="section_title">'. $parameter_name .'</div>';
	$output .= '</div>';
	
	return $output;
}
add_shortcode( 'wt_section_title', 'create_wtsectiontitle_shortcode' );

add_action( 'vc_before_init', 'wtsectiontitle_integrateWithVC' );

// Create wt section title element for Visual Composer
function wtsectiontitle_integrateWithVC() {
	vc_map( array(
		'name' => __( 'wt section title', 'textdomain' ),
		'description' => __( 'اضافه کردن عنوان خاص', '' ),
		'base' => 'wt_section_title',
		'class' => 'wt_section_title',
		'icon' => 'wt_icon',
		'show_settings_on_create' => true,
		'category' => __( 'wt elements', 'textdomain'),
		'params' => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'admin_label' => true,
				'heading' => __( 'عنوان مورد نظر را وارد کنید', 'textdomain' ),
				'param_name' => 'parameter_name',
				'value' => 'عنوان خاص',
				'description' => __( 'عنوان', 'textdomain' )
			),
		)
	) );
}

//==========================================================================
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//==========================================================================

    // Element Init
    add_action( 'vc_before_init', 'vc_wt_title_mapping' );
    add_shortcode( 'wt_section_with_text', 'vc_wt_title_html' );    
     
    // Element Mapping
    function vc_wt_title_mapping() {
       
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('wt section with text', 'text-domain'),
                'base' => 'wt_section_with_text',
                'description' => __('Another simple VC box', 'text-domain'), 
                'show_settings_on_create' => true,   
                'category' => __('wt elements', 'text-domain'),
                'icon' => 'wt_icon',            
                'params' => array(  
                    array(
                        'type' => 'textfield',
                        'holder' => 'h3',
                        'class' => 'title-class',
                        'heading' => __( 'عنوان بخش', 'text-domain' ),
                        'param_name' => 'wt_title',
                        'value' => __( 'عنوان سفارشی', 'text-domain' ),
                        'description' => __( 'ایجاد عنوان سفارشی', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'محتوا',
                    ),                    
                    array(
                        'type' => 'textarea_html',
                        'holder' => 'div',
                        'class' => 'text-class',
                        'heading' => __( 'محتوای متنی', 'text-domain' ),
                        'param_name' => 'content',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( 'محتوای متنی مورد نظر', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 2,
                        'group' => 'محتوا',
                    ),                      
                        
                ),
            )
        );                                
        
    }
     
     
    // Element HTML
    function vc_wt_title_html( $atts , $content ) {
        // Params extraction
        
        $args = shortcode_atts(
            array(
                'wt_title'   => '',
                'content' => '',
            ), 
            $atts
        );
        // Fill $html var with data
        $html = '
            <div class="section">
                <div class="section_title">' . $args['wt_title'] . '</div>
                <div class="section_content">
                    '.$content.'
                </div>
            </div>';      
         
        return $html;
         
    }
    
//==========================================================================
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//==========================================================================
    // Element Init
    add_action( 'vc_before_init', 'wt_images_with' );
    add_shortcode( 'wt_images_with', 'wt_images_html' );    
     
    // Element Mapping
    function wt_images_with() {
       
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('تصاویر پروژه های انجام شده', 'text-domain'),
                'base' => 'wt_images_with',
                'description' => __('المان برای اضافه کردن تصاویر پروژه ها', 'text-domain'), 
                'show_settings_on_create' => true,   
                'category' => __('wt elements', 'text-domain'),
                'icon' => 'wt_icon',            
                'params' => array(        
                    array(
                        'type'          => 'textfield',
                        'holder'        => 'h3',
                        'class'         => 'wt_title',
                        'heading'       => _('عنوان بخش پروژه ها' , 'text-domain'),
                        'param_name'    => 'title',
                        'value'         => _('','text-domain'),
                        'description'   => __( 'عنوان بخش'),
                        'admin_label'   => false,
                        'weight'        => 2,
                        'group'         => 'محتوا'
                    ) ,                     
                    array(
                        'type' => 'textfield',
                        'holder' => 'div',
                        'class' => 'text-class',
                        'heading' => __( 'تعداد پروژه ها برای نمایش', 'text-domain' ),
                        'param_name' => 'num_projects',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( 'تعداد پروژه ها برای نمایش را انتخاب نمایید', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 2,
                        'group' => 'محتوا',
                    ),
                        
                ),
            )
        );                                
        
    }
     
     
    // Element HTML
    function wt_images_html( $atts ) {
        // Params extraction
        
        $args = shortcode_atts(
            array(
                'num_projects'   => 3,
                'title'     => 'پروژه های انجام شده'
            ), 
            $atts
        );
        $num_projects = (int) $args['num_projects'];

        $query_args = array(
            'post_type'         => 'project',
            'posts_per_page'    => $num_projects
        );
        
        $query = new WP_Query( $query_args );

        // Fill $html var with data
        ob_start();
        ?>
            <div class="section">
                <div class="section_title"><?php echo $args['title'] ?></div>
                <div class="section_content">
                    <?php
                    if($query->have_posts()):
                        while($query->have_posts()):
                            $query->the_post();
                            echo '<br/>';
                            the_post_thumbnail( 'full' );
                            echo '<br/>';
                        endwhile;
                    else:
                        echo 'متاسفانه پروژه انجام شده ای وجود ندارد.';
                    endif;
                    wp_reset_query();
                    ?>
                </div>
            </div>     
        <?php
        $html = ob_get_clean();
        return $html;
         
    }

//==========================================================================
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//==========================================================================
    // Element Init
    add_action( 'vc_before_init', 'wt_catalogue' );
    add_shortcode( 'wt_catalogue', 'wt_catalogue_html' );    
     
    // Element Mapping
    function wt_catalogue() {
       
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('کاتالوگ محصولات', 'text-domain'),
                'base' => 'wt_catalogue',
                'description' => __('المان برای اضافه کردن کاتالوگ محصولات', 'text-domain'), 
                'show_settings_on_create' => true,   
                'category' => __('wt elements', 'text-domain'),
                'icon' => 'wt_icon',            
                'params' => array(        
                    array(
                        'type'          => 'textfield',
                        'holder'        => 'h3',
                        'class'         => 'wt_title',
                        'heading'       => __('موضوع کاتالوگ' , 'text-domain'),
                        'param_name'    => 'subject',
                        'value'         => __('','text-domain'),
                        'description'   => __( ''),
                        'admin_label'   => true,
                        'weight'        => 0,
                        'group'         => 'محتوا'
                    ) ,                     
                    array(
                        'type'          => 'textfield',
                        'holder'        => 'h3',
                        'class'         => 'wt_title',
                        'heading'       => __('سال انتشار' , 'text-domain'),
                        'param_name'    => 'year',
                        'value'         => __('','text-domain'),
                        'description'   => __( ''),
                        'admin_label'   => true,
                        'weight'        => 0,
                        'group'         => 'محتوا'
                    ) ,                     
                    array(
                        'type'          => 'textfield',
                        'holder'        => 'h3',
                        'class'         => 'wt_title',
                        'heading'       => __('فرمت کاتالوگ' , 'text-domain'),
                        'param_name'    => 'format',
                        'value'         => __('','text-domain'),
                        'description'   => __( ''),
                        'admin_label'   => true,
                        'weight'        => 0,
                        'group'         => 'محتوا'
                    ) ,                     
                    array(
                        'type'          => 'vc_link',
                        'holder'        => 'h3',
                        'class'         => 'wt_title',
                        'heading'       => __('لینک دانلود' , 'text-domain'),
                        'param_name'    => 'link',
                        'value'         => __('','text-domain'),
                        'description'   => __( ''),
                        'admin_label'   => true,
                        'weight'        => 0,
                        'group'         => 'محتوا'
                    ) ,                     
                    array(
                        'type'          => 'attach_image',
                        'holder'        => 'div',
                        'class'         => 'text-class',
                        'heading'       => __( 'انتخاب تصویر', 'text-domain' ),
                        'param_name'    => 'image',
                        'value'         => __( '', 'text-domain' ),
                        'description'   => __( '', 'text-domain' ),
                        'admin_label'   => true,
                        'weight'        => 0,
                        'group'         => 'محتوا',
                    ),
                        
                ),
            )
        );                                
        
    }
     
     
    // Element HTML
    function wt_catalogue_html( $atts ) {
        // Params extraction
        
        $args = shortcode_atts(
            array(
                'image'       => '',
                'subject'     => '',
                'year'        => '',
                'format'      => '',
                'link'        => ''
            ), 
            $atts
        );
        // Fill $html var with data
        $html = '
                <div class="section_content section_catalogue">
                    <div class="catalogue_img">
                        '. wp_get_attachment_image((int)$args['image'] , 'catalogue') .'
                    </div>                    
                    <div class="catalogue_desc">
                        <div class="catalogue_subject">
                            <span class="csbj">موضوع کاتالوگ: </span>
                            <span class="csbji">'.$args['subject'].'</span>
                        </div>
                        <div class="catalogue_year">
                            <span class="cyear">سال انتشار: </span>
                            <span class="cyeari">'.$args['year'].'</span>
                        </div>
                        <div class="catalogue_format">
                            <span class="cformat">فرمت کاتالوگ: </span>
                            <span class="cformati">'.$args['format'].'</span>
                        </div>
                        <div class="catalogue_link">
                            <span class="clink">لینک کاتالوگ: </span>
                            <span class="clinki"><a href="'.vc_build_link($args['link'])['url'].'">کلیک کنید</a></span>
                        </div>
                    </div>

                </div>';      
         
        return $html;
         
    }


//==========================================================================
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//==========================================================================
     
    // Element Init
    add_action( 'vc_before_init', 'wt_post_query' );
    add_shortcode( 'wt_post_query', 'wt_post_query_html' );    
     
    // Element Mapping
    function wt_post_query() {
        $categories = get_terms('category');
        $category_arr = array();
        foreach($categories as $category){
            $category_arr[$category->name]= $category->slug;
        }
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('نمایش پست سفارشی', 'text-domain'),
                'base' => 'wt_post_query',
                'description' => __('المان برای اضافه کردن کاتالوگ محصولات', 'text-domain'), 
                'show_settings_on_create' => true,   
                'category' => __('wt elements', 'text-domain'),
                'icon' => 'wt_icon',            
                'params' => array(        
                    array(
                        'type'          => 'textfield',
                        'holder'        => 'h3',
                        'class'         => 'wt_title',
                        'heading'       => __('عنوان' , 'text-domain'),
                        'param_name'    => 'title',
                        'value'         => __('','text-domain'),
                        'description'   => __( 'عنوان بخش را در این قسمت وارد نمایید'),
                        'admin_label'   => true,
                        'weight'        => 0,
                        'group'         => 'محتوا'
                    ) ,                     
                    array(
                        'type'          => 'dropdown',
                        'holder'        => 'h3',
                        'class'         => 'wt_title',
                        'heading'       => __('دسته بندی' , 'text-domain'),
                        'param_name'    => 'category',
                        'value'         => $category_arr,
                        'description'   => __( ''),
                        'admin_label'   => true,
                        'weight'        => 0,
                        'group'         => 'محتوا'
                    ) ,                     
                    array(
                        'type'          => 'textfield',
                        'holder'        => 'h3',
                        'class'         => 'wt_title',
                        'heading'       => __('تعداد در هر ردیف' , 'text-domain'),
                        'param_name'    => 'posts_per_page',
                        'value'         => __('','text-domain'),
                        'description'   => __( ''),
                        'admin_label'   => true,
                        'weight'        => 0,
                        'group'         => 'محتوا'
                    ) ,  
                        
                ),
            )
        );                                
        
    }
     
     
    // Element HTML
    function wt_post_query_html( $atts ) {
        // Params extraction
        
        $args = shortcode_atts(
            array(
                'posts_per_page'       => '',
                'category'             => '',
                'title'                => '',
            ), 
            $atts
        );

        $query_args = array(
            'post_type'         => 'post',
            'posts_per_page'    => 8,
        );

        $query = new WP_Query($query_args);

        // Fill $html var with data
        ob_start();?>
        <div class="section">
            <div class="section_title"><?php echo $args['title']; ?></div>
            <div class="section_content wt_post_query">
                <?php if($query->have_posts()):
                    $i = 0;
                    while($query->have_posts()){
                        $i++;
                        $query->the_post();
                        echo '<div class="wt_post">';
                            if( has_post_thumbnail() && $i == 1 || has_post_thumbnail() && $i == 8):
                                echo '<div class="wt_post_thumb">';
                                echo '<a href="' . get_the_permalink() .'">';
                                    the_post_thumbnail( 'wt_grid_first_last');
                                echo '</a>';
                                echo '</div>';
                            elseif( has_post_thumbnail() && $i != 1 || has_post_thumbnail() && $i != 8):
                                echo '<div class="wt_post_thumb">';
                                echo '<a href="' . get_the_permalink() .'">';
                                    the_post_thumbnail( 'wt_grid_middle');
                                echo '</a>';
                                echo '</div>';
                            endif;?>
                            <div class="wt_post_meta">
                                <h3>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title();?>
                                    </a>
                                </h3>
                                <div class="wt_post_date">
                                    <i class="far fa-calendar-alt"></i>
                                    <?php echo get_the_date(); ?>
                                </div>
                            </div>
                        </div>
                    <?php }
                    wp_reset_query();
                else:
                    ?>
                    <h3>متاسفانه دسته بندی انتخابی شما مقاله ای ندارد!</h3>
                    <?php
                endif;
                ?>
            </div>   
        </div>
        <?php
        $html = ob_get_clean();
        return $html;
         
    }
     
//==========================================================================
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//==========================================================================

    // Element Init
    add_action( 'vc_before_init', 'wt_our_partners' );
    add_shortcode( 'wt_our_partners', 'wt_our_partners_html' );    
     
    // Element Mapping
    function wt_our_partners() {
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('همکاران ما', 'text-domain'),
                'base' => 'wt_our_partners',
                'description' => __('المان برای اضافه کردن لوگو همکاران ما', 'text-domain'), 
                'show_settings_on_create' => true,   
                'category' => __('wt elements', 'text-domain'),
                'icon' => 'wt_icon',            
                'params' => array(        
                    array(
                        'type'          => 'textfield',
                        'holder'        => 'h3',
                        'class'         => 'wt_title',
                        'heading'       => __('عنوان' , 'text-domain'),
                        'param_name'    => 'title',
                        'value'         => __('','text-domain'),
                        'description'   => __( 'عنوان بخش را در این قسمت وارد نمایید'),
                        'admin_label'   => true,
                        'weight'        => 0,
                        'group'         => 'محتوا'
                    ) ,                     
                    array(
                        'type'          => 'attach_images',
                        'holder'        => 'h3',
                        'class'         => 'wt_title',
                        'heading'       => __('انتخاب تصاویر' , 'text-domain'),
                        'param_name'    => 'images',
                        'value'         => '',
                        'description'   => __( '۱۰ تصویر برای بخش همکاران ما انتخاب نمایید'),
                        'admin_label'   => true,
                        'weight'        => 0,
                        'group'         => 'محتوا'
                    )
                        
                ),
            )
        );                                
        
    }
     
     
    // Element HTML
    function wt_our_partners_html( $atts ) {
        // Params extraction
        
        $args = shortcode_atts(
            array(
                'images'             => '',
                'title'                => '',
            ), 
            $atts
        );


        $img_arr = explode(',' , $args['images']);
        
        // Fill $html var with data
        $html = '
            <div class="section">
                <div class="section_title">' . $args['title'] . '</div>
                <div class="section_content wt_our_partners">';
                    foreach($img_arr as $img){
                        $html .= '<div class="wt_partner_logo">';
                        $html .= wp_get_attachment_image((int)$img , 'full');
                        $html .= '</div>';
                    }
        $html .= '</div>
            </div>';      
         
        return $html;
         
    }
     

//==========================================================================
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//==========================================================================

    // Element Init
    add_action( 'vc_before_init', 'wt_image_and_text_mapping' );
    add_shortcode( 'wt_image_and_text', 'wt_image_and_text_html' );    
     
    // Element Mapping
    function wt_image_and_text_mapping() {
       
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('تصویر چپ و متن راست', 'text-domain'),
                'base' => 'wt_image_and_text',
                'description' => __('اضافه کردن بخش تصویری دلخواه', 'text-domain'), 
                'show_settings_on_create' => true,   
                'category' => __('wt elements', 'text-domain'),
                'icon' => 'wt_icon',            
                'params' => array(  
                    array(
                        'type' => 'textfield',
                        'holder' => 'h3',
                        'class' => 'title-class',
                        'heading' => __( 'عنوان بخش', 'text-domain' ),
                        'param_name' => 'wt_title',
                        'value' => __( 'عنوان سفارشی', 'text-domain' ),
                        'description' => __( 'ایجاد عنوان سفارشی', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 2,
                        'group' => 'محتوا',
                    ),
                    array(
                        'type'          => 'textfield',
                        'holder'        => 'h3',
                        'class'         => 'title-class',
                        'heading'       => __( 'متن دکمه' , 'text-domain' ),
                        'param_name'    => 'btn_text',
                        'value'         => __( 'متن دکمه سفارشی' , 'text-domain' ),
                        'description'   => __( 'متن مورد نظر خود را وارد نمایید' , 'text-domain' ),
                        'admin_label'   => false,
                        'weight'        => 2,
                        'group'         => 'محتوا'
                    ),                             
                    array(
                        'type' => 'vc_link',
                        'holder' => 'h3',
                        'class' => 'title-class',
                        'heading' => __( 'لینک دکمه', 'text-domain' ),
                        'param_name' => 'btn_link',
                        'value' => __( 'لینک دکمه', 'text-domain' ),
                        'description' => __( 'لینک مد نظر را انتخاب نمایید', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 2,
                        'group' => 'محتوا',
                    ),                    
                    array(
                        'type' => 'textarea_html',
                        'holder' => 'div',
                        'class' => 'text-class',
                        'heading' => __( 'محتوای متنی', 'text-domain' ),
                        'param_name' => 'content',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( 'محتوای متنی مورد نظر', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 2,
                        'group' => 'محتوا',
                    ), 
                    array(
                        'type'        => 'attach_image',
                        'holder'      => 'div',
                        'class'       => 'wt_image',
                        'heading'     => 'تصویر مورد نظر',
                        'param_name'  => 'image',
                        'value'       => '',
                        'description' => 'تصویر مورد نظر را وارد نمایید',
                        'admin_label' => false,
                        'weight'      => 2,
                        'group'       => 'محتوا'
                    )                     
                        
                ),
            )
        );                                
        
    }
    
    
    // Element HTML
    function wt_image_and_text_html( $atts , $content ) {
        // Params extraction
        
        $args = shortcode_atts(
            array(
                'wt_title'  => '',
                'btn_text'  => '',
                'btn_link'  => '',
                'image'     => ''
            ), 
            $atts
        );
        
        // Fill $html var with data
        $img = wp_get_attachment_image((int)$args['image'] , 'full');
        ob_start();
        ?>
            <div class="section">
                <div class="section_title"><?php echo $args['wt_title'] ; ?></div>
                <div class="section_content wt_image_and_text">
                    <div class="sc_right">
                        <?php echo $content; ?>
                        <br>
                        <a class="btn" href="<?php echo vc_build_link($args['btn_link'])['url']; ?>"><?php echo $args['btn_text'];?></a>
                    </div>
                    <div class="sc_left">
                        <?php echo $img ;?>
                    </div>
                </div>
            </div>      
        <?php 
        $html = ob_get_clean();
        return $html;
         
    }
     
// } // End Element Class
 
 
// // Element Class Init
// new wt_section_title_with_text();   

//add contact element to vc

// Element Init
add_action( 'vc_before_init', 'wt_contact_info_mapping' );
add_shortcode( 'wt_contact_info', 'wt_contact_info_html' );    
    
// Element Mapping
function wt_contact_info_mapping() {
    
    // Map the block with vc_map()
    vc_map( 
        array(
            'name' => __('wt Contact information', 'text-domain'),
            'base' => 'wt_contact_info',
            'description' => __('Adding your Contact information in a nice format', 'text-domain'), 
            'show_settings_on_create' => true,   
            'category' => __('wt elements', 'text-domain'),
            'icon' => 'wt_icon',            
            'params' => array(  
                array(
                    'type' => 'textfield',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'عنوان بخش', 'text-domain' ),
                    'param_name' => 'wt_title',
                    'value' => __( 'عنوان سفارشی', 'text-domain' ),
                    'description' => __( 'ایجاد عنوان سفارشی', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'محتوا',
                ),                    
                array(
                    'type' => 'textfield',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'عنوان شبکه اجتماعی', 'text-domain' ),
                    'param_name' => 'wt_social_1',
                    'value' => __( 'عنوان', 'text-domain' ),
                    'description' => __( 'ایجاد عنوان شبکه اجتماعی', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'محتوا',
                ),                    
                array(
                    'type' => 'textfield',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'آدرس شبکه اجتماعی', 'text-domain' ),
                    'param_name' => 'wt_social_1_address',
                    'value' => __( 'عنوان', 'text-domain' ),
                    'description' => __( 'آدرس شبکه اجتماعی مورد نظر را وارد نمایید', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'محتوا',
                ),                    
                array(
                    'type' => 'attach_image',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'آیکن شبکه اجتماعی', 'text-domain' ),
                    'param_name' => 'wt_social_1_icon',
                    'value' => __( 'عنوان', 'text-domain' ),
                    'description' => __( 'آدرس شبکه اجتماعی مورد نظر را وارد نمایید', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'محتوا',
                ),                    
                array(
                    'type' => 'textfield',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'عنوان شبکه اجتماعی', 'text-domain' ),
                    'param_name' => 'wt_social_2',
                    'value' => __( 'عنوان', 'text-domain' ),
                    'description' => __( 'ایجاد عنوان شبکه اجتماعی', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'محتوا',
                ),                    
                array(
                    'type' => 'textfield',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'آدرس شبکه اجتماعی', 'text-domain' ),
                    'param_name' => 'wt_social_2_address',
                    'value' => __( 'عنوان', 'text-domain' ),
                    'description' => __( 'آدرس شبکه اجتماعی مورد نظر را وارد نمایید', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'محتوا',
                ),                    
                array(
                    'type' => 'attach_image',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'آیکن شبکه اجتماعی', 'text-domain' ),
                    'param_name' => 'wt_social_2_icon',
                    'value' => __( 'عنوان', 'text-domain' ),
                    'description' => __( 'آدرس شبکه اجتماعی مورد نظر را وارد نمایید', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'محتوا',
                ),                    
                array(
                    'type' => 'textfield',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'عنوان شبکه اجتماعی', 'text-domain' ),
                    'param_name' => 'wt_social_3',
                    'value' => __( 'عنوان', 'text-domain' ),
                    'description' => __( 'ایجاد عنوان شبکه اجتماعی', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'محتوا',
                ),                    
                array(
                    'type' => 'textfield',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'آدرس شبکه اجتماعی', 'text-domain' ),
                    'param_name' => 'wt_social_3_address',
                    'value' => __( 'عنوان', 'text-domain' ),
                    'description' => __( 'آدرس شبکه اجتماعی مورد نظر را وارد نمایید', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'محتوا',
                ),                    
                array(
                    'type' => 'attach_image',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'آیکن شبکه اجتماعی', 'text-domain' ),
                    'param_name' => 'wt_social_3_icon',
                    'value' => __( 'عنوان', 'text-domain' ),
                    'description' => __( 'آدرس شبکه اجتماعی مورد نظر را وارد نمایید', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'محتوا',
                ),                    
                array(
                    'type' => 'textfield',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'عنوان شبکه اجتماعی', 'text-domain' ),
                    'param_name' => 'wt_social_4',
                    'value' => __( 'عنوان', 'text-domain' ),
                    'description' => __( 'ایجاد عنوان شبکه اجتماعی', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'محتوا',
                ),                    
                array(
                    'type' => 'textfield',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'آدرس شبکه اجتماعی', 'text-domain' ),
                    'param_name' => 'wt_social_4_address',
                    'value' => __( 'عنوان', 'text-domain' ),
                    'description' => __( 'آدرس شبکه اجتماعی مورد نظر را وارد نمایید', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'محتوا',
                ),                    
                array(
                    'type' => 'attach_image',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'آیکن شبکه اجتماعی', 'text-domain' ),
                    'param_name' => 'wt_social_4_icon',
                    'value' => __( 'عنوان', 'text-domain' ),
                    'description' => __( 'آدرس شبکه اجتماعی مورد نظر را وارد نمایید', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'محتوا',
                ),                    
                array(
                    'type' => 'textfield',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'عنوان شبکه اجتماعی', 'text-domain' ),
                    'param_name' => 'wt_social_5',
                    'value' => __( 'عنوان', 'text-domain' ),
                    'description' => __( 'ایجاد عنوان شبکه اجتماعی', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'محتوا',
                ),                    
                array(
                    'type' => 'textfield',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'آدرس شبکه اجتماعی', 'text-domain' ),
                    'param_name' => 'wt_social_5_address',
                    'value' => __( 'عنوان', 'text-domain' ),
                    'description' => __( 'آدرس شبکه اجتماعی مورد نظر را وارد نمایید', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'محتوا',
                ),                    
                array(
                    'type' => 'attach_image',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'آیکن شبکه اجتماعی', 'text-domain' ),
                    'param_name' => 'wt_social_5_icon',
                    'value' => __( 'عنوان', 'text-domain' ),
                    'description' => __( 'آدرس شبکه اجتماعی مورد نظر را وارد نمایید', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'محتوا',
                ),                    
                array(
                    'type' => 'textarea_html',
                    'holder' => 'div',
                    'class' => 'text-class',
                    'heading' => __( 'محتوای متنی', 'text-domain' ),
                    'param_name' => 'content',
                    'value' => __( '', 'text-domain' ),
                    'description' => __( 'محتوای متنی بالای آیکن ها', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 2,
                    'group' => 'محتوا',
                ),                      
                    
            ),
        )
    );                                
    
}
    
    
// Element HTML
function vc_wt_title_html( $atts , $content ) {
    // Params extraction
    
    $args = shortcode_atts(
        array(
            'wt_title'            => '',
            'wt_social_1'         => '',
            'wt_social_1_address' => '',
            'wt_social_1_icon'    => '',
            'wt_social_2'         => '',
            'wt_social_2_address' => '',
            'wt_social_2_icon'    => '',
            'wt_social_3'         => '',
            'wt_social_3_address' => '',
            'wt_social_3_icon'    => '',
            'wt_social_4'         => '',
            'wt_social_4_address' => '',
            'wt_social_4_icon'    => '',
            'wt_social_5'         => '',
            'wt_social_5_address' => '',
            'wt_social_5_icon'    => '',
            'content' => '',
        ), 
        $atts
    );
    // Fill $html var with data
    ob_start();
    ?>
        <div class="wt_section">
            <div class="wt_section_title"><?php echo $args['wt_title']; ?></div>
            <div class="wt_section_content">
                <?php echo $content; ?>
            </div>
            <div class="wt_socials">
                <?php for($i = 1 ; $i < 6 ; $i++):?>
                    <div id="wt_socials_<?php echo $i; ?>">
                        <a class="wt_so_link" title="<?php echo $args['wt_social_'.$i] ?>">
                            <?php echo wp_get_attachment_image((int)$args['wt_social_' . $i . '_icon'] ) ?>
                        </a>
                    </div>
                <?php endfor;?>
            </div>
        </div>
    <?php
    $html = ob_get_clean();
    return $html;
        
}
