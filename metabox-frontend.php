<?php get_header(); ?>

<?php 
$args = array(
	'post_type' => 'your_post',
);  
$your_loop = new WP_Query( $args ); if ( $your_loop->have_posts() ) : while ( $your_loop->have_posts() ) : $your_loop->the_post();
$meta = get_post_meta( $post->ID, 'your_fields', true ); ?>

<h1>Title</h1>
<?php the_title(); ?>

<h1>Content</h1>
<?php the_content(); ?>

<h1>Excerpt</h1>
<?php the_excerpt(); ?>

<h1>Text Input</h1>
<?php echo $meta['text']; ?>

<h1>Textarea</h1>
<?php echo $meta['textarea']; ?>


<h1>Checkbox</h1>
<?php if ( $meta['checkbox'] === 'checkbox') { ?>
Checkbox is checked.
<?php } else { ?> 
Checkbox is not checked. 
<?php } ?>


<h1>Select Menu</h1>
<p>The actual value selected.</p>
<?php echo $meta['select']; ?>

<p>Switch statement for options.</p>
<?php 
	switch ( $meta['select'] ) {
		case 'option-one':
			echo 'Option One';
			break;
		case 'option-two':
			echo 'Option Two';
			break;
		default:
			echo 'No option selected';
			break;
	} 
?>

<h1>Image</h1>
<img src="<?php echo $meta['image']; ?>">


<?php endwhile; endif; wp_reset_postdata(); ?>

<?php get_footer(); ?>
