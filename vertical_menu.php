<style>
    /* vertical menu style */

#vertical_menu ul{
    position: absolute;
    right:50px;
    top:200px;
    padding:20px 0;
    width:40px;
    background:#403E3E;
    color: #fff;
    border-top-left-radius:  30px;
    border-top-right-radius: 30px;
    border-bottom-left-radius:  30px;
    border-bottom-right-radius: 30px;
    z-index:999;
}

#vertical_menu ul.sticky{
    position:fixed;
    right:50px;
    top: 70px;
}

#vertical_menu ul li{
    height:40px;
    border-bottom:1px solid #fff;
}

#vertical_menu ul li:first-child{
    border-top:1px solid #fff;
}

#vertical_menu ul li a{
    display:block;
    text-align: center;
    height:100%;
    line-height: 50px;
}

#vertical_menu .wt_tooltip{
    position: relative;
    overflow: hidden;
    transition: all 0.35s;
}

#vertical_menu .wt_tooltip .wt_vmenu_icon{
    z-index: 9;
    position: relative;
    display: block;
    width:100%;
    height:100%;
}

#vertical_menu .wt_tooltip:hover .wt_vmenu_icon{
    border-left:1px solid #fff;
}

#vertical_menu .wt_tooltip .wt_vmenu_icon .vmenu_hover_icon{
    display:none;
}

#vertical_menu .wt_tooltip:hover .wt_vmenu_icon .vmenu_hover_icon{
    display:block;
}


#vertical_menu .wt_tooltip:hover .wt_vmenu_icon .vmenu_normal_icon{
    display:none;
}

#vertical_menu .wt_tooltip .wt_vmenu_icon .vmenu_normal_icon{
    display:block;
}

#vertical_menu .wt_tooltip .wt_tip{
    position: absolute;
    right:0;
    left:0;
    z-index: 5;
    min-width:50px;
    background: #e0a252;
    height: 100%;
    border-top-left-radius:  30px;
    border-bottom-left-radius:  30px;
    visibility: hidden;    
	font-size: 13px;
}

#vertical_menu .wt_tooltip:hover{
    background: #e0a252;
    overflow: unset;
    transition: all 0.35s;
}

#vertical_menu .wt_tooltip:hover .wt_tip{
    visibility: visible;
    transition: right .35s;
    right:100%;
    left:-100%;
    line-height: 35px;
	width: max-content !important;
	padding: 0 20px;
}

#vertical_menu span.wt_vmenu_icon img {
    width: 100%;
    height: 100%;
}
</style>


<div id="vertical_menu">
    <nav>
        <ul>
        <?php 
            $items = wp_get_nav_menu_items( 238 , array() );

            foreach( $items as $item ){
                $img = get_field( 'side_menu_logo' , $item->ID);
                $imgHover = get_field( 'side_menu_logo_hover' , $item->ID);
                ?>
                <li>
                    <a href="<?php echo $item->url; ?>" class="wt_tooltip">
                        <span class="wt_tip">
                            <?php echo $item->title; ?>
                        </span>
                        <span class="wt_vmenu_icon vmenu-<?php echo $item->ID; ?>">
                            <img class="vmenu_normal_icon" src="<?php echo $img['url']; ?>"/>
                            <img class="vmenu_hover_icon" src="<?php echo $imgHover['url']; ?>"/>
                        </span>
                    </a>
                </li>
                <?php
            }
        ?>

    </ul>
</nav>
</div>
