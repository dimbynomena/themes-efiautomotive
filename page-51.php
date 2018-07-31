<?php 
/*template name: Page news */

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
 * Start news
 * =============
 */
?>

<?php
$categories = get_main_articles_categories();
?>

<div class="block_news">
    <div class="container-fluid">
        
        <?php foreach($categories as $category) :
            if ($category->term_id=='46') { ?>
                <div class="row category">
    
                    <?php foreach($category->articles as $article) : ?>
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
                    <?php endforeach;?>
                </div>
            <?php } ?>
        <?php endforeach;?>
            
    </div>
</div>

<?php
/* =============
 * End news
 * =============
 */
?>

<?php get_footer(); ?>