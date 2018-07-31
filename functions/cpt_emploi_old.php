<?
#=================================================================#
# Cpt Offres d'emploi
#=================================================================#

#=======================#
# + Add offresemploi cpt to site
#=======================#

function offresemploi() {

	$labels = array(
		'name'                  => _x( 'Offres d\'emploi', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Offre d\'emploi', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Offres d\'emploi', 'text_domain' ),
		'name_admin_bar'        => __( 'Offre d\'emploi', 'text_domain' ),
		'archives'              => __( 'Archive des offres d\'emploi', 'text_domain' ),
		'attributes'            => __( 'Attributs des offres d\'emploi', 'text_domain' ),
		'parent_item_colon'     => __( 'Offre d\'emploi parente', 'text_domain' ),
		'all_items'             => __( 'Toutes les offres d\'emploi', 'text_domain' ),
		'add_new_item'          => __( 'Ajouter nouvelle offre d\'emploi', 'text_domain' ),
		'add_new'               => __( 'Ajouter nouvelle', 'text_domain' ),
		'new_item'              => __( 'Nouvelle offre d\'emploi', 'text_domain' ),
		'edit_item'             => __( 'Editer une offre d\'emploi', 'text_domain' ),
		'update_item'           => __( 'Mettre à jour une offre d\'emploi', 'text_domain' ),
		'view_item'             => __( 'Voir une offre d\'emploi', 'text_domain' ),
		'view_items'            => __( 'Voir les offres d\'emploi', 'text_domain' ),
		'search_items'          => __( 'Rechercher une offre d\'emploi', 'text_domain' ),
		'not_found'             => __( 'Non trouvé', 'text_domain' ),
		'not_found_in_trash'    => __( 'Non trouvé dans la poubelle', 'text_domain' ),
		'featured_image'        => __( 'Image principale', 'text_domain' ),
		'set_featured_image'    => __( 'Définir l\'image principale', 'text_domain' ),
		'remove_featured_image' => __( 'Enlever l\'image principale', 'text_domain' ),
		'use_featured_image'    => __( 'Utiliser comme image principale', 'text_domain' ),
		'insert_into_item'      => __( 'Insérer dans le nouvel élément', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploader vers cette offre d\'emploi', 'text_domain' ),
		'items_list'            => __( 'Liste des offres d\'emploi', 'text_domain' ),
		'items_list_navigation' => __( 'Navigation entre les offres d\'emploi', 'text_domain' ),
		'filter_items_list'     => __( 'Filtrer la liste des offres d\'emploi', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Offre d\'emploi', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => true,
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
		'menu_icon' => 'dashicons-location-alt',
		'rewrite' => array(
            'slug' => 'offres-emploi'
        ),
		'capability_type'       => 'page',
	);
	register_post_type( 'offresemploi', $args );

}
add_action( 'init', 'offresemploi', 0 );

#=======================#
# + Add offresemploi categories taxonomy to site
#=======================#

function offresemploi_categories() {

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
		'show_tagcloud'              => true
	);
	register_taxonomy( 'offresemploi_categories', array( 'offresemploi' ), $args );

}
add_action( 'init', 'offresemploi_categories', 0 );

#=======================#
# + Add offresemploi type taxonomy to site
#=======================#

function offresemploi_types() {

	$labels = array(
		'name'                       => _x( 'Types de contrats', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Type de contrat', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Types de contrats', 'text_domain' ),
		'all_items'                  => __( 'Tous les types de contrats', 'text_domain' ),
		'parent_item'                => __( 'Type de contrat parent', 'text_domain' ),
		'parent_item_colon'          => __( 'Type de contrat parent', 'text_domain' ),
		'new_item_name'              => __( 'Nouveau nom du type de contrat', 'text_domain' ),
		'add_new_item'               => __( 'Ajouter nouveau type de contrat', 'text_domain' ),
		'edit_item'                  => __( 'Editer le type de contrat', 'text_domain' ),
		'update_item'                => __( 'Mettre à jour le type de contrat', 'text_domain' ),
		'view_item'                  => __( 'Voir le type de contrat', 'text_domain' ),
		'separate_items_with_commas' => __( 'Séparer les types de contrats avec des virgules', 'text_domain' ),
		'add_or_remove_items'        => __( 'Ajouter ou supprimer des types de contrats', 'text_domain' ),
		'choose_from_most_used'      => __( 'Sélectionner par la plus utilisée', 'text_domain' ),
		'popular_items'              => __( 'Types de contrats populaires', 'text_domain' ),
		'search_items'               => __( 'Rechecher des catégories', 'text_domain' ),
		'not_found'                  => __( 'Non trouvé', 'text_domain' ),
		'no_terms'                   => __( 'Aucun élément', 'text_domain' ),
		'items_list'                 => __( 'Liste des types de contrats', 'text_domain' ),
		'items_list_navigation'      => __( 'Navigation entre les types de contrats', 'text_domain' ),
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
	register_taxonomy( 'offresemploi_types', array( 'offresemploi' ), $args );

}
add_action( 'init', 'offresemploi_types', 0 );

#=======================#
# + Add offresemploi type taxonomy to site
#=======================#

class caractristiquesdesoMetabox {
	private $screen = array(
		'offresemploi',
	);
	private $meta_fields = array(
		array(
			'label' => 'Adresse du lieu de travail',
			'id' => 'adressedulieude_73838',
			'type' => 'text',
		),
		array(
			'label' => 'Code postal du lieu de travail',
			'id' => 'codepostal_73838',
			'type' => 'text',
		),
		array(
			'label' => 'Ville du lieu de travail',
			'id' => 'ville_73838',
			'type' => 'text',
		),
		array(
			'label' => 'Pays du lieu de travail',
			'id' => 'pays_73838',
			'type' => 'text',
		),
		array(
			'label' => 'Heures par semaines',
			'id' => 'heuresparsemain_63775',
			'type' => 'number',
		),
		array(
			'label' => 'Salaire estimatif',
			'id' => 'salaireestimati_82291',
			'type' => 'text',
		),
		array(
			'label' => 'Formation(s) exigée(s)',
			'id' => 'formationsexi_82618',
			'type' => 'textarea',
		),
		array(
			'label' => 'Expérience exigée',
			'id' => 'exprienceexig_71777',
			'type' => 'textarea',
		),
		array(
			'label' => 'Certificat ou accréditation exigés',
			'id' => 'certificatouacc_65547',
			'type' => 'textarea',
		),
	);
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'caractristiquesdeso',
				__( 'Caractéristiques des offres', 'textdomain' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'normal',
				'default'
			);
		}
	}
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'caractristiquesdeso_data', 'caractristiquesdeso_nonce' );
		$this->field_generator( $post );
	}
	public function field_generator( $post ) {
		$output = '';
		echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAp6OozsNYTg54zXueGYC_RXNt6bqazgcA&sensor=false&libraries=places" type="text/javascript"></script>';
		echo '
		<script type="text/javascript">
		
		$LocationInfo = {
			geocode: null,
			streetNumber: null,
			street: null,
			city: null,
			state: null,
			country: null,
			postalCode: null,
			reset: function () {
			  this.geocode = null;
			  this.streetNumber = null;
			  this.street = null;
			  this.city = null;
			  this.state = null;
			  this.country = null;
			  this.postalCode = null;
			}
		};
		
		function initialize() {
			var input = document.getElementById("googlemapautocomplete");
			var autocomplete = new google.maps.places.Autocomplete(input, { types: ["address"] });
			google.maps.event.addListener(autocomplete, "place_changed", onPlaceChanged);
		}
		google.maps.event.addDomListener(window, "load", initialize);
		
		function onPlaceChanged() {
			var place = this.getPlace();
            var address = place.address_components;
			
			for(var i=0; i<address.length; i++) {
			  var component = address[i].types[0];
			  switch (component) {
				case "street_number":
				  $LocationInfo.streetNumber = address[i]["long_name"];
				  break;
				case "route":
				  $LocationInfo.street = address[i]["long_name"];
				  break;
				case "locality":
				  $LocationInfo.city = address[i]["long_name"];
				  break;
				case "administrative_area_level_1":
				  $LocationInfo.state = address[i]["long_name"];
				  break;
				case "country":
				  $LocationInfo.country = address[i]["long_name"];
				  break;
				case "postal_code":
				  $LocationInfo.postalCode = address[i]["long_name"];
				  break;
				default:
				  break;
			  }
			}
			
			$(".adressedulieude_73838").val($LocationInfo.street);
			$(".codepostal_73838").val($LocationInfo.postalCode);
			$(".ville_73838").val($LocationInfo.city);
			$(".pays_73838").val($LocationInfo.country);
		}
		
		</script>
		';
		echo '<label><b>Rechercher un lieu : </b></label><input style="width: 100%" id="googlemapautocomplete" name="googlemapautocomplete"  placeholder="Indiquez un lieu" autocomplete="off" type="text">';
		
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
						'<input %s id="%s" class="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
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
		if ( ! isset( $_POST['caractristiquesdeso_nonce'] ) )
			return $post_id;
		$nonce = $_POST['caractristiquesdeso_nonce'];
		if ( !wp_verify_nonce( $nonce, 'caractristiquesdeso_data' ) )
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
if (class_exists('caractristiquesdesoMetabox')) {
	new caractristiquesdesoMetabox;
};

#=======================#
# + Job filters
#=======================#

function get_job_filters()
{
	// Get categories
	$categories = get_terms('offresemploi_categories', array(
		'hide_empty' => false
	));
	
	$categories_html = '
	  <div class="form-group">
	   <label for="catgories">'.__('Catégories','theme-text-domain').' :</label>
	   <select class="form-control" id="job-categories" name="job-categories" onchange="this.form.submit()">
		<option value="all">'.__('Toutes les catégories','theme-text-domain').'</option>
		';
		foreach($categories as $category)
		{
	      $selected = '';
		  if($category->term_id == $_POST['job-categories']) : $selected = 'selected="true"'; endif;
		  $categories_html .= '<option '.$selected.' value="'.$category->term_id.'">'.$category->name.'</option>';
		}
		$categories_html.='
	   </select>
	 </div> 
	';
	
	// Get types
	$types = get_terms('offresemploi_types', array(
		'hide_empty' => false
	));
	
	$types_html = '
	  <div class="form-group">
	   <label for="catgories">'.__('Types de contrats','theme-text-domain').' :</label>
	   <select class="form-control" id="job-contrat" name="job-contrat" onchange="this.form.submit()">
		<option value="all">'.__('Tous les types de contrats','theme-text-domain').'</option>
		';
		foreach($types as $type)
		{
	      $selected = '';
		  if($type->term_id == $_POST['job-contrat']) : $selected = 'selected="true"'; endif;
		  $types_html .= '<option '.$selected.' value="'.$type->term_id.'">'.$type->name.'</option>';
		}
		$types_html.='
	   </select>
	 </div> 
	';

	// Get hours
	
	$hours = array(
		'middle' => 'Temps partiel',
		'full' => 'Temps plein'
	);
	
	$hours_html = '
	  <div class="form-group">
	   <label for="catgories">'.__('Nombre d\'heures','theme-text-domain').' :</label>
	   <select class="form-control" id="job-hours" name="job-hours" onchange="this.form.submit()">
		';
		
		foreach($hours as $key => $hour)
		{
	      $selected = '';
		  if($key == $_POST['job-hours']) : $selected = 'selected="true"'; endif;
		  $hours_html .= '<option '.$selected.' value="'.$key.'">'.$hour.'</option>';
		}
		
		$hours_html .= '
	   </select>
	 </div> 
	';
	
	// Get coutry
	$jobs = get_posts(
		array(
			'posts_per_page' => -1,
			'post_type' => 'offresemploi',
			'suppress_filters' => 0,
		)
	);
	$countries = array();
	foreach($jobs as $job)
	{
	  $countries[get_post_meta($job->ID, 'pays_73838')[0]] = get_post_meta($job->ID, 'pays_73838')[0];
	}
	
	$countries_html = '
	  <div class="form-group">
	   <label for="catgories">'.__('Pays','theme-text-domain').' :</label>
	   <select class="form-control" id="job-country" name="job-country" onchange="this.form.submit()">
		<option value="all">'.__('Mexico-Guadelajara','theme-text-domain').'</option>
		<option value="all">'.__('Usa-plymouth','theme-text-domain').'</option>
		<option value="all">'.__('usa-Elkmont','theme-text-domain').'</option>
		<option value="all">'.__('France-Beynost','theme-text-domain').'</option>
		<option value="all">'.__('France-Joinville','theme-text-domain').'</option>
		<option value="all">'.__('Allemagne','theme-text-domain').'</option>
		<option value="all">'.__('Espagne','theme-text-domain').'</option>
		<option value="all">'.__('Italie','theme-text-domain').'</option>
		<option value="all">'.__('Turquie-Dubullu','theme-text-domain').'</option>
		<option value="all">'.__('Japon-Tokyo','theme-text-domain').'</option>
		<option value="all">'.__('Chine-Wuhan','theme-text-domain').'</option>

		';
		foreach($countries as $country)
		{
	      $selected = '';
		  if($country == $_POST['job-country']) : $selected = 'selected="true"'; endif;
		  $countries_html .= '<option '.$selected.' value="'.$country.'">'.$country.'</option>';
		}
		$countries_html.='
	   </select>
	 </div> 
	';
	
	echo $categories_html;
	echo $types_html;
	echo $hours_html;
	echo $countries_html;
}