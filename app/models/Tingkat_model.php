<?php

class Tingkat_model {
	private $table = 'tb_tingkat';
	private $db;

	public function __construct() {
		$this->db = new Model;
	}

	public function get() {
		$this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY tingkat_id ASC');
		return $this->db->result();
	}

	public function get_tingkat_sd() {
		$this->db->query("SELECT * FROM " . $this->table . " WHERE tingkat_nama > 0 AND tingkat_nama <= 6 ORDER BY tingkat_id");
		return $this->db->result();
	}

	public function get_tingkat_smp() {
		$this->db->query("SELECT * FROM " . $this->table . " WHERE tingkat_nama > 6 AND tingkat_nama <= 9 ORDER BY tingkat_id");
		return $this->db->result();
	}

	public function get_tingkat_sma_smk() {
		$this->db->query("SELECT * FROM " . $this->table . " WHERE tingkat_nama > 9 AND tingkat_nama <= 12 ORDER BY tingkat_id");
		return $this->db->result();
	}

	public function add($data) {
		$query = "INSERT INTO ".$this->table." (tingkat_nama) VALUES (:tingkat_nama)";
		$this->db->query($query);
		$this->db->bind('tingkat_nama', $data['tingkat_nama']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function update($data) {
		$query = "UPDATE ".$this->table." SET tingkat_nama=:tingkat_nama WHERE tingkat_id=:tingkat_id";
		$this->db->query($query);
		$this->db->bind('tingkat_nama', $data['tingkat_nama']);
		$this->db->bind('tingkat_id', $data['tingkat_id']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function delete($id) {
		$query = "DELETE FROM " . $this->table . " WHERE tingkat_id=:tingkat_id";
		$this->db->query($query);
		$this->db->bind('tingkat_id', $id);
		$this->db->execute();

		return $this->db->rowCount();
	}
}