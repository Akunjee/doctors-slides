<?php

	add_action('cmb2_admin_init','taufik_metabox_fields_add');
	function taufik_metabox_fields_add(){
		$prefix='_prefix_';
		$metaboxsection=new_cmb2_box(array(
			'title'	=>	__('Informations','slides-plugin'),
			'id'	=>	'doctors-info-fields',
			'object_types'	=>	array('doctors_info')
		));

		$metaboxsection->add_field(array(
			'name'	=> __('Name','slides-plugin'),
			'type'	=>	'text',
			'id'	=>	$prefix.'doctors_name'
		));
		$metaboxsection->add_field(array(
			'name'	=> __('Age','slides-plugin'),
			'type'	=>	'text',
			'id'	=>	$prefix.'doctors_age'
		));
		$metaboxsection->add_field(array(
			'name'	=> __('Degree','slides-plugin'),
			'type'	=>	'text',
			'id'	=>	$prefix.'doctors_degree'
		));

		$metaboxsection->add_field(array(
			'name'	=> __('Chamber','slides-plugin'),
			'type'	=>	'wysiwyg',
			'id'	=>	$prefix.'doctors_chamber'
		));
	}