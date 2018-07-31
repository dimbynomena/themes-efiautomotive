<?php 
/*template name: Page news */

get_header(); ?>

<?php
/* =============
 * Start top page
 * =============
 */
?>
<div class="banner_top" style="background-image:url(<?php echo the_post_thumbnail_url(); ?>)">
    <div class="caption">
        <h1><?php echo $post->post_title?></h1>
        <hr noshade/>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myEventModal">
			<?php _e('Participer à l\'évènement','theme-text-domain'); ?>
		</button>
    </div>
</div>

<div class="modal fade" id="myEventModal" tabindex="-1" role="dialog" aria-labelledby="myEventModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myEventModalLabel"><?php _e('Participer à l\'évènement','theme-text-domain'); ?></h4>
      </div>
      <div class="modal-body">
        <?php
		$subject = __('Demande de participation à un évènement :','theme-text-domain').' '.$post->post_title;
		$id = get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['page_events_form_'.ICL_LANGUAGE_CODE];
		$shortcode = '[contact-form-7 id="'.$id.'" your-subject="'.$subject.'"]';
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
 * Start article
 * =============
 */
?>
<br/>
<div class="block_evenement">
   <div class="container">
	  
	<?php $start_date = get_post_meta($post->ID, 'datededbut_33725')[0];?>
	<?php $end_date = get_post_meta($post->ID, 'datedefin_52933')[0];?>
	<?php $places = get_post_meta($post->ID, 'nombredeplacesm_36736')[0];?>
	<?php $localisation = get_post_meta($post->ID, 'localisation_78494')[0];?>
	  
      <ul class="details">
        <?php if($start_date) :?><li><i class="fa fa-calendar" aria-hidden="true"></i> <span><?php _e('Date de début','theme-text-domain'); ?></span><?php echo date('d-m-Y', strtotime($start_date))?></li><?php endif;?>
        <?php if($end_date) :?><li><i class="fa fa-calendar" aria-hidden="true"></i> <span><?php _e('Date de fin','theme-text-domain'); ?></span><?php echo date('d-m-Y', strtotime($end_date))?></li><?php endif;?>
        <?php if($places) :?><li><i class="fa fa-users" aria-hidden="true"></i> <span><?php _e('Places disponibles','theme-text-domain'); ?></span><?php echo $places?></li><?php endif;?>
        <?php if($localisation) :?><li><i class="fa fa-map-marker" aria-hidden="true"></i>  <a target="_blank" href="https://www.google.fr/maps/place/<?php echo str_replace(' ', '+', str_replace(' -', '', $localisation))?>"><?php echo $localisation?></a></li><?php endif;?>
      </ul>
      
	  <?php echo $post->post_content;?>
	  
   </div>
</div>

<?php
/* =============
 * End article
 * =============
 */
?>

<?php
/* =============
 * Start news
 * =============
 */
?>

<div class="blog-recent" fnc-latestPosts>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-lg-6">
				<h3><?php echo get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['all_news_'.ICL_LANGUAGE_CODE]?></h3>
			</div>
			<div class="col-xs-12 col-sm-6 col-lg-6 text-right">
				<h3><a href="#"><?php echo get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['see_all_'.ICL_LANGUAGE_CODE]?></a></h3>
			</div>
		</div>
		<div class="row">
			
			<?php
			$articles = get_recent_articles();
			query_posts($articles);
			if(have_posts()) : while(have_posts()) : the_post(); ?>
			
			<div class="col-xs-12 col-sm-6 col-lg-3">
		
				<div class="post-header" fnc-latestPostsBox>
					<a href="<?php the_permalink(); ?>">
					  <div class="image" style="background-image:url(<?php echo the_post_thumbnail_url(); ?>)"></div>
					  <p><?php echo get_the_category()[0]->name; ?></p>
					  <h3 class="title"><?php the_title(); ?></h3>
					</a>
				</div>
								
			</div>
			
			<?php endwhile; endif; ?>
		
		</div>
	</div>
</div>

<?php
/* =============
 * End news
 * =============
 */
?>

<?php get_footer(); ?>