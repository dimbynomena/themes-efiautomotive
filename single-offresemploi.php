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
		<?php
		/* =============
		 * Button language start
		 * =============
		 */
		?>
	    <?php
	    // la variable $currentlang recolte la langue
	    $currentlang = get_bloginfo('language');
	    // si la langue afficher est le français
	    if($currentlang=="fr-FR"): ?>
	    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myOfferModal"><?php _e('Postuler à cette offre','theme-text-domain'); ?></a>
	    <?php 
	    // si la langue afficher est l'anglais US
	    elseif($currentlang=="en-US"):?>
	    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myOfferModal"><?php _e('Apply to this offer','theme-text-domain'); ?></a>
	    <?php endif; ?>
		<?php
		/* =============
		 * Button language end
		 * =============
		 */
		?>
    </div>
</div>

<div class="modal fade" id="myOfferModal" tabindex="-1" role="dialog" aria-labelledby="myOfferModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myOfferModalLabel"><?php _e('Envoyer ma candidature','theme-text-domain'); ?></h4>
      </div>
      <div class="modal-body">
        <?php
		$subject = __('Candidature à une offre d\'emploi :','theme-text-domain').' '.$post->post_title;
		$id = get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['page_offer_form_'.ICL_LANGUAGE_CODE];
		$shortcode = '[contact-form-7 id="'.$id.'" your-subject="'.$subject.'"]';
		echo do_shortcode($shortcode);
		?>
      </div>
    </div>
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
<div class="block_offer">
   <div class="container">
   	<a href="/offres-emploi" class="gm-style-iw" style="margin-bottom:10px;display:block;font-size:12px;">
   		« Retour à nos offres d'emploi
   	</a>
	<?php $post_date = get_the_time('l j F Y', $post->ID);?>
	<?php $hours = get_post_meta($post->ID, 'heuresparsemain_63775')[0];?>
	<?php $money = get_post_meta($post->ID, 'salaireestimati_82291')[0];?>
	<?php $city = get_post_meta($post->ID, 'ville_73838')[0];?>
	<?php $street = get_post_meta($post->ID, 'adressedulieude_73838')[0];?>
	<?php $postal_code = get_post_meta($post->ID, 'codepostal_73838')[0];?>
	<?php $country = get_post_meta($post->ID, 'pays_73838')[0];?>
	<?php $formation = get_post_meta($post->ID, 'formationsexi_82618')[0];?>
	<?php $experience = get_post_meta($post->ID, 'exprienceexig_71777')[0];?>
	<?php $certification = get_post_meta($post->ID, 'certificatouacc_65547')[0];?>
	<?php $localisation = /*$city.' '.*/$country;?>
	<?php 
		//Page test Rocky
	/*	$sectors = get_main_filiales_entreprises();
	echo '<pre>';
	print_r($post);
		foreach ($sectors as $sector) {
			foreach($sector->entreprises as $entreprise){
				echo '<pre>';
				print_r($entreprise);
				echo $entreprise->post_name. '<br>'; 
			}
		}
		exit();*/
	 ?>
       <ul class="details">
        <?php if($post_date) :?><li><i class="fa fa-calendar" aria-hidden="true"></i> <span><?php _e('Date de parution','theme-text-domain'); ?></span><?php echo ucfirst($post_date)?></li><?php endif;?>
        <?php if($hours) :?><li><i class="fa fa-clock-o" aria-hidden="true"></i> <span><?php _e('Horaires','theme-text-domain'); ?></span><?php echo $hours?></li><?php endif;?>
        <?php if($money) :?><li><i class="fa fa-money" aria-hidden="true"></i> <span><?php _e('Salaire estimatif','theme-text-domain'); ?></span><?php echo $money?></li><?php endif;?>
        <?php 
        //code Link Page Recrutement
	        if($city == "Beynost"){
	        	$linkPage = "electricfil-automotive-siege-social";
			}elseif($city == "Guadalajara"){
				$linkPage = "electricfil-de-mexico-guadalaja";
			}elseif($city == "Dubullu"){
				$linkPage = "electricfil-unifil-otomotiv";
			}elseif($city == "Elkmont"){
				$linkPage = "electricfil-corporation-alabama-facility";
			}elseif($city == "Plymouth"){
				$linkPage = "electricfil-corporation-michigan-office";
			}elseif($city == "Joinville"){
				$linkPage = "electricfil-service";
			}elseif($city == "Tokyo"){
				$linkPage = "Japan-office";
			}elseif($city == "Wuhan"){
				$linkPage = "electricfil-engine-components";
			}elseif($city == "Madrid"){
				$linkPage = "electricfil-espanola";
			}elseif($city == "Berlin"){
				$linkPage = "electricfil-automotive-bureau-allemagne";
			}elseif($city == "Rome"){
				$linkPage = "electricfil-automotive-bureau-italie";
			}
		?>
        <?php if($city && $country) :?><li><i class="fa fa-map-marker" aria-hidden="true"></i><span><?php _e('Localisation','theme-text-domain'); ?></span> <a target="_blank" href="<?php 
        		/*global $wp;  
				$current_url = home_url(add_query_arg(array(),$wp->request));*/
				/*    efi config  global url filiales  */
				//$page_id = 'Japan-office';
				/*$page_id = 'electricfil-corporation-michigan-office';
				$page_id = 'electricfil-de-mexico-guadalaja';
				$page_id = 'electricfil-engine-components';
				$page_id = 'electricfil-automotive-siege-social';
				$page_id = 'electricfil-automotive-bureau-allemagne';
				$page_id = 'electricfil-service';
				$page_id = 'electricfil-espanola';
				$page_id = 'electricfil-automotive-bureau-italie';
				$page_id = 'electricfil-unifil-otomotiv';
				$page_id = 'electricfil-corporation-alabama-facility';*/
				echo get_site_url('/nos-filiales' , $linkPage);
				/*function getURL(){
					foreach('$url' as '$key' => '$value')	
				}*/
				/*$page_id = 'array('')';*/
	/*echo site_url('/nos-filiales'.'/'.);*/
				/*    efi config  global url filiales  */
        ?>">
        	<?php echo $localisation;?></a></li><?php endif;?>
      </ul>
	  <h2 class="subtitle"><?php _e('Présentation du poste','theme-text-domain'); ?></h2>
	  <?php echo $post->post_content;?>
	  <?php if($formation) :?>
		<h2 class="subtitle"><?php _e('Formation(s) exigée(s)','theme-text-domain'); ?></h2>
		<?php echo $formation;?>
	  <?php endif;?>
	  <?php if($experience) :?>
		<h2 class="subtitle"><?php _e('Expérience exigée','theme-text-domain'); ?></h2>
		<?php echo $experience;?>
	  <?php endif;?>
	  <?php if($certification) :?>
		<h2 class="subtitle"><?php _e('Certificat ou accréditation exigés','theme-text-domain'); ?></h2>
		<?php echo $certification;?>
	  <?php endif;?>
	  <hr noshade/>
<?php
/* =============
 * Button language start
 * =============
 */
?>
    <?php
    // la variable $currentlang recolte la langue
    $currentlang = get_bloginfo('language');
    // si la langue afficher est le français
    if($currentlang=="fr-FR"): ?>
    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myOfferModal"><?php _e('Postuler à cette offre','theme-text-domain'); ?></a>
    <?php 
    // si la langue afficher est l'anglais US
    elseif($currentlang=="en-US"):?>
    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myOfferModal"><?php _e('Apply to this offer','theme-text-domain'); ?></a>
    <?php endif; ?>
<?php
/* =============
 * Button language end
 * =============
 */
?>
	  <br/><br/>
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
<?php
/* =============
 * End news
 * =============
 */
?>

<?php get_footer(); ?>