<?php 

$pageID = get_option('page_on_front');
$homepage = get_page($pageID);

get_header(); ?>

<?php
/* =============
 * Start top page
 * =============
 */
?>

<?php $options = get_option('salient'); ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $homepage->ID ), 'single-post-thumbnail' ); ?>

<div class="banner_top" style="background-image:url(<?php echo $image[0];?>)">
    <div class="caption">
        <h1><?php echo get_post_meta( $homepage->ID, 'subtitle_meta_box_text' )[0]?></h1>
        <hr noshade/>
        <h2><?php echo $homepage->post_excerpt?></h2>
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
 * Start search
 * =============
 */
?>

<script>
jQuery(document).ready(function($){
	
	var $searchContainer = $('#search-results')
	
	$(window).load(function(){
		
		$searchContainer.isotope({
		   itemSelector: '.result',
		   masonry: { columnWidth: $('#search-results').width() / 3 }
		});
		
		$searchContainer.css('visibility','visible');
				
	});
	
	$(window).smartresize(function(){
	   $searchContainer.isotope({
	      masonry: { columnWidth: $('#search-results').width() / 3}
	   });
	});

	
});
</script>

<div class="block_search">
	
	<div class="container main-content">
		
		<div class="row">
			<div class="col span_12">
				<div class="col span_12 section-title">
					<h2><?php echo __('Results For', NECTAR_THEME_NAME); ?><span>"<?php the_search_query(); ?>"</span></h2>
				</div>
			</div>
		</div>
		
		<div class="divider"></div>
		
		<div class="row">
			
			<div class="col span_12">
				
				<div>
						
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
						
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-lg-2">
									<?php if(has_post_thumbnail( $post->ID )) {	
										echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'full', array('title' => '')).'</a>'; 
									} ?>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-lg-10">
									<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <?php if( get_post_type($post->ID) == 'page' ): ?>
                                        <p><?php echo $post->post_excerpt?></p>
                                    <?php else :?>
                                        <p><?php echo wp_trim_words( strip_tags($post->post_content), 20, '...' )?></p>
                                    <?php endif;?>
                                </div>
                            </div>
                            
                            <hr noshade/>

					<?php endwhile; 
					
					else: echo "<p>" . __('No results found', NECTAR_THEME_NAME) . "</p>"; endif;?>
				
						
				</div><!--/search-results-->
				
				
				<?php if( get_next_posts_link() || get_previous_posts_link() ) { ?>
					<div id="pagination">
						<div class="prev"><?php previous_posts_link('&laquo; Previous Entries') ?></div>
						<div class="next"><?php next_posts_link('Next Entries &raquo;','') ?></div>
					</div>	
				<?php }?>
				
			</div><!--/span_9-->
			
			<div id="sidebar" class="col span_3 col_last">
				<?php get_sidebar(); ?>
			</div><!--/span_3-->
		
		</div><!--/row-->
		
	</div><!--/container-->

</div><!--/container-wrap-->

<?php
/* =============
 * End content
 * =============
 */
?>

<?php get_footer(); ?>
