<?php

namespace App\Models;

use MF\Model\Model;

class Exame extends Model {

	private $id;
	private $id_exame;
	private $id_patient;
	
	private $day;
	private $hour;
	
	

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

	public function register() {

		$query = "insert into exames(id_exame, id_patient, hour)
				  values(:id_exame,:id_patient, :hour)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_exame', $this->__get('id_exame'));
		$stmt->bindValue(':id_patient', $this->__get('id_patient'));
		$stmt->bindValue(':hour', $this->__get('hour'));
		$stmt->execute();

		return $this;
	}


	public function getAll(){

		$query = 'SELECT id, name_exame
				  FROM exame_type';
		$stmt = $this->db->prepare($query);

		$stmt->execute();
		
		return  $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	
	public function getExame(){

		$query = 'SELECT e.id, t.name_exame, e.hour, e.id_doctor
				  FROM exames AS e
				  LEFT JOIN exame_type AS t ON (e.id_exame = t.id)
				  WHERE e.id = :id';
				  
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));

		$stmt->execute();
		
		return  $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function list(){

		$query = 'SELECT e.id, t.name_exame, e.hour, e.id_doctor, d.name_doctor, e.released
				  FROM exames AS e
				  LEFT JOIN exame_type AS t ON (e.id_exame = t.id)
				  LEFT JOIN doctors AS d ON (e.id_doctor= d.id)
				  WHERE e.id_patient = :id_patient';
				  
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_patient', $this->__get('id_patient'));
		
		$stmt->execute();
		
		return  $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

}
	

?>