<?php

class critgijon_custom_types {
	
	function __construct() {
		
		/* Constructor de la clase */		
		register_activation_hook(__FILE__,array($this,'activate'));
		register_deactivation_hook(__FILE__,array($this,'deactivate'));
		//Registramos con prioridad 0
		add_action('init', array($this,'register_custom_types'),0);
		add_action('init', array($this,'register_custom_taxonomies'),0);		
		
	}
	
	public function register_custom_types() {

		register_post_type('sponsors', array(

			'public'				=>	true,
			'publicly_queryable'	=>	true,
			'show_ui'				=>	true,
			'show_in_menu'			=>	true,
			'menu_position'			=>	5,
			'menu_icon'				=>   'dashicons-sos',
			'rewrite'				=>	array('slug' =>	'sponsors', 'with_front' => false),
			'supports'				=>	array('title','thumbnail'),
			'labels'	=>	array(
					'name'					=>	'sponsors',
					'singular_name'			=>	'sponsors',
					'add_new'				=>	'Nuevo Sponsor',
					'all_items'				=>	'Ver todos los Sponsors',
					'add_new_item'			=>	'Añadir nuevo Sponsor',
					'edit_item'				=>	'Editar Sponsor',
					'new_item'				=>	'Nuevo Sponsor',
					'view_item'				=>	'Ver Sponsor',
					'search_items'			=>	'Buscar Sponsors',
					'not_found'				=>	'Sponsor no encontrado',
					'not_found_in_trash'	=>	'Sponsors no encontrados en la papelera',
					'menu_name'				=>	'Sponsors'
					)
		));
	}
	
	public function register_custom_taxonomies() {

		register_taxonomy('tipo','sponsors', array(
	
		'hierarchical'			=>	true,
		'public'				=> 	true,
		'show_ui'				=>	true,
		'query_var'				=>	true,
		'show_admin_column'		=>	true,
		'rewrite'				=>	array('slug' =>	'tipo', 'with_front' => false),
		'labels'	=>	array(
				'name'					=>  'Tipo de sponsor',
				'singular_name'			=>	'Tipo de sponsor',
				'add_new'				=>	'Añadir Tipo de sponsor',
				'all_items'				=>	'Todos los Tipo de sponsor',
				'add_new_item'			=>	'Añadir nuevo Tipo de sponsor',
				'edit_item'				=>	'Editar Tipo de sponsor',
				'new_item'				=>	'Nuevo Tipo de sponsor',
				'view_item'				=>	'Ver Tipo de sponsor',
				'search_items'			=>	'Buscar Tipo de sponsor',
				'not_found'				=>	'Tipo de sponsor no encontrados',
				'not_found_in_trash'	=>	'Tipo de sponsor no encontrados en papelera',
				'menu_name'				=>	'Tipo de sponsor'
				)
		));

	}
	
	
	private function activate() {
		
		/* Acciones cuando se instala el plugin */
		
		$this->register_custom_types();
		
		$this->register_custom_taxonomies();
		
	}
	
	private function deactivate() {
		
		/* Acciones cuando se desactiva el plugin */
		
		//echo 'Desactivado';
	}
	
}

new critgijon_custom_types();

?>