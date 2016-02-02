<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Modules_Promo_Config extends Controller_Admin_Modules_Promo {

	protected $title = 'Config';
	
	public function action_index()
	{
		$request = $this->request->current();
			
		$errors = array();
		$submit = $request->post('submit');
		if ($submit) {
			try {
				$this->config_orm->updater_id = $this->user->id;
				$this->config_orm->updated = date('Y-m-d H:i:s');
				
				$values = $request->post();
				$this->config_orm
					->values($values)
					->save();
				
				if ( ! empty($this->back_url)) {
					$request
						->redirect($this->back_url);
				}
			} catch (ORM_Validation_Exception $e) {
				$errors = $this->errors_extract($e);
			}
		}
		
		$mode_options = Kohana::$config->load('_promo.mode');
		if (IS_MASTER_SITE) {
			unset($mode_options['inherit']);
		}

		$this->template
			->set_filename('modules/promo/config/edit')
			->set('errors', $errors)
			->set('orm', $this->config_orm)
			->set('mode_options', $mode_options);
		
		$this->left_menu_element_add();
	}
	
	protected function _get_breadcrumbs()
	{
		$breadcrumbs = parent::_get_breadcrumbs();
		
		$breadcrumbs[] = array(
			'title' => __('Config'),
			'link' => Route::url('modules', array(
				'controller' => $this->controller_name['config'],
			)),
		);
		
		return $breadcrumbs;
	}
} 
