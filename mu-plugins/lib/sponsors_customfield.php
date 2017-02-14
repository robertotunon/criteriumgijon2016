<?php
/*____________________

Custom field para links de Sponsors

______________________*/


function custom_css() {
   echo '<style type="text/css">#enlace{width:100%}</style>';
}
add_action('admin_head', 'custom_css');


add_action('add_meta_boxes', 'enlace_meta_boxes');

function enlace_meta_boxes() {
    add_meta_box( 
    	'enlace-meta-box',
    	__('Enlace:'),
    	'enlace_meta_box_callback',
    	'sponsors',
    	'normal'
    );
}

function enlace_meta_box_callback( $post, $args = array() ) {
	//El nonce es opcional pero recomendable. Vea http://codex.wordpress.org/Function_Reference/wp_nonce_field
	wp_nonce_field( 'enlace_meta_box', 'enlace_meta_box_nonce' );

	//Obtenemos los meta data actuales para rellenar los custom fields
	//en caso de que ya tenga valores
	$post_meta = get_post_custom($post->ID);

	//url input text
	$current_value = '';
	if( isset( $post_meta['enlace'][0] ) ) {
	 $current_value = $post_meta['enlace'][0];
	}
?>
	<p>
	 <label class="enlace" for="enlace"><?php echo "Pon aquí el enlace al sitio web de este sponsor:";?> </label>
	 <input  name="enlace" id="enlace" type="url" value="<?php echo $current_value; ?>"/>
	</p>
<?php
}

add_action('save_post', 'enlace_save_custom_fields', 10, 2);

function enlace_save_custom_fields( $post_id, $post ){

    // Primero comprobamos el tipo de post y que el usuario tenga permiso para editarlo
    if ( 'post' == $post->post_type ) {
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    // Segundo, comprobamos el nonce como medida de seguridad
    if ( !isset( $_POST['enlace_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['enlace_meta_box_nonce'], 'enlace_meta_box' ) ) {
        return;
    }

    //Tercero, validamos y almacenamos el valor del custom field o lo borramos si es necesario

    //primer input
    if( isset($_POST['enlace']) && $_POST['enlace'] != "" ) {
        update_post_meta( $post_id, 'enlace', sanitize_text_field( $_POST['enlace'] ) );
    } else {
        //$_POST['text_meta_field'] no tiene valor establecido, eliminar el meta field de la base de datos
        if ( isset( $post_id ) ) {
            delete_post_meta($post_id, 'enlace');
        }
    }
	
}