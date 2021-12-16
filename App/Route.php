<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		/*=.=.=.=.=.=.=.=GERAL=.=.=.=.=.=.=.*/
		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['adm'] = array(
			'route' => '/adm',
			'controller' => 'AdmController',
			'action' => 'login'
		);

		$routes['patient'] = array(
			'route' => '/patient',
			'controller' => 'PatientController',
			'action' => 'login'
		);

		$routes['doctor'] = array(
			'route' => '/doctor',
			'controller' => 'DoctorController',
			'action' => 'login'
		);

		
		$routes['login'] = array(
			'route' => '/login',
			'controller' => 'AuthController',
			'action' => 'login'
		);

		
		$routes['logout'] = array(
			'route' => '/logout',
			'controller' => 'AuthController',
			'action' => 'logout'
		);
		
		
		/*=.=.=.=.=.=.=.=ADMINS=.=.=.=.=.=.=.*/
		$routes['dashboard-admin'] = array(
			'route' => '/dashboard-admin',
			'controller' => 'AdmController',
			'action' => 'index'
		);

		$routes['config-admin'] = array(
			'route' => '/config-admin',
			'controller' => 'AdmController',
			'action' => 'config'
		);

		//patients
		$routes['register-patient'] = array(
			'route' => '/register-patient',
			'controller' => 'AdmController',
			'action' => 'register_patient'
		);

		$routes['list-patients'] = array(
			'route' => '/list-patients',
			'controller' => 'AdmController',
			'action' => 'list_patients'
		);

			
		$routes['info-patient'] = array(
			'route' => '/info-patient',
			'controller' => 'AdmController',
			'action' => 'info_patients'
		);

		$routes['regiter-data-patient'] = array(
			'route' => '/regiter-data-patient',
			'controller' => 'AdmController',
			'action' => 'registerDataPatient'
		);
		//doctors
		$routes['register-data-doctor'] = array(
			'route' => '/register-data-doctor',
			'controller' => 'AdmController',
			'action' => 'registerDataDoctor'
		);

		$routes['register-sucess-doctor'] = array(
			'route' => '/register-sucess-doctor',
			'controller' => 'AdmController',
			'action' => 'registerSucessDoctor'
		);

		$routes['info-doctor'] = array(
			'route' => '/info-doctor',
			'controller' => 'AdmController',
			'action' => 'info_doctor'
		);

		$routes['doctor-register'] = array(
			'route' => '/doctor-register',
			'controller' => 'AdmController',
			'action' => 'doctorRegister'
		);

		$routes['list-doctors'] = array(
			'route' => '/list-doctors',
			'controller' => 'AdmController',
			'action' => 'list_doctors'
		);
		//Urgency 
		$routes['urgency-solicitation'] = array(
			'route' => '/urgency-solicitation',
			'controller' => 'AdmController',
			'action' => 'urgency_solicitation'
		);
		$routes['find-patient-urgency'] = array(
			'route' => '/find-patient-urgency',
			'controller' => 'AdmController',
			'action' => 'find_patient_urgency'
		);
		$routes['urgency-register'] = array(
			'route' => '/urgency-register',
			'controller' => 'AdmController',
			'action' => 'register_urgency'
		);
		$routes['regiter-data-urgency'] = array(
			'route' => '/regiter-data-urgency',
			'controller' => 'AdmController',
			'action' => 'register_data_urgency'
		);
		$routes['list-urgency'] = array(
			'route' => '/list-urgency',
			'controller' => 'AdmController',
			'action' => 'list_urgency'
		);
		$routes['info-urgency'] = array(
			'route' => '/info-urgency',
			'controller' => 'AdmController',
			'action' => 'info_urgency'
		);
		//ecommerce
		$routes['leads-solicitation'] = array(
			'route' => '/leads-solicitation',
			'controller' => 'AdmController',
			'action' => 'simulations'
		);

		$routes['product'] = array(
			'route' => '/product',
			'controller' => 'AdmController',
			'action' => 'product'
		);


	/*=.=.=.=.=.=.=.=ECOMMERCE=.=.=.=.=.=.=.*/
		$routes['leads'] = array(
			'route' => '/leads',
			'controller' => 'LeadController',
			'action' => 'index'
		);

		
		$routes['simulation'] = array(
			'route' => '/simulation',
			'controller' => 'LeadController',
			'action' => 'simulation'
		);

		$routes['register-lead'] = array(
			'route' => '/register-lead',
			'controller' => 'LeadController',
			'action' => 'register'
		);

	/*=.=.=.=.=.=.=.=PATIENT=.=.=.=.=.=.=.*/
	//geral
		$routes['dashboard-patient'] = array(
			'route' => '/dashboard-patient',
			'controller' => 'PatientController',
			'action' => 'dashboard'
		);

		$routes['config-patient'] = array(
			'route' => '/config-patient',
			'controller' => 'PatientController',
			'action' => 'config'
		);
		
		$routes['save-edit-patient'] = array(
			'route' => '/save-edit-patient',
			'controller' => 'PatientController',
			'action' => 'save_edit'
		);
		//exames
		$routes['exame-schedule-index'] = array(
			'route' => '/exame-schedule-index',
			'controller' => 'PatientController',
			'action' => 'exame_schedule_index'
		);
		$routes['exame-schedule'] = array(
			'route' => '/exame-schedule',
			'controller' => 'PatientController',
			'action' => 'exame_schedule'
		);
		$routes['register-exame-schedule'] = array(
			'route' => '/register-exame-schedule',
			'controller' => 'PatientController',
			'action' => 'register_exame_schedule'
		);

		$routes['exame-register-sucess'] = array(
			'route' => '/exame-register-sucess',
			'controller' => 'PatientController',
			'action' => 'exame_register_sucess'
		);
		$routes['follow-up-exame'] = array(
			'route' => '/follow-up-exame',
			'controller' => 'PatientController',
			'action' => 'follow_up_exame'
		);
		
		$routes['list-exame-patient'] = array(
			'route' => '/list-exame-patient',
			'controller' => 'PatientController',
			'action' => 'list_exame_patient'
		);
	
	/*=.=.=.=.=.=.=.=DOCTORS=.=.=.=.=.=.=.*/

	$routes['dashboard-doctor'] = array(
		'route' => '/dashboard-doctor',
		'controller' => 'DoctorController',
		'action' => 'dashboard'
	);

	$routes['config'] = array(
		'route' => '/config-doctor',
		'controller' => 'DoctorController',
		'action' => 'config'
	);
	
	$routes['save-edit-doctor'] = array(
		'route' => '/save-edit-doctor',
		'controller' => 'DoctorController',
		'action' => 'save_edit'
	);

		
	$routes['list-urgency-doctor'] = array(
		'route' => '/list-urgency-doctor',
		'controller' => 'DoctorController',
		'action' => 'list_urgency'
	);

	$routes['info-urgency-doctor'] = array(
		'route' => '/info-urgency-doctor',
		'controller' => 'DoctorController',
		'action' => 'info_urgency'
	);

	$routes['attendance-urgency-doctor'] = array(
		'route' => '/attendance-urgency-doctor',
		'controller' => 'DoctorController',
		'action' => 'attendance_urgency'
	);
	$routes['register-attendance-urgency'] = array(
		'route' => '/register-attendance-urgency',
		'controller' => 'DoctorController',
		'action' => 'register_attendance_urgency'
	);
	$routes['finish-attendance-urgency-doctor'] = array(
		'route' => '/finish-attendance-urgency-doctor',
		'controller' => 'DoctorController',
		'action' => 'finish_attendance_urgency'
	);

		
		

		$this->setRoutes($routes);
	}

}

?>