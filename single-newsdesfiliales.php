<?php 
/*template name: Page newsdesfiliales */

get_header(); ?>

<?php
/* =============
 * Start top page
 * =============
 */
?>

<?php if ( get_post_type( get_the_ID() ) == 'job_listing' ) : ?>

	<?php
	$pageID = get_option('page_on_front');
	$homepage = get_page($pageID);
	?>

	<?php $options = get_option('salient'); ?>
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $homepage->ID ), 'single-post-thumbnail' ); ?>

	<div class="banner_top" style="background-image:url(<?php echo $image[0];?>)">
		<div class="caption">
			<h1><?php echo get_post_meta( $homepage->ID, 'subtitle_meta_box_text' )[0]?></h1>
			<hr noshade/>
			<h2><?php echo $post->post_title?></h2>
		</div>
	</div>

<?php else :?>

	<?php $options = get_option('salient'); ?>
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
	<?php $header_bg = get_post_meta($post->ID, '_nectar_header_bg', true);  ?>

	<div class="banner_top" style="background-image:url(/wp-content/uploads/2017/07/efi-filiale.jpg)">
		<div class="caption">
			<h1><?php echo $post->post_title?></h1>
			<hr noshade/>
			<?php /*<h2><?php echo wp_trim_words( strip_tags($post->post_content), 5, '...' )?></h2>*/ ?>
		</div>
	</div>

<?php endif;?>

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

<div class="block_article">
   <div class="container">
	  <div class="caption">
		 <div class="header">
			<h2><?php echo $post->post_title?></h2>
			<?php /*<small><?php echo get_the_date(); ?></small>*/?>
		 </div>
		 <div class="content">
		 	<div class="row">
		 		<div class="col-12 col-lg-6">
					<div class="imgPostUneAutoArticl">
						<?php $image = wp_get_attachment_url( get_post_thumbnail_id($r->ID)); ?>
						<?php print_r($article); ?>
						<img class="imagepost" src="<?php echo $image?>" alt="<?php echo $article->post_title?>"/>
					</div>
				</div>
				<div class="col-12 col-lg-6">
					<?php echo $post->post_content;?>
				</div>
			</div>
		 </div>
		 <div class="clearfix"></div>
	  </div>
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
<?php */
$currentlang = get_bloginfo('language');
?>

<div class="blog-recent" fnc-latestPosts>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-lg-6">
				<?php if($currentlang=="fr-FR"): ?>
					<h3>Prochains évènements</h3>
				<?php else: ?>
					<h3>Upcoming events</h3>
				<?php endif; ?>
			</div>
			<div class="col-xs-12 col-sm-6 col-lg-6 text-right">
				<h3><a href="#"><?php echo get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['see_all_'.ICL_LANGUAGE_CODE]?></a></h3>
			</div>
		</div>
		<div class="row">
			<?php
			$categories = get_main_articles_categories();
			if($currentlang=="fr-FR"): ?>
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
					                                <?php /*<small><?php echo $date;?></small>*/ ?>
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
			<?php 
			// si la langue afficher est l'anglais US
			elseif($currentlang=="en-US"):?>
				<div class="block_news">
				    <div class="container-fluid">
			            <?php foreach($categories as $category) :
			                if ($category->term_id=='3') { ?>
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
					                                <?php /*<small><?php echo $date;?></small>*/ ?>
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
<?php endif; ?>

<?php
/* =============
 * End news
 * =============
 */
?>

<?php get_footer(); ?>