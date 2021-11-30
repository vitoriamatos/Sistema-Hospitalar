<?php

namespace MF\Controller;

abstract class Action {

	protected $view;

	public function __construct() {
		$this->view = new \stdClass();
	}

	protected function render($view, $layout = 'layout') {
		$this->view->page = $view;

		if(file_exists("../App/Views/".$layout.".phtml")) {
			require_once "../App/Views/".$layout.".phtml";
		} else {
			$this->content();
		}
	}

	protected function content() {
		$classAtual = get_class($this);

		$classAtual = str_replace('App\\Controllers\\', '', $classAtual);

		$classAtual = strtolower(str_replace('Controller', '', $classAtual));

		require_once "../App/Views/".$classAtual."/".$this->view->page.".phtml";
	}

	protected function footer(){

		require_once "../App/Views/footer.phtml";

	}

	
	protected function adm($view){
		$this->view->page = $view;
		require_once "../App/Views/adm/".$view.".phtml";

	}

	protected function dashboard(){
		$this->view->page = "dashboard";
		require_once "../App/Views/adm/dashboard.phtml";

	}

	protected function dashboard_patient(){
		$this->view->page = "dashboard";
		require_once "../App/Views/patient/dashboard.phtml";

	}

	protected function dashboard_doctor(){
		$this->view->page = "dashboard";
		require_once "../App/Views/doctor/dashboard.phtml";

	}




}

?>