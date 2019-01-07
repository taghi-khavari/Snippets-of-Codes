add_action( 'add_meta_boxes', 'weblandtk_add_your_fields_meta_box' );

function weblandtk_add_your_fields_meta_box() {
    add_meta_box(
        'weblandtk_fields_meta_box', // $id
        'Your Fields', // $title
        'weblandtk_show_your_fields_meta_box', // $callback
        'product', // $screen
        'side', // $context
        'high' // $priority
    );
}


function weblandtk_show_your_fields_meta_box() {
    global $post;  
    $meta = get_post_meta( $post->ID, 'your_fields', true ); ?>

  <input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

  <p>
    <label for="your_fields[text]">Input Text</label>
    <br>
    <input type="text" name="your_fields[text]" id="your_fields[text]" class="regular-text" value="<?php if (is_array($meta) && isset($meta['text'])) {	echo $meta['text']; } ?>">
  </p>
  <p>
    <label for="your_fields[textarea]">Textarea</label>
    <br>
    <textarea name="your_fields[textarea]" id="your_fields[textarea]" rows="5" cols="30" style="width:500px;"><?php echo $meta['textarea']; ?></textarea>
  </p>
  <p>
    <label for="your_fields[checkbox]">Checkbox
			<input type="checkbox" name="your_fields[checkbox]" value="checkbox" <?php if ( $meta['checkbox'] === 'checkbox' ) echo 'checked'; ?>>
		</label>
  </p>
  <p>
    <label for="your_fields[select]">Select Menu</label>
    <br>
    <select name="your_fields[select]" id="your_fields[select]">
				<option value="option-one" <?php selected( $meta['select'], 'option-one' ); ?>>Option One</option>
				<option value="option-two" <?php selected( $meta['select'], 'option-two' ); ?>>Option Two</option>
		</select>
  </p>
  <p>
    <label for="your_fields[image]">Image Upload</label><br>
    <input type="text" name="your_fields[image]" id="your_fields[image]" class="meta-image regular-text" value="<?php echo $meta['image']; ?>">
    <input type="button" class="button image-upload" value="Browse">
  </p>
  <div class="image-preview"><img src="<?php echo $meta['image']; ?>" style="max-width: 250px;"></div>


//this js file is for opening the media library of wordpress

  <script>
    jQuery(document).ready(function ($) {
      // Instantiates the variable that holds the media library frame.
      var meta_image_frame;
      // Runs when the image button is clicked.
      $('.image-upload').click(function (e) {
        // Get preview pane
        var meta_image_preview = $(this).parent().parent().children('.image-preview');
        // Prevents the default action from occuring.
        e.preventDefault();
        var meta_image = $(this).parent().children('.meta-image');
        // If the frame already exists, re-open it.
        if (meta_image_frame) {
          meta_image_frame.open();
          return;
        }
        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
          title: meta_image.title,
          button: {
            text: meta_image.button
          }
        });
        // Runs when an image is selected.
        meta_image_frame.on('select', function () {
          // Grabs the attachment selection and creates a JSON representation of the model.
          var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
          // Sends the attachment URL to our custom image input field.
          meta_image.val(media_attachment.url);
          meta_image_preview.children('img').attr('src', media_attachment.url);
        });
        // Opens the media library frame.
        meta_image_frame.open();
      });
    });
  </script>

  <?php }
function save_your_fields_meta( $post_id ) {   
	// verify nonce
	if ( isset($_POST['your_meta_box_nonce']) 
			&& !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
			return $post_id; 
		}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if (isset($_POST['post_type'])) { //Fix 2
        if ( 'page' === $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }  
        }
    }
	
	$old = get_post_meta( $post_id, 'your_fields', true );
		if (isset($_POST['your_fields'])) { //Fix 3
			$new = $_POST['your_fields'];
			if ( $new && $new !== $old ) {
				update_post_meta( $post_id, 'your_fields', $new );
			} elseif ( '' === $new && $old ) {
				delete_post_meta( $post_id, 'your_fields', $old );
			}
		}
}
add_action( 'save_post', 'save_your_fields_meta' );
