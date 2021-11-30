<?php

namespace App\Models;

use MF\Model\Model;

class Plains extends Model {

	private $id;
	private $name;
	private $price;
	private $descripition;

	

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

	
	public function register() {

		$query = "insert into plains(name, price)
				  values(:name, :price)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':name', $this->__get('name'));
		$stmt->bindValue(':price', $this->__get('price'));
		$stmt->execute();

		return $this;
	}

	
	
	public function getAll(){

		$query = 'SELECT p.id, p.name, p.price
				  FROM plains AS p';
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		return  $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
	}

	public function getPlain(){

		$query = 'SELECT  name,price
				  FROM plains  WHERE id = :id';
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));
		$stmt->execute();
		
		return  $stmt->fetch(\PDO::FETCH_ASSOC);
		
	}
	
	public function getIdPlain(){

		$query = 'SELECT  id
				  FROM plains  WHERE id = :id';
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));
		$stmt->execute();
		
		return  $stmt->fetch(\PDO::FETCH_ASSOC);
		
	}
	
	
	public function getInfoPlain(){
		$query = 'SELECT description FROM plain_descriptions WHERE id_plain = :id';
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));
		//die(var_dump($this->__get('id')));
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

}

?>