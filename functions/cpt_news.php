<?
#=================================================================#
# Cpt News
#=================================================================#

function create_newsdesfiliales_cpt() {

	$labels = array(
		'name' => __( 'News des filiales', 'Post Type General Name', 'Gestion des actualités des filiales' ),
		'singular_name' => __( 'News des filiales', 'Post Type Singular Name', 'Gestion des actualités des filiales' ),
		'menu_name' => __( 'News des filiales', 'Gestion des actualités des filiales' ),
		'name_admin_bar' => __( 'News des filiales', 'Gestion des actualités des filiales' ),
		'archives' => __( 'Archives News des filiales', 'Gestion des actualités des filiales' ),
		'attributes' => __( 'Attributs News des filiales', 'Gestion des actualités des filiales' ),
		'parent_item_colon' => __( 'Parents News des filiales:', 'Gestion des actualités des filiales' ),
		'all_items' => __( 'Toutes les news des filiales', 'Gestion des actualités des filiales' ),
		'add_new_item' => __( 'Ajouter nouvelle news des filiales', 'Gestion des actualités des filiales' ),
		'add_new' => __( 'Ajouter', 'Gestion des actualités des filiales' ),
		'new_item' => __( 'Nouvelle News des filiales', 'Gestion des actualités des filiales' ),
		'edit_item' => __( 'Modifier News des filiales', 'Gestion des actualités des filiales' ),
		'update_item' => __( 'Mettre à jour News des filiales', 'Gestion des actualités des filiales' ),
		'view_item' => __( 'Voir News des filiales', 'Gestion des actualités des filiales' ),
		'view_items' => __( 'Voir News des filiales', 'Gestion des actualités des filiales' ),
		'search_items' => __( 'Rechercher dans les News des filiales', 'Gestion des actualités des filiales' ),
		'not_found' => __( 'Aucun News des filialestrouvé.', 'Gestion des actualités des filiales' ),
		'not_found_in_trash' => __( 'Aucun News des filialestrouvé dans la corbeille.', 'Gestion des actualités des filiales' ),
		'featured_image' => __( 'Image mise en avant', 'Gestion des actualités des filiales' ),
		'set_featured_image' => __( 'Définir l’image mise en avant', 'Gestion des actualités des filiales' ),
		'remove_featured_image' => __( 'Supprimer l’image mise en avant', 'Gestion des actualités des filiales' ),
		'use_featured_image' => __( 'Utiliser comme image mise en avant', 'Gestion des actualités des filiales' ),
		'insert_into_item' => __( 'Insérer dans News des filiales', 'Gestion des actualités des filiales' ),
		'uploaded_to_this_item' => __( 'Téléversé sur cet News des filiales', 'Gestion des actualités des filiales' ),
		'items_list' => __( 'Liste News des filiales', 'Gestion des actualités des filiales' ),
		'items_list_navigation' => __( 'Navigation de la liste News des filiales', 'Gestion des actualités des filiales' ),
		'filter_items_list' => __( 'Filtrer la liste News des filiales', 'Gestion des actualités des filiales' ),
	);

	$args = array(
		'label' => __( 'News des filiales', 'Gestion des actualités des filiales' ),
		'description' => __( 'Gestion des actualités des filiales', 'Gestion des actualités des filiales' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-format-aside',
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'author', 'custom-fields', ),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => false,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
        'rewrite' => array(
            'slug' => 'actualites-des-filiales'
        )
	);
	register_post_type( 'newsdesfiliales', $args );
}

add_action( 'init', 'create_newsdesfiliales_cpt', 0 );


function news_entreprise_taxonomy( $meta_boxes ) {
	$prefix = 'prefix-';
	$meta_boxes[] = array(
		'id' => 'taxonomyentreprises',
		'title' => esc_html__( 'Taxonomy entreprises', 'news-entreprise-taxonomy' ),
		'post_types' => 'newsdesfiliales',
		'context' => 'normal',
		'priority' => 'default',
		'autosave' => false,
		'fields' => array(
			array(
				'id' => $prefix . 'entreprise',
				'type' => 'post',
				'name' => esc_html__( 'Entreprise', 'news-entreprise-taxonomy' ),
				'desc' => esc_html__( 'Sélectionner l\'entreprise relative à cette nouvelle news', 'news-entreprise-taxonomy' ),
				'post_type' => 'entreprise_sector',
				'field_type' => 'select',
			),
		),
	);

	return $meta_boxes;

}

add_filter( 'rwmb_meta_boxes', 'news_entreprise_taxonomy' );


#=================================================================#
# Metabox
#=================================================================#

add_action( 'add_meta_boxes', 'cpt_news_filiale_meta_box_add' );

function cpt_news_filiale_meta_box_add()
{
   add_meta_box( 'gps-meta-box-id', 'Filiale', 'cpt_entreprise_news_filiale_meta_box_display', 'newsdesfiliales', 'normal', 'high' );
}

// Dislay metabox
function cpt_entreprise_news_filiale_meta_box_display( $post )
{
	$args = array(
		'numberposts' => 999,
		'post_type' => 'entreprise_sector',
		'status' => 'publish',
		'suppress_filters' => 0,
	);

	$entreprises = get_posts( $args );

	$values = get_post_meta( $post->ID,'filiale_referente', true);
	$valuesArr = explode(",",$values);
	?>

	<p>
		<label for="filiale_referente" class="filiale_referente">Filiale référente : </label>
		<select name='filiale_referente[]' id='filiale_referente' class="filiale_referente_s" multiple="multiple" size="12">
			<?php foreach ($entreprises as $entreprise): ?>
			<option <?php if( in_array($entreprise->ID,$valuesArr)) :?> selected="true" <?php endif;?>value="<?php echo esc_attr($entreprise->ID); ?>"><?php echo esc_html($entreprise->post_title); ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<!--   style for select form -->
	<style type="text/css">
		.filiale_referente{
			font-weight: bold;
			font-size: 16px;
		}
		.filiale_referente_s{
			width: 100%;
			font-weight: bold;
			height: 230px !important;
		}
	</style>



	<?php ;
		

}




// Save metabox

add_action( 'save_post', 'cpt_news_filiale_meta_box_save' );

function cpt_news_filiale_meta_box_save( $post_id )

{

	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	if( !current_user_can( 'edit_post', $post_id ) ) return;





	if( isset( $_POST['filiale_referente'] ) )

		update_post_meta( $post_id, 'filiale_referente', implode(",",$_POST['filiale_referente']) );



}


/* 

//Original single choice for filiale news



// Add metabox

add_action( 'add_meta_boxes', 'cpt_news_filiale_meta_box_add' );

function cpt_news_filiale_meta_box_add()

{

    add_meta_box( 'gps-meta-box-id', 'Filiale', 'cpt_entreprise_news_filiale_meta_box_display', 'newsdesfiliales', 'normal', 'high' );

}



// Dislay metabox

function cpt_entreprise_news_filiale_meta_box_display( $post )

{

    $args = array(

        'numberposts' => 999,

        'post_type' => 'entreprise_sector',

        'status' => 'publish',

        'suppress_filters' => 0,

    );

    $entreprises = get_posts( $args );

    

    $values = get_post_custom( $post->ID );

    $text = isset( $values['filiale_referente'] ) ? esc_attr( $values['filiale_referente'][0] ) : '';

    ?>

    <p>

        <label for="filiale_referente">Filiale référente : </label>

        <select name='filiale_referente' id='filiale_referente'>

            <?php foreach ($entreprises as $entreprise): ?>

            <option <?php if($text == $entreprise->ID) :?> selected="true" <?php endif;?>value="<?php echo esc_attr($entreprise->ID); ?>"><?php echo esc_html($entreprise->post_title); ?></option>

            <?php endforeach; ?>

        </select>

    </p>

    

    <?php   

}



// Save metabox 

add_action( 'save_post', 'cpt_news_filiale_meta_box_save' );

function cpt_news_filiale_meta_box_save( $post_id )

{

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    if( !current_user_can( 'edit_post', $post_id ) ) return;



    if( isset( $_POST['filiale_referente'] ) )

        update_post_meta( $post_id, 'filiale_referente', wp_kses( $_POST['filiale_referente'] ) );





} */