<?php
/**
 * Plugin Name: Ivor's Custom Post Type
 * Description: Plugin to display projects as a custom post type
 * Version: 0.1
 * Author: Ivor Cheung
 * License: GPL2
 */

/*  Copyright 2014  Ivor Cheung

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function custom_project_posttypes(){

  $labels = array(
        'name'               => 'Projects',
        'singular_name'      => 'Project',
        'menu_name'          => 'Projects',
        'name_admin_bar'     => 'Project',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Project',
        'new_item'           => 'New Projects',
        'edit_item'          => 'Edit Projects',
        'view_item'          => 'View Projects',
        'all_items'          => 'All Projects',
        'search_items'       => 'Search Projects',
        'parent_item_colon'  => 'Parent Projects:',
        'not_found'          => 'No projects found.',
        'not_found_in_trash' => 'No projects found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-archive',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'projects' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail' )
    );

  register_post_type ('Projects', $args);

}

add_action( 'init', 'custom_project_posttypes');


//Flushing Rewrite

function my_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry,
    // when you add a post of this CPT.
    custom_project_posttype();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );
