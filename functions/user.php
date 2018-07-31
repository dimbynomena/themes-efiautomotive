<?php
#=================================================================#
# User config
#=================================================================#

$result = add_role( 'filiale', __(
    'Filiale' ),
    array(
        'read' => true,
        'edit_posts' => true,
        'edit_pages' => true, 
        'edit_others_posts' => false, 
        'create_posts' => true,
        'manage_categories' => false, 
        'publish_posts' => true, 
        'edit_themes' => false, 
        'install_plugins' => false,
        'update_plugin' => false, 
        'update_core' => false 
    )
);

add_action( 'admin_init', 'my_remove_menu_pages' );
function my_remove_menu_pages() {

    global $user_ID;

    if ( current_user_can( 'filiale' ) ) {
        remove_menu_page('edit.php'); 
        remove_menu_page('upload.php'); 
        remove_menu_page('link-manager.php'); 
        remove_menu_page('edit-comments.php'); 
        remove_menu_page('edit.php?post_type=page');
        remove_menu_page('edit.php?post_type=nectar_slider'); 
        remove_menu_page('edit.php?post_type=portfolio'); 
        remove_menu_page('plugins.php');
        remove_menu_page('themes.php'); 
        remove_menu_page('users.php'); 
        remove_menu_page('tools.php'); 
        remove_menu_page('options-general.php');
        remove_menu_page('wpcf7');
        remove_menu_page('profile.php');
    }
}