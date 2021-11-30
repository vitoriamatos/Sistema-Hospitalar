<?php

namespace App\Controllers;


use MF\Controller\Action;
use MF\Model\Container;

class LeadController extends Action
{

	public function index()
	{
		$plain = Container::getModel('Plains');

		$plains = $plain->getAll();
		$this->view->plains = $plains;
		$description = $plain->getInfoPlain();
		$this->view->descriptions = $description;
		$this->render('index');
	}

	public function simulation()
	{

		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$plains = Container::getModel('Plains');
		$plains->__set('id', $id);
		$this->view->plains = $plains->getPlain();

		$this->view->id_plains = $plains->getIdPlain();

		$description = $plains->getInfoPlain();
		
		$this->view->descriptions = $description;
		//die(var_dump($this->view->descriptions));

		$this->view->user = array(
			'name' => '',
			'email' => '',
			'password' => '',
			'cpf' => '',
			'cellphone' => '',
			'born_register' => '',
			'gender'=> '',
			'cep' => '',
			'citty' => '',
			'street' => '',
			'number' => '',
			'district' => '',

		);

		$this->view->registerError = false;

		$this->render('..\lead\simulation');
	}


	public function register()
	{
		$lead  = Container::getModel('Lead');

		$lead->__set('name', $_POST['name']);
		$lead->__set('email', $_POST['email']);
		$lead->__set('cpf', $_POST['cpf']);
		$lead->__set('cellphone', $_POST['cellphone']);
		$lead->__set('born_register', $_POST['born_register']);
		$lead->__set('gender', $_POST['gender']);
		$lead->__set('cep', $_POST['cep']);
		$lead->__set('citty', $_POST['citty']);
		$lead->__set('street', $_POST['street']);
		$lead->__set('number', $_POST['number']);
		$lead->__set('district', $_POST['district']);
		$lead->__set('id_plan', $_POST['id_plan']);


		$lead->register();
		//die(var_dump($_POST['id']));
		$this->render('register-sucess');
	}


	public function register_user()
	{

		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$plains = Container::getModel('Plains');
		$plains->__set('id', $id);
		$this->view->plains = $plains->getPlain();

		$this->view->id_plains = $plains->getIdPlain();

		$description = $plains->getInfoPlain();
		
		$this->view->descriptions = $description;

		$lead  = Container::getModel('Lead');

		
		$lead->__set('email', $_POST['email']);
		$lead->__set('password', $_POST['password']);


		$lead->register_user();
		$this->render('register');
	}



}
