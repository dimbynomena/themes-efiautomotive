/*
* ===========
* Appv2 js
* ===========
*/

/*
 * Bootstrap
 * -
 */

jQuery(function () {
    jQuery('[data-toggle="tooltip"]').tooltip();
})

/*
 * Navbar
 * @navbarResize
 */

jQuery(window).scroll(function() {
    var nav = jQuery('#header-outer');
    var top = 10;
    if (jQuery(window).scrollTop() >= top) {

        nav.removeClass('transparent');
        nav.addClass('fixed');

    } else {
        nav.removeClass('fixed');
        nav.addClass('transparent');
    }
});

jQuery(document).ready(function() {
    var nav = jQuery('#header-outer');
    var top = 10;
    if (jQuery(window).scrollTop() >= top) {

        nav.removeClass('transparent');
        nav.addClass('fixed');

    } else {
        nav.removeClass('fixed');
        nav.addClass('transparent');
    }
});

/*
 * Homepage
 * @resizeLatestPosts
 */

function resizeLatestPosts() {
    if(jQuery(window).width() >= 768){
        var latestPostsElements = [];
        jQuery('[fnc-latestPosts] [fnc-latestPostsBox]').each(function(){
            latestPostsElements.push(jQuery(this).height()); 
        });
        
        var latestPostsElementsHeight = Math.max.apply(Math,latestPostsElements);
        jQuery('[fnc-latestPosts] [fnc-latestPostsBox]').height(latestPostsElementsHeight);
    }
}

jQuery(document).ready(resizeLatestPosts);
jQuery(window).resize(resizeLatestPosts);


/*
 * Homepage
 * @resizeProductCategories
 */

function resizeProductCategories() {
    if(jQuery(window).width() >= 768){
        var productCategoriesElements = [];
        jQuery('[fnc-productCategories] [fnc-productCategoriesBox]').each(function(){
            productCategoriesElements.push(jQuery(this).height()); 
        });
        
        var productCategoriesElementsHeight = Math.max.apply(Math,productCategoriesElements);
        jQuery('[fnc-productCategories] [fnc-productCategoriesBox]').height(productCategoriesElementsHeight);
    }
}

jQuery(document).ready(resizeProductCategories);
jQuery(window).resize(resizeProductCategories);

/*
 * Widget CTA
 * @resizeCta
 */

function resizeCta() {
    if(jQuery(window).width() >= 768){
        var ctaElements = [];
        jQuery('[fnc-widgetPage] [fnc-ctaElement]').each(function(){
            ctaElements.push(jQuery(this).height()); 
        });
        
        var ctaElementsHeight = Math.max.apply(Math,ctaElements);
        jQuery('[fnc-widgetPage] [fnc-ctaElement]').height(ctaElementsHeight);
    }
}

jQuery(document).ready(resizeCta);
jQuery(window).resize(resizeCta);

/*
 * Filiales
 * @resizeFiliales
 */

function resizeFiliales() {
    if(jQuery(window).width() >= 768){
        var filialeElements = [];
        jQuery('[fnc-filialeBlock] [fnc-sectorElement]').each(function(){
            filialeElements.push(jQuery(this).height()); 
        });
        
        var filialeElementsHeight = Math.max.apply(Math,filialeElements);
        jQuery('[fnc-filialeBlock] [fnc-sectorElement]').height(filialeElementsHeight);
    }
}

jQuery(document).ready(resizeFiliales);
jQuery(window).resize(resizeFiliales);

/*
 * Filiales
 * @resizeFiliales
 */

function resizeProductsCategory() {
    if(jQuery(window).width() >= 768){
        var productsElements = [];
        jQuery('[fncProductCategory]').each(function(){
            productsElements.push(jQuery(this).height()); 
        });
        
        var productsElementsHeight = Math.max.apply(Math,productsElements);
        jQuery('[fncProductCategory]').height(productsElementsHeight);
    }
}

jQuery(document).ready(resizeProductsCategory);
jQuery(window).resize(resizeProductsCategory);

/*
 * Articles
 * @resizeArticles
 */

function resizeArticlesCategories() {
    if(jQuery(window).width() >= 768){
        var articlesElements = [];
        jQuery('[fncArticlesCategory]').each(function(){
            articlesElements.push(jQuery(this).height()); 
        });
        
        var articlesElementsHeight = Math.max.apply(Math,articlesElements);
        jQuery('[fncArticlesCategory]').height(articlesElementsHeight);
    }
}

jQuery(document).ready(resizeArticlesCategories);
jQuery(window).resize(resizeArticlesCategories);

/*
 * Page
 * @setActiveClass
 */

jQuery(document).on('click', '.panel-title a', function(){
    jQuery('.panel-title .collapsed').removeClass('active');
    jQuery(this).addClass('active');
});

/*
 * Map google
 * -
 */

jQuery(document).on('click', '[fnc-DisplayMap]', function(){
    jQuery('[fnc-CaptionMap]').fadeToggle();
    jQuery('[fnc-CloseMap]').fadeToggle();
});

jQuery(document).on('click', '[fnc-CloseMap]', function(){
    jQuery('[fnc-CaptionMap]').fadeToggle();
    jQuery('[fnc-CloseMap]').fadeToggle();
});

jQuery(document).on('click', '[fnc-LocateEntreprise]', function(){
    if(jQuery('[fnc-CaptionMap]').is(":visible")){
        jQuery('[fnc-CaptionMap]').fadeToggle();
        jQuery('[fnc-CloseMap]').fadeToggle();
    }
});

/*
 * Scroll To function
 * -
 */

function scrollToAnchor(aid){
    var aTag = jQuery("[fncScrollToTarget='"+ aid +"']");
    jQuery('html,body').animate({scrollTop: aTag.offset().top - 100},'slow');
}

jQuery(document).on('click', '[fnc-productCategories] .element a', function(){
    var target = jQuery(this).attr('href');
    target = target.slice(1);
    scrollToAnchor(target);
});

jQuery(document).ready(function(){
    if(window.location.hash) {
        var hash = window.location.hash;
        target = hash.slice(1);
        scrollToAnchor(target);
    }
});

/*
 * Lightbox function
 * -
 */

jQuery(document).on('click', '[fnc-LighBoxImage]', function(){
    var imgsrc = jQuery(this).attr('src');
    var lightbox = '<div class="block_lightbox"><div class="caption"><img class="img-responsive" src="' + imgsrc + '"/><a fnc-CloseLightbox class="btn btn-primary">Fermer</a></div></div>';
    jQuery('html, body').toggleClass('overflow-hidden');
    jQuery('body').append(lightbox);
});

jQuery(document).on('click', '[fnc-CloseLightbox]', function(){
    jQuery('.block_lightbox').remove();
    jQuery('html, body').toggleClass('overflow-hidden');
});

/*
 * Replace occurence
 * -
 */

function walkText(node) {
  if (node.nodeType == 3) {
    //node.data = node.data.replace('Efi', "EFI");
    //node.data = node.data.replace('efi', "EFI");
  }
  if (node.nodeType == 1 && node.nodeName != "SCRIPT") {
    for (var i = 0; i < node.childNodes.length; i++) {
      walkText(node.childNodes[i]);
    }
  }
}

jQuery(document).ready(function(){
    walkText(document.body);    
});

/*
 * Job form
 * -
 */

jQuery(document).on('click', '.btn[jobfilterReset]', function(){
    jQuery('form.job_filters').find('input').val('');
    location.reload();
});

/*
 * Events details
 * -
 */

jQuery(function(){
  if ( jQuery( ".block_evenement .details" ).length ) {
     var count = jQuery(".block_evenement .details li").length;
     var width = (100 / count) - 1;
     jQuery(".block_evenement .details li").width(width + '%');
  }
});

/*
 * Offer details
 * -
 */
jQuery(function(){
  if ( jQuery( ".block_offer .details" ).length ) {
     var count = jQuery(".block_offer .details li").length;
     var width = (100 / count) - 1;
     jQuery(".block_offer .details li").width(width + '%');
  }
});

if (jQuery('#CTACorporate').length) {
    var HauteurP=0;
    jQuery('#CTACorporate .UnWidgetCTA .caption > p').each(function() {
      var HauteurCeP=jQuery(this).height();
      if (HauteurP<HauteurCeP) {
        HauteurP=HauteurCeP;
      }
    });
    jQuery('#CTACorporate .UnWidgetCTA .caption > p').height(HauteurP);
}

if (jQuery('.wpcf7-form-control-wrap.your-recipient').length) {
    if (jQuery('.wpcf7-form-control-wrap.Domaine').length) {
        jQuery('.wpcf7-form-control-wrap.Domaine select').change(function() {
            var Domaine=jQuery('.wpcf7-form-control-wrap.Domaine select').val();
            if (Domaine=="EFI Automotive") { // France Beynost, Turquie, USA, Mexique, Chine, Japon, Italie, Allemagne
                jQuery('.wpcf7-form-control-wrap.your-recipient select option').css('display','none');
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="France (Beynost - dépt. 01)"]').css('display','block').attr("selected","selected");
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="Turquie"]').css('display','block');
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="USA"]').css('display','block');
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="Mexique"]').css('display','block');
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="Chine"]').css('display','block');
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="Japon"]').css('display','block');
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="Italie"]').css('display','block');
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="Allemagne"]').css('display','block');

                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="France (Beynost)"]').css('display','block').attr("selected","selected");
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="Turkey"]').css('display','block');
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="Mexico"]').css('display','block');
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="China"]').css('display','block');
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="Japan"]').css('display','block');
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="Italia"]').css('display','block');
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="Germany"]').css('display','block');
            }
            else if (Domaine=="EFI Automotive Service") {
                jQuery('.wpcf7-form-control-wrap.your-recipient select option').css('display','none');
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="France (Joinville - dépt. 52)"]').css('display','block').attr("selected","selected");
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="France (Joinville)"]').css('display','block').attr("selected","selected");
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="Espagne"]').css('display','block');
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="Spain"]').css('display','block');
            }
            else if (Domaine=="Axandus") {
                jQuery('.wpcf7-form-control-wrap.your-recipient select option').css('display','none');
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="France (Beynost - dépt. 01)"]').css('display','block').attr("selected","selected");
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="France (Beynost)"]').css('display','block').attr("selected","selected");
            }
            else if (Domaine=="EFI Lighting") {
                jQuery('.wpcf7-form-control-wrap.your-recipient select option').css('display','none');
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="France (Beynost - dépt. 01)"]').css('display','block').attr("selected","selected");
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="France (Beynost)"]').css('display','block').attr("selected","selected");
            }
            else {
                jQuery('.wpcf7-form-control-wrap.your-recipient select option').css('display','block');
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="France (Beynost - dépt. 01)').attr("selected","selected");
                jQuery('.wpcf7-form-control-wrap.your-recipient select option[value="France (Beynost)"]').attr("selected","selected");
            }
        });
    }
}
