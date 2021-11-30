<?php


namespace MF\Model;

abstract class Model {

	protected $db;

	public function __construct(\PDO $db) {
		$this->db = $db;
	}

	protected function isGetRequest(){
		return $this->input->server('REQUEST_METHOD') == "GET";
	}

	protected function isPostRequest()
	{
		return $this->input->server('REQUEST_METHOD') == "POST";
	}

}


?>