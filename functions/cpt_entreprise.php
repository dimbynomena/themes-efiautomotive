<?
#=================================================================#
# Cpt Entreprise
#=================================================================#

#=======================#
# + Add entreprise taxonomy in site
#=======================#

if ( ! function_exists( 'cpt_entreprise_sectors' ) ) {

    // Register Custom Taxonomy
    function cpt_entreprise_sectors() {
    
        $labels = array(
            'name'                       => _x( 'Secteurs', 'Taxonomy General Name', 'text_domain' ),
            'singular_name'              => _x( 'Secteurs', 'Taxonomy Singular Name', 'text_domain' ),
            'menu_name'                  => __( 'Secteurs', 'text_domain' ),
            'all_items'                  => __( 'Tous les secteurs', 'text_domain' ),
            'parent_item'                => __( 'Secteur parent', 'text_domain' ),
            'parent_item_colon'          => __( 'Secteur parent :', 'text_domain' ),
            'new_item_name'              => __( 'Nom du nouveau secteur', 'text_domain' ),
            'add_new_item'               => __( 'Ajouter nouveau secteur', 'text_domain' ),
            'edit_item'                  => __( 'Editer secteur', 'text_domain' ),
            'update_item'                => __( 'Mettre à jour secteur', 'text_domain' ),
            'view_item'                  => __( 'Voir le secteur', 'text_domain' ),
            'separate_items_with_commas' => __( 'Séparer les secteurs avec des virgules', 'text_domain' ),
            'add_or_remove_items'        => __( 'Ajouter ou supprimer des secteurs', 'text_domain' ),
            'choose_from_most_used'      => __( 'Sélectionner par le plus utilisé', 'text_domain' ),
            'popular_items'              => __( 'Secteurs populaires', 'text_domain' ),
            'search_items'               => __( 'Rechercher un secteur', 'text_domain' ),
            'not_found'                  => __( 'Non trouvé', 'text_domain' ),
            'no_terms'                   => __( 'Aucun secteur', 'text_domain' ),
            'items_list'                 => __( 'Liste des secteurs', 'text_domain' ),
            'items_list_navigation'      => __( 'Navigation liste des secteurs', 'text_domain' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'sectors', array( 'entreprise_sector' ), $args );
    
    }
    add_action( 'init', 'cpt_entreprise_sectors', 0 );

}

#=======================#
# + Add entreprise cpt in site
#=======================#

if ( ! function_exists('cpt_entreprise') ) {

    // Register Custom Post Type
    function cpt_entreprise() {
    
        $labels = array(
            'name'                  => _x( 'Filiales', 'Post Type General Name', 'text_domain' ),
            'singular_name'         => _x( 'Filiales', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'             => __( 'Filiales', 'text_domain' ),
            'name_admin_bar'        => __( 'Filiales', 'text_domain' ),
            'archives'              => __( 'Lite des entreprises', 'text_domain' ),
            'attributes'            => __( 'Attributs de l\'entreprise', 'text_domain' ),
            'parent_item_colon'     => __( 'Parent de l\'entreprise', 'text_domain' ),
            'all_items'             => __( 'Toutes les entreprises', 'text_domain' ),
            'add_new_item'          => __( 'Ajouter une entreprise', 'text_domain' ),
            'add_new'               => __( 'Ajouter nouvelle', 'text_domain' ),
            'new_item'              => __( 'Nouvelle entreprise', 'text_domain' ),
            'edit_item'             => __( 'Editer l\'entreprise', 'text_domain' ),
            'update_item'           => __( 'Mettre à jour l\'entreprise', 'text_domain' ),
            'view_item'             => __( 'Voir l\'entreprise', 'text_domain' ),
            'view_items'            => __( 'Voir les entreprises', 'text_domain' ),
            'search_items'          => __( 'Rechercher un élément', 'text_domain' ),
            'not_found'             => __( 'Aucun résultat', 'text_domain' ),
            'not_found_in_trash'    => __( 'Aucun résultat dans la poubelle', 'text_domain' ),
            'featured_image'        => __( 'Image principale', 'text_domain' ),
            'set_featured_image'    => __( 'Définir l\'image principale', 'text_domain' ),
            'remove_featured_image' => __( 'Enlever l\'image principale', 'text_domain' ),
            'use_featured_image'    => __( 'Utiliser comme image principale', 'text_domain' ),
            'insert_into_item'      => __( 'Insérer dans le nouvel élément.', 'text_domain' ),
            'uploaded_to_this_item' => __( 'Uploader vers cette entreprise', 'text_domain' ),
            'items_list'            => __( 'Liste des entreprises', 'text_domain' ),
            'items_list_navigation' => __( 'Navigation entre entreprises', 'text_domain' ),
            'filter_items_list'     => __( 'Filter la liste des entreprises', 'text_domain' ),
        );
        $args = array(
            'label'                 => __( 'Secteur d\'entreprises', 'text_domain' ),
            'description'           => __( 'Description', 'text_domain' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes', 'post-formats', 'post-excerpt', ),
            'taxonomies'            => array( 'sectors', 'entreprise_tag' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => false,		
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'menu_icon' => 'dashicons-location-alt',
            'rewrite' => array(
                'slug' => 'nos-filiales'
            ),
        );
        register_post_type( 'entreprise_sector', $args );
    
    }
    add_action( 'init', 'cpt_entreprise', 0 );
}

#=======================#
# + Display Metabox
#=======================#

define('WYSIWYG_META_BOX_ID', 'presentation-meta-box-id');
define('WYSIWYG_EDITOR_ID', 'myeditor'); //Important for CSS that this is different
define('WYSIWYG_META_KEY', 'extra-content');

// Add metabox
add_action( 'add_meta_boxes', 'cpt_entreprise_meta_box_add' );
function cpt_entreprise_meta_box_add()
{
    add_meta_box( 'mail-meta-box-id', 'Email principal', 'cpt_entreprise_mail_meta_box_display', 'entreprise_sector', 'normal', 'high' );
    add_meta_box( 'gps-meta-box-id', 'Coordonnées GPS', 'cpt_entreprise_gps_meta_box_display', 'entreprise_sector', 'normal', 'high' );
    add_meta_box( 'itineraire-meta-box-id', 'URL itinéraire', 'cpt_entreprise_itineraire_meta_box_display', 'entreprise_sector', 'normal', 'high' );
    add_meta_box( 'filiale-meta-box-id', 'Nom de la filiale', 'cpt_entreprise_filiale_meta_box_display', 'entreprise_sector', 'normal', 'high' );
    add_meta_box(WYSIWYG_META_BOX_ID, __('Présentation de la filiale', 'wysiwyg'), 'wysiwyg_render_meta_box', 'entreprise_sector');
}

// Get editor
function wysiwyg_render_meta_box(){
	
        global $post;
        
        $meta_box_id = WYSIWYG_META_BOX_ID;
        $editor_id = WYSIWYG_EDITOR_ID;
        
        //Add CSS & jQuery goodness to make this work like the original WYSIWYG
        echo "
                <style type='text/css'>
                        #$meta_box_id #edButtonHTML, #$meta_box_id #edButtonPreview {background-color: #F1F1F1; border-color: #DFDFDF #DFDFDF #CCC; color: #999;}
                        #$editor_id{width:100%;}
                        #$meta_box_id #editorcontainer{background:#fff !important;}
                        #$meta_box_id #$editor_id_fullscreen{display:none;}
                </style>
            
                <script type='text/javascript'>
                        jQuery(function($){
                                $('#$meta_box_id #editor-toolbar > a').click(function(){
                                        $('#$meta_box_id #editor-toolbar > a').removeClass('active');
                                        $(this).addClass('active');
                                });
                                
                                if($('#$meta_box_id #edButtonPreview').hasClass('active')){
                                        $('#$meta_box_id #ed_toolbar').hide();
                                }
                                
                                $('#$meta_box_id #edButtonPreview').click(function(){
                                        $('#$meta_box_id #ed_toolbar').hide();
                                });
                                
                                $('#$meta_box_id #edButtonHTML').click(function(){
                                        $('#$meta_box_id #ed_toolbar').show();
                                });
				//Tell the uploader to insert content into the correct WYSIWYG editor
				$('#media-buttons a').bind('click', function(){
					var customEditor = $(this).parents('#$meta_box_id');
					if(customEditor.length > 0){
						edCanvas = document.getElementById('$editor_id');
					}
					else{
						edCanvas = document.getElementById('content');
					}
				});
                        });
                </script>
        ";
        
        //Create The Editor
        $content = get_post_meta($post->ID, WYSIWYG_META_KEY, true);
        the_editor($content, $editor_id);
        
        //Clear The Room!
        echo "<div style='clear:both; display:block;'></div>";
}

function cpt_entreprise_mail_meta_box_display( $post )
{
    $values = get_post_custom( $post->ID );
    $text = isset( $values['mail_meta_box_text'] ) ? esc_attr( $values['mail_meta_box_text'][0] ) : '';
    ?>
    <p>
        <label for="mail_meta_box_text">Email principal</label>
    </p>
    <input type="text" name="mail_meta_box_text" id="mail_meta_box_text" value="<?php echo $text; ?>" />
    
    <?php   
}

function cpt_entreprise_gps_meta_box_display( $post )
{
    $values = get_post_custom( $post->ID );
    $text = isset( $values['gps_meta_box_text'] ) ? esc_attr( $values['gps_meta_box_text'][0] ) : '';
    ?>
    <p>
        <label for="gps_meta_box_text">Coordonnées GPS</label>
    </p>
    <input type="text" name="gps_meta_box_text" id="gps_meta_box_text" value="<?php echo $text; ?>" />
    
    <?php   
}

function cpt_entreprise_itineraire_meta_box_display( $post )
{
    $values = get_post_custom( $post->ID );
    $text = isset( $values['itineraire_meta_box_text'] ) ? esc_attr( $values['itineraire_meta_box_text'][0] ) : '';
    ?>
    <p>
        <label for="itineraire_meta_box_text">Itinéraire</label>
    </p>
    <input type="text" name="itineraire_meta_box_text" id="itineraire_meta_box_text" value="<?php echo $text; ?>" />
    
    <?php   
}

function cpt_entreprise_filiale_meta_box_display( $post )
{
    $values = get_post_custom( $post->ID );
    $text = isset( $values['filiale_meta_box_text'] ) ? esc_attr( $values['filiale_meta_box_text'][0] ) : '';
    ?>
    <p>
        <label for="filiale_meta_box_text">Nom de la filiale</label>
    </p>
    <input type="text" name="filiale_meta_box_text" id="filiale_meta_box_text" value="<?php echo $text; ?>" />
    
    <?php   
}

add_action( 'save_post', 'cpt_entreprise_meta_box_save' );
function cpt_entreprise_meta_box_save( $post_id )
{
    $editor_id = WYSIWYG_EDITOR_ID;
    $meta_key = WYSIWYG_META_KEY;
    
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !current_user_can( 'edit_post', $post_id ) ) return;

    if( isset( $_POST['gps_meta_box_text'] ) )
        update_post_meta( $post_id, 'gps_meta_box_text', wp_kses( $_POST['gps_meta_box_text'] ) );

    if( isset( $_POST['itineraire_meta_box_text'] ) )
        update_post_meta( $post_id, 'itineraire_meta_box_text', wp_kses( $_POST['itineraire_meta_box_text'] ) );
        
    if( isset( $_POST['mail_meta_box_text'] ) )
        update_post_meta( $post_id, 'mail_meta_box_text', wp_kses( $_POST['mail_meta_box_text'] ) );
        
    if( isset( $_POST['filiale_meta_box_text'] ) )
        update_post_meta( $post_id, 'filiale_meta_box_text', wp_kses( $_POST['filiale_meta_box_text'] ) );
        
    if(isset($_REQUEST[$editor_id]))
        update_post_meta($_REQUEST['post_ID'], WYSIWYG_META_KEY, $_REQUEST[$editor_id]);
}


#=======================#
# + Remove slug
#=======================#

function entreprise_remove_cpt_slug( $post_link, $post, $leavename ) {
 
    if ( ! in_array( $post->post_type, array( 'entreprise_sector' ) ) || 'publish' != $post->post_status )
        return $post_link;
 
    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
 
    return $post_link;
}
add_filter( 'post_type_link', 'entreprise_remove_cpt_slug', 10, 3 );
 
function entreprise_parse_request_tricksy( $query ) {
 
    // Only noop the main query
    if ( ! $query->is_main_query() )
        return;
 
    // Only noop our very specific rewrite rule match
    if ( 2 != count( $query->query )
        || ! isset( $query->query['page'] ) )
        return;
 
    // 'name' will be set if post permalinks are just post_name, otherwise the page rule will match
    if ( ! empty( $query->query['name'] ) )
        $query->set( 'post_type', array( 'entreprise_sector ' ) );
}
add_action( 'pre_get_posts', 'entreprise_parse_request_tricksy' );

#=======================#
# + Galerie fields
#=======================#

add_action( 'admin_init', 'add_post_gallery_so_14445904' );
add_action( 'admin_head-post.php', 'print_scripts_so_14445904' );
add_action( 'admin_head-post-new.php', 'print_scripts_so_14445904' );
add_action( 'save_post', 'update_post_gallery_so_14445904', 10, 2 );

/**
 * Add custom Meta Box to Posts post type
 */
function add_post_gallery_so_14445904() 
{
    add_meta_box(
        'post_gallery',
        'Galerie d\'images',
        'post_gallery_options_so_14445904',
        'entreprise_sector',
        'normal',
        'core'
    );
}

/**
 * Print the Meta Box content
 */
function post_gallery_options_so_14445904() 
{
    global $post;
    $gallery_data = get_post_meta( $post->ID, 'gallery_data', true );

    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'noncename_so_14445904' );
?>

<div id="dynamic_form">

    <div id="field_wrap">
    <?php 
    if ( isset( $gallery_data['image_url'] ) ) 
    {
        for( $i = 0; $i < count( $gallery_data['image_url'] ); $i++ ) 
        {
        ?>

        <div class="field_row">

          <div class="field_left">
            <div class="form_field">
              <label>Image</label>
              <input type="text"
                     class="meta_image_url"
                     name="gallery[image_url][]"
                     value="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>"
              />
            </div>
            <div class="form_field">
              <label>Description</label>
              <input type="text"
                     class="meta_image_desc"
                     name="gallery[image_desc][]"
                     value="<?php esc_html_e( $gallery_data['image_desc'][$i] ); ?>"
              />
            </div>
          </div>

          <div class="field_right image_wrap">
            <img src="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>" height="48" width="48" />
          </div>

          <div class="field_right">
            <input class="button" type="button" value="Sélectionner fichier" onclick="add_image(this)" /><br />
            <input class="button" type="button" value="Supprimer" onclick="remove_field(this)" />
          </div>

          <div class="clear" /></div> 
        </div>
        <?php
        } // endif
    } // endforeach
    ?>
    </div>

    <div style="display:none" id="master-row">
    <div class="field_row">
        <div class="field_left">
            <div class="form_field">
                <label>Image</label>
                <input class="meta_image_url" value="" type="text" name="gallery[image_url][]" />
            </div>
            <div class="form_field">
                <label>Description</label>
                <input class="meta_image_desc" value="" type="text" name="gallery[image_desc][]" />
            </div>
        </div>
        <div class="field_right image_wrap">
        </div> 
        <div class="field_right"> 
            <input type="button" class="button" value="Sélectionner fichier" onclick="add_image(this)" />
            <br />
            <input class="button" type="button" value="Supprimer" onclick="remove_field(this)" /> 
        </div>
        <div class="clear"></div>
    </div>
    </div>

    <div id="add_field_row">
      <input class="button" type="button" value="Ajouter champ" onclick="add_field_row();" />
    </div>

</div>

  <?php
}

/**
 * Print styles and scripts
 */
function print_scripts_so_14445904()
{
    // Check for correct post_type
    global $post;
    if( 'entreprise_sector' != $post->post_type )
        return;
    ?>  
    <style type="text/css">
      .field_left {
        float:left;
      }

      .field_right {
        float:right;
        margin-left:10px;
      }
      
      .field_right input{
        margin-bottom: 3px !important;
      }

      .clear {
        clear:both;
      }

      #dynamic_form {
        width:100%;
      }

      #dynamic_form input[type=text] {
        width:800px;
      }

      #dynamic_form .field_row {
        border:1px solid #999;
        margin-bottom:10px;
        padding:10px;
      }

      #dynamic_form label {
        padding:0 6px;
        display: inline-block;
        width: 100px;
      }
    </style>

    <script type="text/javascript">
        function add_image(obj) {
            var parent=jQuery(obj).parent().parent('div.field_row');
            var inputField = jQuery(parent).find("input.meta_image_url");

            tb_show('', 'media-upload.php?TB_iframe=true');

            window.send_to_editor = function(html) {
                var url = jQuery(html).find('img').attr('src');
                inputField.val(url);
                jQuery(parent)
                .find("div.image_wrap")
                .html('<img src="'+url+'" height="48" width="48" />');

                // inputField.closest('p').prev('.awdMetaImage').html('<img height=120 width=120 src="'+url+'"/><p>URL: '+ url + '</p>'); 

                tb_remove();
            };

            return false;  
        }

        function remove_field(obj) {
            var parent=jQuery(obj).parent().parent();
            //console.log(parent)
            parent.remove();
        }

        function add_field_row() {
            var row = jQuery('#master-row').html();
            jQuery(row).appendTo('#field_wrap');
        }
    </script>
    <?php
}

/**
 * Save post action, process fields
 */
function update_post_gallery_so_14445904( $post_id, $post_object ) 
{
    // Doing revision, exit earlier **can be removed**
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;

    // Doing revision, exit earlier
    if ( 'revision' == $post_object->post_type )
        return;

    // Verify authenticity
    if ( !wp_verify_nonce( $_POST['noncename_so_14445904'], plugin_basename( __FILE__ ) ) )
        return;

    // Correct post type
    if ( 'entreprise_sector' != $_POST['post_type'] ) 
        return;

    if ( $_POST['gallery'] ) 
    {
        // Build array for saving post meta
        $gallery_data = array();
        for ($i = 0; $i < count( $_POST['gallery']['image_url'] ); $i++ ) 
        {
            if ( '' != $_POST['gallery']['image_url'][ $i ] ) 
            {
                $gallery_data['image_url'][]  = $_POST['gallery']['image_url'][ $i ];
                $gallery_data['image_desc'][] = $_POST['gallery']['image_desc'][ $i ];
            }
        }

        if ( $gallery_data ) 
            update_post_meta( $post_id, 'gallery_data', $gallery_data );
        else 
            delete_post_meta( $post_id, 'gallery_data' );
    } 
    // Nothing received, all fields are empty, delete option
    else 
    {
        delete_post_meta( $post_id, 'gallery_data' );
    }
}