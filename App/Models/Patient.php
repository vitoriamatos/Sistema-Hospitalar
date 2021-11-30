<?php

namespace App\Models;

use MF\Model\Model;

class Patient extends Model {

	private $id;
	private $name;
	private $email;
	private $password;
	private $cpf;
	private $cellphone;
	private $born_register;
	private $cep;
	private $citty;
	private $street;
	private $number;
	private $district;
	private $id_plan;
	

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

	
	public function register() {

		$query = "insert into patients(name_patient, email, password, cpf, cellphone, born_register, cep, citty, street, number, district, id_plan)
				  values(:name, :email, :password, :cpf, :cellphone, :born_register, :cep, :citty, :street, :number, :district, :id_plan)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':name', $this->__get('name'));
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':password', $this->__get('password'));
		$stmt->bindValue(':cpf', $this->__get('cpf'));
		$stmt->bindValue(':cellphone', $this->__get('cellphone'));
		$stmt->bindValue(':born_register', $this->__get('born_register'));
		$stmt->bindValue(':cep', $this->__get('cep'));
		$stmt->bindValue(':citty', $this->__get('citty'));
		$stmt->bindValue(':street', $this->__get('street'));
		$stmt->bindValue(':number', $this->__get('number'));
		$stmt->bindValue(':district', $this->__get('district'));
		$stmt->bindValue(':id_plan', $this->__get('id_plan'));
		$stmt->execute();
		
	
		return $this;

		
	}

	public function isRegisterValid() {
		$valid = true;

		if(strlen($this->__get('name')) < 3) {
			$valid = false;
		}

		if(strlen($this->__get('email')) < 3) {
			$valid = false;
		}

		return $valid;
	}

	
	public function getUserFromEmail() {
		$query = "select , email from patients where email = :email";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}


	public function authentication() {

		$query = "SELECT id, name_patient, password FROM patients WHERE email =:email AND password =:password";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':password', $this->__get('password'));
		$stmt->execute();

		$user = $stmt->fetch(\PDO::FETCH_ASSOC);

		if($user['id'] != '' && $user['name_patient'] != ''){
			$this->__set('id', $user['id']);
			$this->__set('name', $user['name_patient']);
		}
		return $user;
	}

	public function getAll(){

		$query = 'SELECT l.id, l.name_patient,  p.name
				  FROM patients AS l
				  LEFT JOIN plains AS p ON (l.id_plan = p.id)';
		$stmt = $this->db->prepare($query);
		
		$stmt->execute();
		
		return  $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	
	public function getPatient(){

		$query = 'SELECT l.id, l.name_patient,  l.email, l.cpf, l.cellphone, l.born_register, l.gender, l.cep, l.citty, l.street, l.number, l.district, l.id_plan, p.name
				  FROM patients AS l
				  LEFT JOIN plains AS p ON (l.id_plan = p.id) WHERE l.id = :id';
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));
		
		$stmt->execute();
		//die(var_dump( $stmt->fetch(\PDO::FETCH_ASSOC)));
		return  $stmt->fetch(\PDO::FETCH_ASSOC);
	}
	
	public function getInfoUser(){
		$query = "SELECT name_patient FROM patients WHERE id = :id_user";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_user', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);

	}

	public function findPatient(){

		$query = "SELECT id
				  FROM patients 
				  WHERE cpf = :cpf";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':cpf', $this->__get('cpf'));
		
		$stmt->execute();
		
		return  $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function edit(){
		$query = "SELECT name_patient FROM patients WHERE id = :id_user";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_user', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);

	}
}

?>