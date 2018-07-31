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

<div id="BanniereTopForm" class="banner_top" style="background-image:url(<?php echo $image[0];?>)">
    <div class="caption">
    	<div id="LogosFormulaire">
			<?php
			$Logo1=$formCode=get_post_meta($post->ID, 'logo_un', true);
			if ($Logo1!='') {
				?>
				<img src="<?php echo $Logo1 ?>" alt="Logo <?php echo $post->post_title; ?>" title="Inscrivez vous au <?php echo $post->post_title; ?>"/>
				<?php
			}
			$Logo2=$formCode=get_post_meta($post->ID, 'logo_deux', true);
			if ($Logo2!='') {
				?>
				<img src="<?php echo $Logo2 ?>" alt="Logo <?php echo $post->post_title; ?>" title="Inscrivez vous au <?php echo $post->post_title; ?>"/>
				<?php
			}
			?><br/><?php
			$Logo3=$formCode=get_post_meta($post->ID, 'logo_trois', true);
			if ($Logo3!='') {
				?>
				<img src="<?php echo $Logo3 ?>" alt="Logo <?php echo $post->post_title; ?>" title="Inscrivez vous au <?php echo $post->post_title; ?>"/>
				<?php
			}
			$Logo4=$formCode=get_post_meta($post->ID, 'logo_quatre', true);
			if ($Logo4!='') {
				?>
				<img src="<?php echo $Logo4 ?>" alt="Logo <?php echo $post->post_title; ?>" title="Inscrivez vous au <?php echo $post->post_title; ?>"/>
				<?php
			}
			?>
		</div>
    </div>
</div>

<div id="PageFormulaire" class="content container">
	
	<div class="row mt-5">
		<?php
		$formCode=get_post_meta($post->ID, 'formulaire', true);
		$ColBody="col-md-12";
		if ($formCode!='') {
			$ColBody='col-md-8';
		}
		?>
		<?php if(!empty($post->post_content)) : ?>
	    <div class="body mt-0 <?php echo $ColBody ?>">
	    	<h1><span><?php echo $post->post_title; ?></span></h1>
			<?php the_content()?>
	    </div>
		<?php endif;?>
		<?php
		if ($formCode!='') {
			?>
			<div class="col-md-4">
				<div id="FormEvent">
					<?php echo do_shortcode($formCode); ?>
				</div>
			</div>
		<?php } ?>
    </div>
	
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

<style>
#top,
#footer-widgets {
	display: none;
}
</style>
<?php get_footer(); ?>