<?php

function wt_member_posttype()
{
  $labels = array(
    'name'                  => _x('اعضا', '', 'wt_member'),
    'singular_name'         => _x('عضو', '', 'wt_member'),
    'menu_name'             => _x('اعضا', '', 'wt_member'),
    'name_admin_bar'        => _x('عضو', '', 'wt_member'),
    'add_new'               => __('اضافه کردن جدید', 'wt_member'),
    'add_new_item'          => __('اضافه کردن عضو جدید', 'wt_member'),
    'new_item'              => __('عضو جدید', 'wt_member'),
    'edit_item'             => __('ویرایش عضو', 'wt_member'),
    'view_item'             => __('مشاهده عضو', 'wt_member'),
    'all_items'             => __('تمامی اعضا', 'wt_member'),
    'search_items'          => __('جستجوی اعضا', 'wt_member'),
    'parent_item_colon'     => __('عضو سرشاخه:', 'wt_member'),
    'not_found'             => __('هیچ عضوی یافت نشد', 'wt_member'),
    'not_found_in_trash'    => __('هیچ عضوی در سطل زباله یافت نشد.', 'wt_member'),
    'featured_image'        => _x('تصویر عضو', '', 'wt_member'),
    'set_featured_image'    => _x('تنظیم تصویر شاخص', '', 'wt_member'),
    'remove_featured_image' => _x('حذف تصویر شاخص', '', 'wt_member'),
    'use_featured_image'    => _x('استفاده بعنوان تصویر شاخص', '', 'wt_member'),
    'archives'              => _x('آرشیو اعضا', '', 'wt_member'),
    'insert_into_item'      => _x('به این عضو اضافه شد', '', 'wt_member'),
    'uploaded_to_this_item' => _x('به این عضو بارگزاری شد', '', 'wt_member'),
    'filter_items_list'     => _x('فیلتر لیست اعضا', '', 'wt_member'),
    'items_list_navigation' => _x('راهبری لیست آیتمها', '', 'wt_member'),
    'items_list'            => _x('لیست اعضا', '', 'wt_member'),
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array('slug' => 'اعضا'),
    'taxonomies'         => array('wt_member_type'),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'menu_icon'          => 'dashicons-buddicons-buddypress-logo',
    'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
  );

  register_post_type('wt_member', $args);
}

add_action('init', 'wt_member_posttype');

add_action('init', 'wt_create_taxonomies', 0);

function wt_create_taxonomies()
{
  $labels = array(
    'name'              => _x('دسته بندی اعضا', 'wt_member_type'),
    'singular_name'     => _x('دسته بندی', 'wt_member_type'),
    'search_items'      => __('جستجوی دسته بندی اعضا', 'wt_member_type'),
    'all_items'         => __('تمامی دسته بندی های اعضا', 'wt_member_type'),
    'parent_item'       => __('دسته بندی سرشاخه', 'wt_member_type'),
    'parent_item_colon' => __('دسته بندی سرشاخه:', 'wt_member_type'),
    'edit_item'         => __('ویرایش دسته بندی', 'wt_member_type'),
    'update_item'       => __('بروزرسانی دسته بندی', 'wt_member_type'),
    'add_new_item'      => __('اضافه کردن دسته بندی جدید', 'wt_member_type'),
    'new_item_name'     => __('نام دسته بندی جدید', 'wt_member_type'),
    'menu_name'         => __('دسته بندی', 'wt_member_type'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'دسته-بندی-اعضا'),
  );

  register_taxonomy('wt_member_type', array('wt_member'), $args);
}
