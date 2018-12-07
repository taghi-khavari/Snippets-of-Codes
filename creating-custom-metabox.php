//input files for meta box
<div class='inside'>
	<h3><?php _e( 'Carbohydrates', 'food_example_plugin' ); ?></h3>
	<p>
		<input type="text" name="carbohydrates" value="<?php echo $current_carbohydrates; ?>" /> 
	</p>
</div>

<h3><?php _e( 'Cholesterol', 'food_example_plugin' ); ?></h3>
<p>
	<input type="radio" name="cholesterol" value="0" <?php checked( $current_cholesterol, '0' ); ?> /> Yes<br />
	<input type="radio" name="cholesterol" value="1" <?php checked( $current_cholesterol, '1' ); ?> /> No
</p>

//group of checkboxes
<h3><?php _e( 'Vitamins', 'food_example_plugin' ); ?></h3>
<p>
	<input type="checkbox" name="vitamins[]" value="Vitamin A" <?php checked( ( in_array( 'Vitamin A', $current_vitamins ) ) ? 'Vitamin A' : '', 'Vitamin A' ); ?> />Vitamin A <br />
	<input type="checkbox" name="vitamins[]" value="Thiamin (B1)" <?php checked( ( in_array( 'Thiamin (B1)', $current_vitamins ) ) ? 'Thiamin (B1)' : '', 'Thiamin (B1)' ); ?> />Thiamin (B1) <br />

	<!-- more vitamins here -->
</p>


//put all things together
<?php
/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function food_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'food_meta_box_nonce' );
	// retrieve the _food_cholesterol current value
	$current_cholesterol = get_post_meta( $post->ID, '_food_cholesterol', true );
	// retrieve the _food_carbohydrates current value
	$current_carbohydrates = get_post_meta( $post->ID, '_food_carbohydrates', true );
	$vitamins = array( 'Vitamin A', 'Thiamin (B1)', 'Riboflavin (B2)', 'Niacin (B3)', 'Pantothenic Acid (B5)', 'Vitamin B6', 'Vitamin B12', 'Vitamin C', 'Vitamin D', 'Vitamin E', 'Vitamin K' );
	
	// stores _food_vitamins array 
	$current_vitamins = ( get_post_meta( $post->ID, '_food_vitamins', true ) ) ? get_post_meta( $post->ID, '_food_vitamins', true ) : array();
	?>
	<div class='inside'>

		<h3><?php _e( 'Cholesterol', 'food_example_plugin' ); ?></h3>
		<p>
			<input type="radio" name="cholesterol" value="0" <?php checked( $current_cholesterol, '0' ); ?> /> Yes<br />
			<input type="radio" name="cholesterol" value="1" <?php checked( $current_cholesterol, '1' ); ?> /> No
		</p>

		<h3><?php _e( 'Carbohydrates', 'food_example_plugin' ); ?></h3>
		<p>
			<input type="text" name="carbohydrates" value="<?php echo $current_carbohydrates; ?>" /> 
		</p>

		<h3><?php _e( 'Vitamins', 'food_example_plugin' ); ?></h3>
		<p>
		<?php
			foreach ( $vitamins as $vitamin ) {
				?>
				<input type="checkbox" name="vitamins[]" value="<?php echo $vitamin; ?>" <?php checked( ( in_array( $vitamin, $current_vitamins ) ) ? $vitamin : '', $vitamin ); ?> /><?php echo $vitamin; ?> <br />
				<?php
			}
		?>
		</p>
	</div>
	<?php
}





//saving the metadata


<?php
/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function food_save_meta_box_data( $post_id ){
	// verify taxonomies meta box nonce
	if ( !isset( $_POST['food_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['food_meta_box_nonce'], basename( __FILE__ ) ) ){
		return;
	}
	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}
	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		return;
	}
	// store custom fields values
	// cholesterol string
	if ( isset( $_REQUEST['cholesterol'] ) ) {
		update_post_meta( $post_id, '_food_cholesterol', sanitize_text_field( $_POST['cholesterol'] ) );
	}
	
	// store custom fields values
	// carbohydrates string
	if ( isset( $_REQUEST['carbohydrates'] ) ) {
		update_post_meta( $post_id, '_food_carbohydrates', sanitize_text_field( $_POST['carbohydrates'] ) );
	}
	
	// store custom fields values
	if( isset( $_POST['vitamins'] ) ){
		$vitamins = (array) $_POST['vitamins'];
		// sinitize array
		$vitamins = array_map( 'sanitize_text_field', $vitamins );
		// save data
		update_post_meta( $post_id, '_food_vitamins', $vitamins );
	}else{
		// delete data
		delete_post_meta( $post_id, '_food_vitamins' );
	}
}
add_action( 'save_post_food', 'food_save_meta_box_data' );
