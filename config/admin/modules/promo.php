<?php defined('SYSPATH') or die('No direct access allowed.');

return array(
	'a2' => array(
		'resources' => array(
			'promo_element_controller' => 'module_controller',
			'promo_config_controller' => 'module_controller',
			'promo_controller' => 'module_controller',
			'promo' => 'module',
		),
		'rules' => array(
			'allow' => array(
				'controller_access_1' => array(
					'role' => 'base',
					'resource' => 'promo_element_controller',
					'privilege' => 'access',
				),
				'controller_access_2' => array(
					'role' => 'base',
					'resource' => 'promo_config_controller',
					'privilege' => 'access',
				),
				'controller_access_3' => array(
					'role' => 'base',
					'resource' => 'promo_controller',
					'privilege' => 'access',
				),
			
				'promo_edit_1' => array(
					'role' => 'super',
					'resource' => 'promo',
					'privilege' => 'edit',
				),
				'promo_edit_2' => array(
					'role' => 'base',
					'resource' => 'promo',
					'privilege' => 'edit',
					'assertion' => array('Acl_Assert_Argument', array(
						'site_id' => 'site_id'
					)),
				),
				'promo_hide' => array(
					'role' => 'full',
					'resource' => 'promo',
					'privilege' => 'hide',
					'assertion' => array('Acl_Assert_Site', array(
						'site_id' => SITE_ID,
						'site_id_master' => SITE_ID_MASTER
					)),
				),
				'promo_fix_all' => array(
					'role' => 'super',
					'resource' => 'promo',
					'privilege' => 'fix_all',
				),
				'promo_fix_master' => array(
					'role' => 'main',
					'resource' => 'promo',
					'privilege' => 'fix_master',
				),
				'promo_fix_slave' => array(
					'role' => 'full',
					'resource' => 'promo',
					'privilege' => 'fix_slave',
				),
				
				'promo_config_edit_1' => array(
					'role' => 'super',
					'resource' => 'promo_config',
					'privilege' => 'edit',
				),
				'promo_config_edit_2' => array(
					'role' => 'base',
					'resource' => 'promo_config',
					'privilege' => 'edit',
					'assertion' => array('Acl_Assert_Argument', array(
						'site_id' => 'site_id'
					)),
				),
			),
			'deny' => array(
			)
		)
	),
);