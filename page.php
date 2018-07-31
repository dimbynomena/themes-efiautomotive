<?php 
/*template name: Page Standard */

get_header(); ?>

<?php
/* =============
 * Start top page
 * =============
 */
?>

<?php $options = get_option('salient'); ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>

<div class="banner_top" style="background-image:url(<?php echo $image[0];?>)">
    <div class="caption">
        <h1><?php echo get_post_meta( $post->ID, 'subtitle_meta_box_text' )[0]?></h1>
        <hr noshade/>
        <h2><?php echo $post->post_excerpt?></h2>
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
 * Start content
 * =============
 */
?>

<div class="content container">
	
	<?php if(!empty($post->post_content)) : ?>
    <div class="body">
		<?php the_content()?>
    </div>
	<?php endif;?>
    
	<?php
	$repeatable = get_post_meta( $post->ID, 'repeatable_fields' );
	$repeatable = $repeatable[0];
	if($repeatable) :
	?>
		<div class="repeatable">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			  
			  <?php $i = 0;?>
			  <?php foreach($repeatable as $element) :?>
			  
					<div class="panel panel-default">
					  <div class="panel-heading" role="tab" id="heading<?php echo sanitize_title($element['name'])?>">
						<h4 class="panel-title">
						  <a class="<?php if($i == 0) : echo 'active'; endif;?>" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo sanitize_title($element['name'])?>" aria-expanded="true" aria-controls="collapse<?php echo sanitize_title($element['name'])?>">
							<?php echo $element['name']?>
						  </a>
						</h4>
					  </div>
					  <div id="collapse<?php echo sanitize_title($element['name'])?>" class="panel-collapse collapse <?php if($i == 0) : echo 'in'; endif;?>" role="tabpanel" aria-labelledby="heading<?php echo sanitize_title($element['name'])?>">
						<div class="panel-body">
							<div class="caption">
								<?php echo $element['element']?>	
							</div>
						</div>
					  </div>
					</div>
					
			  <?php $i++;?>
			  <?php endforeach;?>
			
			</div>
		</div>
	<?php endif;?>
		
</div>

<?php
/* =============
 * End content
 * =============
 */
?>


<?php get_footer(); ?>