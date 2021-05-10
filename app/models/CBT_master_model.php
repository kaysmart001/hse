<?php

class CBT_master_model {
	private $table_topik = 'tb_topik';
	private $table_soal = 'tb_soal';
	private $table_jawaban = 'tb_jawaban';
	private $db;

	public function __construct() {
		$this->db = new Model;
	}

	public function get_topik() {
		$this->db->query('SELECT * FROM ' . $this->table_topik . ' ORDER BY topik_id DESC');
		return $this->db->result();
	}

	public function add_topik($data) {
		$query = 'INSERT INTO ' . $this->table_topik . ' (topik_judul, topik_deskripsi, topik_status, topik_pembuat) VALUES (:topik_judul, :topik_deskripsi, :topik_status, :topik_pembuat)';
		$this->db->query($query);
		$this->db->bind('topik_judul', $data['topik_judul']);
		$this->db->bind('topik_deskripsi', ($data['topik_deskripsi'] != '' ? $data['topik_deskripsi'] : ''));
		$this->db->bind('topik_status', $data['topik_status']);
		$this->db->bind('topik_pembuat', $_SESSION['id']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function update_topik($data) {
		$query = 'UPDATE ' . $this->table_topik . ' SET topik_judul=:topik_judul, topik_deskripsi=:topik_deskripsi, topik_status=:topik_status, topik_pembuat=:topik_pembuat WHERE topik_id=:topik_id';
		$this->db->query($query);
		$this->db->bind('topik_judul', $data['topik_judul']);
		$this->db->bind('topik_deskripsi', ($data['topik_deskripsi'] != '' ? $data['topik_deskripsi'] : ''));
		$this->db->bind('topik_status', $data['topik_status']);
		$this->db->bind('topik_pembuat', $_SESSION['id']);
		$this->db->bind('topik_id', $data['topik_id']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function delete_topik($id) {
		$this->db->query("DELETE FROM " . $this->table_topik . " WHERE topik_id=:topik_id");
		$this->db->bind('topik_id', $id);
		$this->db->execute();

		return $this->db->rowCount();
	}

}