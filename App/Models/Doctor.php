<?php

namespace App\Models;

use MF\Model\Model;

class Doctor extends Model {

	private $id;
	private $name;
	private $email;
	private $password;
	private $cpf;
	private $crm;
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

		$query = "insert into doctors(name_doctor, email, password, cpf, crm, cellphone, born_register, gender, cep, citty, street, number, district)
				  values(:name, :email, :password, :cpf, :crm, :cellphone, :born_register, :gender,:cep, :citty, :street, :number, :district)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':name', $this->__get('name'));
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':password', $this->__get('password'));
		$stmt->bindValue(':cpf', $this->__get('cpf'));
		$stmt->bindValue(':crm', $this->__get('crm'));
		$stmt->bindValue(':cellphone', $this->__get('cellphone'));
		$stmt->bindValue(':born_register', $this->__get('born_register'));
		$stmt->bindValue(':gender', $this->__get('gender'));
		$stmt->bindValue(':cep', $this->__get('cep'));
		$stmt->bindValue(':citty', $this->__get('citty'));
		$stmt->bindValue(':street', $this->__get('street'));
		$stmt->bindValue(':number', $this->__get('number'));
		$stmt->bindValue(':district', $this->__get('district'));
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
		$query = "select email from doctors where email = :email";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function authentication() {

		$query = "SELECT id, name_doctor, password FROM doctors WHERE email =:email AND password =:password";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':password', $this->__get('password'));
		$stmt->execute();

		$user = $stmt->fetch(\PDO::FETCH_ASSOC);

		if($user['id'] != '' && $user['name_doctor'] != ''){
			$this->__set('id', $user['id']);
			$this->__set('name', $user['name_doctor']);
		}
		return $user;
	}

	public function getAll(){

		$query = 'SELECT id, name_doctor,  crm
				  FROM doctors';
		$stmt = $this->db->prepare($query);
		
		$stmt->execute();
		
		return  $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	public function getDoctor(){

		$query = 'SELECT id, name_doctor,  email, cpf, crm, cellphone, born_register, gender, cep, citty, street, number, district
				  FROM doctors';
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));
		
		$stmt->execute();
		
		return  $stmt->fetch(\PDO::FETCH_ASSOC);
	}
	
	public function getInfoUser(){
		$query = "SELECT name_doctor FROM doctors WHERE id = :id_user";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_user', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);

	}

	public function edit(){
		$query = "SELECT name_doctor FROM doctors WHERE id = :id_user";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_user', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);

	}
}

?>