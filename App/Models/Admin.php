<?php

namespace App\Models;

use MF\Model\Model;

class Admin extends Model {

	private $id;
	private $name;
	private $email;
	private $password;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

	public function register() {

		$query = "insert into admins(name, email, password)values(:name, :email, :password)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':name', $this->__get('name'));
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':password', $this->__get('password')); 
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

		if(strlen($this->__get('password')) < 3) {
			$valid = false;
		}


		return $valid;
	}

	
	public function getUserFromEmail() {
		$query = "select name, email from admins where email = :email";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}


	public function authentication() {

		$query = "SELECT id, name, email, password FROM admins WHERE email =:email AND password =:password";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':password', $this->__get('password'));
		$stmt->execute();

		$user = $stmt->fetch(\PDO::FETCH_ASSOC);
		
		if($user['id'] != '' && $user['name'] != ''){
			$this->__set('id', $user['id']);
			$this->__set('name', $user['name']);
		}

		
		return $user;
	}


	public function getAll(){

		$query = "SELECT id, name, email FROM admins";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':name', $this->__get('name'));
		$stmt->bindValue(':id', $this->__get('id'));
		$stmt->execute();

		return  $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	public function getInfoUser(){
		$query = "SELECT name, email, password FROM admins WHERE id = :id_user";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_user', $this->__get('id'));
		$stmt->execute();

		return $stmt->fetch(\PDO::FETCH_ASSOC);

	}

}

?>