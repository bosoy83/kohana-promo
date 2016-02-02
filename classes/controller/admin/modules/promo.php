<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Modules_Promo extends Controller_Admin_Front {

	protected $module_config = 'promo';
	protected $menu_active_item = 'modules';
	protected $title = 'Promo';
	protected $sub_title = 'Promo';
	
	protected $category_id;
	protected $controller_name = array(
		'element' => 'promo_element',
		'config' => 'promo_config',
	);
	protected $config_orm;
	
	public function before()
	{
		parent::before();
	
		$request = $this->request;
		$query_controller = $request->query('controller');
		if ( ! empty($query_controller) AND is_array($query_controller)) {
			$this->controller_name = $request->query('controller');
		}
		$this->template
			->bind_global('CONTROLLER_NAME', $this->controller_name);
		
		$this->title = __($this->title);
		$this->sub_title = __($this->sub_title);
		
		$this->config_orm = ORM::factory($this->controller_name['config']);
		$this->config_orm
			->where('site_id', '=', SITE_ID)
			->find();
			
		if ( ! $this->config_orm->loaded()) {
			$values = array(
				'site_id' => SITE_ID,
				'mode' => 'inherit',
				'creator_id'  =>  $this->user->id,
			);
			if (IS_MASTER_SITE) {
				$values['mode'] = 'internal';
			}
			
			$this->config_orm
				->values($values, array_keys($values))
				->save();
			
			unset($values);
		}
	}
	
	protected function layout_aside()
	{
		$menu_items = array_merge_recursive(
			Kohana::$config->load('admin/aside/promo')->as_array(),
			$this->menu_left_ext
		);
		
		return parent::layout_aside()
			->set('menu_items', $menu_items);
	}

	protected function left_menu_element_add()
	{
		$this->menu_left_add(array(
			'promo' => array(
				'sub' => array(
					'add' => array(
						'title' => __('Add banner'),
						'link' => Route::url('modules', array(
							'controller' => $this->controller_name['element'],
							'action' => 'edit',
						)),
					),
				),
			),
		));
	}
	
	protected function left_menu_element_fix($orm)
	{
		$can_fix_all = $this->acl->is_allowed($this->user, $orm, 'fix_all');
		$can_fix_master = $this->acl->is_allowed($this->user, $orm, 'fix_master');
		$can_fix_slave = $this->acl->is_allowed($this->user, $orm, 'fix_slave');
		
		if ($can_fix_all OR $can_fix_master OR $can_fix_slave) {
			$this->menu_left_add(array(
				'promo' => array(
					'sub' => array(
						'fix' => array(
							'title' => __('Fix positions'),
							'link'  => Route::url('modules', array(
								'controller' => $this->controller_name['element'],
								'action' => 'position',
								'query' => 'mode=fix'
							)),
						),
					),
				),
			));
		}
	}
	
	protected function _get_breadcrumbs()
	{
		return array(
			array(
				'title' => __('Promo'),
				'link' => Route::url('modules', array(
					'controller' => $this->controller_name['element'],
				)),
			)
		);
	}
	
}

