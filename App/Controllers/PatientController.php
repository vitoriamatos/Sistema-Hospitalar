<?php

namespace App\Controllers;


use MF\Controller\Action;
use MF\Model\Container;

class PatientController extends Action
{

	

	public function login()
	{

		$this->view->user = array(
			'name' => '',
			'email' => '',
			'password' => '',
		);

		$this->view->registerError = false;

		$this->render('login');
	}

	public function dashboard()
    {

        $this->athenticationValidate();

        $patient = Container::getModel('Patient');

        $patient->__set('id', $_SESSION['id']);
        $this->view->info_user = $patient->getInfoUser();

        $this->render('dashboard');
    }

	public function athenticationValidate()
    {

        session_start();
        if (!isset($_SESSION['id']) ||  $_SESSION['id'] == '' || !isset($_SESSION['id']) || $_SESSION['name'] == '') {

            header('Location: /?login=erro');
        }
    }


    public function config()
    {
       
        $this->athenticationValidate();

        $patient = Container::getModel('Patient');

        $patient->__set('id', $_SESSION['id']);
        $this->view->info_user = $patient->getPatient();

       
        $this->render('info-patient');

       
    }

    public function save_edit()
    {

        header('Content-type: application/json');
        die(var_dump(( $_POST)));

        $this->athenticationValidate();

        $patient = Container::getModel('Patient');

        $patient->__set('id', $_SESSION['id']);
        $this->view->info_user = $patient->getPatient();

        $this->render('info-patient');

       
    }


    public function exame_schedule_index()
    {

        $this->athenticationValidate();

        $patient = Container::getModel('Patient');

        $patient->__set('id', $_SESSION['id']);
        $this->view->info_user = $patient->getPatient();


        $exame = Container::getModel('Exame');

        $this->view->info_exame = $exame->getAll();

        $this->render('exame-schedule');

       
    }


    public function exame_schedule()
    {

        $this->athenticationValidate();

        $patient = Container::getModel('Patient');

        $patient->__set('id', $_SESSION['id']);
        $this->view->info_user = $patient->getPatient();


        $exame = Container::getModel('Exame');

        $this->view->info_exame = $exame->getAll();

        $this->render('exame-register');

       
    }


    public function register_exame_schedule()
    {

        $this->athenticationValidate();

        $patient = Container::getModel('Patient');

        $patient->__set('id', $_SESSION['id']);
        $this->view->info_user = $patient->getPatient();

      
        $exame = Container::getModel('Exame');
        $exame->__set('id_exame',$_POST['idExame']);
        $exame->__set('id_patient',$_POST['idPacient']);
        $exame->__set('hour',$_POST['horarios']);
        $exame->register();

        header('Location:/exame-register-sucess?id='.$_POST['idExame']);
       
    }

    public function exame_register_sucess()
    {

        $this->athenticationValidate();

        $patient = Container::getModel('Patient');

        $patient->__set('id', $_SESSION['id']);
        $this->view->info_user = $patient->getPatient();

      
        $exame = Container::getModel('Exame');
       

        $this->render('exame-register-sucess');
       
    }

    public function follow_up_exame()
    {

        $this->athenticationValidate();

        $patient = Container::getModel('Patient');

        $patient->__set('id', $_SESSION['id']);
        $this->view->info_user = $patient->getPatient();


        $exame = Container::getModel('Exame');
        $exame->__set('id', $_GET['id']);
        $this->view->info_exame = $exame->getExame();

      
        $this->render('follow-up-exame');

       
    }


    public function list_exame_patient()
    {

        $this->athenticationValidate();

        $patient = Container::getModel('Patient');

        $patient->__set('id', $_SESSION['id']);
        $this->view->info_user = $patient->getPatient();


       
        $exame = Container::getModel('Exame');
        $exame->__set('id_patient', $_SESSION['id']);
       
        $this->view->info_exame = $exame->list();
       
      
        $this->render('list-exame');

       
    }
  
}
