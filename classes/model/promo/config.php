<?php defined('SYSPATH') or die('No direct script access.');

class Model_Promo_Config extends ORM_Base {

	protected $_primary_key = 'site_id';
	protected $_table_name = 'promo_config';

	public function labels()
	{
		return array(
			'mode' => 'Mode',
			'embed_code' => 'Embed code',
		);
	}

	public function rules()
	{
		return array(
			'site_id' => array(
				array('not_empty'),
				array('digit'),
			),
			'mode' => array(
				array('in_array', array(':value', array('inherit', 'external', 'internal'))),
			),
		);
	}

	public function filters()
	{
		return array(
			TRUE => array(
				array('trim'),
			),
		);
	}
}
