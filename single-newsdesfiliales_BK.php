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

        <h2><?php echo wp_trim_words( strip_tags($post->post_content), 5, '...' )?></h2>

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

<div class="block_article">

   <div class="container">

	  

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