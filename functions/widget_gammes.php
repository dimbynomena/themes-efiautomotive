<?php
#=================================================================#
# Banner widget
#=================================================================#

#=======================#
# + Register new sidebar
#=======================#

add_action('widgets_init', 'gammes_widget_init');
function gammes_widget_init() {
    register_widget("Gammes_Widget");
}

#=======================#
# + Register js
#=======================#

//Enqueue WordPress media JS to handle image upload dialog box
add_action('admin_enqueue_scripts', 'gammes_widget_scripts');
function gammes_widget_scripts() {
    global $pagenow;
    if( $pagenow == 'widgets.php' ){
        wp_enqueue_media();
    }
}
 
#=======================#
# + Widget class
#=======================#
 
//Create a class extending WP_Widget
class Gammes_Widget extends WP_Widget {
 
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'gammes_widget', // Base ID
            'Gammes', // Name
            array( 'description' => __( 'Liste des gammes' ) ) // Args
        );
    }
 
    /**
     * Widget Front-end display
     */
    public function widget( $args, $instance ) {
         
        $title = $instance['title'];
        $categories = get_main_portfolio_categories();
		$page = get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['page_applications_'.ICL_LANGUAGE_CODE];
		$page = get_post($page);
        ?>
            <div class="widget widget_recent_entries">
                <h4><?php echo $title;?></h4>
                <hr noshade/>
                <ul>
                    <?php foreach($categories as $category) :
                        if ($category->parent=='0') { ?>
                            <li class="row">
                                <a href="<?php echo get_permalink($page->ID).'#'.$category->slug;?>">
                                    <div class="colxs-12 col-sm-3 col-lg-2 imagecolumn">
    									<img class="imagepost" src="<?php echo $category->term_meta['catimg']?>" alt="<?php echo $article->post_title?>"/>
                                    </div>
                                    <div class="colxs-12 col-sm-9 col-lg-8">
                                        <h5 style="color:<?php echo $category->term_meta['cat_color']?>"><?php echo $category->name?></h5>
                                        <h6><?php echo $category->term_meta['subtitle']; ?></h6>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    <?php endforeach;?>
                </ul>
            </div>
        <?php
    
    }
 
    /**
     * Sanitize widget form values as they are saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = strip_tags( $new_instance['title'] );
        
        // Get checkbox categories by keys
        
        return $instance;
    }
 
    /**
     * Back-end widget form.
     */
    public function form( $instance ) {
         
        $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';         
        
        // Get all categories
        // Make checkbox inputs
        
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title') ?>">Titre :</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" type="text" value="<?php echo esc_attr($title) ?>" />
        </p>

        <?php
    }
 
}