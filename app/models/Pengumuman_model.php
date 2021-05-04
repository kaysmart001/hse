<?php

class Pengumuman_model {
	private $table = 'tb_pengumuman';
	private $db;

	public function __construct() {
		$this->db = new Model;
	}

	public function get($by = NULL, $order = NULL, $single = FALSE) {
		$this->db->query(
			"SELECT * FROM " 
			. $this->table .
			"
			INNER JOIN tb_jenjang ON jenjang_id = pengumuman_jenjang
			"
			. (!is_null($by) ? " WHERE " . $by[0] . "=:" . $by[0] : "") 
			. (!is_null($order) ? ' ORDER BY ' . $order : '') 
		);
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

	public function add($data) {
		$query = "INSERT INTO ".$this->table." (pengumuman_jenjang, pengumuman_isi, pengumuman_waktu) VALUES (:pengumuman_jenjang, :pengumuman_isi, :pengumuman_waktu)";
		$this->db->query($query);
		$this->db->bind('pengumuman_jenjang', $data['pengumuman_jenjang']);
		$this->db->bind('pengumuman_isi', $data['pengumuman_isi']);
		$this->db->bind('pengumuman_waktu', $data['pengumuman_waktu']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function update($data) {
		$query = "UPDATE ".$this->table." SET pengumuman_jenjang=:pengumuman_jenjang, pengumuman_isi=:pengumuman_isi, pengumuman_waktu=:pengumuman_waktu WHERE pengumuman_id=:pengumuman_id";
		$this->db->query($query);
		$this->db->bind('pengumuman_jenjang', $data['pengumuman_jenjang']);
		$this->db->bind('pengumuman_isi', $data['pengumuman_isi']);
		$this->db->bind('pengumuman_waktu', $data['pengumuman_waktu']);
		$this->db->bind('pengumuman_id', $data['pengumuman_id']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function delete($id) {
		$query = "DELETE FROM " . $this->table . " WHERE pengumuman_id=:pengumuman_id";
		$this->db->query($query);
		$this->db->bind('pengumuman_id', $id['id']);
		$this->db->execute();

		return $this->db->rowCount();
	}
}