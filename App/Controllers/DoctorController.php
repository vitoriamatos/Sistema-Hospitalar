<?php

namespace App\Controllers;


use MF\Controller\Action;
use MF\Model\Container;

class DoctorController extends Action
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

        $doctor = Container::getModel('Doctor');

        $doctor->__set('id', $_SESSION['id']);
        $this->view->info_user = $doctor->getInfoUser();

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

        $doctor = Container::getModel('Doctor');

        $doctor->__set('id', $_SESSION['id']);
        $this->view->info_user = $doctor->getDoctor();

        $this->render('info-doctor');

       
    }

    public function save_edit()
    {

        header('Content-type: application/json');
        die(var_dump(( $_POST)));

        $this->athenticationValidate();

        $doctor = Container::getModel('Doctor');

        $doctor->__set('id', $_SESSION['id']);
        $this->view->info_user = $doctor->getDoctor();

        $this->render('info-doctor');

       
    }

    public function list_urgency()
    {
        $this->athenticationValidate();

        $doctor = Container::getModel('Doctor');

        $doctor->__set('id', $_SESSION['id']);
        $this->view->info_user = $doctor->getDoctor();
     
        $urgency = Container::getModel('Urgency');
        $this->view->urgencies = $urgency->getAll();

        $this->render("list-urgency");
    }


    public function info_urgency()
    {
        $this->athenticationValidate();

        $doctor = Container::getModel('Doctor');

        $doctor->__set('id', $_SESSION['id']);
        $this->view->info_user = $doctor->getDoctor();

        $this->view->user = array(
            'cpf' => "",
        );
        $this->view->registerError = false;
        $this->render("info-urgency");
    }

    public function attendance_urgency(){
        $this->athenticationValidate();

        $doctor = Container::getModel('Doctor');

        $doctor->__set('id', $_SESSION['id']);
        $this->view->info_user = $doctor->getDoctor();

        $urgency = Container::getModel('Urgency');
        $urgency->__set('id', $_GET['id']);
        $this->view->urgency = $urgency->getUrgency();
       
        $patient = Container::getModel('Patient');
        $idPatient =  $urgency->getIdPatient($_GET['id']);
        $patient->__set('id',$idPatient['id_patient']);
      
        $this->view->patient = $patient->getPatient();

        $this->render("attendance-urgency");
    }

    public function register_attendance_urgency()
    {


        $urgency = Container::getModel('Urgency');

        $urgency->__set('id', $_POST['id']);
        $urgency->__set('id_patient', $_POST['id_patient']);
        $urgency->__set('id_doctor', $_POST['id_doctor']);
        $urgency->__set('symptoms', $_POST['symptoms']);
        $urgency->__set('diagnosis', $_POST['diagnosis']);
        $urgency->__set('prescription', $_POST['prescription']);
        $urgency->__set('observation', $_POST['observation']);

        $urgency->update();

     
        header('Location: /attendance-urgency-doctor?id='.$_POST['id']);
      
    }

    public function finish_attendance_urgency()
    {

        $urgency = Container::getModel('Urgency');

        $urgency->__set('id', $_GET['id']);
        $urgency->__set('released', 1);
       

        $urgency->released();

        $this->render('register-sucess-urgency');
      
    }

}
