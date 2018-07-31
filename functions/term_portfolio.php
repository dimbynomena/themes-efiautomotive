<?php
#=================================================================#
# Term Portfolio
#=================================================================#

#=======================#
# + Add technologies taxonomy in site
#=======================#

if ( ! function_exists( 'cpt_portfolio_technologies' ) ) {

    // Register Custom Taxonomy
    function cpt_portfolio_technologies() {
    
        $labels = array(
            'name'                       => _x( 'Technologies', 'Taxonomy General Name', 'text_domain' ),
            'singular_name'              => _x( 'Technologies', 'Taxonomy Singular Name', 'text_domain' ),
            'menu_name'                  => __( 'Technologies', 'text_domain' ),
            'all_items'                  => __( 'Toutes les technologies', 'text_domain' ),
            'parent_item'                => __( 'Technologie parente', 'text_domain' ),
            'parent_item_colon'          => __( 'Technologie parente :', 'text_domain' ),
            'new_item_name'              => __( 'Nom de la nouvelle technologie', 'text_domain' ),
            'add_new_item'               => __( 'Ajouter nouvelle technologie', 'text_domain' ),
            'edit_item'                  => __( 'Editer technologie', 'text_domain' ),
            'update_item'                => __( 'Mettre à jour technologie', 'text_domain' ),
            'view_item'                  => __( 'Voir la technologie', 'text_domain' ),
            'separate_items_with_commas' => __( 'Séparer les technologies avec des virgules', 'text_domain' ),
            'add_or_remove_items'        => __( 'Ajouter ou supprimer des technologies', 'text_domain' ),
            'choose_from_most_used'      => __( 'Sélectionner par le plus utilisé', 'text_domain' ),
            'popular_items'              => __( 'Technologies populaires', 'text_domain' ),
            'search_items'               => __( 'Rechercher une technologie', 'text_domain' ),
            'not_found'                  => __( 'Non trouvé', 'text_domain' ),
            'no_terms'                   => __( 'Aucune technologie', 'text_domain' ),
            'items_list'                 => __( 'Liste des technologies', 'text_domain' ),
            'items_list_navigation'      => __( 'Navigation liste des technologies', 'text_domain' ),
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
        register_taxonomy( 'technologies', array( 'portfolio' ), $args );
    
    }
    add_action( 'init', 'cpt_portfolio_technologies', 0 );
}

#=======================#
# + Add portfolio category custom field (new category)
#=======================#

add_action( 'project-type_add_form_fields', 'pt_taxonomy_add_new_meta_field', 10, 2 );
function pt_taxonomy_add_new_meta_field()
{
    ?>
	<div class="form-field">
			<label for="term_meta[catimg]">Image principale :</label><br/>
			<input class="upload_image" id="catimg" type="hidden" name="term_meta[catimg]" value="<?php echo $term_meta['catimg'] ?>" />
			<input class="upload_image_button button" id="catimg_button" type="button" value="Charger une image" data-field-id="catimg" />
			<div id="catimg_img" class="upload_image_wrapper">
				<?php if( !empty($term_meta['catimg']) ):?>
					<br/>
					<img src="<?php echo $term_meta['catimg'] ?>" />
					<br/>
					<a href="#" class="button upload_image_delete" data-field-id="catimg">Supprimer l'image</a>
				<?php endif ?>
			</div>
	</div>
	<div class="form-field">
        <label for="term_meta[icone]">Url de l'icone</label>
        <input type="text" name="term_meta[icone]" id="term_meta[icone]" value="">
        <p class="description">Url de l'icone</p>
    </div>
	<div class="form-field">
        <label for="term_meta[subtitle]">Sous titre</label>
        <input type="text" name="term_meta[subtitle]" id="term_meta[subtitle]" value="">
        <p class="description">Définir le sous titre de la catégorie</p>
    </div>
    <div class="form-field">
        <label for="term_meta[cat_color]">Couleur hexadécimal (Ex : #FFFFFF)</label>
        <input type="text" name="term_meta[cat_color]" id="term_meta[cat_color]" value="">
        <p class="description">Sélectionner une couleur relative à la catégorie en cours</p>
    </div>
	<div class="form-field">
        <label for="term_meta[order]">Numéro d'ordre</label>
        <input type="text" name="term_meta[order]" id="term_meta[order]" value="">
        <p class="description">Sélectionner un numéro d'ordre d'affichage</p>
    </div>
	<div class="form-field">
        <label for="term_meta[cat_featured]">Mise en avant</label>
        <select name="term_meta[cat_featured]" id="term_meta[cat_featured]">
			<option value="oui">Oui</option>
			<option value="non">Non</option>
		</select>
        <p class="description">Définir si la catégorie sera mise en avant</p>
    </div>
	<style>
		.upload_image_wrapper img{ width:250px }
	</style>
	 
	<script>
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

#=======================#
# + Add portfolio category custom field (edit category)
#=======================#

add_action( 'project-type_edit_form_fields', 'pt_taxonomy_edit_meta_field', 10, 2 );
function pt_taxonomy_edit_meta_field($term)
{
    $t_id = $term->term_id;
    $term_meta = get_option( "taxonomy_$t_id" );
	$featured = esc_attr( $term_meta['cat_featured'] ) ? esc_attr( $term_meta['cat_featured'] ) : '';
    ?>
	<tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[subtitle]">Image principale</label></th>
        <td>
			<label for="term_meta[catimg]">Image :</label><br/>
			<input class="upload_image" id="catimg" type="hidden" name="term_meta[catimg]" value="<?php echo $term_meta['catimg'] ?>" />
			<input class="upload_image_button button" id="catimg_button" type="button" value="Charger une image" data-field-id="catimg" />
			<div id="catimg_img" class="upload_image_wrapper">
				<?php if( !empty($term_meta['catimg']) ):?>
					<br/>
					<img src="<?php echo $term_meta['catimg'] ?>" />
					<br/>
					<a href="#" class="button upload_image_delete" data-field-id="catimg">Supprimer l'image</a>
				<?php endif ?>
			</div>
        </td>
    </tr>
	<tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[subtitle]">Url de l'icone</label></th>
        <td>
            <input type="text" name="term_meta[icone]" id="term_meta[icone]" value="<?php echo $term_meta['icone'] ? $term_meta['icone'] : ''; ?>">
            <p class="description">Url de l'icone</p>
        </td>
    </tr>
	<tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[subtitle]">Sous titre</label></th>
        <td>
            <input type="text" name="term_meta[subtitle]" id="term_meta[subtitle]" value="<?php echo $term_meta['subtitle'] ? $term_meta['subtitle'] : ''; ?>">
            <p class="description">Définir le sous titre de la catégorie</p>
        </td>
    </tr>
    <tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[cat_color]">Couleur hexadécimal (Ex : #FFFFFF)</label></th>
        <td>
            <input type="text" name="term_meta[cat_color]" id="term_meta[cat_color]" value="<?php echo esc_attr( $term_meta['cat_color'] ) ? esc_attr( $term_meta['cat_color'] ) : ''; ?>">
            <?php if(!empty($term_meta['cat_color'])):?>
			<p class="description">
				Couleur sélectionnée : <span class="color-example" style="background-color:<?php echo $term_meta['cat_color'];?>"></span>
			</p>
			<?php endif;?>
			<p class="description">Sélectionner une couleur relative à la catégorie en cours</p>
        </td>
    </tr>
	<tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[order]">Numéro d'ordre</label></th>
        <td>
            <input type="text" name="term_meta[order]" id="term_meta[order]" value="<?php echo esc_attr( $term_meta['order'] ) ? esc_attr( $term_meta['order'] ) : ''; ?>">
            <?php if(!empty($term_meta['order'])):?>
			<p class="description">
				Ordre sélectionné : <span class="color-example" style="background-color:<?php echo $term_meta['order'];?>"></span>
			</p>
			<?php endif;?>
			<p class="description">Sélectionner un numéro d'ordre d'affichage</p>
        </td>
    </tr>
    <tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[cat_featured]">Mise en avant</label></th>
        <td>
			<select name="term_meta[cat_featured]" id="term_meta[cat_featured]" value="">
				<?php if($featured == 'oui') :?>
					<option selected="true" value="oui">Oui</option>
					<option value="non">Non</option>
				<?php elseif($featured == 'non') : ?>
					<option value="oui">Oui</option>
					<option selected="true" value="non">Non</option>
				<?php else :?>
					<option value="oui">Oui</option>
					<option value="non">Non</option>
				<?php endif;?>
			</select>
            <p class="description">Définir si la catégorie sera mise en avant</p>
        </td>
    </tr>
	
	<style>
		.upload_image_wrapper img{ width:250px }
		.color-example {
			width: 20px;
			height: 20px;
			display: inline-block;
			border-radius: 20px;
		}
	</style>
	 
	<script>
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
#=======================#
# + Add portfolio category custom field (save category)
#=======================#

add_action( 'edited_project-type', 'pt_save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_project-type', 'pt_save_taxonomy_custom_meta', 10, 2 );
 
function pt_save_taxonomy_custom_meta( $term_id ) {
	$_POST = stripslashes_deep( $_POST );
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        $cat_keys = array_keys( $_POST['term_meta'] );
        foreach ( $cat_keys as $key ) {
            if ( isset ( $_POST['term_meta'][$key] ) ) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
		
        // Save the option array.
        update_option( "taxonomy_$t_id", $term_meta );
    }
}

#=======================#
# + Get technologies list
#=======================#

function get_Technologies()
{
	$technologies = get_terms('technologies', array(
		'hide_empty' => false
	));
	
	return $technologies;
}

#=======================#
# + Add portfolio technologies custom field (new technology)
#=======================#

add_action( 'technologies_add_form_fields', 'pt_taxonomy_technologies_add_new_meta_field', 10, 2 );
function pt_taxonomy_technologies_add_new_meta_field()
{
    ?>
	<div class="form-field">
			<label for="term_meta[catimg]">Image principale :</label><br/>
			<input class="upload_image" id="catimg" type="hidden" name="term_meta[catimg]" value="<?php echo $term_meta['catimg'] ?>" />
			<input class="upload_image_button button" id="catimg_button" type="button" value="Charger une image" data-field-id="catimg" />
			<div id="catimg_img" class="upload_image_wrapper">
				<?php if( !empty($term_meta['catimg']) ):?>
					<br/>
					<img src="<?php echo $term_meta['catimg'] ?>" />
					<br/>
					<a href="#" class="button upload_image_delete" data-field-id="catimg">Supprimer l'image</a>
				<?php endif ?>
			</div>
	</div>
	<div class="form-field">
        <label for="term_meta[subtitle]">Sous titre</label>
        <input type="text" name="term_meta[subtitle]" id="term_meta[subtitle]" value="">
        <p class="description">Définir le sous titre de la catégorie</p>
    </div>
	<div class="form-field term-parent-wrap">
        <label for="term_meta[technologie_parent]">Technologie parente</label>
		<select class="postform" name="term_meta[technologie_parent]" id="term_meta[technologie_parent]">
			<option value="null">-</option>
			<?php foreach(get_Technologies() as $technologie) :?>
				<option value="<?php echo $technologie->term_id?>"><?php echo wp_trim_words( $technologie->name, 4, '...' )?></option>
			<?php endforeach;?>
		</select>
        <p class="description">Définir la technologie parente</p>
    </div>
	<style>
		.upload_image_wrapper img{ width:250px }
	</style>
	 
	<script>
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

#=======================#
# + Add portfolio category custom field (edit category)
#=======================#

add_action( 'technologies_edit_form_fields', 'pt_taxonomy_technologies_edit_meta_field', 10, 2 );
function pt_taxonomy_technologies_edit_meta_field($term)
{
    $t_id = $term->term_id;
    $term_meta = get_option( "taxonomy_$t_id" );
	$featured = esc_attr( $term_meta['cat_featured'] ) ? esc_attr( $term_meta['cat_featured'] ) : '';
    ?>
	<tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[subtitle]">Image principale</label></th>
        <td>
			<label for="term_meta[catimg]">Image :</label><br/>
			<input class="upload_image" id="catimg" type="hidden" name="term_meta[catimg]" value="<?php echo $term_meta['catimg'] ?>" />
			<input class="upload_image_button button" id="catimg_button" type="button" value="Charger une image" data-field-id="catimg" />
			<div id="catimg_img" class="upload_image_wrapper">
				<?php if( !empty($term_meta['catimg']) ):?>
					<br/>
					<img src="<?php echo $term_meta['catimg'] ?>" />
					<br/>
					<a href="#" class="button upload_image_delete" data-field-id="catimg">Supprimer l'image</a>
				<?php endif ?>
			</div>
        </td>
    </tr>
	<tr class="form-field">
    <th scope="row" valign="top"><label for="term_meta[subtitle]">Sous titre</label></th>
        <td>
            <input type="text" name="term_meta[subtitle]" id="term_meta[subtitle]" value="<?php echo $term_meta['subtitle'] ? $term_meta['subtitle'] : ''; ?>">
            <p class="description">Définir le sous titre de la catégorie</p>
        </td>
    </tr>
    <th scope="row" valign="top"><label for="term_meta[technologie_parent]">Technologie parente</label></th>
        <td>
			<select class="postform" name="term_meta[technologie_parent]" id="term_meta[technologie_parent]">
				<option value="null">-</option>
				<?php foreach(get_Technologies() as $technologie) :?>
					<?php if(isset($term_meta['technologie_parent']) && $term_meta['technologie_parent'] == $technologie->term_id) :?>
						<option selected="true" value="<?php echo $technologie->term_id?>"><?php echo wp_trim_words( $technologie->name, 4, '...' )?></option>
					<?php else :?>
						<option value="<?php echo $technologie->term_id?>"><?php echo wp_trim_words( $technologie->name, 4, '...' )?></option>
					<?php endif; ?>
				<?php endforeach;?>
			</select>
			<p class="description">Définir la technologie parente</p>
        </td>
    </tr>
	<style>
		.upload_image_wrapper img{ width:250px }
		.color-example {
			width: 20px;
			height: 20px;
			display: inline-block;
			border-radius: 20px;
		}
	</style>
	 
	<script>
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
#=======================#
# + Add portfolio category custom field (save category)
#=======================#

add_action( 'edited_technologies', 'pt_save_taxonomy_technologies_custom_meta', 10, 2 );
add_action( 'create_technologies', 'pt_save_taxonomy_technologies_custom_meta', 10, 2 );
 
function pt_save_taxonomy_technologies_custom_meta( $term_id ) {
	$_POST = stripslashes_deep( $_POST );
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        $cat_keys = array_keys( $_POST['term_meta'] );
        foreach ( $cat_keys as $key ) {
            if ( isset ( $_POST['term_meta'][$key] ) ) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
		
        // Save the option array.
        update_option( "taxonomy_$t_id", $term_meta );
    }
}