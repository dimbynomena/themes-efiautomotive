<?php 

/*template name: Page evenement */



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

 * Start events

 * =============

 */

?>



<?php

$categories = get_main_events_categories();

?>



<div class="block_news">

    <div class="container-fluid">

        

            

            <?php foreach($categories as $category) :?>

                <div class="row category">

                    <div class="col-xs-12 col-sm-12 col-lg-12">

                        <a href="<?php echo get_term_link($category->term_id)?>"><h3><?php echo $category->name?></h3></a>

                        <hr noshade/>

                    </div>

    

                    <?php foreach($category->articles as $article) :?>

                    <?php $image = wp_get_attachment_url( get_post_thumbnail_id($article->ID)); ?>

                    <?php $date = date('Y-m-d', strtotime($article->post_modified)); ?>

					<?php $start_date = get_post_meta($article->ID, 'datededbut_33725')[0];?>

					<?php $places = get_post_meta($article->ID, 'nombredeplacesm_36736')[0];?>

					

                    <div class="col-xs-12 col-sm-6 col-lg-4 article event">

                        <a href="<?php echo get_permalink( $article->ID )?>" class="caption" fncArticlesCategory>

                            <img class="imagepost" src="<?php echo $image?>" alt="<?php echo $article->post_title?>"/>

							<?php if($start_date) :?>

							<span class="date"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('d-m-Y', strtotime($start_date))?></span>

							<?php endif;?>

							<?php if($places) :?>

							<span class="places"><i class="fa fa-users" aria-hidden="true"></i> <?php echo $places?></span>

							<?php endif;?>

                            <h4><?php echo $article->post_title?></h4>

                            <p><?php echo wp_trim_words( strip_tags($article->post_content), 5, '...' )?></p>
                            <?php /*<small><?php echo $date;?></small>*/ ?>

                        </a>

                    </div>

                    <?php endforeach;?>

                </div>

            <?php endforeach;?>

            

        </div>

    </div>

</div>



<?php

/* =============

 * End events

 * =============

 */

?>



<?php get_footer(); ?>