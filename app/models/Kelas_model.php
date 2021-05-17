<?php

class Kelas_model {
	private $table = 'tb_kelas';
	private $db;

	public function __construct() {
		$this->db = new Model;
	}

	public function get() {
		$this->db->query('
			SELECT * FROM ' . $this->table . '
			LEFT JOIN tb_jenjang ON jenjang_id = kelas_jenjang
			LEFT JOIN tb_tingkat ON tingkat_id = kelas_tingkat
			LEFT JOIN tb_jurusan ON jurusan_id = kelas_jurusan
		');
		return $this->db->result();
	}

	public function get_by($by = NULL, $single = FALSE) {
		$this->db->query('
			SELECT * FROM ' . $this->table . ' 
			LEFT JOIN tb_jenjang ON jenjang_id = kelas_jenjang
			LEFT JOIN tb_tingkat ON tingkat_id = kelas_tingkat
			LEFT JOIN tb_jurusan ON jurusan_id = kelas_jurusan ' .
			(!is_null($by) ? " WHERE " . $by[0] . '=:' . $by[0] : "")
		);

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

	public function get_kelas() {
		$this->db->query('SELECT kelas_id, jenjang_nama, kelas_nama FROM ' . $this->table . ' LEFT JOIN tb_jenjang ON jenjang_id = kelas_jenjang');

		return $this->db->result();
	}

	public function add($data) {
		$query = "INSERT INTO ".$this->table." (kelas_jenjang, kelas_tingkat, kelas_jurusan, kelas_nama) VALUES (:kelas_jenjang, :kelas_tingkat, :kelas_jurusan, :kelas_nama)";
		$this->db->query($query);
		$this->db->bind('kelas_jenjang', $data['kelas_jenjang']);
		$this->db->bind('kelas_tingkat', $data['kelas_tingkat']);
		$this->db->bind('kelas_jurusan', (isset($data['kelas_jurusan']) ? $data['kelas_jurusan'] : NULL));
		$this->db->bind('kelas_nama', $data['kelas_nama']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function update($data) {
		$query = "UPDATE ".$this->table." SET kelas_jenjang=:kelas_jenjang, kelas_tingkat=:kelas_tingkat, kelas_jurusan=:kelas_jurusan, kelas_nama=:kelas_nama WHERE kelas_id=:kelas_id";
		$this->db->query($query);
		$this->db->bind('kelas_jenjang', $data['kelas_jenjang']);
		$this->db->bind('kelas_tingkat', $data['kelas_tingkat']);
		$this->db->bind('kelas_jurusan', (isset($data['kelas_jurusan']) ? $data['kelas_jurusan'] : NULL));
		$this->db->bind('kelas_nama', $data['kelas_nama']);
		$this->db->bind('kelas_id', $data['kelas_id']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function delete($id) {
		$query = "DELETE FROM " . $this->table . " WHERE kelas_id=:kelas_id";
		$this->db->query($query);
		$this->db->bind('kelas_id', $id);
		$this->db->execute();

		return $this->db->rowCount();
	}
}