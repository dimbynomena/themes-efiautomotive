<?php
#=================================================================#
# CallToAction widget
#=================================================================#

#=======================#a
# + Register new sidebar
#=======================#

add_action('widgets_init', 'cta_widget_init');
function cta_widget_init() {
    register_widget("Cta_Widget");
}

#=======================#
# + Register js
#=======================#

//Enqueue WordPress media JS to handle image upload dialog box
add_action('admin_enqueue_scripts', 'cta_widget_scripts');
function cta_widget_scripts() {
    global $pagenow;
    if( $pagenow == 'widgets.php' ){
        wp_enqueue_media();
    }
}
 
#=======================#
# + Widget class
#=======================#
 
//Create a class extending WP_Widget
class Cta_Widget extends WP_Widget {
 
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'cta_widget', // Base ID
            'Call To Action', // Name
            array( 'description' => __( 'Call to Action' ) ) // Args
        );
    }
 
    /**
     * Widget Front-end display
     */
    public function widget( $args, $instance ) {
         
        $img = $instance['img'];
        $url = $instance['url'];
        $title = $instance['title'];
        $description = $instance['description'];
        $button = $instance['button'];
        $logo = $instance['logo'];
        $width = $instance['width'];
        
        /*if($width == 'full') :
        ?>
        <div class="col-xs-12 col-sm-12 col-lg-12 block_cta col-centered">
        <?php else :?>
        <div class="col-xs-12 col-sm-6 col-lg-6 block_cta col-centered">
        <?php endif;?>
            <div fncScrollToTarget="<?php echo sanitize_title($title)?>" class="element" style="background-image:url(<?php echo $img;?>)">
                <div class="background"></div>
                <div class="container">
                    <div class="caption" fnc-ctaElement>
                        <img src="<?php echo $logo;?>"/>
                        <h2><?php echo $title;?></h2>
                        <hr noshade>
                        <p><?php echo $description;?></p>
                        <a href="<?php echo $url;?>" class="btn btn-primary"><?php echo $button;?></a>
                    </div>
                </div>
            </div>
        </div>
        <?php*/?>
        
        <div class="col-xs-12 col-md-4 UnWidgetCTA">
            <div class="caption" fnc-ctaElement>
                <img src="<?php echo $logo;?>"/>
                <h2><?php echo $title;?></h2>
                <hr noshade>
                <p><?php echo $description;?></p>
                <a href="<?php echo $url;?>" class="btn btn-primary"><?php echo $button;?></a>
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
        $instance['button'] = strip_tags( $new_instance['button'] );
        $instance['description'] = strip_tags( $new_instance['description'] );
        $instance['logo'] = strip_tags( $new_instance['logo'] );
        $instance['width'] = strip_tags( $new_instance['width'] );
 
        return $instance;
    }
 
    /**
     * Back-end widget form.
     */
    public function form( $instance ) {
         
        $img = isset( $instance[ 'img' ] ) ? $instance[ 'img' ] : '';
        $url = isset( $instance[ 'url' ] ) ? $instance[ 'url' ] : '';
        $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        $button  = isset( $instance[ 'button' ] ) ? $instance[ 'button' ] : '';
        $description  = isset( $instance[ 'description' ] ) ? $instance[ 'description' ] : '';
        $logo  = isset( $instance[ 'logo' ] ) ? $instance[ 'logo' ] : '';
        $width  = isset( $instance[ 'width' ] ) ? $instance[ 'width' ] : '';
         
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
            <label for="<?php echo $this->get_field_id('title') ?>">Titre du CTA :</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" type="text" value="<?php echo esc_attr($title) ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('description') ?>">Description du CTA :</label>
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
        
        <p>
            <label for="<?php echo $this->get_field_id('logo') ?>">URL du logo :</label>
            <input class="widefat" id="<?php echo $this->get_field_id('logo') ?>" name="<?php echo $this->get_field_name('logo') ?>" type="text" value="<?php echo esc_attr($logo) ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('width') ?>">Format (full ou half) :</label>
            <input class="widefat" id="<?php echo $this->get_field_id('width') ?>" name="<?php echo $this->get_field_name('width') ?>" type="text" value="<?php echo esc_attr($width) ?>" />
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