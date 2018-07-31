<?php 
/*template name: Page Filiale */

get_header(); ?>

<div class="top-filiales"></div>

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
		var iconBase = 'http://efiautomotive.kiweerouge.com/wp-content/uploads/2017/06/Logo-EFI-RVB-Inf-90-mm-1.png';
		var icon = {
			url: iconBase,
			scaledSize: new google.maps.Size(27, 20), 
			origin: new google.maps.Point(0,0), 
			anchor: new google.maps.Point(15, 10) 
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
						   posturl: "<?php echo get_permalink($entreprise->ID)?>",
						   content: "<?php echo preg_replace("/\r\n|\r|\n/",'<br/>',str_replace('"', "'", strip_tags($entreprise->post_content)))?>"
						},
					<?php endif;?>
					
				<?php endforeach;?>
			<?php endforeach;?>
		];
		
		function initialize() {
		   var mapOptions = {
			 zoom: 3,
			 minZoom: 1,
			 maxZoom: 10,
			 disableDefaultUI: false,
			 scrollwheel: false,
			 center: new google.maps.LatLng(48.447614, 5.156181),
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
			   var iwContent = '<div id="iw_container"><div class="iw_title">' + name + '</div><hr noshade/><div class="iw_content">' + content + '</div><a href="' + posturl + '" class="btn btn-primary"><?php echo get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['button_more_'.ICL_LANGUAGE_CODE]?></a></div>';
			   infoWindow.setContent(iwContent);
			   infoWindow.open(map, marker);
			});
		}
		
		function OpenInfowindowForMarker(index) {
			var iwContent = '<div id="iw_container"><div class="iw_title">' + markerMap[ index ].title + '</div><hr noshade/><div class="iw_content">' + markerMap[ index ].content + '</div><a href="' + markerMap[ index ].posturl + '" class="btn btn-primary"><?php echo get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['button_more_'.ICL_LANGUAGE_CODE]?></a></div>';
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

<!--         Losalisation vers pages filiales -->
	<div id="filiales" class="animated-map">
		<div class="block_map" id="map"></div>
		<div fnc-CloseMap class="closed"><i class="fa fa-times" aria-hidden="true"></i></div>
	</div>

	<!--   fil d'ariane modif -->
	    <?php if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb('<p id="breadcrumbs">','</p>');
    } ?>
	<div fnc-CaptionMap class="caption">
			<h3 style="text-align: center;"><?php echo $efi_configuration_options['titre_map_filiales_'.ICL_LANGUAGE_CODE]?></h3>
			<hr noshade/ style="border: 1px #dc0014 solid;width: 790px;">
			<div class="col-md-12">
				<p style="text-align: center;padding: 20px;"><?php echo $efi_configuration_options['description_map_filiales_'.ICL_LANGUAGE_CODE]?></p>
			</div>
				<!-- <div class="container">
					<div class="col-md-12" style="text-align: center;">
					<a fnc-DisplayMap class="btn btn-primary"><?php //echo $efi_configuration_options['bouton_map_filiales_'.ICL_LANGUAGE_CODE]?></a><br><br>
					</div><br><br><br>
				</div> -->
			<!--<div class="marker_localise" style="text-align: center;"><i class="fa fa-map-marker"></i></div>-->
	
	
	</div>
	
	
    

	
	<div class="container block_sectors" fnc-filialeBlock>
		<div class="row">
			<?php foreach($sectors as $sector) :?>
			
				<div class="col-xs-12 col-sm-6 col-lg-4 sector">
					<div class="caption"  fnc-sectorElement>
						<h4><?php echo $sector->name?></h4>
						<?php if($sector->description && !empty($sector->description)) :?>
						<p><?php echo $sector->description?></p>
						<?php endif;?>
						
						<?php foreach($sector->entreprises as $entreprise) :?>
						
							<?php $filiale = get_post_meta( $entreprise->ID, 'filiale_meta_box_text' )[0]?>
							<?php $gps = str_replace(' ', '', explode(',', get_post_meta( $entreprise->ID, 'gps_meta_box_text' )[0]))?>
							<a style="margin-bottom:5px;" <?php if($gps && !empty($gps)) :?> onclick="OpenInfowindowForMarker('<?php echo 'marker-'.$entreprise->ID;?>')" fnc-LocateEntreprise="<?php echo $entreprise->ID?>" fnc-GpsLatt="<?php echo $gps[0]?>" fnc-GpsLng="<?php echo $gps[1]?>" <?php endif;?> class="btn btn-default" data-toggle="tooltip" data-placement="top" title="<?php echo $entreprise->post_title?>"><?php echo $filiale?></a>
						
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

<?php get_footer(); ?>