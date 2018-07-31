<?php
#=================================================================#
# App function
#=================================================================#

#=======================#
# + Register sidebars
#=======================#

register_sidebar( array('name'=>'Page Accueil', 'id' => "home_widgets" ) );
//register_sidebar( array('name'=>'Page Widgets', 'id' => "page_wigets" ) );
register_sidebar( array('name'=>'Page Corporate', 'id' => "cta_wigets" ) );

add_action('admin_head', 'custom_widget_render');
function custom_widget_render() {
  echo
  '<style>
    #widgets-right .sidebars-column-1 .widgets-holder-wrap:nth-last-child(-n+3){
		display:none;
	}
  </style>';
}


#=======================#
# + Remove items from admin menu
#=======================#

function remove_item_menu() {
    remove_menu_page( 'edit.php?post_type=home_slider' );
}
add_action( 'admin_menu', 'remove_item_menu' );

#=======================#
# + Get main portfolio categories
#=======================#

function get_main_portfolio_categories()
{
	$categories = get_terms('project-type', array(
		'hide_empty' => false
	));
	foreach($categories as $key => $category)
	{
		$categories[$key]->term_meta = get_option( "taxonomy_".$category->term_id);
		$categories[$key]->order = $categories[$key]->term_meta['order'];
		if($categories[$key]->term_meta['cat_featured'] != 'oui')
		{
			unset($categories[$key]);
		}
	}
	usort($categories, "sortObjectArray");
	return $categories;
}

function sortObjectArray($a, $b) {
  return strcmp($a->order, $b->order); 
}

/* Ajout H2C le 09/03/2018 */
#=======================#
# + Get header portfolio technologies
#=======================#
function get_header_portfolio_technologies()
{
	$headertech = array();
	$args = array	(	'taxonomy' => 'technologies',
						'hide_empty' => false,
					);
	$term_query = new WP_Term_Query( $args );
	if ( ! empty( $term_query->terms ) ) {
		foreach ( $term_query->terms as $term ) {
			//if($term->parent == 0) {
				if($term->slug === "capteurs" or $term->slug === "sensors") {
					$headertech[$term->term_id] = 0;
				}
				elseif($term->slug === "actionneurs" OR $term->slug === "actuators") {
					$headertech[$term->term_id] = 1;
		  		}
		  		elseif($term->slug === "actuateurs") {
					$headertech[$term->term_id] = 2;
		 		}
		 		/*else {
					echo '<br/> *** trouvé!!! *** term_slug :'.$term->slug.'<br/>';
					$headertech[$term->term_id] = 3;
		  		}*/
			//}
      	}
	  	asort($headertech);
	  	return $headertech;
  	}
  	else {
		return $headertech;
 	}
}

#=======================#
# + Get Portfolio Technologies Products
#=======================#

function get_main_portfolio_tehnologies_products($category_id)
{
	$products = get_posts(
		array(
			'posts_per_page' => -1,
			'post_type' => 'portfolio',
			'tax_query' => array(
				array(
					'taxonomy' => 'technologies',
					'field' => 'term_id',
					'terms' => $category_id,
				)
			)
		)
	);

	return $products;
}
/* Fin Ajout H2C le 09/03/2018 */

/* Ajout H2C le 16/03/2018 */
#=======================#
# + Get Secondary Portfolio Technologies Products
#=======================#

/*function get_secondary_portfolio_tehnologies_products($category_id)
{
	$products = get_posts(
		array(
			'posts_per_page' => -1,
			'post_type' => 'portfolio',
			'tax_query' => array(
				array(
					'taxonomy' => 'technologies',
					'field' => 'term_id',
					'terms' => $category_id,
				)
			)
		)
	);

	return $products;
}*/

/* Fin Ajout H2C le 16/03/2018 */

#=======================#
# + Get portfolio technologies
#=======================#

function get_main_portfolio_technologies()
{
  $technologies = get_terms('technologies', array('hide_empty' => false,));
  $order_technologies = array();
  foreach($technologies as $key => $technology)
  {
	  $technologies[$key]->term_meta = get_option( "taxonomy_".$technology->term_id);
	  $technologies[$key]->childs = array();
	  $order_technologies[$technology->term_id] = $technologies[$key];
  }
  
  foreach($order_technologies as $key => $order_technology)
  {
	  if(isset($order_technology->term_meta['technologie_parent']) &&
	  isset($order_technologies[(int)$order_technology->term_meta['technologie_parent']]))
	  {
		  unset($order_technologies[$key]);
		  $order_technologies[(int)$order_technology->term_meta['technologie_parent']]->childs[] = $order_technology;
		  
	  }
  }
  
  return $order_technologies;
}

#=======================#
# + Get filiales entreprises
#=======================#

function get_main_filiales_entreprises()
{
	$sectors = get_terms('sectors', array(
		'hide_empty' => false
	));

	foreach($sectors as $key => $sector)
	{
		$entreprises = get_posts(
			array(
				'posts_per_page' => -1,
				'post_type' => 'entreprise_sector',
				'tax_query' => array(
					array(
						'taxonomy' => 'sectors',
						'field' => 'term_id',
						'terms' => $sector->term_id,
					)
				)
			)
		);
		
		$sectors[$key]->entreprises = $entreprises;
	}
	
	return $sectors;
}

#=======================#
# + Get Portfolio Products
#=======================#

function get_main_portfolio_products($category_id)
{
	$products = get_posts(
		array(
			'posts_per_page' => -1,
			'post_type' => 'portfolio',
			'tax_query' => array(
				array(
					'taxonomy' => 'project-type',
					'field' => 'term_id',
					'terms' => $category_id,
				)
			)
		)
	);

	return $products;
}

/* Ajout H2C le 05/03/2018 */
#=======================#
# + Get Name Categorie Products
#=======================#

function get_name_category_product($category_id)
{
  global $wpdb;
  $sqlname = " SELECT $wpdb->terms.name
				FROM $wpdb->terms 
				WHERE $wpdb->terms.term_id = ". $category_id;
  $namecats = $wpdb->get_var($sqlname, 0);
  return $namecats;
}

#=======================#
# + Get Description Categorie Products
#=======================#

function get_description_category_product($category_id)
{
  global $wpdb;
  $sqlname = " SELECT $wpdb->term_taxonomy.description
				FROM $wpdb->terms
				  LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id
				WHERE $wpdb->terms.term_id = ". $category_id;
  $namedescription = $wpdb->get_var($sqlname, 0);
  return $namedescription;
}

#=======================#
# + Get Secondary Portofolio Products
#=======================#

function get_secondary_portfolio_products($category_id, $color, $orders)
{
	global $wpdb;
	$sqlsscat = "SELECT $wpdb->term_taxonomy.term_id
				FROM $wpdb->term_taxonomy
				WHERE $wpdb->term_taxonomy.parent = ". $category_id;
	$secondarycategoriestemp = $wpdb->get_results($sqlsscat);
	
	if ($secondarycategoriestemp)
	{
		foreach($secondarycategoriestemp as $secondarycategorytmp) {
			foreach($orders as $order)
			{
				if($order->term_id == $secondarycategorytmp->term_id) {
					$secondarycategories[$secondarycategorytmp->term_id]=$order->order;
				}
			}
		}
		asort($secondarycategories);
	 
		$montableautitre = '';
		foreach($secondarycategories as $key => $secondarycategory) {
			if ($key!='267') {
				$products = get_posts(	array(	'posts_per_page' => -1,
												'post_type' => 'portfolio',
												'tax_query' => array(array(	'taxonomy' => 'project-type',
												'field' => 'term_id',
												'terms' => $key,)))) ;
				$montableaucontenu = "";
				foreach($products as $product) {
					$image = wp_get_attachment_url( get_post_thumbnail_id($product->ID));
					$namecategoryproduct = get_name_category_product($key);
					if ($product->ID!='2453') {
						$montableaucontenu .= '<a href="'.get_permalink( $product->ID ).'" class="caption" style="border-left-color:'.$color.'; background-color: white;" fncProductCategory>';
					}
					$montableaucontenu.='<h5 style="color: black;">'.$product->post_title.'</h5><img class="imageproduct" style="width:150px; height: auto !important;" src="'.$image.'" title="'.esc_attr($product->post_title).'" />';
					if ($product->ID!='2453') {
						$montableaucontenu.='</a>';
					}
					//<h5>'.esc_attr($product->post_title).'</h5>
				}
				/* Titre de la Catégorie de Produits */
				if($namecategoryproduct!=="All") {
					$cslug=strtolower($namecategoryproduct);
					$monnewtableau[$key]['nom'] = '<h4 class="TitreCat" style="color:'.$color.'">'.$namecategoryproduct.'</h4>';
				}
				else {
					$monnewtableau[$key]['nom'] = '<h4 style="color:white;">'.$namecategoryproduct.'</h4>';
				}
				/* Liste des Produits */
				$monnewtableau[$key]['valeur'] = $montableaucontenu ;
			}
		}
		
		if(sizeof($monnewtableau) == 1) {
			$entetetableau = '<table class="UneCol" style="width: 100%;">';
		}
		else if(sizeof($monnewtableau) == 2) {
			$entetetableau = '<table class="DeuxCol" style="width: 100%;">';
		}
		else if(sizeof($monnewtableau) == 3) {
			$entetetableau = '<table class="TroisCol" style="width: 100%;">';
		}
		$fintableau = '</table>';

		?>
		<div class="products row">
			<?php if ($montableaucontenu!='') { ?>
				<div class="col-xs-12 col-md-12 col-lg-12">
					<h4 style="color:<?php echo $color; ?>">
						<?php echo get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['range_products_'.ICL_LANGUAGE_CODE]?>
					</h4>
				</div>
			<?php } ?>
			<?php
			echo '<div class="col-xs-12 col-md-12 col-lg-12">';
			echo $entetetableau;
			echo '<thead>';

			foreach ($monnewtableau as $keytab => $valuetab){
				echo '<th style="width: 33%;">'.$monnewtableau[$keytab]['nom'].'</th>';
			}
			echo '</thead>';
			echo '<tbody>';
			foreach ($monnewtableau as $keytab => $valuetab){
				echo '<td style="width: 33%; border-left-style: solid;border-left-width: 3px;border-left-color: '.$color.';">'.$monnewtableau[$keytab]['valeur'].'</td>';
			}
			echo '</tbody>';
			echo $fintableau;
			echo '</div>';
			?>
		</div>
		<?php
		// On a des sous-catégories
		return 1;
	} else {
		// On n'a pas de sous-catégories
		return 0;
	}
}
/* Fin Ajout H2C le 05/03/2018 */

#=======================#
# + Get technologies products
#=======================#

function get_main_technologies_products($technology_id)
{
	$products = get_posts(
		array(
			'posts_per_page' => -1,
			'post_type' => 'portfolio',
			'tax_query' => array(
				array(
					'taxonomy' => 'technologies',
					'field' => 'term_id',
					'terms' => $technology_id,
				)
			)
		)
	);
	
	return $products;
}

#=======================#
# + Get articles news by categories
#=======================#

function get_main_articles_categories()
{
	$categories = get_terms('category', array(
		'hide_empty' => true
	));
	
	foreach($categories as $key => $category)
	{
		$articles = get_posts(
			array(
				'posts_per_page' => 20,
				'post_type' => 'post',
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'term_id',
						'terms' => $category->term_id,
					)
				)
			)
		);
		$categories[$key]->articles = $articles;
	}
	
	return $categories;
}

#=======================#
# + Get events by categories
#=======================#

function get_main_events_categories()
{
	$categories = get_terms('evenement_categories', array(
		'hide_empty' => true
	));
	
	foreach($categories as $key => $category)
	{
		$articles = get_posts(
			array(
				'posts_per_page' => -1,
				'post_type' => 'evenement',
				'tax_query' => array(
					array(
						'taxonomy' => 'evenement_categories',
						'field' => 'term_id',
						'terms' => $category->term_id,
					)
				)
			)
		);
		$categories[$key]->articles = $articles;
	}

	return $categories;
}

#=======================#
# + Get articles news by category
#=======================#

function get_main_articles_category($id)
{
	$articles = get_posts(
		array(
			'posts_per_page' => -1,
			'post_type' => 'post',
			'suppress_filters' => 0,
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'field' => 'term_id',
					'terms' => $id,
				)
			)
		)
	);

	return $articles;
}

#=======================#
# + Get products in same category
#=======================#

function get_same_category_products($category_id)
{
	$products = get_posts(
		array(
			'posts_per_page' => 4,
			'post_type' => 'portfolio',
			'suppress_filters' => 0,
			'tax_query' => array(
				array(
					'taxonomy' => 'project-type',
					'field' => 'term_id',
					'terms' => $category_id,
				)
			)
		)
	);

	return $products;
}

#=======================#
# + Get recent articles
#=======================#

function get_recent_articles()
{
	$recentBlogPosts = array(
	  'showposts' => 4,
	  'ignore_sticky_posts' => 1,
	  'tax_query' => array(
		  array( 'taxonomy' => 'post_format',
			  'field' => 'slug',
			  'terms' => array('post-format-link','post-format-quote'),
			  'operator' => 'NOT IN'
			  )
		  )
	);
	
	return $recentBlogPosts;
}

#=======================#
# + Get recent articles by filiales
#=======================#

function get_recent_articles_by_filiale($filiale_id)
{

	$recentBlogPosts = array(
	  'showposts' => -1,
	  'ignore_sticky_posts' => 1,
	  'post_type' => 'newsdesfiliales',
	  'tax_query' => array(
		  array( 'taxonomy' => 'post_format',
			  'field' => 'slug',
			  'terms' => array('post-format-link','post-format-quote'),
			  'operator' => 'NOT IN'
			  )
	  ),
	  'meta_query' => array(
		  array( 'key' => 'filiale_referente',
			  'value' => $filiale_id
		  )
		),
	);
	
	return $recentBlogPosts;
}



#=======================#
# + Get all Jobs
#=======================#

function get_all_jobs()
{
	
	$tax_query = null;
	$meta_query = null;
	
	if(isset($_POST['job-categories']) || isset($_POST['job-contrat']))
	{
	  $tax_query = array();
	  
	  if(isset($_POST['job-categories']) && $_POST['job-categories'] != 'all')
	  {
		  $tax_query[] = array(
			  'taxonomy' => 'offresemploi_categories',
			  'field' => 'term_id',
			  'terms' => $_POST['job-categories'],
		  );
	  }
	  
	  if(isset($_POST['job-contrat']) && $_POST['job-contrat'] != 'all')
	  {
		  $tax_query[] = array(
			  'taxonomy' => 'offresemploi_types',
			  'field' => 'term_id',
			  'terms' => $_POST['job-contrat'],
		  );
	  }
	  
	}
	
	if(isset($_POST['job-hours']) || isset($_POST['job-country']))
	{
	  $meta_query = array();
	
	  if(isset($_POST['job-hours']) && $_POST['job-hours'] != 'all')
	  {
		 
			$meta_query[] = array(
				'key' => 'heuresparsemain_63775',
				'value' => $_POST['job-hours'],
				'compare' => 'LIKE',
			);
		 
	  }
	  
	  if(isset($_POST['job-country']) && $_POST['job-country'] != 'all')
	  {
		  $meta_query[] = array(
			  'key' => 'pays_73838',
			  'value' => $_POST['job-country'],
			  'compare' => 'LIKE',
		  );
	  }
	  
	}

	$allJobs = get_posts(
		array(
			'posts_per_page' => -1,
			'post_type' => 'offresemploi',
			'suppress_filters' => 0,
			'tax_query' => $tax_query,
			'meta_query' => $meta_query,
		)
	);
	return $allJobs;
}

#=======================#
# + Override widgets
#=======================#

function custom_widgets_init() {
	include_once( dirname( __FILE__ ) . '/widget_menu.php' );
	register_widget( 'Custom_WP_Nav_Menu_Widget' );
	
	include_once( dirname( __FILE__ ) . '/widget_search.php' );
	register_widget( 'Custom_WP_Widget_Search' );
	
	include_once( dirname( __FILE__ ) . '/widget_posts.php' );
	register_widget( 'Custom_WP_Widget_Recent_Posts' );
}
add_action( 'widgets_init', 'custom_widgets_init', 20 );

#=======================#
# + Change 
#=======================#

add_action( 'admin_menu', 'change_post_menu_label' );
function change_post_menu_label() {
    global $menu;
    global $submenu;

	
    $submenu['edit.php?post_type=portfolio'][15][0] = 'Catégories';
    $submenu['edit.php?post_type=portfolio'][16][0] = 'Attributs';
}

#=======================#
# + Display admin notification 
#=======================#

function display_admin_notification()
{
    global $post, $pagenow;

    // Abort in certain conditions, based on the global $pagenow
    if ( ! in_array(
         $pagenow
        ,array(
             'post-new.php'
            ,'post.php'
         )
    ) )
        return;

    // You can use the global $post here
    echo '<p>
	Dimensions des images :<br/>
		- Images produits : 500x500 pixels<br/>
		- Images news : 500x500 pixels<br/>
		- Bannières : Au minimum 1920x700 pixels
	</p>';
}
add_action( 'all_admin_notices', 'display_admin_notification' );




function admin_add_wysiwyg_custom_field_textarea()
{ ?>
<script type="text/javascript">/* <![CDATA[ */
	jQuery(function($){
		var i=1;
		$('.verve_meta_box_content textarea').each(function(e)
		{
		  var id = $(this).attr('id');
		  if (!id)
		  {
		   id = 'customEditor-' + i++;
		   $(this).attr('id',id);
		  }
		tinyMCE.execCommand("mceAddEditor", false, id);
		tinyMCE.execCommand("mceAddControl", false, id);
		});
	});
/* ]]> */</script>
<?php }
add_action( 'admin_print_footer_scripts', 'admin_add_wysiwyg_custom_field_textarea', 99 );

#=======================#
# + Contact form pass value
#=======================#

add_filter( 'shortcode_atts_wpcf7', 'custom_shortcode_atts_wpcf7_filter', 10, 3 );
function custom_shortcode_atts_wpcf7_filter( $out, $pairs, $atts ) 
{
    $post_attr = 'postid';
    if ( isset( $atts[$post_attr] ) ) {
        $out[$post_attr] = $atts[$post_attr];
    }
  
    $subject_attr = 'your-subject';
    if ( isset( $atts[$subject_attr] ) ) {
        $out[$subject_attr] = $atts[$subject_attr];
    }
    return $out;
}

add_action("wpcf7_before_send_mail", "kodex_wpcf7_before_send_mail");
function kodex_wpcf7_before_send_mail($contact_form){
	$current_mail_array = $contact_form->prop('mail');
	$submission = WPCF7_Submission::get_instance();
	$posted_data = $submission->get_posted_data();

	if( isset($posted_data['postid']) ){
	    $current_mail_array['recipient'] = get_post_meta($posted_data['postid'], 'mail_meta_box_text')[0];
	}
	$contact_form->set_properties(array('mail'=>$current_mail_array));
}

#=======================#
# + Disable comments in Wordpress
#=======================#

add_filter('comments_open', 'wpc_comments_closed', 10, 2);
function wpc_comments_closed( $open, $post_id )
{
  $post = get_post( $post_id );
  if ('post' == $post->post_type)
  {
	$open = false;
  }
  
  return $open;
}

add_action( 'admin_menu' , 'remove_commentstatus_meta_box' );
function remove_commentstatus_meta_box() {
  remove_meta_box( 'commentstatusdiv' , 'post' , 'normal' );
}

add_action( 'admin_init', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}