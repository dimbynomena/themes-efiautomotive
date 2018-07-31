<?php 
/*template name: Page Corporate */

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
 * Start content
 * =============
 */
?>

<?php
$repeatable = get_post_meta( $post->ID, 'fields_data', $fields_data );
$repeatable = $repeatable[0];
if($repeatable && isset($repeatable['image_url']) && !empty($repeatable['image_url'])) :
$count = count($repeatable['image_url']);
$width = (100 / $count) - 1;
?>
<div class="product-categories corporate" fnc-productCategories>
	<div class="container-fluid">
		<div class="row">
			<?php foreach($repeatable['image_url'] as $key => $element) :?>
			
				   <div class="element" style="width:<?php echo $width?>%">
					  <a href="#<?php echo sanitize_title($repeatable['image_desc'][$key])?>">
						 <div class="box" fnc-productCategoriesBox>
							 <div class="image" style="background-image:url(<?php echo $element?>)">
							 </div>
							 <h3><?php echo $repeatable['image_desc'][$key]?></h3>
						 </div>
					  </a>
				   </div>
				   
			<?php endforeach;?>
		</div>
	</div>
</div>
<?php endif;?>

<div class="content container">
	
	<?php if(!empty($post->post_content)) : ?>
    <div class="body">
		<?php
		$content = explode('|', get_the_content());
		?>
		
		<div class="row">
			<div class="text-center"<?php /*class="col-xs-12 col-sm-6"*/ ?>>
				<?php echo $content[0]?>
			</div>
			<?php /*<div class="col-xs-12 col-sm-6">
				<?php echo $content[1]?>
			</div>*/ ?>
		</div>
		
    </div>
	<?php endif;?>
    
	<?php
	if($repeatable && isset($repeatable['image_url']) && !empty($repeatable['image_url'])) :
	?>
		<div class="repeatable">
			  
			  <?php $i = 0;?>
			  <?php foreach($repeatable['image_url'] as $key => $element) :?>
			  
					<div fncScrollToTarget="<?php echo sanitize_title($repeatable['image_desc'][$key])?>" class="panel panel-default">
					  <div class="panel-heading" role="tab" id="<?php echo sanitize_title($repeatable['image_desc'][$key])?>">
						<h4 class="panel-title">
						  <?php echo $repeatable['image_desc'][$key]?>
						</h4>
					  </div>
					  <div>
						<div class="panel-body2">
							<div class="caption2">
								<?php echo $repeatable['image_html'][$key]?>	
							</div>
						</div>
					  </div>
					</div>
					
			  <?php $i++;?>
			  <?php endforeach;?>
			
		</div>
	<?php endif;?>
		
</div>

<?php
/* =============
 * End content
 * =============
 */
?>

<?php
/* =============
* Start map
* =============
*/
?>

<?php
$efi_configuration_options = get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE );
$sectors = get_main_filiales_entreprises();
?>

<?php
$map = get_post_meta( $post->ID, 'map_meta_box_text' )[0];
if($map && $map == 'oui') :
?>

	<script type="text/javascript">
		
		// Necessary variables
		var map;
		var infoWindow;
		var iconBase = 'http://localhost/efi-automotive/wp-content/uploads/2017/06/Logo-EFI-RVB-Inf-90-mm-1.png';
		var icon = {
			url: iconBase, // url
			scaledSize: new google.maps.Size(27, 20), // scaled size
			origin: new google.maps.Point(0,0), // origin
			anchor: new google.maps.Point(0, 0) // anchor
		};
		
		var markerMap = {};
		
		// Markers data
		var markersData = [
			<?php foreach($sectors as $sector) :?>
				<?php foreach($sector->entreprises as $entreprise) :?>
				
					<?php $gps = get_post_meta( $entreprise->ID, 'gps_meta_box_text' )[0];?>
					<?php if($gps && !empty($gps)) :?>
						<?php $gps = str_replace(' ', '', explode(',', get_post_meta( $entreprise->ID, 'gps_meta_box_text' )[0]))?>
						{
						   id: <?php echo $entreprise->ID?>,
						   lat: <?php echo $gps[0]?>,
						   lng: <?php echo $gps[1]?>,
						   name: "<?php echo $entreprise->post_title?>",
						   content: "<?php echo preg_replace("/\r\n|\r|\n/",'<br/>',str_replace('"', "'", strip_tags($entreprise->post_content)))?>"
						},
					<?php endif;?>
					
				<?php endforeach;?>
			<?php endforeach;?>
		];
		
		function initialize() {
		   var mapOptions = {
			 zoom: 3,
			 minZoom:3;
			 disableDefaultUI: true,
			 scrollwheel: false,
			 center: new google.maps.LatLng(0, 0),
			 styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
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
			  var content = markersData[i].content;
			  var id = markersData[i].id;
		
			  createMarker(latlng, name, content, id);
			  bounds.extend(latlng);
			  
		   }

		   map.fitBounds(bounds);
		}
		
		function createMarker(latlng, name, content, id){
			var marker = new google.maps.Marker({
			   map: map,
			   position: latlng,
			   title: name,
			   icon: icon,
			   id: id,
			   content: content
			});
			markerMap[ "marker-" + id ] = marker;
		
			google.maps.event.addListener(marker, 'click', function() {
			   var iwContent = '<div id="iw_container"><div class="iw_title">' + name + '</div><hr noshade/><div class="iw_content">' + content + '</div><a href="" class="btn btn-primary">Actualités</a></div>';
			   infoWindow.setContent(iwContent);
			   infoWindow.open(map, marker);
			});
		}
		
		function OpenInfowindowForMarker(index) {
			var iwContent = '<div id="iw_container"><div class="iw_title">' + markerMap[ index ].title + '</div><hr noshade/><div class="iw_content">' + markerMap[ index ].content + '</div><a href="" class="btn btn-primary">Actualités</a></div>';
			infoWindow.setContent(iwContent);
			infoWindow.open(map, markerMap[ index ]);
			var aTag = jQuery("#map");
			jQuery('html,body').animate({scrollTop: aTag.offset().top - 100},'slow');
		}
		
		jQuery(document).on('click', '[fnc-CloseMap]', function(){
			infoWindow.close();
		});
		 
	 </script>

	<div id="filiales" class="animated-map">
		<div class="block_map" id="map"></div>
		<div fnc-CloseMap class="closed"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div fnc-CaptionMap class="caption">
			<h3><?php echo $efi_configuration_options['titre_map_filiales_'.ICL_LANGUAGE_CODE]?></h3>
			<hr noshade/>
			<p><?php echo $efi_configuration_options['description_map_filiales_'.ICL_LANGUAGE_CODE]?></p>
			<a fnc-DisplayMap class="btn btn-primary"><?php echo $efi_configuration_options['bouton_map_filiales_'.ICL_LANGUAGE_CODE]?></a>
		</div>
	</div>
	
	<div class="container block_sectors" fnc-filialeBlock>
		<div class="row">
			<?php foreach($sectors as $sector) :?>
			
				<div class="col-xs-12 col-sm-6 col-lg-4 sector">
					<div class="caption"  fnc-sectorElement>
						<h4><?php echo $sector->name?></h4>
						<p><?php echo $sector->description?></p>
						
						<?php foreach($sector->entreprises as $entreprise) :?>
						
							<?php $filiale = get_post_meta( $entreprise->ID, 'filiale_meta_box_text' )[0]?>
							<?php $gps = str_replace(' ', '', explode(',', get_post_meta( $entreprise->ID, 'gps_meta_box_text' )[0]))?>
							<a <?php if($gps && !empty($gps)) :?> onclick="OpenInfowindowForMarker('<?php echo 'marker-'.$entreprise->ID;?>')" fnc-LocateEntreprise="<?php echo $entreprise->ID?>" fnc-GpsLatt="<?php echo $gps[0]?>" fnc-GpsLng="<?php echo $gps[1]?>" <?php endif;?> class="btn btn-default" data-toggle="tooltip" data-placement="top" title="<?php echo $entreprise->post_title?>"><?php echo $filiale?></a>
						
						<?php endforeach;?>
						
					</div>
				</div>
			
			<?php endforeach;?>
		</div>
	</div>

	<?php
	/* =============
	 * End map
	 * =============
	 */
	?>

<?php endif;?>

<?php
/* =============
 * Start widgets
 * =============
 */
?>


<div id="CTACorporate" class="container-fluid block_widgets" fnc-widgetPage>
	<div class="row row-centered">
		<div class="col-xs-12 block_cta col-centered">
            <div class="element" <?php /*style="background-image:url(http://efiautomotive.kiweerouge.com/wp-content/uploads/2017/08/slider-img1.jpg)"*/ ?>>
                <div class="background"></div>
                <div class="row">
					<?php if( dynamic_sidebar('cta_wigets') ): ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>


<?php if( dynamic_sidebar('page_wigets') ): ?>
		<?php endif; ?>

<?php
/* =============
 * End widgets
 * =============
 */
?>

<?php get_footer(); ?>