<?php

class CBT_master_model {
	private $table_topik = 'tb_topik';
	private $table_soal = 'tb_soal';
	private $table_jawaban = 'tb_jawaban';
	private $db;

	public function __construct() {
		$this->db = new Model;
	}

	/* Master Topik */
	public function get_topik($by = NULL, $single = FALSE) {
		$this->db->query(
			'SELECT * FROM ' . 
			$this->table_topik . 
			(!is_null($by) ? " WHERE " . $by[0] . '=:' . $by[0] : "") . 
			' ORDER BY topik_id DESC');

		if (!is_null($by)) {
			$this->db->bind($by[0], $by[1]);
		}

		if ($single) {
			$method = $this->db->row();
		} else {
			$method = $this->db->result();
		}

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
	/* End Master Topik */

	/* Master Soal */
	public function get_soal($by = NULL, $single = FALSE) {
		$this->db->query(
			'SELECT * FROM ' . 
			$this->table_soal . 
			' INNER JOIN ' . $this->table_topik . ' ON topik_id = soal_topik ' .
			(!is_null($by) ? " WHERE " . $by[0] . '=:' . $by[0] : "") . 
			' ORDER BY soal_id DESC');
		if (!is_null($by)) {
			$this->db->bind($by[0], $by[1]);
		}

		if ($single) {
			$method = $this->db->row();
		} else {
			$method = $this->db->result();
		}
		return $method;
	}

	public function add_soal($data) {
		$query = 'INSERT INTO ' . $this->table_soal . ' (soal_topik, soal_detail, soal_tipe, soal_pembuat) VALUES (:soal_topik, :soal_detail, :soal_tipe, :soal_pembuat)';
		$this->db->query($query);
		$this->db->bind('soal_topik', $data['soal_topik']);
		$this->db->bind('soal_detail', ($data['soal_detail'] != '' ? $data['soal_detail'] : ''));
		$this->db->bind('soal_tipe', $data['soal_tipe']);
		$this->db->bind('soal_pembuat', $_SESSION['id']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function update_soal($data) {
		$query = 'UPDATE ' . $this->table_soal . ' SET soal_topik=:soal_topik, soal_detail=:soal_detail, soal_tipe=:soal_tipe WHERE soal_id=:soal_id';
		$this->db->query($query);
		$this->db->bind('soal_topik', $data['soal_topik']);
		$this->db->bind('soal_detail', ($data['soal_detail'] != '' ? $data['soal_detail'] : ''));
		$this->db->bind('soal_tipe', $data['soal_tipe']);
		$this->db->bind('soal_id', $data['soal_id']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function delete_soal($id) {
		$this->db->query("DELETE FROM " . $this->table_soal . " WHERE soal_id=:soal_id");
		$this->db->bind('soal_id', $id);
		$this->db->execute();

		return $this->db->rowCount();
	}
	/* End Master Soal */

	/* Master Jawaban */
	public function get_jawaban($by = NULL, $single = FALSE) {
		$this->db->query(
			'SELECT * FROM ' . 
			$this->table_jawaban . 
			(!is_null($by) ? " WHERE " . $by[0] . '=:' . $by[0] : "") . 
			' ORDER BY jawaban_id DESC');
		if (!is_null($by)) {
			$this->db->bind($by[0], $by[1]);
		}

		if ($single) {
			$method = $this->db->row();
		} else {
			$method = $this->db->result();
		}
		return $method;
	}

	public function add_jawaban($data) {
		$query = 'INSERT INTO ' . $this->table_jawaban . ' (jawaban_soal, jawaban_detail, jawaban_benar, jawaban_pembuat) VALUES (:jawaban_soal, :jawaban_detail, :jawaban_benar, :jawaban_pembuat)';
		$this->db->query($query);
		$this->db->bind('jawaban_soal', $data['jawaban_soal']);
		$this->db->bind('jawaban_detail', ($data['jawaban_detail'] != '' ? $data['jawaban_detail'] : ''));
		$this->db->bind('jawaban_benar', $data['jawaban_benar']);
		$this->db->bind('jawaban_pembuat', $_SESSION['id']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function update_jawaban($data) {
		$query = 'UPDATE ' . $this->table_jawaban . ' SET jawaban_soal=:jawaban_soal, jawaban_detail=:jawaban_detail, jawaban_benar=:jawaban_benar WHERE jawaban_id=:jawaban_id';
		$this->db->query($query);
		$this->db->bind('jawaban_soal', $data['jawaban_soal']);
		$this->db->bind('jawaban_detail', ($data['jawaban_detail'] != '' ? $data['jawaban_detail'] : ''));
		$this->db->bind('jawaban_benar', $data['jawaban_benar']);
		$this->db->bind('jawaban_id', $data['jawaban_id']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function delete_jawaban($id) {
		$this->db->query("DELETE FROM " . $this->table_jawaban . " WHERE jawaban_id=:jawaban_id");
		$this->db->bind('jawaban_id', $id);
		$this->db->execute();

		return $this->db->rowCount();
	}
	/* End Master Jawaban */

}