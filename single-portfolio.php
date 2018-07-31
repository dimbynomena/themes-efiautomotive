<?php get_header(); ?>

<?php
/* =============
 * Start top page
 * =============
 */
?>

<?php
$options = get_option('salient');

$page_applications = get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['page_applications_'.ICL_LANGUAGE_CODE];
$page_contacts = get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['page_contacts_'.ICL_LANGUAGE_CODE];

$page_applications = get_post($page_applications);
$page_contacts = get_post($page_contacts);

$category = get_the_terms( $post->ID, 'project-type' );
/*?>//<?php print_r($category); ?>\\<?php*/
if ($category!='') {
	$category[0]->term_meta = get_option( "taxonomy_".$category[0]->term_id);
}

$file = get_post_meta($post->ID, 'wp_custom_attachment');
?>

<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $page_applications->ID ), 'single-post-thumbnail' ); ?>

<div class="banner_top" style="background-image:url(<?php echo $image[0];?>)">
    <div class="caption">
        <h1><?php echo $post->post_title?></h1>
        <hr noshade/>
        <h2><?php //echo wp_trim_words( $category[0]->description, 20, '...' )?></h2>
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
 * Start product
 * =============
 */
$LANG=get_locale();
?>

<div class="block_product container-fluid">
    <div class="row">
        
        <div class="col-xs-12 col-sm-12 col-lg-7 informations">
            <h3 style="color:<?php echo $category[0]->term_meta['cat_color'];?>"><?php echo $category[0]->name?></h3>
            <?php /*<a class="goback" href="<?php echo get_permalink($page_applications->ID).'#'.$category[0]->slug;?>"><i style="color:<?php echo $category[0]->term_meta['cat_color'];?>" class="fa fa-chevron-left" aria-hidden="true"></i> Retour aux gammes</a>*/ ?>
            <a class="goback" href="javascript: history.go(-1)">
            	<i class="fa fa-chevron-left" aria-hidden="true"></i>
            	<?php
				if ($LANG=='fr_FR') {
					echo ' Retour';
				}
				else if ($LANG=='en_US') {
					echo ' Back';
				} 
				?>
			</a>
            
			<?php if(the_content()) :?>
            <hr noshade style="border-top-color:<?php echo $category[0]->term_meta['cat_color'];?>"/>
            
            <div class="content">
                <?php the_content()?>
            </div>
            
            <hr noshade style="border-top-color:<?php echo $category[0]->term_meta['cat_color'];?>"/>
			
			<?php endif;?>
            
			<?php if($file) :?>
            <a target="_blank" href="<?php echo $file[0]['url'];?>" class="btn btn-primary" style="background-color:<?php echo $category[0]->term_meta['cat_color'];?>; border-color:<?php echo $category[0]->term_meta['cat_color'];?>">
            	<?php
				if ($LANG=='fr_FR') {
					echo 'Télécharger la fiche technique';
				}
				else if ($LANG=='en_US') {
					echo 'Download the product sheet';
				} 
				?>
            </a>
			<?php endif;?>
			<br/>
			<?php
			$codlang="";
			if ($LANG=='en_US') {
				$codlang="en/";
			} 
			?>
            <a target="_blank" href="<?php echo get_site_url().'/'.$codlang.$page_contacts->post_name?>" class="btn btn-default" style="color:<?php echo $category[0]->term_meta['cat_color'];?>; border-color:<?php echo $category[0]->term_meta['cat_color'];?>">
            	<?php
				if ($LANG=='fr_FR') {
					echo 'Demande d\'informations';
				}
				else if ($LANG=='en_US') {
					echo 'Information request';
				} 
				?>
            </a>

        </div>
        
        <div class="col-xs-12 col-sm-12 col-lg-5 images">
            <?php $product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
            <img class="img-responsive" fnc-LighBoxImage src="<?php echo $product_image[0];?>" alt="<?php echo $post->post_title?>" title="<?php echo $post->post_title?>"/>
        </div>
        
    </div>
</div>


<style type="text/css">
    .block_product .content li:before{
        color:<?php echo $category[0]->term_meta['cat_color'];?>
    }
</style>

<?php
/* =============
 * End product
 * =============
 */
?>

<?php
/* =============
 * Start products
 * =============
 */
if ($category!='') {
	$CategoryParent = get_the_category_by_ID($category[0]->parent);
	?>

	<div class="blog-recent products" fnc-latestPosts>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-lg-6">
					<h3><?php _e('Autres produits du domaine d\'activité','theme-text-domain'); echo ' '.$CategoryParent; ?></h3>
				</div>
				<div class="col-xs-12 col-sm-6 col-lg-6 text-right">
					<h3><a href="<?php echo get_permalink($page_applications->ID).'#'.$category[0]->slug;?>"><?php echo get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['see_all_'.ICL_LANGUAGE_CODE]?></a></h3>
				</div>
			</div>
			<div class="row">
				
				<?php
				$list_products = get_same_category_products($category[0]->parent);
				if($list_products && !empty($list_products)) :
					foreach($list_products as $list_product) : ?>
						<div class="col-xs-12 col-sm-6 col-lg-3">
							<div class="post-header" fnc-latestPostsBox>
								<a href="<?php echo get_permalink($list_product->ID); ?>">
								  <div class="image" style="background-image:url(<?php echo get_the_post_thumbnail_url($list_product->ID); ?>)"></div>
								  <!--<p><?php echo $CategoryParent; ?></p>-->
								  <h3 class="title"><?php echo $list_product->post_title; ?></h3>
								</a>
							</div>
											
						</div>
					
					<?php endforeach;
				endif; ?>
			
			</div>
		</div>
	</div>

	<?php
}
/* =============
 * End products
 * =============
 */
?>

<?php
/* =============
 * Start news
 * =============

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