<?php

$category = get_the_category();

get_header(); ?>

<?php
/* =============
 * Start top page
 * =============
 */
?>

<?php $options = get_option('salient'); ?>
<?php $category[0]->image = get_term_meta( $category[0]->cat_ID, 'category-image-id' ); ?>
<?php $image = wp_get_attachment_url( $category[0]->image[0] ); ?>

<div class="banner_top" style="background-image:url(<?php echo $image?>)">
    <div class="caption">
        <h1><?php echo $category[0]->name?></h1>
        <hr noshade/>
        <h2><?php echo wp_trim_words( strip_tags($category[0]->category_description), 5, '...' )?></h2>
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
 * Start news
 * =============
 */
?>

<?php
$articles = get_main_articles_category($category[0]->cat_ID);
?>

<div class="block_news category">
    <div class="container-fluid">

                <div class="row category">

                    <?php foreach($articles as $article) :?>
                    <?php $image = wp_get_attachment_url( get_post_thumbnail_id($article->ID)); ?>
                    <?php $date = date('Y-m-d', strtotime($article->post_modified)); ?>
                    <div class="col-xs-12 col-sm-6 col-lg-3 article titi">
                        <a href="<?php echo get_permalink( $article->ID )?>" class="caption" fncArticlesCategory>
							<img class="imagepost" src="<?php echo $image?>" alt="<?php echo $article->post_title?>"/>
                            <h4><?php echo $article->post_title?></h4>
                            <p><?php echo wp_trim_words( strip_tags($article->post_content), 5, '...' )?></p>
                              
                        </a>
                    </div>
                    <?php endforeach;?>
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

<?php get_footer(); ?>