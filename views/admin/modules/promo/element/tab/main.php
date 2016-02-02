<?php defined('SYSPATH') or die('No direct access allowed.');

	$orm = $helper_orm->orm();
	$labels = $orm->labels();
	$required = $orm->required_fields();

/**** for_all ****/

	if (IS_MASTER_SITE) {
		echo View_Admin::factory('form/checkbox', array(
			'field' => 'for_all',
			'errors' => $errors,
			'labels' => $labels,
			'required' => $required,
			'orm_helper' => $helper_orm,
		));
	}	
	
/**** active ****/
	
	echo View_Admin::factory('form/checkbox', array(
		'field' => 'active',
		'errors' => $errors,
		'labels' => $labels,
		'required' => $required,
		'orm_helper' => $helper_orm,
	));
	
/**** title ****/
	
	echo View_Admin::factory('form/control', array(
		'field' => 'title',
		'errors' => $errors,
		'labels' => $labels,
		'required' => $required,
		'controls' => Form::input('title', $orm->title, array(
			'id' => 'title_field',
			'class' => 'input-xxlarge',
		)),
	));

/**** public_date ****/
	
	echo View_Admin::factory('form/date', array(
		'field' => 'public_date',
		'errors' => $errors,
		'labels' => $labels,
		'required' => $required,
		'orm' => $orm,
	));
	
/**** image_1 ****/
	
	echo View_Admin::factory('form/image', array(
		'field' => 'image_1',
		'value' => $orm->image_1,
		'orm_helper' => $helper_orm,
		'errors' => $errors,
		'labels' => $labels,
		'required' => $required,
		'help_text' => Arr::get($field_hints, 'image_1'),
	));
	
/**** image_2 ****/
	
	echo View_Admin::factory('form/image', array(
		'field' => 'image_2',
		'value' => $orm->image_2,
		'orm_helper' => $helper_orm,
		'errors' => $errors,
		'labels' => $labels,
		'required' => $required,
		'help_text' => Arr::get($field_hints, 'image_2'),
	));
	
/**** link ****/
	
	echo View_Admin::factory('form/control', array(
		'field' => 'link',
		'errors' => $errors,
		'labels' => $labels,
		'required' => $required,
		'controls' => Form::input('link', $orm->link, array(
			'id' => 'link_field',
			'class' => 'input-xxlarge',
		)),
	));
