<?php defined('SYSPATH') or die('No direct access allowed.');

return array(
	'promo' => array(
		'title' => __('Banners list'),
		'link' => Route::url('modules', array(
			'controller' => 'promo_element',
		)),
		'sub' => array(),
	),
	'promo_config' => array(
		'title' => __('Config'),
		'link' => Route::url('modules', array(
			'controller' => 'promo_config',
		)),
	),
);