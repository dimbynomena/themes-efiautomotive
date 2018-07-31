<?php get_header(); ?>
<?php
/* =============
 * Start top page
 * =============
 */
$filiale = $post;
$LANG=get_locale();
?>

<?php
$options = get_option('salient');
$page_applications = get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['page_applications_'.ICL_LANGUAGE_CODE];
$page_contacts = get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['page_contacts_'.ICL_LANGUAGE_CODE];
$page_applications = get_post($page_applications);
$page_contacts = get_post($page_contacts);
?>

<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>

<div class="banner_top" style="background-image:url(<?php echo $image[0];?>)">
    <div class="caption">
        <h1><?php echo $post->post_title?></h1>
        <hr noshade/>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myFilialeModal">
			<?php echo get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['contact_filiales_'.ICL_LANGUAGE_CODE]?>
		</button>
    </div>
</div>

<div class="modal fade" id="myFilialeModal" tabindex="-1" role="dialog" aria-labelledby="myFilialeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myFilialeModalLabel"><?php echo get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['contact_filiales_'.ICL_LANGUAGE_CODE]?></h4>
      </div>
      <div class="modal-body">
        <?php
        $emailDestinataire = get_post_meta( $post->ID, 'mail_meta_box_text' );
    		$subject = __('Demande de contact à une fililale :','theme-text-domain').' '.$post->post_title;
    		$id = get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['contact_form_'.ICL_LANGUAGE_CODE];
    		$shortcode = '[contact-form-7 id="1959" your-subject="'.$subject.'" postid="'.$post->ID.'"]';
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

<div class="block_filiale" style="margin-top: 25px;">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <a class="goback" href="nos-filiales">
          <i class="fa fa-chevron-left" aria-hidden="true"></i>
          <?php
          if ($LANG=='fr_FR') {
            echo ' Retour à la liste des filiales';
          }
          else if ($LANG=='en_US') {
            echo ' Back to our sites list';
          } 
          ?>
        </a>
        <?php
        $presentation = get_post_meta( $post->ID, 'extra-content');
        echo $presentation[0];
        ?>
        <?php
        /* =============
         * Start galerie
         * =============
         */

        $gallery_data = get_post_meta( $filiale->ID, 'gallery_data', true );
        if($gallery_data && isset($gallery_data['image_url']) && !empty($gallery_data['image_url'])) :
        ?><hr>
          <div class="blog-recent filiale galerie" fnc-latestPosts>
            <div class="">
              <div class="row">
                <div class="col-xs-12">
                  <h3>
                    <?php
                    if ($LANG=='fr_FR') {
                     // echo 'Produits fabriqués';
					  echo 'Quelques produits fabriqués';
                    }
                    else if ($LANG=='en_US') {
                      echo ' Manufactured products';
                    } 
                    ?>
                  </h3>
                </div>
              </div> 
              <div class="row">
                <?php
                foreach($gallery_data['image_url'] as $key => $image) : ?>
                  <div class="col-xs-12 col-sm-6 col-lg-4">
                    <div class="post-header" fnc-latestPostsBox data-toggle="modal" data-target="#modalImage<?php echo $key?>">
                      <h5 style="color: black; margin-bottom: 20px; margin-top:0px;padding:7px;"><?php echo $gallery_data['image_desc'][$key]; ?></h5>
                      <div class="image" style="background-image:url(<?php echo $image; ?>)"></div>
                    </div>
                  </div>
                  <div class="modal fade" id="modalImage<?php echo $key?>" tabindex="-1" role="dialog" aria-labelledby="modalImage<?php echo $key?>Label">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-body">
                          <img src="<?php echo $image; ?>" class="img-responsive"/>
                          <p><?php echo $gallery_data['image_desc'][$key]; ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach;?>
              </div>
            </div>
          </div>
        <?php
        endif;

        /* =============
         * End galerie
         * =============
         */
        ?>
      </div>
      <div class="col-md-4">
        <h5 style="line-height:1.5em;">
          <?php echo preg_replace("/\r\n|\r|\n/",'<br/>',str_replace('"', "'", $filiale->post_content))?>
        </h5>
        <div class="block_map" id="map" style="width:100%;height:300px;margin:20px 0;"></div>
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
 */
$articles = get_recent_articles_by_filiale($filiale->ID);
query_posts($articles);
?>
<hr>
<div class="blog-recent filiale" fnc-latestPosts>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-lg-6">
				<h3><?php echo get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['all_news_'.ICL_LANGUAGE_CODE]?></h3>
			</div>
		</div>
		<div class="row">
			<?php
			if(have_posts()) {
        while(have_posts()) : the_post(); ?>
    			<div class="col-xs-12 col-sm-6 col-lg-3">
    				<div class="post-header" fnc-latestPostsBox>
    					<a href="<?php the_permalink(); ?>">
    					  <div class="image" style="background-image:url(<?php echo the_post_thumbnail_url(); ?>)"></div>
    					  <p><?php echo get_the_category()[0]->name; ?></p>
    					  <h3 class="title"><?php the_title(); ?></h3>
    					</a>
    				</div>
    			</div>
  			<?php endwhile;
      } else { ?>
        <div class="col-xs-12">
          Actualités à venir
        </div>
     <?php } ?>
		</div>
	</div>
</div>

<?php

/* =============
 * End news
 * =============
 */
?>

<script type="text/javascript">
    // Necessary variables
    var map;
    var infoWindow;
    var iconBase = 'http://efiautomotive.kiweerouge.com/wp-content/uploads/2017/06/Logo-EFI-RVB-Inf-90-mm-1.png';
    var icon = {
        url: iconBase,
        scaledSize: new google.maps.Size(27, 20), 
        origin: new google.maps.Point(0,0), 
        anchor: new google.maps.Point(15, 10) 
    };
    var markerMap = {};
    // Markers data
    <?php $gps = str_replace(' ', '', explode(',', get_post_meta( $filiale->ID, 'gps_meta_box_text' )[0]))?>
    var markersData = [
        {
            id: <?php echo $filiale->ID?>,
            lat: <?php echo $gps[0]?>,
            lng: <?php echo $gps[1]?>,
            name: "<?php echo $filiale->post_title?>",
            posturl: "<?php echo get_permalink($filiale->ID)?>",
            content: "<?php echo preg_replace("/\r\n|\r|\n/",'<br/>',str_replace('"', "'", strip_tags($filiale->post_content)))?>"
        }
    ];
    function initialize() {
       var mapOptions = {
        zoom: 15,
		minZoom: 3,
        maxZoom: 21,
        disableDefaultUI: false,
        scrollwheel: true,
        center: new google.maps.LatLng(0, 0),
        styles:
          [{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#fcfcfc"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#fcfcfc"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#dddddd"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#dddddd"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#dddddd"}]}]			 
      };
	  
	
	  
      map = new google.maps.Map(document.getElementById('map'), mapOptions);
	  
      infoWindow = new google.maps.InfoWindow();
      google.maps.event.addListener(map, 'click', function() {

        infoWindow.close();
      });
      displayMarkers();
	  
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    function displayMarkers(){
       var bounds = new google.maps.LatLngBounds();
       for (var i = 0; i < markersData.length; i++){
          var latlng = new google.maps.LatLng(markersData[i].lat, markersData[i].lng);
          var name = markersData[i].name;
          var posturl = markersData[i].posturl;
          var content = markersData[i].content;
          var id = markersData[i].id;
          createMarker(latlng, name, content, id, posturl);
          bounds.extend(latlng);
       }
       map.fitBounds(bounds);
	   var listener = google.maps.event.addListener(map, "idle", function() { map.setZoom(15); google.maps.event.removeListener(listener); });
    }
    function createMarker(latlng, name, content, id, posturl){
        var marker = new google.maps.Marker({
           map: map,
           position: latlng,
           title: name,
           icon: icon,
           id: id,
           posturl: posturl,
           content: content
        });
        markerMap[ "marker-" + id ] = marker;
        google.maps.event.addListener(marker, 'click', function() {
           var iwContent = '<div id="iw_container"><div class="iw_title">' + name + '</div><hr noshade/><div class="iw_content">' + content + '</div></div>';
           infoWindow.setContent(iwContent);
           infoWindow.open(map, marker);
        });
    }
    function OpenInfowindowForMarker(index) {
        var iwContent = '<div id="iw_container"><div class="iw_title">' + markerMap[ index ].title + '</div><hr noshade/><div class="iw_content">' + markerMap[ index ].content + '</div></div>';
        infoWindow.setContent(iwContent);
        infoWindow.open(map, markerMap[ index ]);
        var aTag = jQuery("#map");
        var latLng = markerMap[ index ].getPosition(); // returns LatLng object
        map.setCenter(latLng);
        jQuery('html,body').animate({scrollTop: aTag.offset().top - 100},'slow');
    }
    jQuery(document).on('click', '[fnc-CloseMap]', function(){
        infoWindow.close();
    });
 </script>

<?php get_footer(); ?>