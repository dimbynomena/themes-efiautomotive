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
<?php
$repeatable = get_post_meta( $post->ID, 'fields_data', $fields_data );
$repeatable = $repeatable[0];
if($repeatable && isset($repeatable['image_url']) && !empty($repeatable['image_url'])) {
$count = count($repeatable['image_url']);
}
?>

<div class="content container">
	
	<?php if(!empty($post->post_content)) : ?>
    <div class="body">
		<?php the_content()?>
    </div>
	<?php endif;?>
    
	<?php
	if($repeatable && isset($repeatable['image_url']) && !empty($repeatable['image_url'])) :
	?>
		<div class="row">
			  
			<?php $i = 0;
			$ContenuGauche='';
			$ContenuDroite='';
			foreach($repeatable['image_url'] as $key => $element) {
				if ($i % 2 == 1) {
					$VarContenu="ContenuGauche";
				}
				else {
					$VarContenu="ContenuDroite";
				}
				$$VarContenu.='
				<div class="mb-4">
					<div class="mb-4">
						<div>
							<img src="'.$repeatable['image_url'][$key].'" alt="Logo '.$repeatable['image_desc'][$key].'" title="'.$repeatable['image_desc'][$key].'" />
						</div>
						<h2>
							'.$repeatable['image_desc'][$key].'
						</h2>
						<div>
							'.$repeatable['image_html'][$key].'
						</div>
					</div>
					<hr/>
				</div>';
				$i++;
			}
			?>

			<div class="col-md-6"><?php echo $ContenuDroite; ?></div>
			<div class="col-md-6"><?php echo $ContenuGauche; ?></div>
			
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