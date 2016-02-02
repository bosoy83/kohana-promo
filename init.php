<?php defined('SYSPATH') or die('No direct script access.');

Route::set('promo', 'promo(/<id>)')
	->defaults(array(
		'directory' => 'modules',
		'controller' => 'promo',
		'action' => 'index',
	));