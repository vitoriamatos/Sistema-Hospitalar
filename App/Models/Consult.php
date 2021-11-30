<?php

namespace App\Models;

use MF\Model\Model;

class Consult extends Model {

	private $id;
	private $id_patient;
	private $id_doctor;
	private $day;
	private $hour;
	
	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}

	public function register() {

		$query = "insert into consults(id_patient, id_doctor, day, hour)
				  values(:id_patient, :id_doctor, :day, :hour)";
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':id_patient', $this->__get('id_patient'));
		$stmt->bindValue(':id_doctor', $this->__get('id_doctor'));
		$stmt->bindValue(':day', $this->__get('day'));
		$stmt->bindValue(':hour', $this->__get('hour'));
		$stmt->execute();

		return $this;
	}


}
	

?>