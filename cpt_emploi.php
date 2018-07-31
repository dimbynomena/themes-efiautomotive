<?
#=================================================================#
# Cpt Offres d'emploi
#=================================================================#

#=======================#
# + Add offresemploi cpt to site
#=======================#
session_start();

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
/**
 * Generated by the WordPress Meta Box generator
 * at http://jeremyhixon.com/tool/wordpress-meta-box-generator/
 */

function get_meta_file( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function add_meta_boxes() {
	add_meta_box(
		'caractristiquesdeso',
		__( 'Caractéristiques des offres', 'caractristiques_des_offres' ),
		'meta_box_callback',
		'offresemploi',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'add_meta_boxes' );

function meta_box_callback( $post) {
	wp_nonce_field( 'caractristiquesdeso_data', 'caractristiquesdeso_nonce' ); ?>

	<p>
		<label for="adressedulieude_73838" class="labs_"><?php _e( 'Adresse du lieu de travail', 'caractristiques_des_offres' ); ?></label><br>
		<input type="text" name="adressedulieude_73838" id="adressedulieude_73838" value="<?php echo get_meta_file( 'adressedulieude_73838' ); ?>" class="input_datas">
	</p>	<p>
		<label for="codepostal_73838" class="labs_"><?php _e( 'Code postal du lieu de travail', 'caractristiques_des_offres' ); ?></label><br>
		<input type="text" name="codepostal_73838" id="codepostal_73838" value="<?php echo get_meta_file( 'codepostal_73838' ); ?>" class="input_datas">
	</p>	<p>
		<label for="ville_73838" class="labs_"><?php _e( 'Ville du lieu de travail', 'caractristiques_des_offres' ); ?></label><br>
		<select name="ville_73838" id="ville_73838" class="input_datas">
			<option value="" <?php echo (get_meta_file( 'ville_73838' ) === '' ) ? 'selected' : '' ?>>Choix option</option>
			<option <?php echo (get_meta_file( 'ville_73838' ) === 'USA - Plymouth' ) ? 'selected' : '' ?>>USA - Plymouth</option>
			<option <?php echo (get_meta_file( 'ville_73838' ) === 'USA - Elkmont' ) ? 'selected' : '' ?>>USA - Elkmont</option>
			<option <?php echo (get_meta_file( 'ville_73838' ) === 'Mexico - Guadalajara' ) ? 'selected' : '' ?>>Mexico - Guadalajara</option>


            <option <?php echo (get_meta_file( 'ville_73838' ) === 'France - Beynost' ) ? 'selected' : '' ?>>France - Beynost</option>
			<option <?php echo (get_meta_file( 'ville_73838' ) === 'France - Joinville' ) ? 'selected' : '' ?>>France - Joinville</option>
			<option <?php echo (get_meta_file( 'ville_73838' ) === 'Allemagne' ) ? 'selected' : '' ?>>Allemagne</option>
			<option <?php echo (get_meta_file( 'ville_73838' ) === 'Espagne' ) ? 'selected' : '' ?>>Espagne</option>



			<option <?php echo (get_meta_file( 'ville_73838' ) === 'Italie' ) ? 'selected' : '' ?>>Italie</option>
			<option <?php echo (get_meta_file( 'ville_73838' ) === 'Turquie - Dudullu' ) ? 'selected' : '' ?>>Turquie - Dudullu</option>
			<option <?php echo (get_meta_file( 'ville_73838' ) === 'Japon - Tokyo' ) ? 'selected' : '' ?>>Japon - Tokyo</option>
			<option <?php echo (get_meta_file( 'ville_73838' ) === 'Chine - Wuhan' ) ? 'selected' : '' ?>>Chine - Wuhan</option>
		</select>
	</p>	<p>
		<label for="pays_73838" class="labs_"><?php _e( 'Pays du lieu de travail', 'caractristiques_des_offres' ); ?></label><br>
		<input type="text" name="pays_73838" id="pays_73838" value="<?php echo get_meta_file( 'pays_73838' ); ?>" class="input_datas">
	</p>	<p>
		<label for="heuresparsemain_63775" class="labs_"><?php _e( 'Heures par semaines', 'caractristiques_des_offres' ); ?></label><br>
		<select name="heuresparsemain_63775" id="heuresparsemain_63775" class="input_datas">
			<option <?php echo (get_meta_file( 'heuresparsemain_63775' ) === 'Temps Partiel' ) ? 'selected' : '' ?>>Temps Partiel</option>
			<option <?php echo (get_meta_file( 'heuresparsemain_63775' ) === 'Temps Plein' ) ? 'selected' : '' ?>>Temps Plein</option>
		</select>
	</p>	<p>
		<label for="salaireestimati_82291" class="labs_"><?php _e( 'Salaire estimatif', 'caractristiques_des_offres' ); ?></label><br>
		<input type="text" name="salaireestimati_82291" id="salaireestimati_82291" value="<?php echo get_meta_file( 'salaireestimati_82291' ); ?>" class="input_datas">
	</p>	<p>
		<label for="formationsexi_82618" class="labs_"><?php _e( 'Formation(s) exigée(s)', 'caractristiques_des_offres' ); ?></label><br>
		<textarea name="formationsexi_82618" id="formationsexi_82618" class="input_datas" ><?php echo get_meta_file( 'formationsexi_82618' ); ?></textarea>
	
	</p>	<p>
		<label for="exprienceexig_71777" class="labs_"><?php _e( 'Expérience exigée', 'caractristiques_des_offres' ); ?></label><br>
		<textarea name="exprienceexig_71777" id="exprienceexig_71777" class="input_datas" ><?php echo get_meta_file( 'exprienceexig_71777' ); ?></textarea>
	
	</p>	<p>
		<label for="certificatouacc_65547" class="labs_"><?php _e( 'Certificat ou accréditation exigés', 'caractristiques_des_offres' ); ?></label><br>
		<textarea name="certificatouacc_65547" id="certificatouacc_65547" class="input_datas" ><?php echo get_meta_file( 'certificatouacc_65547' ); ?></textarea>
	
	</p>	
	<style type="text/css">
		.input_datas{
			display: block;
		    width: 100%;
		    padding: 5px;
		    font-size: 1rem;
		    line-height: 1.5;
		    color: #495057;
		    background-color: #fff;
		    background-clip: padding-box;
		    border: 1px solid #ced4da;
		    border-radius: .25rem;
		    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
		    margin-top:10px;
		}
		.labs_{
		    font-size: 15px;
			font-weight: 600;
		}
	</style>
	<?php
}

function save_fields( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['caractristiquesdeso_nonce'] ) || ! wp_verify_nonce( $_POST['caractristiquesdeso_nonce'], 'caractristiquesdeso_data' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['adressedulieude_73838'] ) )
		update_post_meta( $post_id, 'adressedulieude_73838', esc_attr( $_POST['adressedulieude_73838'] ) );
	if ( isset( $_POST['codepostal_73838'] ) )
		update_post_meta( $post_id, 'codepostal_73838', esc_attr( $_POST['codepostal_73838'] ) );
	if ( isset( $_POST['ville_73838'] ) )
		update_post_meta( $post_id, 'ville_73838', esc_attr( $_POST['ville_73838'] ) );
	if ( isset( $_POST['pays_73838'] ) )
		update_post_meta( $post_id, 'pays_73838', esc_attr( $_POST['pays_73838'] ) );
	if ( isset( $_POST['heuresparsemain_63775'] ) )
		update_post_meta( $post_id, 'heuresparsemain_63775', esc_attr( $_POST['heuresparsemain_63775'] ) );
	if ( isset( $_POST['salaireestimati_82291'] ) )
		update_post_meta( $post_id, 'salaireestimati_82291', esc_attr( $_POST['salaireestimati_82291'] ) );
	if ( isset( $_POST['formationsexi_82618'] ) )
		update_post_meta( $post_id, 'formationsexi_82618', esc_attr( $_POST['formationsexi_82618'] ) );
	if ( isset( $_POST['exprienceexig_71777'] ) )
		update_post_meta( $post_id, 'exprienceexig_71777', esc_attr( $_POST['exprienceexig_71777'] ) );
	if ( isset( $_POST['certificatouacc_65547'] ) )
		update_post_meta( $post_id, 'certificatouacc_65547', esc_attr( $_POST['certificatouacc_65547'] ) );
	if ( isset( $_POST['url_fields'] ) )
		update_post_meta( $post_id, 'url_fields', esc_attr( $_POST['url'] ) );
}
add_action( 'save_post', 'save_fields' );


/*
	Usage: get_meta_file( 'adressedulieude_73838' )
	Usage: get_meta_file( 'codepostal_73838' )
	Usage: get_meta_file( 'ville_73838' )
	Usage: get_meta_file( 'pays_73838' )
	Usage: get_meta_file( 'heuresparsemain_63775' )
	Usage: get_meta_file( 'salaireestimati_82291' )
	Usage: get_meta_file( 'formationsexi_82618' )
	Usage: get_meta_file( 'exprienceexig_71777' )
	Usage: get_meta_file( 'certificatouacc_65547' )
*/

/**
 * Generated by the WordPress Meta Box generator
 * at http://jeremyhixon.com/tool/wordpress-meta-box-generator/
 */

function fileal_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function fileal_add_meta_box() {
	add_meta_box(
		'fileal-fileal',
		__( 'Fileal', 'fileal' ),
		'fileal_html',
		'post',
		'side',
		'high'
	);
	add_meta_box(
		'fileal-fileal',
		__( 'Fileal', 'fileal' ),
		'fileal_html',
		'offresemploi',
		'side',
		'high'
	);
}
//add_action( 'add_meta_boxes', 'fileal_add_meta_box' );

function fileal_html( $post) {
	wp_nonce_field( '_fileal_nonce', 'fileal_nonce' ); ?>

	<p>
		<label for="fileal_fileal_select"><?php _e( 'Fileal Select', 'fileal' ); ?></label><br>
		<select name="fileal_fileal_select" id="fileal_fileal_select">
			<?php
				$args = array( 'post_type' => 'entreprise_sector', 'posts_per_page' => -1);
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
			?>
			<option <?php echo (fileal_get_meta( 'fileal_fileal_select' ) === '' ) ? 'selected' : ''?>><?php echo get_the_title();?>


				<!-- <?php echo get_permalink(); ?> -->
				
			</option>

			<?php endwhile; ?>
			
		</select>
	</p><?php
}



function fileal_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['fileal_nonce'] ) || ! wp_verify_nonce( $_POST['fileal_nonce'], '_fileal_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['fileal_fileal_select'] ) )
		update_post_meta( $post_id, 'fileal_fileal_select', esc_attr( $_POST['fileal_fileal_select'] ) );
}
//add_action( 'save_post', 'fileal_save' );

/*
	Usage: fileal_get_meta( 'fileal_fileal_select' )
*/



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
	$hours = get_posts(
		array(
			'posts_per_page' => 0,
			'post_type' => 'offresemploi',
			'suppress_filters' => 0
			
		)
	);

	
	$test = array();
	foreach($hours as $hour)
	{
		
		//var_dump($hour->filter);
	  $test[get_post_meta($hour->ID, 'heuresparsemain_63775')[0]] = get_post_meta($hour->ID, 'heuresparsemain_63775')[0];
	  var_dump($hours);
	}
	
	
	$test_html = '
	  <div class="form-group">

	   <label for="catgories">'.__('Heures','theme-text-domain').' :</label>

	   <select class="form-control" id="hour-tests" name="hour-tests" onchange="this.form.submit()">

		<option value="all" selected="selected">'.__('Tous les heures','theme-text-domain').'</option>

		';

		foreach($test as $tests)

		{
			
	      $selected = '';

		  if($tests == $_POST['hour-tests']) : $selected = 'selected="true"'; endif;

		  $test_html .= '<option '.$selected.' value="'.$tests.'">'.$tests.'</option>';

		}

		$test_html.='

	   </select>

	 </div> 
	';
	
	// Get coutry
	$jobs = get_posts(
		array(
			'posts_per_page' => -1,
			'post_type' => 'offresemploi',
			'suppress_filters' => 0
		)
	);

	
	$countries = array();
	foreach($jobs as $job)
	{
		
		//var_dump($job);
	  $countries[get_post_meta($job->ID, 'pays_73838')[0]] = get_post_meta($job->ID, 'pays_73838')[0];
	  var_dump($countries);
	}
	
	
	$countries_html = '
	  <div class="form-group">

	   <label for="catgories">'.__('Pays','theme-text-domain').' :</label>

	   <select class="form-control" id="job-country" name="job-country" onchange="this.form.submit()">

		<option value="all" selected="selected">'.__('Tous les pays','theme-text-domain').'</option>

		';

		foreach($countries as $country)

		{
//var_dump($country);
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
	echo $test_html;
	echo $countries_html;

	?>
<script>
	var indexPays = document.getElementById("job-country");
	if(indexPays.value == ''){
		indexPays.value = 'all';
	}

		
		
	
</script>

	<?php
}
