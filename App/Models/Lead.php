<?php

namespace App\Models;

use MF\Model\Model;

class Lead extends Model {

	private $id;
	private $name;
	private $email;
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

		$query = "insert into leads(name_lead, email, cpf, cellphone, born_register, gender, cep, citty, street, number, district, id_plan)
				  values(:name, :email, :cpf, :cellphone, :born_register, :gender,  :cep, :citty, :street, :number, :district, :id_plan)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':name', $this->__get('name'));
		$stmt->bindValue(':email', $this->__get('email'));
		$stmt->bindValue(':cpf', $this->__get('cpf'));
		$stmt->bindValue(':cellphone', $this->__get('cellphone'));
		$stmt->bindValue(':born_register', $this->__get('born_register'));
		$stmt->bindValue(':gender', $this->__get('gender'));
		$stmt->bindValue(':cep', $this->__get('cep'));
		$stmt->bindValue(':citty', $this->__get('citty'));
		$stmt->bindValue(':street', $this->__get('street'));
		$stmt->bindValue(':number', $this->__get('number'));
		$stmt->bindValue(':district', $this->__get('district'));
		$stmt->bindValue(':id_plan', $this->__get('id_plan'));
		$stmt->execute();
		
	
		return $this;

		
	}

	public function getAll(){

		$query = 'SELECT l.id, l.name_lead,  p.name
				  FROM leads AS l
				  LEFT JOIN plains AS p ON (l.id_plan = p.id)';
		$stmt = $this->db->prepare($query);
		
		$stmt->execute();
		
		return  $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}


	public function getLead(){

		$query = 'SELECT l.id, l.name_lead,  l.email, l.cpf, l.cellphone, l.born_register, l.gender, l.cep, l.citty, l.street, l.number, l.district, l.id_plan, p.name
				  FROM leads AS l
				  LEFT JOIN plains AS p ON (l.id_plan = p.id) WHERE l.id = :id';
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));
		
		$stmt->execute();
		
		return  $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	
	public function delete($id){
		$query = "DELETE FROM leads WHERE id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $id);

		$stmt->execute();

		return true;
		

	}
	
	


}

?>