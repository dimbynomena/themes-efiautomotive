
<?php 
    /*template name: Page technologie*/
    
    get_header(); ?>
<?php
    /* =============
     * Start top page
     * =============
     */
    $LANG=get_locale();
    //var_dump($LANG);
    ?>
<?php $options = get_option('salient'); ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
<div class="banner_top" style="background-image:url(<?php echo $image[0];?>)">
    <div class="caption">
        <h1>
            <?php echo get_post_meta( $post->ID, 'subtitle_meta_box_text' )[0]?>
        </h1>
        <hr noshade/>
        <h2>
            <?php echo $post->post_excerpt?>
        </h2>
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
     * Start categories
     * =============
     */
    ?>
<?php
    $header_technologies = get_header_portfolio_technologies();
    if(isset($header_technologies) && !empty($header_technologies))
    {
        $order_technologies = get_main_portfolio_technologies();
        
        ?>
<div class="product-categories technologies" style="padding-bottom: 0;" fnc-productCategories>
    <div class="container-fluid">
        <?php 
            if ($LANG=='fr_FR') {
                ?>
        <div class="row justify-content-md-center">
            <div class="col-xs-12 col-sm-4 col-lg-2 element">
                <a href="#capteurs">
                    <div class="box" style="height: 236px;" fnc-productcategoriesbox="">
                        <div class="image" style="background-image:url(http://efiautomotive.kiweerouge.com/wp-content/uploads/2017/06/capteur-bidir-magnet-shadow-1.jpg)"></div>
                        <h3>Capteurs</h3>
                    </div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-2 element">
                <a href="#actionneurs">
                    <div class="box" style="height: 236px;" fnc-productcategoriesbox="">
                        <div class="image" style="background-image:url(http://efiautomotive.kiweerouge.com/wp-content/uploads/2017/06/module-actionneur-DC-low2-1.jpg)"></div>
                        <h3>Actionneurs</h3>
                    </div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-2 element">
                <a href="#actuateurs">
                    <div class="box" style="height: 236px;" fnc-productcategoriesbox="">
                        <div class="image" style="background-image:url(http://efiautomotive.kiweerouge.com/wp-content/uploads/2018/03/actuateur-injection-diesel-vehicule-leger.jpg)"></div>
                        <h3>Actuateurs</h3>
                    </div>
                </a>
            </div>
        </div>
        <?php
            }
            else if ($LANG=='en_US') {
                ?>
        <div class="row justify-content-md-center">
            <div class="col-xs-12 col-sm-4 col-lg-2 element" id="sensors">
                <a href="#sensors">
                    <div class="box" style="height: 236px;" fnc-productcategoriesbox="">
                        <div class="image" style="background-image:url(http://efiautomotive.kiweerouge.com/wp-content/uploads/2017/06/capteur-bidir-magnet-shadow-1.jpg)"></div>
                        <h3>SENSORS</h3>
                    </div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-2 element">
                <a href="#actuators" id="actuators">
                    <div class="box" style="height: 236px;" fnc-productcategoriesbox="">
                        <div class="image" style="background-image:url(http://efiautomotive.kiweerouge.com/wp-content/uploads/2017/06/module-actionneur-DC-low2-1.jpg)"></div>
                        <h3>ACTUATORS</h3>
                    </div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-2 element" id="injection-actuators">
                <a href="#injection-actuators">
                    <div class="box" style="height: 236px;" fnc-productcategoriesbox="">
                        <div class="image" style="background-image:url(http://efiautomotive.kiweerouge.com/wp-content/uploads/2018/03/actuateur-injection-diesel-vehicule-leger.jpg)"></div>
                        <h3>INJECTION ACTUATORS</h3>
                    </div>
                </a>
            </div>
        </div>
        <?php
            } 
            ?>
    </div>
</div>
<!-- Affichage des Produits suivants la Technologie -->
<div class="product-grid-products technologies">
    <div class="container">
        <?php
            foreach($header_technologies as $techno => $order) { // pour chaque catégorie principale
                foreach($order_technologies as $technology) { // pour chaque catégorie
                    if($technology->term_id == $techno) { // si la catégorie est une des principales
                        $test="1";
                        //if(isset($technology->childs) && !empty($technology->childs)) {
                        if ($test=='1') {
                            ?>
        <h2 class="section-title" fncScrollToTarget="<?php echo $technology->slug; ?>" id="<?php echo $technology->slug; ?>">
            <?php echo $technology->name; ?>
            <?php if($technology->name==="Capteurs" OR $technology->name==="Sensors") { ?>
            <div class="SommaireTechno">
                <?php 
                    if ($LANG=='fr_FR') {
                        ?>
                <a href="#capteurs-de-positions">
                    <i class="fa fa-angle-down" aria-hidden="true"></i> Capteurs de positions</a>
                <a href="#capteurs-de-vitesse">
                    <i class="fa fa-angle-down" aria-hidden="true"></i> Capteurs de vitesse</a>
                <a href="#modules">
                    <i class="fa fa-angle-down" aria-hidden="true"></i> Modules</a>
                <?php
                    }
                    else if ($LANG=='en_US') {
                        ?>
                <a href="#position-sensors">
                    <i class="fa fa-angle-down" aria-hidden="true"></i> Position sensors</a>
                <a href="#speed-sensor">
                    <i class="fa fa-angle-down" aria-hidden="true"></i> Speed sensors</a>
                <a href="#modules">
                    <i class="fa fa-angle-down" aria-hidden="true"></i> Modules</a>
                <?php
                    } 
                    ?>
            </div>
            <?php } ?>
        </h2>
        <p style="margin:0;">
            <?php echo $technology->description; ?>
        </p>
        <?php
            if($technology->name==="Capteurs" OR $technology->name==="Sensors") {
                foreach($technology->childs as $children) {
            
                    $products = get_main_technologies_products($children->term_id);
                    if (empty($product)) {
                        //$products = get_main_technologies_products($technology->term_id);
                    }
                    if($products) {
                        ?>
        <div id="<?php echo $children->slug; ?>" class="category row" fncScrollToTarget="<?php echo $children->slug; ?>">
            <div class="col-xs-12 col-md-12 col-lg-12 category-description" id="effet-hall">
                <h3 style="margin-bottom: 10px; color:#dc0014;">
                    <?php echo $children->name;?>
                </h3>
                <p style="margin:0;">
                    <?php echo $children->description; ?>
                </p>
            </div>
        </div>
        <?php
            foreach($children->term_meta as $testvalue => $mavalue) {
                if($testvalue === "technologie_parent") {
                    if($mavalue == $techno) {
                        if($children->term_id==244 OR $children->term_id==280) { // Capteurs
                            ?>
        <div class="category row">

            <div class="col-xs-12 col-md-12 col-lg-12 category-description">
                <h4 style="color:#dc0014;">
                    <?php // Effet hall
                            if ($LANG=='fr_FR') {
                                echo get_name_category_product(93);
                            }
                            else if ($LANG=='en_US') {
                                echo get_name_category_product(107);
                            } 
                            ?>
                </h4>

                <div class="CategorieDesc">
                    <?php
                            if ($LANG=='fr_FR') {
                                echo get_description_category_product(93);
                            }
                            else if ($LANG=='en_US') {
                                echo get_description_category_product(107);
                            } 
                            ?>
                </div>
            </div>

        </div>
        <?php
            if ($LANG=='fr_FR') {
                $listeproducts = get_main_portfolio_tehnologies_products(93);
            }
            else if ($LANG=='en_US') {
                $listeproducts = get_main_portfolio_tehnologies_products(107);
            } 
            echo '<div class="category row">';
                foreach($listeproducts as $listeproduct) {
                    ?>
        <div class="product" fncScrollToTarget="<?php echo $listeproduct->ID; ?>" id="<?php echo $listeproduct->ID; ?>">
            <div class="en-focalt" id="technology-for-angular-sensors">
                <div class="col-xs-2 col-md-2 col-lg-2" id="court-de-focault">
                    <?php
                    $image = wp_get_attachment_url( get_post_thumbnail_id($listeproduct->ID));
                    ?>
                    <a href="<?php echo get_permalink( $listeproduct->ID )?>" class="caption" style="border-left-color:<?php echo $color;?>"
                        fncProductCategory>
                        <h5 style="color: black; margin-bottom: 10px;">
                            <?php echo $listeproduct->post_title;?>
                        </h5>

                        <img class="imageproduct" style="width: 80%;" src="<?php echo $image?>" />

                    </a>
                </div>
            </div>
        </div>


        <?php
            }
            echo '</div>';
            // Foucault
            ?>
        <div class="category row">
            <div class="col-xs-12 col-md-12 col-lg-12 category-description">
                <h4 style="color:#dc0014;">
                    <?php
                        if ($LANG=='fr_FR') {
                            echo get_name_category_product(92);
                        }
                        else if ($LANG=='en_US') {
                            echo get_name_category_product(108);
                        } 
                        ?>
                </h4>
                <div class="CategorieDesc">
                    <?php
                        if ($LANG=='fr_FR') {
                            echo get_description_category_product(92);
                        }
                        else if ($LANG=='en_US') {
                            echo get_description_category_product(108);
                        } 
                        ?>
                </div>
            </div>
        </div>
        <?php
            if ($LANG=='fr_FR') {
                $listeproducts = get_main_portfolio_tehnologies_products(92);
            }
            else if ($LANG=='en_US') {
                $listeproducts = get_main_portfolio_tehnologies_products(108);
            }
            echo '<div class="category row">';
                foreach($listeproducts as $listeproduct) {
                    ?>
        <div class="product" fncScrollToTarget="<?php echo $listeproduct->ID; ?>" id="<?php echo $listeproduct->ID; ?>">
            <div class="col-xs-2 col-md-2 col-lg-2" id="magnetoresistive-technology">
                <div class="col-xs-2 col-md-2 col-lg-2" id="magnétorésistance">
                    <?php
                        $image = wp_get_attachment_url( get_post_thumbnail_id($listeproduct->ID));
                        ?>
                    <a href="<?php echo get_permalink( $listeproduct->ID )?>" class="caption" style="border-left-color:<?php echo $color;?>"
                        fncProductCategory>
                        <h5 style="color: black; margin-bottom: 10px;">
                            <?php echo $listeproduct->post_title;?>
                        </h5>
                        <img class="imageproduct" style="width: 80%;" src="<?php echo $image?>" />
                    </a>
                </div>
            </div>
        </div>
        <?php
            }
            echo '</div>';
            // Magnetoresistance
            ?>
        <div class="category row">
            <div class="col-xs-12 col-md-12 col-lg-12 category-description">
                <h4 style="color:#dc0014;">
                    <?php
                        if ($LANG=='fr_FR') {
                            echo get_name_category_product(95);
                        }
                        else if ($LANG=='en_US') {
                            echo get_name_category_product(109);
                        } 
                        ?>
                </h4>
                <div class="CategorieDesc">
                    <?php
                        if ($LANG=='fr_FR') {
                            echo get_description_category_product(95);
                        }
                        else if ($LANG=='en_US') {
                            echo get_description_category_product(109);
                        } 
                        ?>
                </div>
            </div>
        </div>
        <?php
            echo '<div class="category row">';
            if ($LANG=='fr_FR') {
                $listeproducts = get_main_portfolio_tehnologies_products(95);
            }
            else if ($LANG=='en_US') {
                $listeproducts = get_main_portfolio_tehnologies_products(109);
            }
                foreach($listeproducts as $listeproduct) {
                    ?>
        <div class="product" fncScrollToTarget="<?php echo $listeproduct->ID; ?>" id="<?php echo $listeproduct->ID; ?>">
            <div class="sensor-en" id="hall-effect-speed-sensor">
                <div class="col-xs-2 col-md-2 col-lg-2" id="effet-hall-capteur-de-vitesse">
                    <?php
                            $image = wp_get_attachment_url( get_post_thumbnail_id($listeproduct->ID));
                            ?>
                    <a href="<?php echo get_permalink( $listeproduct->ID )?>" class="caption" style="border-left-color:<?php echo $color;?>"
                        fncProductCategory>
                        <h5 style="color: black; margin-bottom: 10px;">
                            <?php echo $listeproduct->post_title;?>
                        </h5>
                        <img class="imageproduct" style="width: 80%;" src="<?php echo $image?>" />
                    </a>
                </div>
            </div>
        </div>
        <?php
            }
            echo '</div>';
            }
            else if($children->term_id==245 OR $children->term_id==273) { // capteur de vitesse
            // Effet hall
            ?>
        <div class="category row">
            <div class="col-xs-12 col-md-12 col-lg-12 category-description">
                <h4 style="color:#dc0014;">
                    <?php
                        if ($LANG=='fr_FR') {
                            echo get_name_category_product(262);
                        }
                        else if ($LANG=='en_US') {
                            echo get_name_category_product(285);
                        } 
                        ?>
                </h4>
                <div class="CategorieDesc">
                    <?php
                        if ($LANG=='fr_FR') {
                            echo get_description_category_product(262);
                        }
                        else if ($LANG=='en_US') {
                            echo get_description_category_product(285);
                        } 
                        ?>
                </div>
            </div>
        </div>
        <?php
            if ($LANG=='fr_FR') {
                $listeproducts = get_main_portfolio_tehnologies_products(262);
            }
            else if ($LANG=='en_US') {
                $listeproducts = get_main_portfolio_tehnologies_products(285);
            } 
            echo '<div class="category row">';
                foreach($listeproducts as $listeproduct) {
                    ?>
        <div class="product" fncScrollToTarget="<?php echo $listeproduct->ID; ?>" id="<?php echo $listeproduct->ID; ?>">
            <div class="col-xs-2 col-md-2 col-lg-2">
                <?php
                    $image = wp_get_attachment_url( get_post_thumbnail_id($listeproduct->ID));
                    ?>
                <a href="<?php echo get_permalink( $listeproduct->ID )?>" class="caption" style="border-left-color:<?php echo $color;?>"
                    fncProductCategory>
                    <h5 style="color: black; margin-bottom: 10px;">
                        <?php echo $listeproduct->post_title;?>
                    </h5>
                    <img class="imageproduct" style="width: 80%;" src="<?php echo $image?>" />
                </a>
            </div>
        </div>
        <?php
            }
            echo '</div>';
            }
            // Modules
            else if($children->term_id==246 OR $children->term_id==288) {
            ?>
        <p style="margin:0;padding:0;">
            <?php
                if ($LANG=='fr_FR') {
                    echo get_description_category_product(246);
                }
                else if ($LANG=='en_US') {
                    echo get_description_category_product(288);
                } 
                ?>
        </p>
        <?php
            if ($LANG=='fr_FR') {
                $listeproducts = get_main_portfolio_tehnologies_products(246);
            }
            else if ($LANG=='en_US') {
                $listeproducts = get_main_portfolio_tehnologies_products(288);
            } 
            echo '<div class="category">';
                foreach($listeproducts as $listeproduct) { ?>
        <div class="product row" fncScrollToTarget="<?php echo $listeproduct->ID; ?>" id="<?php echo $listeproduct->ID; ?>">
            <div class="col-xs-2 col-md-2 col-lg-2">
                <?php
                    $image = wp_get_attachment_url( get_post_thumbnail_id($listeproduct->ID));
                    ?>
                <a href="<?php echo get_permalink( $listeproduct->ID )?>" class="caption" style="border-left-color:<?php echo $color;?>"
                    fncProductCategory>
                    <h5 style="color: black; margin-bottom: 10px;">
                        <?php echo $listeproduct->post_title;?>
                    </h5>
                    <img class="imageproduct" style="width: 80%;" src="<?php echo $image?>" />
                </a>
            </div>
        </div>
        <?php
            }
            echo '</div>';
            }
            }
            }
            } 
            }
            }
            }
            // Actionneurs
            else if($technology->name==="Actionneurs" OR $technology->name==="Actuators") {
            if ($LANG=='fr_FR') {
            $listeproducts = get_main_portfolio_tehnologies_products(114);
            }
            else if ($LANG=='en_US') {
            $listeproducts = get_main_portfolio_tehnologies_products(104);
            } 
            echo '<div class="category row">';
            foreach($listeproducts as $listeproduct) {
            ?>
        <div class="product" fncScrollToTarget="<?php echo $listeproduct->ID; ?>" id="<?php echo $listeproduct->ID; ?>">
            <div class="col-xs-2 col-md-2 col-lg-2">
                <?php
                    $image = wp_get_attachment_url( get_post_thumbnail_id($listeproduct->ID));
                    ?>
                <a href="<?php echo get_permalink( $listeproduct->ID )?>" class="caption" style="border-left-color:<?php echo $color;?>"
                    fncProductCategory>
                    <h5 style="color: black; margin-bottom: 10px;">
                        <?php echo $listeproduct->post_title;?>
                    </h5>
                    <img class="imageproduct" style="width: 80%;" src="<?php echo $image?>" />
                </a>
            </div>
        </div>
        <?php
            }
            echo '</div>';
            }
            else if($technology->name==="Actuateurs" OR $technology->name==="Injection actuators") {
            if ($LANG=='fr_FR') {
            $listeproducts = get_main_portfolio_tehnologies_products(97);
            }
            else if ($LANG=='en_US') {
            $listeproducts = get_main_portfolio_tehnologies_products(289);
            } 
            echo '<div class="category row">';
            foreach($listeproducts as $listeproduct) {
                ?>
        <div class="product" fncScrollToTarget="<?php echo $listeproduct->ID; ?>" id="<?php echo $listeproduct->ID; ?>">
            <div class="col-xs-2 col-md-2 col-lg-2">
                <?php
                    $image = wp_get_attachment_url( get_post_thumbnail_id($listeproduct->ID));
                    ?>
                <a href="<?php echo get_permalink( $listeproduct->ID )?>" class="caption" style="border-left-color:<?php echo $color;?>"
                    fncProductCategory>
                    <h5 style="color: black; margin-bottom: 10px;">
                        <?php echo $listeproduct->post_title;?>
                    </h5>
                    <img class="imageproduct" style="width: 80%;" src="<?php echo $image?>" />
                </a>
            </div>
        </div>
        <?php
            }
            echo '</div>';
            }                   
            }
            }
            }
            }
            ?>
        <br/>
        <br/>
    </div>
</div>
<?php
    }
    
    /* FIN H2C */
    
    //$order_technologies = get_main_portfolio_technologies();
    ?>
<!--
    <div class="product-categories technologies" fnc-productCategories>
        <div class="container-fluid">
            <div class="row">
                <?php //foreach($order_technologies as $technology) :?>
                    <?php //if(isset($technology->childs) && !empty($technology->childs)) :?>
                        <?php //foreach($technology->childs as $children) :?>
                            <?php
        //$products = get_main_technologies_products($children->term_id);?>
                            <?php //if($products) :?>
                               <div class="col-xs-12 col-sm-4 col-lg-2 element">
                                  <a href="#<?php //echo $children->slug;?>">
                                     <div class="box" style="border-color:<?php //echo $children->term_meta['cat_color'];?>" fnc-productCategoriesBox>
                                         <div class="image" style="background-image:url(<?php //echo $children->term_meta['catimg']?>)"></div>
                                         <h3><?php //echo $technology->name;?></h3>
                                         <!--<p>
                                            <?php
        //echo wp_trim_words( $children->description, 5, '...' );
        ?>
                                         </p> -->
<!-- </div>
    </a>
    </div>
    <?php //endif; ?>   
    <?php //endforeach;?>
    <?php //endif; ?>
    <?php //endforeach;?>
    </div>
    </div>
    </div>
    -->
<!-- 
    <div class="product-grid-products technologies">
        <div class="container">
                <?php //foreach($order_technologies as $technology) :?>
                        
                       <?php //if(isset($technology->childs) && !empty($technology->childs)) :?>
                        
                       <h2 class="section-title"><?php //echo $technology->name?></h2>
                       <hr class="section-hr" noshade/>
                        
                       
                        <?php //foreach($technology->childs as $children) :?>
                        
                            <?php //$products = get_main_technologies_products($children->term_id);?>
                            <?php //if($products) :?>
                            
                                <div class="category row" fncScrollToTarget="<?php //echo $children->slug;?>">
                                   <div class="col-xs-12 col-md-4 col-lg-4">
                                     <div class="category-image"  style="background-image:url(<?php //echo $children->term_meta['catimg']?>)"></div>
                                   </div>
                                   <div class="col-xs-12 col-md-8 col-lg-8 category-description">
                                         <h2 style="margin-bottom: 10px;"><?php //echo $children->name;?></h2>
                                         <h3><?php //echo esc_attr($children->term_meta['subtitle'])?></h3>
                                         <div class="category-content">
                                             <?php //echo $children->description?>
                                         </div>
                                   </div>
                                </div>
                                
                                <div class="products row">
                                   <div class="col-xs-12 col-md-12 col-lg-12">
                                     <h4><?php //echo get_option( 'efi_configuration_option_name_'.ICL_LANGUAGE_CODE )['range_products_'.ICL_LANGUAGE_CODE]?></h4>
                                   </div>
                                   <div class="col-xs-12 col-md-12 col-lg-12">
                                     <div class="row">
                                         
                                         <?php //foreach($products as $product) :?>
                                             <?php //$image = wp_get_attachment_url( get_post_thumbnail_id($product->ID)); ?>
                                             <div class="col-xs-12 col-md-4 col-lg-4 product">
                                                 <a href="<?php //echo get_permalink( $product->ID )?>" class="caption" style="border-left-color:<?php //echo $category->term_meta['cat_color'];?>" fncProductCategory>
                                                     <img class="imageproduct" src="<?php //echo $image?>"/>
                                                     <div class="content">
                                                         <h5 style="color:<?php //echo $category->term_meta['cat_color'];?>"><?php //echo $product->post_title?></h5>
                                                         <h6><?php //echo wp_trim_words( $product->post_content, 20, '...' )?></h6>                     
                                                     </div>
                                                 </a>
                                             </div>
                                         
                                         <?php //endforeach;?>
                                         
                                     </div>
                                   </div>   
                             
                                </div>
                            
                            <?php //endif;?>
                            
                        <?php //endforeach;?>
                       <?php //endif;?>
                       
                <?php //endforeach;?>
        </div>
    </div> -->
<?php
    /* =============
     * End categories
     * =============
     */
    ?>
<?php get_footer(); ?>