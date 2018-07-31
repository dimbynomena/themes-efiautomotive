<?php
#=================================================================#
# Config function
#=================================================================#

#=======================#
# + Add Wordpress configuration page
#=======================#

// ICL_LANGUAGE_CODE
// icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str')

class EfiConfiguration {
	
	private $efi_configuration_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'efi_configuration_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'efi_configuration_page_init' ) );
	}

	public function efi_configuration_add_plugin_page() {
		add_options_page(
			'Efi Configuration',
			'Efi Configuration', 
			'manage_options', 
			'efi-configuration', 
			array( $this, 'efi_configuration_create_admin_page' ) 
		);
	}

	public function efi_configuration_create_admin_page() {
		$this->efi_configuration_options = get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE ); ?>

		<div class="wrap">
			<h2>Efi Configuration</h2>
			<p>Gestion de la configuration dédiée EFI Automotive</p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'efi_configuration_option_group' );
					do_settings_sections( 'efi-configuration-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function efi_configuration_page_init() {
		register_setting(
			'efi_configuration_option_group', 
			'efi_configuration_option_name_'.ICL_LANGUAGE_CODE, 
			array( $this, 'efi_configuration_sanitize' ) 
		);

		add_settings_section(
			'efi_configuration_setting_section_home',
			'Gestion de la homepage',
			array( $this, 'efi_configuration_section_info' ),
			'efi-configuration-admin' 
		);
				add_settings_field(
					'all_news_'.ICL_LANGUAGE_CODE,
					'Toutes les actualités',
					array( $this, 'all_news_callback' ),
					'efi-configuration-admin', 
					'efi_configuration_setting_section_home'
				);
				
				add_settings_field(
					'see_all_'.ICL_LANGUAGE_CODE,
					'Toutes les actualités',
					array( $this, 'see_all_callback' ),
					'efi-configuration-admin', 
					'efi_configuration_setting_section_home'
				);
				
				add_settings_field(
					'button_more_'.ICL_LANGUAGE_CODE,
					'Bouton en savoir +',
					array( $this, 'button_more_callback' ),
					'efi-configuration-admin',
					'efi_configuration_setting_section_home'
				);
				
				add_settings_field(
					'domaines_activites_'.ICL_LANGUAGE_CODE,
					'Domaines d\'activités',
					array( $this, 'domaines_activites_callback' ),
					'efi-configuration-admin', 
					'efi_configuration_setting_section_home'
				);
				
				add_settings_field(
					'button_more_'.ICL_LANGUAGE_CODE,
					'Bouton en savoir +',
					array( $this, 'button_more_callback' ),
					'efi-configuration-admin',
					'efi_configuration_setting_section_home'
				);
		
		add_settings_section(
			'efi_configuration_setting_section_filiales', 
			'Gestion des filiales', 
			array( $this, 'efi_configuration_section_info' ), 
			'efi-configuration-admin' 
		);

				add_settings_field(
					'titre_map_filiales_'.ICL_LANGUAGE_CODE,
					'Titre de la map des filiales',
					array( $this, 'titre_map_filiales_callback' ), 
					'efi-configuration-admin',
					'efi_configuration_setting_section_filiales'
				);
				
				add_settings_field(
					'contact_filiales_'.ICL_LANGUAGE_CODE,
					'Titre du bouton de contact',
					array( $this, 'contact_filiales_callback' ), 
					'efi-configuration-admin',
					'efi_configuration_setting_section_filiales'
				);
				
				add_settings_field(
					'contact_form_'.ICL_LANGUAGE_CODE,
					'Shortcode du formulaire',
					array( $this, 'contact_form_callback' ), 
					'efi-configuration-admin',
					'efi_configuration_setting_section_filiales'
				);
		
				add_settings_field(
					'description_map_filiales_'.ICL_LANGUAGE_CODE,
					'Description de la map des filiales', 
					array( $this, 'description_map_filiales_callback' ), 
					'efi-configuration-admin', 
					'efi_configuration_setting_section_filiales'
				);
				
				add_settings_field(
					'bouton_map_filiales_'.ICL_LANGUAGE_CODE,
					'Bouton de la map des filiales',
					array( $this, 'bouton_map_filiales_callback' ),
					'efi-configuration-admin',
					'efi_configuration_setting_section_filiales'
				);
			
		add_settings_section(
			'efi_configuration_setting_section_applications',
			'Gestion des applications',
			array( $this, 'efi_configuration_section_info' ),
			'efi-configuration-admin' 
		);
		
				add_settings_field(
					'page_applications_'.ICL_LANGUAGE_CODE,
					'Page applications',
					array( $this, 'page_applications_callback' ),
					'efi-configuration-admin', 
					'efi_configuration_setting_section_applications'
				);
				
				add_settings_field(
					'page_contacts_'.ICL_LANGUAGE_CODE,
					'Page contact',
					array( $this, 'page_contacts_callback' ),
					'efi-configuration-admin',
					'efi_configuration_setting_section_applications'
				);
				
				add_settings_field(
					'page_contacts_'.ICL_LANGUAGE_CODE,
					'Page contact',
					array( $this, 'page_contacts_callback' ),
					'efi-configuration-admin',
					'efi_configuration_setting_section_applications'
				);

				add_settings_field(
					'range_products_'.ICL_LANGUAGE_CODE,
					'Produits de la gamme',
					array( $this, 'range_products_callback' ),
					'efi-configuration-admin',
					'efi_configuration_setting_section_applications'
				);
				
		add_settings_section(
			'efi_configuration_setting_section_events',
			'Gestion des évènements',
			array( $this, 'efi_configuration_section_info' ),
			'efi-configuration-admin' 
		);
				add_settings_field(
					'page_events_form_'.ICL_LANGUAGE_CODE,
					'Shortcode du formulaire',
					array( $this, 'page_events_form_callback' ),
					'efi-configuration-admin', 
					'efi_configuration_setting_section_events'
				);
				
		add_settings_section(
			'efi_configuration_setting_section_offers',
			'Gestion des offres d\'emploi',
			array( $this, 'efi_configuration_section_info' ),
			'efi-configuration-admin' 
		);
				add_settings_field(
					'page_offers_form_'.ICL_LANGUAGE_CODE,
					'Shortcode du formulaire de candidature spontannée',
					array( $this, 'page_offers_form_callback' ),
					'efi-configuration-admin', 
					'efi_configuration_setting_section_offers'
				);
				
				add_settings_field(
					'page_offer_form_'.ICL_LANGUAGE_CODE,
					'Shortcode du formulaire pour postuler',
					array( $this, 'page_offer_form_callback' ),
					'efi-configuration-admin', 
					'efi_configuration_setting_section_offers'
				);
	}

	public function efi_configuration_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['titre_map_filiales_'.ICL_LANGUAGE_CODE] ) ) {
			$sanitary_values['titre_map_filiales_'.ICL_LANGUAGE_CODE] = sanitize_text_field( $input['titre_map_filiales_'.ICL_LANGUAGE_CODE] );
		}

		if ( isset( $input['description_map_filiales_'.ICL_LANGUAGE_CODE] ) ) {
			$sanitary_values['description_map_filiales_'.ICL_LANGUAGE_CODE] = esc_textarea( $input['description_map_filiales_'.ICL_LANGUAGE_CODE] );
		}
        
        if ( isset( $input['bouton_map_filiales_'.ICL_LANGUAGE_CODE] ) ) {
			$sanitary_values['bouton_map_filiales_'.ICL_LANGUAGE_CODE] = esc_textarea( $input['bouton_map_filiales_'.ICL_LANGUAGE_CODE] );
		}
		
		if ( isset( $input['contact_filiales_'.ICL_LANGUAGE_CODE] ) ) {
			$sanitary_values['contact_filiales_'.ICL_LANGUAGE_CODE] = esc_textarea( $input['contact_filiales_'.ICL_LANGUAGE_CODE] );
		}
		
		if ( isset( $input['contact_form_'.ICL_LANGUAGE_CODE] ) ) {
			$sanitary_values['contact_form_'.ICL_LANGUAGE_CODE] = esc_textarea( $input['contact_form_'.ICL_LANGUAGE_CODE] );
		}
		
		if ( isset( $input['page_applications_'.ICL_LANGUAGE_CODE] ) ) {
			$sanitary_values['page_applications_'.ICL_LANGUAGE_CODE] = esc_textarea( $input['page_applications_'.ICL_LANGUAGE_CODE] );
		}
		
		if ( isset( $input['page_contacts_'.ICL_LANGUAGE_CODE] ) ) {
			$sanitary_values['page_contacts_'.ICL_LANGUAGE_CODE] = esc_textarea( $input['page_contacts_'.ICL_LANGUAGE_CODE] );
		}
		
		if ( isset( $input['domaines_activites_'.ICL_LANGUAGE_CODE] ) ) {
			$sanitary_values['page_contacts_'.ICL_LANGUAGE_CODE] = esc_textarea( $input['page_contacts_'.ICL_LANGUAGE_CODE] );
		}
		
		if ( isset( $input['domaines_activites_'.ICL_LANGUAGE_CODE] ) ) {
			$sanitary_values['domaines_activites_'.ICL_LANGUAGE_CODE] = esc_textarea( $input['domaines_activites_'.ICL_LANGUAGE_CODE] );
		}
		
		if ( isset( $input['button_more_'.ICL_LANGUAGE_CODE] ) ) {
			$sanitary_values['button_more_'.ICL_LANGUAGE_CODE] = esc_textarea( $input['button_more_'.ICL_LANGUAGE_CODE] );
		}
		
		if ( isset( $input['all_news_'.ICL_LANGUAGE_CODE] ) ) {
			$sanitary_values['all_news_'.ICL_LANGUAGE_CODE] = esc_textarea( $input['all_news_'.ICL_LANGUAGE_CODE] );
		}
		
		if ( isset( $input['see_all_'.ICL_LANGUAGE_CODE] ) ) {
			$sanitary_values['see_all_'.ICL_LANGUAGE_CODE] = esc_textarea( $input['see_all_'.ICL_LANGUAGE_CODE] );
		}
		
		if ( isset( $input['range_products_'.ICL_LANGUAGE_CODE] ) ) {
			$sanitary_values['range_products_'.ICL_LANGUAGE_CODE] = esc_textarea( $input['range_products_'.ICL_LANGUAGE_CODE] );
		}
		
		if ( isset( $input['page_events_form_'.ICL_LANGUAGE_CODE] ) ) {
			$sanitary_values['page_events_form_'.ICL_LANGUAGE_CODE] = esc_textarea( $input['page_events_form_'.ICL_LANGUAGE_CODE] );
		}
		
		if ( isset( $input['page_offers_form_'.ICL_LANGUAGE_CODE] ) ) {
			$sanitary_values['page_offers_form_'.ICL_LANGUAGE_CODE] = esc_textarea( $input['page_offers_form_'.ICL_LANGUAGE_CODE] );
		}
		
		if ( isset( $input['page_offer_form_'.ICL_LANGUAGE_CODE] ) ) {
			$sanitary_values['page_offer_form_'.ICL_LANGUAGE_CODE] = esc_textarea( $input['page_offer_form_'.ICL_LANGUAGE_CODE] );
		}

		return $sanitary_values;
	}

	public function efi_configuration_section_info() {
		
	}

	public function titre_map_filiales_callback() {
		printf(
			'<input class="regular-text" type="text" name="efi_configuration_option_name_'.ICL_LANGUAGE_CODE.'[titre_map_filiales_'.ICL_LANGUAGE_CODE.']" id="titre_map_filiales_'.ICL_LANGUAGE_CODE.'" value="%s">',
			isset( $this->efi_configuration_options['titre_map_filiales_'.ICL_LANGUAGE_CODE] ) ? esc_attr( $this->efi_configuration_options['titre_map_filiales_'.ICL_LANGUAGE_CODE]) : ''
		);
	}

	public function description_map_filiales_callback() {
		printf(
			'<textarea class="large-text" rows="5" name="efi_configuration_option_name_'.ICL_LANGUAGE_CODE.'[description_map_filiales_'.ICL_LANGUAGE_CODE.']" id="description_map_filiales">%s</textarea>',
			isset( $this->efi_configuration_options['description_map_filiales_'.ICL_LANGUAGE_CODE] ) ? esc_attr( $this->efi_configuration_options['description_map_filiales_'.ICL_LANGUAGE_CODE]) : ''
		);
	}
    
    public function bouton_map_filiales_callback() {
		printf(
			'<input class="regular-text" type="text" name="efi_configuration_option_name_'.ICL_LANGUAGE_CODE.'[bouton_map_filiales_'.ICL_LANGUAGE_CODE.']" id="bouton_map_filiales_'.ICL_LANGUAGE_CODE.'" value="%s">',
			isset( $this->efi_configuration_options['bouton_map_filiales_'.ICL_LANGUAGE_CODE] ) ? esc_attr( $this->efi_configuration_options['bouton_map_filiales_'.ICL_LANGUAGE_CODE]) : ''
		);
	}
	
	public function contact_filiales_callback() {
		printf(
			'<input class="regular-text" type="text" name="efi_configuration_option_name_'.ICL_LANGUAGE_CODE.'[contact_filiales_'.ICL_LANGUAGE_CODE.']" id="contact_filiales_'.ICL_LANGUAGE_CODE.'" value="%s">',
			isset( $this->efi_configuration_options['contact_filiales_'.ICL_LANGUAGE_CODE] ) ? esc_attr( $this->efi_configuration_options['contact_filiales_'.ICL_LANGUAGE_CODE]) : ''
		);
	}
	
	public function contact_form_callback() {
		printf(
			'<input class="regular-text" type="text" name="efi_configuration_option_name_'.ICL_LANGUAGE_CODE.'[contact_form_'.ICL_LANGUAGE_CODE.']" id="contact_form_'.ICL_LANGUAGE_CODE.'" value="%s">',
			isset( $this->efi_configuration_options['contact_form_'.ICL_LANGUAGE_CODE] ) ? esc_attr( $this->efi_configuration_options['contact_form_'.ICL_LANGUAGE_CODE]) : ''
		);
	}
	
	public function page_applications_callback() {
		
		$pages = $this->get_pages();
		echo '<select class="regular-text" name="efi_configuration_option_name_'.ICL_LANGUAGE_CODE.'[page_applications_'.ICL_LANGUAGE_CODE.']" id="page_applications_'.ICL_LANGUAGE_CODE.'">';
		echo '<option value="0">-</option>';
		foreach($pages as $page)
		{
			if(isset($this->efi_configuration_options['page_applications_'.ICL_LANGUAGE_CODE]) && esc_attr( $this->efi_configuration_options['page_applications_'.ICL_LANGUAGE_CODE]) == $page->ID)
			{
				echo '<option selected="true" value="'.$page->ID.'">'.$page->post_title.'</option>';	
			} else {
				echo '<option value="'.$page->ID.'">'.$page->post_title.'</option>';
			}
			
		}
		echo '</select>';
	}
	
	public function page_contacts_callback() {
		
		$pages = $this->get_pages();
		echo '<select class="regular-text" name="efi_configuration_option_name_'.ICL_LANGUAGE_CODE.'[page_contacts_'.ICL_LANGUAGE_CODE.']" id="page_contacts_'.ICL_LANGUAGE_CODE.'">';
		echo '<option value="0">-</option>';
		foreach($pages as $page)
		{
			if(isset($this->efi_configuration_options['page_contacts_'.ICL_LANGUAGE_CODE]) && esc_attr( $this->efi_configuration_options['page_contacts_'.ICL_LANGUAGE_CODE]) == $page->ID)
			{
				echo '<option selected="true" value="'.$page->ID.'">'.$page->post_title.'</option>';	
			} else {
				echo '<option value="'.$page->ID.'">'.$page->post_title.'</option>';
			}
			
		}
		echo '</select>';
	}
	
	public function domaines_activites_callback() {
		printf(
			'<input class="regular-text" type="text" name="efi_configuration_option_name_'.ICL_LANGUAGE_CODE.'[domaines_activites_'.ICL_LANGUAGE_CODE.']" id="domaines_activites_'.ICL_LANGUAGE_CODE.'" value="%s">',
			isset( $this->efi_configuration_options['domaines_activites_'.ICL_LANGUAGE_CODE] ) ? esc_attr( $this->efi_configuration_options['domaines_activites_'.ICL_LANGUAGE_CODE]) : ''
		);
	}
	
	public function button_more_callback() {
		printf(
			'<input class="regular-text" type="text" name="efi_configuration_option_name_'.ICL_LANGUAGE_CODE.'[button_more_'.ICL_LANGUAGE_CODE.']" id="button_more_'.ICL_LANGUAGE_CODE.'" value="%s">',
			isset( $this->efi_configuration_options['button_more_'.ICL_LANGUAGE_CODE] ) ? esc_attr( $this->efi_configuration_options['button_more_'.ICL_LANGUAGE_CODE]) : ''
		);
	}
	
	public function all_news_callback() {
		printf(
			'<input class="regular-text" type="text" name="efi_configuration_option_name_'.ICL_LANGUAGE_CODE.'[all_news_'.ICL_LANGUAGE_CODE.']" id="all_news_'.ICL_LANGUAGE_CODE.'" value="%s">',
			isset( $this->efi_configuration_options['all_news_'.ICL_LANGUAGE_CODE] ) ? esc_attr( $this->efi_configuration_options['all_news_'.ICL_LANGUAGE_CODE]) : ''
		);
	}
	
	public function see_all_callback() {
		printf(
			'<input class="regular-text" type="text" name="efi_configuration_option_name_'.ICL_LANGUAGE_CODE.'[see_all_'.ICL_LANGUAGE_CODE.']" id="see_all_'.ICL_LANGUAGE_CODE.'" value="%s">',
			isset( $this->efi_configuration_options['see_all_'.ICL_LANGUAGE_CODE] ) ? esc_attr( $this->efi_configuration_options['see_all_'.ICL_LANGUAGE_CODE]) : ''
		);
	}
	
	public function range_products_callback() {
		printf(
			'<input class="regular-text" type="text" name="efi_configuration_option_name_'.ICL_LANGUAGE_CODE.'[range_products_'.ICL_LANGUAGE_CODE.']" id="range_products_'.ICL_LANGUAGE_CODE.'" value="%s">',
			isset( $this->efi_configuration_options['range_products_'.ICL_LANGUAGE_CODE] ) ? esc_attr( $this->efi_configuration_options['range_products_'.ICL_LANGUAGE_CODE]) : ''
		);
	}

	public function page_events_form_callback() {
		printf(
			'<input class="regular-text" type="text" name="efi_configuration_option_name_'.ICL_LANGUAGE_CODE.'[page_events_form_'.ICL_LANGUAGE_CODE.']" id="page_events_form_'.ICL_LANGUAGE_CODE.'" value="%s">',
			isset( $this->efi_configuration_options['page_events_form_'.ICL_LANGUAGE_CODE] ) ? esc_attr( $this->efi_configuration_options['page_events_form_'.ICL_LANGUAGE_CODE]) : ''
		);
	}
	
	public function page_offers_form_callback() {
		printf(
			'<input class="regular-text" type="text" name="efi_configuration_option_name_'.ICL_LANGUAGE_CODE.'[page_offers_form_'.ICL_LANGUAGE_CODE.']" id="page_offers_form_'.ICL_LANGUAGE_CODE.'" value="%s">',
			isset( $this->efi_configuration_options['page_offers_form_'.ICL_LANGUAGE_CODE] ) ? esc_attr( $this->efi_configuration_options['page_offers_form_'.ICL_LANGUAGE_CODE]) : ''
		);
	}
	
	public function page_offer_form_callback() {
		printf(
			'<input class="regular-text" type="text" name="efi_configuration_option_name_'.ICL_LANGUAGE_CODE.'[page_offer_form_'.ICL_LANGUAGE_CODE.']" id="page_offer_form_'.ICL_LANGUAGE_CODE.'" value="%s">',
			isset( $this->efi_configuration_options['page_offer_form_'.ICL_LANGUAGE_CODE] ) ? esc_attr( $this->efi_configuration_options['page_offer_form_'.ICL_LANGUAGE_CODE]) : ''
		);
	}
	
	public function get_pages()
	{
		$args = array(
			'sort_order' => 'asc',
			'sort_column' => 'post_title',
			'hierarchical' => 1,
			'exclude' => '',
			'include' => '',
			'meta_key' => '',
			'meta_value' => '',
			'authors' => '',
			'child_of' => 0,
			'parent' => -1,
			'exclude_tree' => '',
			'number' => '',
			'offset' => 0,
			'post_type' => 'page',
			'post_status' => 'publish'
		); 
		
		return get_pages($args);
	}

}
if ( is_admin() )
	$efi_configuration = new EfiConfiguration();
