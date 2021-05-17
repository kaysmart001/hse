<?php

class Jawaban_model {
	private $table = 'tb_jawaban';
	private $db;

	public function __construct() {
		$this->db = new Model;
	}

	public function insert($data) {
		$query = 'INSERT INTO ' . $this->table . ' (jawaban_soal, jawaban_detail, jawaban_benar, jawaban_pembuat) VALUES (:jawaban_soal, :jawaban_detail, :jawaban_benar, :jawaban_pembuat)';
		$this->db->query($query);
		$this->db->bind('jawaban_soal', $data['jawaban_soal']);
		$this->db->bind('jawaban_detail', ($data['jawaban_detail'] != '' ? $data['jawaban_detail'] : ''));
		$this->db->bind('jawaban_benar', $data['jawaban_benar']);
		$this->db->bind('jawaban_pembuat', $_SESSION['id']);

		$this->db->execute();

		return $this->db->insert_id();
	}
}