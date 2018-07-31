<?
#=================================================================#
# Cpt Portfolio
#=================================================================#

#=======================#
# + Add fields to portfolio cpt
#=======================#

// Make metabox
add_action('add_meta_boxes', 'add_custom_meta_boxes');
function add_custom_meta_boxes() {
 
    add_meta_box(
        'wp_custom_attachment',
        'Fichier de documentation',
        'wp_custom_attachment',
        'portfolio'
    );
 
}

// Make render field
function wp_custom_attachment($id) {
    
    $html = '';
 
    wp_nonce_field(plugin_basename(__FILE__), 'wp_custom_attachment_nonce');
    $file = get_post_meta($id->ID, 'wp_custom_attachment');
    
    if($file)
    {
        $html .= '<p class="description">Fichier actuel : '.basename($file[0]['file']).'</p><a class="button button-default button-large" href="'.$file[0]['url'].'">Télécharger le fichier</a>';
        $html .= '<br/><br/>';
    }
    
    $html .= '<p class="description">';
    $html .= 'Télécharger un fichier pdf (.pdf uniquement)';
    $html .= '</p>';
    $html .= '<span style="position: relative;" class="button button-primary button-large">Uploader un nouveau fichier <input class="opacity" type="file" id="wp_custom_attachment" name="wp_custom_attachment" value="" size="25" /></span>';
     
    $html .= '
    <style type="text/css">
    .opacity {
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        filter: alpha(opacity=0);
        -moz-opacity: 0;
        -khtml-opacity: 0;
        opacity: 0;
        position: absolute;
        left: 0px;
        top: 0px;
    }
    </style>
    ';
     
    echo $html;
}

// Save data
function save_custom_meta_data($id) {
 
    if(!wp_verify_nonce($_POST['wp_custom_attachment_nonce'], plugin_basename(__FILE__))) {
      return $id;
    }
       
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return $id;
    }
     
    if(!empty($_FILES['wp_custom_attachment']['name'])) {
         
        $supported_types = array('application/pdf');
         
        $arr_file_type = wp_check_filetype(basename($_FILES['wp_custom_attachment']['name']));
        $uploaded_type = $arr_file_type['type'];
         
        if(in_array($uploaded_type, $supported_types)) {
 
            $upload = wp_upload_bits($_FILES['wp_custom_attachment']['name'], null, file_get_contents($_FILES['wp_custom_attachment']['tmp_name']));
     
            if(isset($upload['error']) && $upload['error'] != 0) {
                wp_die('Une erreur a été détectée pendant le téléchargement de votre fichier : ' . $upload['error']);
            } else {
                add_post_meta($id, 'wp_custom_attachment', $upload);
                update_post_meta($id, 'wp_custom_attachment', $upload);     
            } 
        } else {
            wp_die("Le type de fichier que vous avez téléchargé n'est pas au format .pdf");
        }
         
    }
     
}
add_action('save_post', 'save_custom_meta_data');

// Update form
function update_edit_form() {
    echo ' enctype="multipart/form-data"';
}
add_action('post_edit_form_tag', 'update_edit_form');