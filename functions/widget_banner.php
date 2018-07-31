<?php
#=================================================================#
# Banner widget
#=================================================================#

#=======================#a
# + Register new sidebar
#=======================#

add_action('widgets_init', 'banner_widget_init');
function banner_widget_init() {
    register_widget("Banner_Widget");
}

#=======================#
# + Register js
#=======================#

//Enqueue WordPress media JS to handle image upload dialog box
add_action('admin_enqueue_scripts', 'banner_widget_scripts');
function banner_widget_scripts() {
    global $pagenow;
    if( $pagenow == 'widgets.php' ){
        wp_enqueue_media();
    }
}
 
#=======================#
# + Widget class
#=======================#
 
//Create a class extending WP_Widget
class Banner_Widget extends WP_Widget {
 
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'banner_widget', // Base ID
            'Bannière', // Name
            array( 'description' => __( 'Bannière personnalisée' ) ) // Args
        );
    }
 
    /**
     * Widget Front-end display
     */
    public function widget( $args, $instance ) {
         
        $img = $instance['img'];
        $url = $instance['url'];
        $title = $instance['title'];
        $subtitle = $instance['subtitle'];
        $description = $instance['description'];
        $button = $instance['button'];
        
        ?>
            <div class="block_banner" style="background-image:url(<?php echo $img;?>)">
                <div class="container">
                    <div class="caption">
                        <h2><?php echo $title;?></h2>
                        <h3><?php echo $subtitle;?></h3>
                        <hr noshade>
                        <p><?php echo $description;?></p>
                        <a href="<?php echo $url;?>" class="btn btn-primary"><?php echo $button;?></a>
                    </div>
                </div>
            </div>
        <?php
    
    }
 
    /**
     * Sanitize widget form values as they are saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
 
        $instance['img'] = strip_tags( $new_instance['img'] );
        $instance['url'] = strip_tags( $new_instance['url'] );
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
        $instance['button'] = strip_tags( $new_instance['button'] );
        $instance['description'] = $new_instance['description'];
 
        return $instance;
    }
 
    /**
     * Back-end widget form.
     */
    public function form( $instance ) {
         
        $img = isset( $instance[ 'img' ] ) ? $instance[ 'img' ] : '';
        $url = isset( $instance[ 'url' ] ) ? $instance[ 'url' ] : '';
        $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        $subtitle = isset( $instance[ 'subtitle' ] ) ? $instance[ 'subtitle' ] : '';
        $button  = isset( $instance[ 'button' ] ) ? $instance[ 'button' ] : '';
        $description  = isset( $instance[ 'description' ] ) ? $instance[ 'description' ] : '';
         
        $img_field_id = $this->get_field_id('img');
         
        ?>
         
        <p>
            <label for="<?php echo $img_field_id ?>">Image :</label><br/>
            <input class="upload_image" id="<?php echo $img_field_id ?>" type="hidden" name="<?php echo $this->get_field_name('img') ?>" value="<?php echo $img ?>" />
            <input class="upload_image_button" id="<?php echo $img_field_id ?>_button" type="button" value="Charger une image" data-field-id="<?php echo $img_field_id ?>" />
            <div id="<?php echo $img_field_id ?>_img" class="upload_image_wrapper">
                <?php if( !empty($img) ):?>
                    <img src="<?php echo $img ?>" />
                    <a href="#" class="upload_image_delete" data-field-id="<?php echo $img_field_id ?>">Supprimer l'image</a>
                <?php endif ?>
            </div>
        </p>
         
        
         
        <p>
            <label for="<?php echo $this->get_field_id('title') ?>">Titre de la bannière :</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" type="text" value="<?php echo esc_attr($title) ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('subtitle') ?>">Sous titre de la bannière :</label>
            <input class="widefat" id="<?php echo $this->get_field_id('subtitle') ?>" name="<?php echo $this->get_field_name('subtitle') ?>" type="text" value="<?php echo esc_attr($subtitle) ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('description') ?>">Description de la bannière :</label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('description') ?>" name="<?php echo $this->get_field_name('description') ?>"><?php echo esc_attr($description) ?></textarea>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('button') ?>">Texte du bouton :</label>
            <input class="widefat" id="<?php echo $this->get_field_id('button') ?>" name="<?php echo $this->get_field_name('button') ?>" type="text" value="<?php echo esc_attr($button) ?>" />
        </p>
         
        <p>
            <label for="<?php echo $this->get_field_id('url') ?>">URL du lien :</label>
            <input class="widefat" id="<?php echo $this->get_field_id('url') ?>" name="<?php echo $this->get_field_name('url') ?>" type="text" value="<?php echo esc_attr($url) ?>" />
        </p>
         
        <style>
            .upload_image_wrapper img{ width:100% }
        </style>
         
        <script>
                //Le code suivant doit normalement être positionné dans un fichier Javascript séparé,
                //notamment dans le cas où on positionne plusieurs fois le widget dans l'interface, 
                //sinon le "jQuery(document).ready()" ci-dessous est lancé autant de fois que le nombre  
                //de widgets positionnés. Ca fonctionne car on fait des "unbind()" mais 
                //ce n'est pas optimisé.
 
                var upload_image_custom_uploaders = upload_image_custom_uploaders || {};
             
                jQuery(document).ready(function($){
  
                        $('.upload_image_button').unbind().click(function(e) {
  
                                e.preventDefault();
  
                                var field_id = $(this).data('field-id');
                     
                                //If the uploader object has already been created, reopen the dialog
                                if( upload_image_custom_uploaders.hasOwnProperty( field_id ) ) {
                                        upload_image_custom_uploaders[field_id].open();
                                        return;
                                }
               
                                //Extend the wp.media object
                                var upload_image_custom_uploader = wp.media.frames.file_frame = wp.media({
                                        title: 'Choisir une image',
                                        button: {
                                            text: 'Choisir cette image'
                                        },
                                        multiple: false
                                });
                     
                                upload_image_custom_uploaders[field_id] = upload_image_custom_uploader;
               
                                //When a file is selected, grab the URL and set it as the text field's value
                                upload_image_custom_uploader.on('select', function() {
                                        attachment = upload_image_custom_uploader.state().get('selection').first().toJSON();
                                        $('#'+ field_id).val(attachment.url);
                                        $('#'+ field_id +'_img').html('<img src="'+ attachment.url +'" />');
                                });
               
                                //Open the uploader dialog
                                upload_image_custom_uploader.open();
               
                        });
  
                        $('.upload_image_delete').unbind().click(function(e){
                                e.preventDefault();
                                var field_id = $(this).data('field-id');
                                $('#'+ field_id).val('');
                                $('#'+ field_id +'_img').html('');
                        });
               
                });
        </script>
         
        <?php
    }
 
}