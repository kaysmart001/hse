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
		');
		return $this->db->result();
	}

	public function get_by($by = NULL, $single = FALSE) {
		$this->db->query('
			SELECT * FROM ' . $this->table . ' 
			LEFT JOIN tb_jenjang ON jenjang_id = kelas_jenjang
			LEFT JOIN tb_tingkat ON tingkat_id = kelas_tingkat ' .
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
		$this->db->query('SELECT kelas_id, jenjang_nama, tingkat_nama, kelas_nama FROM ' . $this->table . ' LEFT JOIN tb_jenjang ON jenjang_id = kelas_jenjang LEFT JOIN tb_tingkat ON tingkat_id = kelas_tingkat');

		return $this->db->result();
	}

	public function add($data) {
		$tingkat_nama = $this->get_tingkat($data['kelas_tingkat'])->tingkat_nama;
		$jenjang_nama = $this->get_jenjang($data['kelas_jenjang'])->jenjang_nama;
		if ($data['kelas_jenjang'] < 3) {
			$kelas_nama = $tingkat_nama . ' ' . $jenjang_nama;
			$query = "INSERT INTO ".$this->table." (kelas_jenjang, kelas_tingkat, kelas_nama) VALUES (:kelas_jenjang, :kelas_tingkat, :kelas_nama)";
		} else if ($data['kelas_jenjang'] == 3 || $jenjang_nama == 'SMA') {
			$jurusan_nama = $this->get_jurusan($data['kelas_jurusan'])->jurusan_nama;
			$kelas_nama = $tingkat_nama . ' ' . $jenjang_nama . ' ' . $jurusan_nama;
			$query = "INSERT INTO ".$this->table." (kelas_jenjang, kelas_tingkat, kelas_jurusan, kelas_nama) VALUES (:kelas_jenjang, :kelas_tingkat, :kelas_jurusan, :kelas_nama)";
		}
		$this->db->query($query);
		$this->db->bind('kelas_jenjang', $data['kelas_jenjang']);
		$this->db->bind('kelas_tingkat', $data['kelas_tingkat']);
		if ($data['kelas_jenjang'] == 3 || $jenjang_nama == 'SMA') {
			$this->db->bind('kelas_jurusan', $data['kelas_jurusan']);
		}
		$this->db->bind('kelas_nama', $kelas_nama);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function update($data) {
		$tingkat_nama = $this->get_tingkat($data['kelas_tingkat'])->tingkat_nama;
		$jenjang_nama = $this->get_jenjang($data['kelas_jenjang'])->jenjang_nama;
		if ($data['kelas_jenjang'] < 3) {
			$kelas_nama = $tingkat_nama . ' ' . $jenjang_nama;
			$query = "UPDATE ".$this->table." SET kelas_jenjang=:kelas_jenjang, kelas_tingkat=:kelas_tingkat, kelas_nama=:kelas_nama WHERE kelas_id=:kelas_id";
		} else if ($data['kelas_jenjang'] == 3 || $jenjang_nama == 'SMA') {
			$jurusan_nama = $this->get_jurusan($data['kelas_jurusan'])->jurusan_nama;
			$kelas_nama = $tingkat_nama . ' ' . $jenjang_nama . ' ' . $jurusan_nama;
			$query = "UPDATE ".$this->table." SET kelas_jenjang=:kelas_jenjang, kelas_tingkat=:kelas_tingkat, kelas_jurusan=:kelas_jurusan, kelas_nama=:kelas_nama WHERE kelas_id=:kelas_id";
		}
		$this->db->query($query);
		$this->db->bind('kelas_jenjang', $data['kelas_jenjang']);
		$this->db->bind('kelas_tingkat', $data['kelas_tingkat']);
		if ($data['kelas_jenjang'] == 3 || $jenjang_nama == 'SMA') {
			$this->db->bind('kelas_jurusan', $data['kelas_jurusan']);
		}
		$this->db->bind('kelas_nama', $kelas_nama);
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

	private function get_jenjang($jenjang_id) {
		$this->db->query('SELECT jenjang_nama FROM tb_jenjang WHERE jenjang_id=:jenjang_id');
		$this->db->bind('jenjang_id', $jenjang_id);
		return $this->db->row();
	}
	private function get_tingkat($tingkat_id) {
		$this->db->query('SELECT tingkat_nama FROM tb_tingkat WHERE tingkat_id=:tingkat_id');
		$this->db->bind('tingkat_id', $tingkat_id);
		return $this->db->row();
	}
	private function get_jurusan($jurusan_id) {
		$this->db->query('SELECT jurusan_nama FROM tb_jurusan WHERE jurusan_id=:jurusan_id');
		$this->db->bind('jurusan_id', $jurusan_id);
		return $this->db->row();
	}
}