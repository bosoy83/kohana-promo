<?php defined('SYSPATH') or die('No direct script access.');

class Model_Promo extends ORM_Base {

	protected $_table_name = 'promo';
	protected $_sorting = array('position' => 'ASC');
	protected $_deleted_column = 'delete_bit';
	protected $_active_column = 'active';

	public function labels()
	{
		return array(
			'title' => 'Title',
			'description' => 'Short',
			'link' => 'Link',
			'image_1' => 'Image 1',
			'image_2' => 'Image 2',
			'text' => 'Text',
			'active' => 'Active',
			'position' => 'Position',
			'for_all' => 'For all sites',
			'public_date' => 'Public date',
		);
	}

	public function rules()
	{
		return array(
			'id' => array(
				array('digit'),
			),
			'site_id' => array(
				array('not_empty'),
				array('digit'),
			),
			'title' => array(
				array('not_empty'),
				array('max_length', array(':value', 255)),
			),
			'description' => array(
				array('max_length', array(':value', 255)),
			),
			'link' => array(
				array('url'),
			),
			'image_1' => array(
				array('max_length', array(':value', 255)),
			),
			'image_2' => array(
				array('max_length', array(':value', 255)),
			),
			'position' => array(
				array('digit'),
			),
			'public_date' => array(
				array('date'),
			),
		);
	}

	public function filters()
	{
		return array(
			TRUE => array(
				array('trim'),
			),
			'title' => array(
				array('strip_tags'),
			),
			'active' => array(
				array(array($this, 'checkbox'))
			),
			'for_all' => array(
				array(array($this, 'checkbox'))
			),
		);
	}
	
	public function apply_mode_filter()
	{
		parent::apply_mode_filter();
	
		if($this->_filter_mode == ORM_Base::FILTER_FRONTEND) {
			$this
				->where($this->_object_name.'.public_date', '<=', date('Y-m-d H:i:00'));
		}
	}
}
