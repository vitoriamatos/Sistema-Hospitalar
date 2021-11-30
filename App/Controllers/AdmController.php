<?php

namespace App\Controllers;


use MF\Controller\Action;
use MF\Model\Container;

class AdmController extends Action
{

    /*=.=.=.=.=.=.=.=GERAL=.=.=.=.=.=.=.*/
    public function login()
    {

        $this->view->user = array(
            'name' => '',
            'email' => '',
            'password' => '',
        );

        $this->view->registerError = false;

        $this->render('..\adm\login');
    }


    public function dashboard()
    {

        $this->athenticationValidate();

        $adm = Container::getModel('Admin');

        $adm->__set('id', $_SESSION['id']);
        $this->view->info_user = $adm->getInfoUser();

        $this->render('..\adm\dashboard');
    }

    public function athenticationValidate()
    {

        session_start();
        if (!isset($_SESSION['id']) ||  $_SESSION['id'] == '' || !isset($_SESSION['id']) || $_SESSION['name'] == '') {

            header('Location: /?login=erro');
        }
    }


    public function index()
    {

        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $patient = Container::getModel('Patient');
        $patient->__set('id', $id);

        $this->view->patient = $patient->getPatient();


        $this->adm("index");
    }
    /*=.=.=.=.=.=.=.=PATIENT=.=.=.=.=.=.=.*/
    public function patientRegister()
    {

        $lead = Container::getModel('Lead');
        $this->view->login = isset($_GET['login']) ?  $_GET['login'] : '';


        $this->view->user = array(
            'name' => '',
            'email' => '',
            'password' => '',
            'cpf' => '',
            'cellphone' => '',
            'born_register' => '',
            'gender' => '',
            'cep' => '',
            'citty' => '',
            'street' => '',
            'number' => '',
            'district' => '',
            'id_plan' => '',
        );

        $this->view->registerError = false;

        $this->adm("register-patient");
    }

    public function list_patients()
    {


        $patient = Container::getModel('Patient');
        $this->view->patients = $patient->getAll();

        $this->adm("list-patients");
    }


    public function register_patient()
    {

        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $leads  = Container::getModel('Lead');
        $leads->__set('id', $id);
        $this->view->lead = $leads->getLead();

        $id_plain = $this->view->lead['id_plan'];

        $plains = Container::getModel('Plains');
		$plains->__set('id', $id_plain);
		$this->view->plains = $plains->getPlain();

		$this->view->id_plains = $plains->getIdPlain();

		$description = $plains->getInfoPlain();
		
		$this->view->descriptions = $description;

        $this->view->registerError = false;

        $this->adm("register-patient");
    }

    public function info_patients()
    {

        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $patient = Container::getModel('Patient');
        $patient->__set('id', $id);

        $this->view->patient = $patient->getPatient();

        $id_plain = $this->view->patient['id_plan'];

        $plains = Container::getModel('Plains');
		$plains->__set('id', $id_plain);
		$this->view->plains = $plains->getPlain();

		$this->view->id_plains = $plains->getIdPlain();

		$description = $plains->getInfoPlain();
		
		$this->view->descriptions = $description;

        $this->adm("info-patient");
    }

    public function registerDataPatient()
    {

        $lead  = Container::getModel('Lead');
        $patient = Container::getModel('Patient');

        $pasword = md5(substr($_POST['cpf'], 0, 3));
        $patient->__set('name', $_POST['name']);
        $patient->__set('email', $_POST['email']);
        $patient->__set('cpf', $_POST['cpf']);
        $patient->__set('cellphone', $_POST['cellphone']);
        $patient->__set('born_register', $_POST['born_register']);
        $patient->__set('cep', $_POST['cep']);
        $patient->__set('citty', $_POST['citty']);
        $patient->__set('street', $_POST['street']);
        $patient->__set('number', $_POST['number']);
        $patient->__set('district', $_POST['district']);
        $patient->__set('id_plan', $_POST['id_plan']);
        $patient->__set('password', $pasword );


        if ($patient->isRegisterValid() && count($patient->getUserFromEmail()) == 0) {

            $patient->register();
            $lead->delete($_POST['id']);

            $this->render('register-sucess-patient');
        } else {

            $this->view->user = array(
                'name' => '',
                'email' => '',
                'password' => '',
                'cpf' => '',
                'cellphone' => '',
                'born_register' => '',
                'gender' => '',
                'cep' => '',
                'citty' => '',
                'street' => '',
                'number' => '',
                'district' => '',
                'id_plan' => '',
            );

            $this->view->registerError = true;

            $this->render('');
        }
    }

    /*=.=.=.=.=.=.=.=DOCTOR=.=.=.=.=.=.=.*/
    public function doctorRegister()
    {
       // $this->athenticationValidate();
        $doctor = Container::getModel('Doctor');
        $this->view->login = isset($_GET['login']) ?  $_GET['login'] : '';


        $this->view->doctor = array(
            'name' => '',
            'email' => '',
            'password' => '',
            'cpf' => '',
            'crm' => '',
            'cellphone' => '',
            'born_register' => '',
            'gender' => '',
            'cep' => '',
            'citty' => '',
            'street' => '',
            'number' => '',
            'district' => '',
            'id_plan' => '',
        );

        $this->view->registerError = false;

        $this->adm("register-doctor");
    }


    public function list_doctors()
    {


        $doctor = Container::getModel('Doctor');
        $this->view->doctors = $doctor->getAll();

        $this->adm("list-doctor");
    }



    public function info_doctor()
    {

        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $doctor = Container::getModel('Doctor');
        $doctor->__set('id', $id);

        $this->view->doctor = $doctor->getDoctor();


        $this->adm("info-doctor");
    }

    public function registerDataDoctor()
    {

        $doctor = Container::getModel('Doctor');

        $doctor->__set('name', $_POST['name']);
        $doctor->__set('email', $_POST['email']);
        $doctor->__set('password', md5(substr($_POST['cpf'], 0, 3)));
        $doctor->__set('cpf', $_POST['cpf']);
        $doctor->__set('crm', $_POST['crm']);
        $doctor->__set('cellphone', $_POST['cellphone']);
        $doctor->__set('born_register', $_POST['born_register']);
        $doctor->__set('gender', $_POST['gender']);
        $doctor->__set('cep', $_POST['cep']);
        $doctor->__set('citty', $_POST['citty']);
        $doctor->__set('street', $_POST['street']);
        $doctor->__set('number', $_POST['number']);
        $doctor->__set('district', $_POST['district']);



        if ($doctor->isRegisterValid() && count($doctor->getUserFromEmail()) == 0) {

            $doctor->register();
            header('Location: /register-sucess-doctor');
        
          // $this->adm("register-sucess-doctor");
                //die(var_dump('aqui'));
          // $this->render('register-sucess-doctor');
        } else {

            $this->view->user = array(
                
            );

            $this->view->registerError = true;

            die(var_dump('erro'));
        }
    }


    public function registerSucessDoctor()
    {
        //$this->athenticationValidate();
        die(var_dump('aqui'));
        $this->adm("register-sucess-doctor");

    }
    /*=.=.=.=.=.=.=.=URGENCY=.=.=.=.=.=.=.*/
    public function urgency_solicitation()
    {
        $this->view->user= array(
            'cpf' => '',);
        $this->view->registerError = false;
        $this->adm("urgency-solicitation");
    }


    public function find_patient_urgency()
    {
        $patient = Container::getModel('Patient');

        $patient->__set('cpf', $_POST['cpf']);

        $isPatient = $patient->findPatient();

        if ($isPatient != null) {
            header('Location:/urgency-register?id=' . $isPatient['id']);
        } else {
            $this->view->registerError = true;
            header('Location:/urgency-solicitation?patient=erro');
        }
    }

    public function register_urgency()
    {
        $patient = Container::getModel('Patient');

        $patient->__set('id', $_GET['id']);

        $this->view->patient = $patient->getPatient();
        $this->adm("register-urgency");
    }
    
    public function register_data_urgency()
    {


        $urgency = Container::getModel('Urgency');

        $urgency->__set('id_patient', $_POST['id_patient']);
        $urgency->__set('symptoms', $_POST['symptoms']);
        $urgency->__set('priority', $_POST['priority']);

        $urgency->register();

        $this->render('register-sucess-urgency');


        $this->render('');
    }


    public function list_urgency()
    {

        $urgency = Container::getModel('Urgency');
        $this->view->urgencies = $urgency->getAll();

        $this->adm("list-urgency");
    }

    public function info_urgency()
    {
        $id_urgency = isset($_GET['id']) ? $_GET['id'] : '';
        $urgency = Container::getModel('Urgency');
        $urgency->__set('id', $id_urgency);
        $this->view->urgencies = $urgency->getUrgency();

        //$this->adm("list-urgency");

        $id_patient =  $this->view->urgencies['id_patient'];
        $patient = Container::getModel('Patient');
        $patient->__set('id', $id_patient);

        $this->view->patient = $patient->getPatient();

        $id_plain = $this->view->patient['id_plan'];

        $plains = Container::getModel('Plains');
		$plains->__set('id', $id_plain);
		$this->view->plains = $plains->getPlain();

		$this->view->id_plains = $plains->getIdPlain();

		$description = $plains->getInfoPlain();
		
		$this->view->descriptions = $description;

        $id_doctor = $this->view->urgencies['id_doctor'];

        $doctor = Container::getModel('Doctor');
		$doctor->__set('id', $id_doctor);
		$this->view->doctors = $doctor->getDoctor();

		$this->view->descriptions = $description;

        

        $this->adm("info-urgency");
    }

    /*=.=.=.=.=.=.=.=ECOMMERCE=.=.=.=.=.=.=.*/
    public function simulations()
    {

        $lead = Container::getModel('Lead');
        $this->view->leads = $lead->getAll();

        $this->adm("register-lead");
    }

    public function product()
	{
        $this->view->login = isset($_GET['login']) ?  $_GET['login'] : '';

		$plain = Container::getModel('Plains');

		$plains = $plain->getAll();
		$this->view->plains = $plains;
		$description = $plain->getInfoPlain();
		$this->view->descriptions = $description;
		$this->adm('product');
	}
}
