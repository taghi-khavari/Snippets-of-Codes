
/*
 * Creating a template that can be called from home page to display
 * 3 random testimonials
 */

$args = array(
    'post_type'     => 'testimonials',
    'posts_per_page'=> 3,
    'orderby'       => 'rand'
);

$testimonials = new WP_Query($args);
?>
    <aside id="testimonials">
<?php
    while($testimonials->have_posts()) : $testimonials->the_post();
?>
        <div class="testimonials">
            <figure class="testimonials-thumb">
                <?php the_post_thumbnail('medium');?>
            </figure>
            <h1 class="entry-title">
                <?php get_the_title();?>
            </h1>
            <div class="entry-content">
                <?php echo the_content();?>
            </div>
        </div>
<?php endwhile;?>
    </aside>
<?php wp_reset_query();?>
