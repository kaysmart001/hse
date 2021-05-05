<?php

class Mapel_model {
	private $table = 'tb_mapel';
	private $db;

	public function __construct() {
		$this->db = new Model;
	}

	public function get() {
		$this->db->query(
			'SELECT * FROM ' 
			. $this->table .
			'
			JOIN tb_guru ON guru_id = mapel_guru
			ORDER BY mapel_id DESC
			'
		);
		return $this->db->result();
	}

	public function add($data) {
		$query = "INSERT INTO " . $this->table . " (mapel_kode, mapel_nama, mapel_guru) VALUES (:mapel_kode, :mapel_nama, :mapel_guru)";
		$this->db->query($query);
		$this->db->bind('mapel_kode', $data['mapel_kode']);
		$this->db->bind('mapel_nama', $data['mapel_nama']);
		$this->db->bind('mapel_guru', $data['mapel_guru']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function update($data) {
		$query = "UPDATE ".$this->table." SET mapel_kode=:mapel_kode, mapel_nama=:mapel_nama, mapel_guru=:mapel_guru WHERE mapel_id=:mapel_id";
		$this->db->query($query);
		$this->db->bind('mapel_kode', $data['mapel_kode']);
		$this->db->bind('mapel_nama', $data['mapel_nama']);
		$this->db->bind('mapel_guru', $data['mapel_guru']);
		$this->db->bind('mapel_id', $data['mapel_id']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function delete($id) {
		$query = "DELETE FROM " . $this->table . " WHERE mapel_id=:mapel_id";
		$this->db->query($query);
		$this->db->bind('mapel_id', $id['id']);
		$this->db->execute();

		return $this->db->rowCount();
	}
}