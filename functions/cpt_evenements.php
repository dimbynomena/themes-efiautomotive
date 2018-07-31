<?
#=================================================================#
# Cpt Evenements
#=================================================================#

#=======================#
# + Add evenement cpt in site
#=======================#

function evenements() {

	$labels = array(
		'name'                  => _x( 'Evènements', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Evènement', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Evènement', 'text_domain' ),
		'name_admin_bar'        => __( 'Evènement', 'text_domain' ),
		'archives'              => __( 'Archive des évènements', 'text_domain' ),
		'attributes'            => __( 'Attributs des évènements', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent de l\'évènement', 'text_domain' ),
		'all_items'             => __( 'Tous les évènements', 'text_domain' ),
		'add_new_item'          => __( 'Ajouter un évènement', 'text_domain' ),
		'add_new'               => __( 'Ajouter nouveau', 'text_domain' ),
		'new_item'              => __( 'Nouveau évènement', 'text_domain' ),
		'edit_item'             => __( 'Editer l\'évènement', 'text_domain' ),
		'update_item'           => __( 'Mettre à jour l\'évènement', 'text_domain' ),
		'view_item'             => __( 'Voir l\'évènement', 'text_domain' ),
		'view_items'            => __( 'Voir les évènements', 'text_domain' ),
		'search_items'          => __( 'Rechercher un évènement', 'text_domain' ),
		'not_found'             => __( 'Non trouvé', 'text_domain' ),
		'not_found_in_trash'    => __( 'Non trouvé dans la poubelle', 'text_domain' ),
		'featured_image'        => __( 'Image principale', 'text_domain' ),
		'set_featured_image'    => __( 'Définir l\'image principale', 'text_domain' ),
		'remove_featured_image' => __( 'Enlever l\'image principale', 'text_domain' ),
		'use_featured_image'    => __( 'Utiliser comme image principale', 'text_domain' ),
		'insert_into_item'      => __( 'Insérer dans le nouvel élément', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploader vers cet évènement', 'text_domain' ),
		'items_list'            => __( 'Liste des évènements', 'text_domain' ),
		'items_list_navigation' => __( 'Navigation entre les évènements', 'text_domain' ),
		'filter_items_list'     => __( 'Filter la liste des évènements', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Evènement', 'text_domain' ),
		'description'           => __( 'Gestionnaire d\'évènements', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
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
		'menu_icon' => 'dashicons-calendar',
		'rewrite' => array(
            'slug' => 'evenements'
        ),
		'capability_type'       => 'page',
	);
	register_post_type( 'evenement', $args );

}
add_action( 'init', 'evenements', 0 );

#=======================#
# + Add taxonomy to evenements
#=======================#

function evenement_categories() {

	$labels = array(
		'name'                       => _x( 'Catégories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Catégorie', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Catégories', 'text_domain' ),
		'all_items'                  => __( 'Toutes les catégories', 'text_domain' ),
		'parent_item'                => __( 'Catégorie parente', 'text_domain' ),
		'parent_item_colon'          => __( 'Catégorie parente', 'text_domain' ),
		'new_item_name'              => __( 'Nouveau nom de la catégorie', 'text_domain' ),
		'add_new_item'               => __( 'Ajouter nouvelle catégorie', 'text_domain' ),
		'edit_item'                  => __( 'Editer la catégorie', 'text_domain' ),
		'update_item'                => __( 'Mettre à jour la catégorie', 'text_domain' ),
		'view_item'                  => __( 'Voir la catégorie', 'text_domain' ),
		'separate_items_with_commas' => __( 'Séparer les catégories avec des virgules', 'text_domain' ),
		'add_or_remove_items'        => __( 'Ajouter ou supprimer des catégories', 'text_domain' ),
		'choose_from_most_used'      => __( 'Sélectionner par la plus utilisée', 'text_domain' ),
		'popular_items'              => __( 'Catégories populaires', 'text_domain' ),
		'search_items'               => __( 'Rechecher des catégories', 'text_domain' ),
		'not_found'                  => __( 'Non trouvé', 'text_domain' ),
		'no_terms'                   => __( 'Aucun élément', 'text_domain' ),
		'items_list'                 => __( 'Liste des catégories', 'text_domain' ),
		'items_list_navigation'      => __( 'Navigation entre les catégories', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => false,
	);
	register_taxonomy( 'evenement_categories', array( 'evenement' ), $args );

}
add_action( 'init', 'evenement_categories', 0 );

#=======================#
# + Add metabox to evenements
#=======================#

class evnementsMetabox {
	private $screen = array(
		'evenement',
	);
	private $meta_fields = array(
		array(
			'label' => 'Date de début',
			'id' => 'datededbut_33725',
			'type' => 'date',
		),
		array(
			'label' => 'Date de fin',
			'id' => 'datedefin_52933',
			'type' => 'date',
		),
		array(
			'label' => 'Nombre de places max.',
			'id' => 'nombredeplacesm_36736',
			'type' => 'number',
		),
		array(
			'label' => 'Localisation',
			'id' => 'localisation_78494',
			'type' => 'text',
		),
	);
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'evnements',
				__( 'Evènements', 'textdomain' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'normal',
				'default'
			);
		}
	}
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'evnements_data', 'evnements_nonce' );
		$this->field_generator( $post );
	}
	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
			if ( empty( $meta_value ) ) {
				$meta_value = $meta_field['default']; }
			switch ( $meta_field['type'] ) {
				case 'textarea':
					$input = sprintf(
						'<textarea style="width: 100%%" id="%s" name="%s" rows="5">%s</textarea>',
						$meta_field['id'],
						$meta_field['id'],
						$meta_value
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}
	public function format_rows( $label, $input ) {
		return '<tr><th>'.$label.'</th><td>'.$input.'</td></tr>';
	}
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['evnements_nonce'] ) )
			return $post_id;
		$nonce = $_POST['evnements_nonce'];
		if ( !wp_verify_nonce( $nonce, 'evnements_data' ) )
			return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
						break;
					case 'text':
						$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
						break;
				}
				update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}
}
if (class_exists('evnementsMetabox')) {
	new evnementsMetabox;
};
