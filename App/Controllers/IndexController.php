<?php

namespace App\Controllers;


use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action
{

	public function index()
	{

		$this->view->login = isset($_GET['login']) ?  $_GET['login'] : '';
		$this->render('index');
	}

}
