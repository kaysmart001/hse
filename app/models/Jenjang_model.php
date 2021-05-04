<?php

class Jenjang_model {
	private $table = 'tb_jenjang';
	private $db;

	public function __construct() {
		$this->db = new Model;
	}

	public function get() {
		$this->db->query('SELECT * FROM ' . $this->table);
		return $this->db->result();
	}

	public function get_orderby($order = NULL) {
		$this->db->query('SELECT * FROM ' . $this->table  . (!is_null($order) ? ' ORDER BY ' . $order : '') );
		return $this->db->result();
	}

	public function add($data) {
		$query = "INSERT INTO ".$this->table." (jenjang_nama) VALUES (:jenjang_nama)";
		$this->db->query($query);
		$this->db->bind('jenjang_nama', $data['jenjang_nama']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function update($data) {
		$query = "UPDATE ".$this->table." SET jenjang_nama=:jenjang_nama WHERE jenjang_id=:jenjang_id";
		$this->db->query($query);
		$this->db->bind('jenjang_nama', $data['jenjang_nama']);
		$this->db->bind('jenjang_id', $data['jenjang_id']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function delete($id) {
		$query = "DELETE FROM " . $this->table . " WHERE jenjang_id=:jenjang_id";
		$this->db->query($query);
		$this->db->bind('jenjang_id', $id);
		$this->db->execute();

		return $this->db->rowCount();
	}
}