<?php defined('SYSPATH') or die('No direct access allowed.');

	echo View_Admin::factory('layout/breadcrumbs', array(
		'breadcrumbs' => $breadcrumbs
	));

	$labels = $orm->labels();
	$required = $orm->required_fields();

	$query_array = array();
	if ( ! empty($BACK_URL)) {
		$query_array['back_url'] = $BACK_URL;
	}

	$query_array = Paginator::query(Request::current(), $query_array);
	$action = Route::url('modules', array(
		'controller' => $CONTROLLER_NAME['config'],
		'query' => Helper_Page::make_query_string($query_array),
	));
	
	echo View_Admin::factory('layout/error')
		->bind('errors', $errors);
?>

	<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data" class="form-horizontal" >
		<div class="tabbable">
			<ul class="nav nav-tabs kr-nav-tsbs">
<?php
				echo '<li class="active">', HTML::anchor('#tab-main', __('Main'), array(
					'data-toggle' => 'tab'
				)), '</li>'; 
?>
				<!-- #tab-nav-insert# -->
			</ul>
			<div class="tab-content kr-tab-content">
				<div class="tab-pane kr-tab-pane active" id="tab-main">
<?php
					echo View_Admin::factory('modules/promo/config/tab/main', array(
						'orm' => $orm,
						'mode_options' => $mode_options,
						'errors' => $errors,
					)); 
?>
				</div>
				<!-- #tab-pane-insert# -->
			</div>
		</div>
<?php
		echo View_Admin::factory('form/submit_save');
?>	
	</form>
