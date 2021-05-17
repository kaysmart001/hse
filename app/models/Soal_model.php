<?php

class Soal_model {
	private $table = 'tb_soal';
	private $db;

	public function __construct() {
		$this->db = new Model;
	}

	public function insert($data) {
		$query = 'INSERT INTO ' . $this->table . ' (soal_topik, soal_detail, soal_tipe, soal_pembuat) VALUES (:soal_topik, :soal_detail, :soal_tipe, :soal_pembuat)';
		$this->db->query($query);
		$this->db->bind('soal_topik', $data['soal_topik']);
		$this->db->bind('soal_detail', ($data['soal_detail'] != '' ? $data['soal_detail'] : ''));
		$this->db->bind('soal_tipe', $data['soal_tipe']);
		$this->db->bind('soal_pembuat', $_SESSION['id']);

		$this->db->execute();

		return $this->db->insert_id();
	}
}