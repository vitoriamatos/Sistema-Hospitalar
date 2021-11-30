<?php

namespace App\Models;

use MF\Model\Model;

class Urgency extends Model {

	private $id;
	private $id_patient;
	private $symptoms;
	private $priority;
	private $date_created;
	private $id_doctor;
	private $diagnosis;
	private $prescription;
	private $observation;
	

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

	
	public function register() {

		$query = "insert into urgencies(id_patient, symptoms, priority)
				  values(:id_patient, :symptoms, :priority)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_patient', $this->__get('id_patient'));
		$stmt->bindValue(':symptoms', $this->__get('symptoms'));
		$stmt->bindValue(':priority', $this->__get('priority'));
		
		$stmt->execute();
		
	
		return $this;

		
	}

	public function update() {
	
	$query = "UPDATE urgencies 
			SET id_doctor= :id_doctor,
				symptoms= :symptoms,
				diagnosis= :diagnosis,
				prescription= :prescription,
				observation = :observation
			WHERE id= :id";
			
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));
		$stmt->bindValue(':id_doctor', $this->__get('id_doctor'));
		$stmt->bindValue(':symptoms', $this->__get('symptoms'));
		$stmt->bindValue(':diagnosis', $this->__get('diagnosis'));
		$stmt->bindValue(':prescription', $this->__get('prescription'));
		$stmt->bindValue(':observation', $this->__get('observation'));
		
		$stmt->execute();
		
	    return $this;

	}

	public function released() {
	

		$query = "UPDATE urgencies 
				  SET released= :released
				  WHERE id= :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));
		$stmt->bindValue(':released', $this->__get('released'));
		
		
		$stmt->execute();
		
	
		return $this;

		
	}


	public function getAll(){

		$query = 'SELECT p.name_patient,u.id, u.priority, d.name_doctor, u.symptoms
				  FROM urgencies AS u
				  LEFT JOIN patients AS p ON (p.id = u.id_patient)
				  LEFT JOIN doctors AS d ON (d.id = u.id_doctor)';
		$stmt = $this->db->prepare($query);
		
		$stmt->execute();
		
		return  $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getIdPatient(){

		$query = 'SELECT id_patient
				  FROM urgencies WHERE id = :id ';
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id',$this->__get('id'));
		$stmt->execute();
		
		return  $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function getUrgency(){

		$query = 'SELECT u.id, u.priority, u.symptoms, u.id_patient, u.id_doctor
				  FROM urgencies AS u
				  WHERE id = :id';
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id', $this->__get('id'));
		$stmt->execute();
		
		return  $stmt->fetch(\PDO::FETCH_ASSOC);
	}
	
	
}

?>