<?php
#=================================================================#
# Page
#=================================================================#

#=======================#
# + Add subtitle field for page
#=======================#

// Add metabox
add_action( 'add_meta_boxes', 'page_meta_box_add' );
function page_meta_box_add()
{
    add_meta_box( 'subtitle-meta-box-id', 'Sous titre', 'subtitle_meta_box_display', 'page', 'normal', 'high' );
    add_meta_box( 'map-meta-box-id', 'Filiales', 'map_meta_box_display', 'page', 'normal', 'high' );
}

// Dislay metabox subtitle
function subtitle_meta_box_display( $post )
{
    $values = get_post_custom( $post->ID );
    $text = isset( $values['subtitle_meta_box_text'] ) ? esc_attr( $values['subtitle_meta_box_text'][0] ) : '';
    wp_nonce_field( 'subtitle_meta_box_nonce', 'meta_box_nonce' );
    ?>
        <p class="post-attributes-label-wrapper">
            <label class="post-attributes-label" for="subtitle_meta_box_text">Ajouter un sous titre</label>  
        </p>
        <input type="text" name="subtitle_meta_box_text" id="subtitle_meta_box_text" value="<?php echo $text; ?>" />
    <?php   
}

// Dislay metabox subtitle
function map_meta_box_display( $post )
{
    $values = get_post_custom( $post->ID );
    $text = isset( $values['map_meta_box_text'] ) ? esc_attr( $values['map_meta_box_text'][0] ) : '';
    ?>
        <p class="post-attributes-label-wrapper">
            <label class="post-attributes-label" for="map_meta_box_text">Afficher les filiales</label>   
        </p>
        <select name="map_meta_box_text" id="map_meta_box_text">
            <option <?php if($text && $text == "non") : echo 'selected="true"'; endif;?> value="non">Non</option>
            <option <?php if($text && $text == "oui") : echo 'selected="true"'; endif;?> value="oui">Oui</option>
        </select>
    <?php   
}

// Save metabox
add_action( 'save_post', 'page_meta_box_save' );
function page_meta_box_save( $post_id )
{
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'subtitle_meta_box_nonce' ) ) return;
    if( !current_user_can( 'edit_post', $post_id ) ) return;

    if( isset( $_POST['subtitle_meta_box_text'] ) )
        update_post_meta( $post_id, 'subtitle_meta_box_text', wp_kses( $_POST['subtitle_meta_box_text'] ) );
        
    if( isset( $_POST['map_meta_box_text'] ) )
        update_post_meta( $post_id, 'map_meta_box_text', wp_kses( $_POST['map_meta_box_text'] ) );
}

#=======================#
# + Custom fields
#=======================#

add_action( 'admin_init', 'add_post_fields_so_14445904' );
add_action( 'admin_head-post.php', 'print_scripts_fields_so_14445904' );
add_action( 'admin_head-post-new.php', 'print_scripts_fields_so_14445904' );
add_action( 'save_post', 'update_post_fields_so_14445904', 10, 2 );

/**
 * Add custom Meta Box to Posts post type
 */
function add_post_fields_so_14445904() 
{
    add_meta_box(
        'post_fields',
        'Champs personnalisés répétables',
        'post_fields_options_so_14445904',
        'page',
        'normal',
        'core'
    );
}

/**
 * Print the Meta Box content
 */
function post_fields_options_so_14445904() 
{
    global $post;
    $fields_data = get_post_meta( $post->ID, 'fields_data', true );

    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'noncename_so_14445904' );
?>

<div id="dynamic_form">

    <div id="field_wrap">
    <?php 
    if ( isset( $fields_data['image_url'] ) ) 
    {
        for( $i = 0; $i < count( $fields_data['image_url'] ); $i++ ) 
        {
        ?>

        <div class="field_row">

          <div class="field_left">
            <div class="form_field">
              <label>Image</label>
              <input type="text"
                     class="meta_image_url"
                     name="fields[image_url][]"
                     value="<?php esc_html_e( $fields_data['image_url'][$i] ); ?>"
              />
            </div>
            <div class="form_field">
              <label>Titre</label>
              <input type="text"
                     class="meta_image_desc"
                     name="fields[image_desc][]"
                     value="<?php esc_html_e( $fields_data['image_desc'][$i] ); ?>"
              />
            </div>
            <div class="form_field">
              <label>Contenu</label>
                <?php
                wysiwyg_render_fields_meta_box($fields_data['image_html'][$i]);
                ?>
            </div>
            
          </div>

          <div class="field_right image_wrap">
            <img src="<?php esc_html_e( $fields_data['image_url'][$i] ); ?>" height="48" width="48" />
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
                <input class="meta_image_url" value="" type="text" name="fields[image_url][]" />
            </div>
            <div class="form_field">
                <label>Titre</label>
                <input class="meta_image_desc" value="" type="text" name="fields[image_desc][]" />
            </div>
            <div class="form_field">
                <label>Contenu</label>
                <?php
                wysiwyg_render_fields_meta_box();
                ?>
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
function print_scripts_fields_so_14445904()
{
    // Check for correct post_type
    global $post;
    if( 'page' != $post->post_type )
        return;
    ?>  
    <style type="text/css">
      .field_left {
        float:left;
        width: 80%;
      }
      
      #dynamic_form .form_field{
        margin-bottom:5px;
      }

      .field_right {
        float:right;
        margin-left:10px;
      }
      
      .field_right input{
        margin-bottom: 3px !important;
      }
      
      .field_left .wp-editor-wrap{
        margin-top:5px;
      }
      
      .field_left .wp-editor-area{
        max-height:200px;
      }

      .clear {
        clear:both;
      }

      #dynamic_form {
        width:100%;
      }

      #dynamic_form input[type=text] {
        width: 100%!important;
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
function update_post_fields_so_14445904( $post_id, $post_object ) 
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
    if ( 'page' != $_POST['post_type'] ) 
        return;

    if ( $_POST['fields'] ) 
    {
        // Build array for saving post meta
        $fields_data = array();
        for ($i = 0; $i < count( $_POST['fields']['image_url'] ); $i++ ) 
        {
            if ( '' != $_POST['fields']['image_url'][ $i ] ) 
            {
                $fields_data['image_url'][]  = $_POST['fields']['image_url'][ $i ];
                $fields_data['image_desc'][] = $_POST['fields']['image_desc'][ $i ];
                $fields_data['image_html'][] = $_POST['fields']['image_html'][ $i ];
            }
        }

        if ( $fields_data ) 
            update_post_meta( $post_id, 'fields_data', $fields_data );
        else 
            delete_post_meta( $post_id, 'fields_data' );
    } 
    // Nothing received, all fields are empty, delete option
    else 
    {
        delete_post_meta( $post_id, 'fields_data' );
    }
}

function wysiwyg_render_fields_meta_box($save_data = null){
	        
        $meta_box_id = 145;
        $editor_id = 'fields[image_html][]';
        
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
        $content = $save_data;
        the_editor($content, $editor_id);
        
        //Clear The Room!
        echo "<div style='clear:both; display:block;'></div>";
}