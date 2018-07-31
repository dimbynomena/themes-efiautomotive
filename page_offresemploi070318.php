<?php 
/*template name: Page offres d'emploi */

get_header(); ?>

<?php
    /* =============
     * Start top page
     * =============
     */
    $LANG=get_locale();
    ?>

<?php $options = get_option('salient'); ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>

<div class="banner_top" style="background-image:url(<?php echo $image[0];?>)">
    <div class="caption">
        <h1><?php echo get_post_meta( $post->ID, 'subtitle_meta_box_text' )[0]?></h1>
    </div>
</div>

<div class="modal fade" id="myOfferModal" tabindex="-1" role="dialog" aria-labelledby="myOfferModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myOfferModalLabel"><?php _e('Candidature spontanée','theme-text-domain'); ?></h4>
      </div>
      <div class="modal-body">
        <?php
		$id = get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['page_offers_form_'.ICL_LANGUAGE_CODE];
		$shortcode = '[contact-form-7 id="'.$id.'"]';
		echo do_shortcode($shortcode);
		?>
      </div>
    </div>
  </div>
</div>

<?php
/* =============
 * End top page
 * =============
 */
?>

<?php if ( function_exists('yoast_breadcrumb') ) {
	yoast_breadcrumb('<p id="breadcrumbs">','</p>');
} ?>



<?php
/* =============
 * Start jobs
 * =============
 */
?>

<?php
$jobs = get_all_jobs();
?>

<div class="block_jobs">
    <div class="container">
			
			<div class="row">
				<div class="col-xs-12 col-md-3 filters">
					<form action="" method="POST">
					<?php get_job_filters();?>
					</form>
				</div>
				
				<div class="col-xs-12 col-md-9 list-offers">
					<div class="heading">
						<div class="row">
							<div class="col-xs-12 col-md-4">
								<span><b><?php _e('Poste à pourvoir','theme-text-domain'); ?></b></span>
							</div>
							<?php /*<div class="col-xs-12 col-md-3">
								<span><b><?php _e('Catégories','theme-text-domain'); ?></b></span>
							</div>*/ ?>
							<div class="col-xs-12 col-md-4 text-center">
								<span><b><?php _e('Type de contrat','theme-text-domain'); ?></b></span>
							</div>
							<div class="col-xs-12 col-md-4 localisation">
								<span><b><?php _e('Localisation','theme-text-domain'); ?></b></span>
							</div>
						</div>
					</div>
					
					<hr noshade/>
					
					<?php if(!empty($jobs)) :?>
					<?php //foreach (range(1, 3) as $i) :?>
					<?php foreach($jobs as $job) :
					?>
						<div class="row job">
							<div class="col-xs-12 col-md-4">
								<a href="<?php echo get_permalink($job->ID)?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?php echo $job->post_title?></a>
								<span class="date"><?php echo get_the_time('l j F Y', $job->ID)?>
									
								</span>
							</div>
							<!--<div class="col-xs-12 col-md-3">
								<?php $term_list = wp_get_post_terms($job->ID, 'offresemploi_categories', array("fields" => "names")); ?>
								<?php foreach($term_list as $term) :?>
								<span><?php echo $term?></span><br/>
								<?php endforeach;?>
							</div>-->
							<div class="col-xs-12 col-md-4 text-center">
								<?php $term_list = wp_get_post_terms($job->ID, 'offresemploi_types', array("fields" => "names")); ?>
								<?php foreach($term_list as $term) :?>
								<span><?php echo $term?></span><br/>
								<?php endforeach;?>
							</div>
							<div class="col-xs-12 col-md-4 localisation">
								<?php $city = get_post_meta($job->ID, 'ville_73838');?>
								<?php $country = get_post_meta($job->ID, 'pays_73838');?>
								<?php //echo get_post_meta($job->ID, 'heuresparsemain_63775', true);?>
								<span><?php //echo $city[0]?> <?php echo /*" - " . */$country[0]?></span>
							</div>
						</div>
					<?php endforeach;?>
					<?php //endforeach;?>
					<?php else :?>
					<p>
						
						<?php 
                    if ($LANG=='fr_FR') {
                        ?>
                <?php _e('aucune offre disponible, élargir votre recherche','theme-text-domain'); ?>
                <?php
                    }
                    else if ($LANG=='en_US') {
                        ?>
               <?php _e('no available offers, please change your search','theme-text-domain'); ?>
                <?php
                    } 
                    ?>


					</p>
					<?php endif;?>
<?php

/* =============

 * Button language start

 * =============

 */

?>
					
	<?php
    // la variable $currentlang recolte la langue
    $currentlang = get_bloginfo('language');
    // si la langue afficher est le français
    if($currentlang=="fr-FR"): ?>
		<div class="text-right">
			<a href="" class="btn btn-primary" data-toggle="modal" data-target="#myOfferModal"><?php _e('Envoyer une candidature spontanée','theme-text-domain'); ?></a>
		</div>
    <?php 
    // si la langue afficher est l'anglais US
    elseif($currentlang=="en-US"):?>
		<div class="text-right">
			<a href="" class="btn btn-primary" data-toggle="modal" data-target="#myOfferModal"><?php _e('Send a spontaneous application','theme-text-domain'); ?></a>
		</div>
    <?php endif; ?>
		
					
<?php

/* =============

 * Button language end

 * =============

 */

?>
					
				</div>
			</div>
            
        </div>
    </div>
</div>

<?php
/* =============
 * End jobs
 * =============
 */
?>

<?php get_footer(); ?>