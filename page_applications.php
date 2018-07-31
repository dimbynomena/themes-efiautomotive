<?php 
/*template name: Page application */

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
 * Start categories
 * =============
 */
?>

<?php
$categories = get_main_portfolio_categories();
$counter = count($categories);
?>

<div class="product-categories" fnc-productCategories>
	<div class="container-fluid">
		<div class="row">
			<?php foreach($categories as $category) :?>
				<?php if($category->parent == 0) :?>
					<div class="col-xs-12 col-sm-4 col-lg-2 element">
					   <a href="#<?php echo $category->slug;?>">
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
					<?php
					/*$NomVariable='cat_'.$category->term_id;
					$NomVariable='
					<div class="col-xs-12 col-sm-4 col-lg-2 element">
					   <a href="#'.$category->slug.'">
						  <div class="box" style="border-color:'.$category->term_meta['cat_color'].'" fnc-productCategoriesBox>
							  <div class="image" style="background-image:url('.$category->term_meta['catimg'].')">
								 <div class="icone">
									 <img src="'.esc_attr($category->term_meta['icone']).'" alt="'.$category->name.'"/>	
								 </div>
							  </div>
							  <h3 style="color:'.$category->term_meta['cat_color'].'">'.$category->name.'</h3>
							  <p>'.esc_attr($category->term_meta['subtitle']).'</p>
						  </div>
					   </a>
					</div>';*/
					?>
				<?php endif; ?>
			<?php endforeach;?>
			<?php //echo $cat_74.$cat_75.$cat_76.$cat_77.$cat_203.$cat_78; ?>
		</div>
	</div>
</div>

<div class="product-grid-products">
	<div class="container">
			<?php foreach($categories as $category) :?>
				<?php
					// $products = get_main_portfolio_products($category->term_id);
					
					if($category->parent == 0) {
					?>
						<div class="category row" fncScrollToTarget="<?php echo $category->slug;?>" id="<?php echo $category->slug;?>">
							<div class="col-xs-12 col-md-4 col-lg-4">
								<div class="category-image"  style="background-image:url(<?php echo $category->term_meta['catimg']?>)">
									<div class="icone">
										<img src="<?php echo esc_attr($category->term_meta['icone'])?>" alt="<?php echo $category->name;?>"/>	
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-md-8 col-lg-8 category-description">
								<h2 style="color:<?php echo $category->term_meta['cat_color'];?>"><?php echo $category->name;?></h2>
								<h3><?php echo esc_attr($category->term_meta['subtitle'])?></h3>
								<hr noshade style="border-top-color:<?php echo $category->term_meta['cat_color'];?>"/>
								<div class="category-content">
									<?php echo $category->description?>
								</div>
							</div>
						</div>
						<?php
						
						$products_tests = get_secondary_portfolio_products($category->term_id, $category->term_meta['cat_color'], $categories);
						
						if($products_tests == 0) {
							$products = get_main_portfolio_products($category->term_id);
							?>
							<div class="products row">
								<div class="col-xs-12 col-md-12 col-lg-12">
								  <h4 style="color:<?php echo $category->term_meta['cat_color']; ?>">
									<?php echo get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['range_products_'.ICL_LANGUAGE_CODE]?>
								  </h4>
								</div>
								<div class="col-xs-12 col-md-12 col-lg-12">
								  <div class="row">
									<?php
									  foreach($products as $product)
									  {
										$image = wp_get_attachment_url( get_post_thumbnail_id($product->ID));
										?>
										<div class="col-xs-12 col-md-4 col-lg-2 product">
										  <a href="<?php echo get_permalink( $product->ID )?>" class="caption" style="border-left-color:<?php echo $category->term_meta['cat_color'];?>" fncProductCategory>
											<img class="imageproduct" src="<?php echo $image?>"/>
										  </a>
										</div>
									  <?php } ?>
								  
								  </div>
								</div>	
								
							</div>
							<?php
						}
						$products_tests = 0;
					}
					
			   ?>
				   				   
				   <?php /* 
					<div class="category row" fncScrollToTarget="<?php //echo $category->slug;?>">
					   <div class="col-xs-12 col-md-4 col-lg-4">
						 <div class="category-image"  style="background-image:url(<?php //echo $category->term_meta['catimg']?>)">
							 <div class="icone">
								 <img src="<?php //echo esc_attr($category->term_meta['icone'])?>" alt="<?php //echo $category->name;?>"/>	
							 </div>
						 </div>
					   </div>
					   <div class="col-xs-12 col-md-8 col-lg-8 category-description">
							 <h2 style="color:<?php //echo $category->term_meta['cat_color'];?>"><?php //echo $category->name;?></h2>
							 <h3><?php //echo esc_attr($category->term_meta['subtitle'])?></h3>
							 <hr noshade style="border-top-color:<?php //echo $category->term_meta['cat_color'];?>"/>
							 <div class="category-content">
								 <?php //echo $category->description?>
							 </div>
					   </div>
					</div>
					
					
					<div class="products row">
					   <div class="col-xs-12 col-md-12 col-lg-12">
						 <h4 style="color:<?php //echo $category->term_meta['cat_color'];?>">
							 <?php //echo get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['range_products_'.ICL_LANGUAGE_CODE]?>
						 </h4>
					   </div>
					   <div class="col-xs-12 col-md-12 col-lg-12">
						 <div class="row">
							 <?php //foreach($products as $product) :?>
								 
								 <?php //echo "product->ID : ".$product->ID."<br/>";
									 //echo "product->name : ".$product->post_name."<br/>";
									 
									 //var_dump($product);
								 ?>
								 
								 
								 <?php //$image = wp_get_attachment_url( get_post_thumbnail_id($product->ID));	?>
								 <!-- <div class="col-xs-12 col-md-4 col-lg-4 product"> -->
								 <!-- <div class="col-xs-12 col-md-4 col-lg-2 product">
									 <a href="<?php //echo get_permalink( $product->ID )?>" class="caption" style="border-left-color:<?php //echo $category->term_meta['cat_color'];?>" fncProductCategory>
										 <img class="imageproduct" src="<?php //echo $image?>"/>
										 <!-- <div class="content" style="width: 33%;">
											 <h5 style="color:<?php //echo $category->term_meta['cat_color'];?>"><?php //echo $product->post_title?></h5>
											 <h6><?php //echo wp_trim_words( $product->post_content, 20, '...' )?></h6>
										 </div> -->
									 <!-- </a>
								 </div>
							 
							 <?php //endforeach;?>
							 
						 </div>
					   </div>	
				 
					</div>
				*/ ?>
			<?php endforeach;?>
	</div>
</div>

<?php
/* =============
 * End categories
 * =============
 */
?>

<?php get_footer(); ?>