

add_action('cmb2_admin_init', 'crd_repeater_metaboxes');
/**
 * Define the metabox and field configurations.
 */
function crd_repeater_metaboxes()
{
	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box(array(
		'id'            => 'wt_repeater_image_with_desk',  // Belgrove Bouncing Castles
		'title'         => 'گالری محصولات',
		'object_types'  => array('wt_gallery',), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	));
	$blog_group_id = $cmb->add_field(array(
		'id'          => 'wt_gallery_group',
		'type'        => 'group',
		'repeatable'  => true,
		'options'     => array(
			'group_title'   => 'تصویر {#}',
			'add_button'    => 'اضافه کردن تصویر جدید',
			'remove_button' => 'حذف تصویر',
			'closed'        => false,  // Repeater fields closed by default - neat & compact.
			'sortable'      => true,  // Allow changing the order of repeated groups.
		),
	));

	$cmb->add_group_field($blog_group_id, array(
		'name' => 'تصویر محصول',
		'desc' => 'انتخاب تصویر محصول',
		'id'   => 'image',
		'type' => 'file',
	));

	$cmb->add_group_field($blog_group_id, array(
		'name' => 'عنوان محصول',
		'desc' => 'عنوان محصول را وارد نمایید',
		'id'   => 'title',
		'type' => 'text',
	));

	// $cmb->add_group_field($blog_group_id, array(
	// 	'name' => 'توضیحات',
	// 	'desc' => 'توضیحات محصول را در این بخش وارد نمایید.',
	// 	'id'   => 'wt_desc',
	// 	'type' => 'wysiwyg',
	// ));
}
