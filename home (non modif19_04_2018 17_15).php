<?php 
/*template name: Efi Accueil */
get_header(); ?>
	
<?php $options = get_option('salient'); ?> 

<?php
/* =============
 * Start Slider
 * =============
 */
?>

<?php 
 $slides = new WP_Query( array( 'post_type' => 'nectar_slider', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'id' ) ); 
 if( $slides->have_posts() ) : ?>

<div id="carousel-home" class="carousel slide" data-ride="carousel">

	<div class="carousel-inner">
	<?php
	$i = 0;
	while( $slides->have_posts() ) : $slides->the_post();
		if($i == 0)
		{
			$active = 'active';
		} else {
			$active = '';
		}
		?>
	
		<div class="item <?php echo $active?>">
		  <div class="image" style="background-image:url(<?php echo get_post_meta($post->ID, '_nectar_slider_image', true);?>)"></div>
		  <div class="caption">
			<div class="table">
				<h1>Efi automotive</h1>
				<h3><?php echo get_post_meta($post->ID, '_nectar_slider_heading', true); ?></h3>
				<hr noshade/>
				<p><?php echo get_post_meta($post->ID, '_nectar_slider_caption', true); ?></p>
				<?php if(get_post_meta($post->ID, '_nectar_slider_button_url', true) && get_post_meta($post->ID, '_nectar_slider_button', true) ) :?>
				  <a href="<?php echo get_site_url().'/'.get_post_meta($post->ID, '_nectar_slider_button_url', true); ?>" class="btn btn-primary"><?php echo get_post_meta($post->ID, '_nectar_slider_button', true); ?></a>
				<?php endif;?>
				<?php if(get_post_meta($post->ID, '_nectar_slider_button_url_2', true) && get_post_meta($post->ID, '_nectar_slider_button_2', true) ) :?>
				  <a href="<?php echo get_site_url().'/'.get_post_meta($post->ID, '_nectar_slider_button_url_2', true); ?>" class="btn btn-primary"><?php echo get_post_meta($post->ID, '_nectar_slider_button_2', true); ?></a>
				<?php endif;?>
			</div>
		  </div>
		</div>
		
		
	<?php
	$i++;
	endwhile; ?>
	</div>
	 
   <a class="left carousel-control" href="#carousel-home" data-slide="prev">
	 <i class="fa fa-angle-left" aria-hidden="true"></i>

   </a>
   <a class="right carousel-control" href="#carousel-home" data-slide="next">
	 <i class="fa fa-angle-right" aria-hidden="true"></i>

   </a>
	
</div>
   

<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php
/* =============
 * End Slider
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
				<h3><a href="<?php echo get_category_link( 46 ); ?>"><?php echo get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['see_all_'.ICL_LANGUAGE_CODE]?></a></h3>
			</div>
		</div>
		<div class="row">
			
			<?php
			/*$articles = get_recent_articles();
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
		
			<?php endwhile; endif;*/ ?>
			<?php
			$categories = get_main_articles_categories();
			?>

			<div class="block_news">
			    <div class="container-fluid">
		            <?php foreach($categories as $category) :
		                if ($category->term_id=='46') { ?>
		                    <div class="row category">
		                        <?php $i=1; foreach($category->articles as $article) : ?>
			                        <?php if ($i<5) { ?>
				                        <?php $image = wp_get_attachment_url( get_post_thumbnail_id($article->ID)); ?>
				                        <?php $date = date('d/m/Y', strtotime($article->post_date)); ?>
				                        <div class="col-xs-12 col-sm-6 col-lg-3 article">
										 <div class ="imageposthome">
				                            <a href="<?php echo get_permalink( $article->ID )?>" class="caption" fncArticlesCategory>
				                                <?php if ($image!='') { ?>
												
				                                    <img class="imagepost" src="<?php echo $image;?>" alt="<?php echo $article->post_title?>"/>
													
				                                <?php } ?>
				                                <h4><?php echo $article->post_title?></h4>
				                                <p><?php echo wp_trim_words( strip_tags($article->post_content), 15, '...' )?></p>
				                                <small><?php echo $date;?></small>
				                            </a>
										   </div>
				                        </div>
			                        <?php } ?>
		                        <?php $i++; endforeach;?>
		                    </div>
		                <?php } ?>
		            <?php endforeach;?>
				
			    </div>
			</div>
		
		</div>
	</div>
</div>

<?php
/* =============
 * End news
 * =============
 */
?>

<?php if( dynamic_sidebar('home_widgets') ): ?>
<?php endif; ?>

<?php
/* =============
 * Start categories
 * =============
 */
?>

<?php
$categories = get_main_portfolio_categories();
//$counter = count($categories);
$counter=0;
foreach($categories as $category) :
	if ($category->parent=='0') {
		$counter++;
	}
endforeach;
?>

<div class="product-categories" fnc-productCategories>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-lg-12">
				<h3 class="title"><span><?php echo $counter;?> <?php echo html_entity_decode(get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['domaines_activites_'.ICL_LANGUAGE_CODE])?></h3>
			</div>
		</div>
		<div class="row">
		 
		 <?php
		 $page = get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['page_applications_'.ICL_LANGUAGE_CODE];
		 $page = get_post($page);
		 ?>
		 
			<?php foreach($categories as $category) : ?>
			
				<?php if ($category->parent=='0') { ?>
					<div class="col-xs-12 col-sm-4 col-lg-2 element">
						<a href="<?php echo get_permalink($page->ID).'#'.$category->slug;?>">
							<div class="box" style="border-color:<?php echo $category->term_meta['cat_color'];?>" fnc-productCategoriesBox>
								<div class="image" style="background-image:url(<?php echo $category->term_meta['catimg']?>)">
									<div class="icone">
										<img src="<?php echo esc_attr($category->term_meta['icone'])?>" alt="<?php echo $category->name;?>"/>	
									</div>
								</div>
								<h3 style="color:<?php echo $category->term_meta['cat_color'];?>"><?php echo $category->name;?></h3>
								<p><?php echo esc_attr($category->term_meta['subtitle'])?></p>
							</div>
						</a>
					</div>
				<?php } ?>
				   
			<?php endforeach;?>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-lg-12 text-center">
				<a href="<?php echo get_site_url().'/'.$page->post_name;?>" class="btn btn-primary"><?php echo get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['button_more_'.ICL_LANGUAGE_CODE]?></a>
			</div>
		</div>
	</div>
</div>

<?php
/* =============
 * End categories
 * =============
 */
?>

	
<?php get_footer(); ?>