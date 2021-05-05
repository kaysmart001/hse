<?php

class Pembayaran_model {
	private $table = 'tb_pembayaran';
	private $db;

	public function __construct() {
		$this->db = new Model;
	}

	public function get($by = NULL, $order = NULL, $single = FALSE) {
		$this->db->query(
			"SELECT * FROM " 
			. $this->table .
			"
			INNER JOIN tb_siswa ON siswa_id = pembayaran_siswa
			INNER JOIN tb_user ON id = siswa_uid
			INNER JOIN tb_kelas ON kelas_id = siswa_kelas
			INNER JOIN tb_jenjang ON jenjang_id = kelas_jenjang
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
		$query = "INSERT INTO ".$this->table." (pembayaran_jenis, pembayaran_keterangan, pembayaran_bukti, pembayaran_status, pembayaran_siswa) VALUES (:pembayaran_jenis, :pembayaran_keterangan, :pembayaran_bukti, :pembayaran_status, :pembayaran_siswa)";
		$this->db->query($query);
		$this->db->bind('pembayaran_jenis', $data['pembayaran_jenis']);
		$this->db->bind('pembayaran_keterangan', $data['pembayaran_keterangan']);
		$this->db->bind('pembayaran_bukti', $data['pembayaran_bukti']);
		$this->db->bind('pembayaran_status', 0);
		$this->db->bind('pembayaran_siswa', $data['pembayaran_siswa']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function accept($id) {
		$query = "UPDATE " . $this->table . " SET pembayaran_status=:pembayaran_status WHERE pembayaran_id=:pembayaran_id";
		$this->db->query($query);
		$this->db->bind('pembayaran_status', 1);
		$this->db->bind('pembayaran_id', $id);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function reject($id) {
		$query = "UPDATE " . $this->table . " SET pembayaran_status=:pembayaran_status WHERE pembayaran_id=:pembayaran_id";
		$this->db->query($query);
		$this->db->bind('pembayaran_status', 2);
		$this->db->bind('pembayaran_id', $id);
		$this->db->execute();

		return $this->db->rowCount();
	}
}