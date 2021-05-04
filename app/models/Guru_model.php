<?php

class Guru_model {
	private $table = 'tb_guru';
	private $db;

	public function __construct() {
		$this->db = new Model;
	}

	public function get_by($by) {
		$this->db->query('SELECT * FROM ' . $this->table . ' WHERE '.$by[0].'=:'.$by[0]);
		$this->db->bind($by[0], $by[1]);

		return $this->db->row();
	}

	public function add($data) {
		$query = "
			INSERT INTO ".$this->table." (
			guru_nip, 
			guru_nama, 
			guru_tmp_lahir, 
			guru_tgl_lahir, 
			guru_jenis_kelamin, 
			guru_agama, 
			guru_alamat, 
			guru_nohp, 
			guru_foto, 
			guru_jenjang, 
			guru_jenjang_pendidikan, 
			guru_uid) 
			VALUES (
			:guru_nip, 
			:guru_nama, 
			:guru_tmp_lahir, 
			:guru_tgl_lahir, 
			:guru_jenis_kelamin, 
			:guru_agama, 
			:guru_alamat, 
			:guru_nohp, 
			:guru_foto, 
			:guru_jenjang, 
			:guru_jenjang_pendidikan, 
			:guru_uid)
		";
		$this->db->query($query);
		$this->db->bind('guru_nip', $data['guru_nip']);
		$this->db->bind('guru_nama', $data['guru_nama']);
		$this->db->bind('guru_tmp_lahir', $data['guru_tmp_lahir']);
		$this->db->bind('guru_tgl_lahir', $data['guru_tgl_lahir']);
		$this->db->bind('guru_jenis_kelamin', $data['guru_jenis_kelamin']);
		$this->db->bind('guru_agama', $data['guru_agama']);
		$this->db->bind('guru_alamat', $data['guru_alamat']);
		$this->db->bind('guru_nohp', $data['guru_nohp']);
		$this->db->bind('guru_foto', ($data['guru_foto'] != '' ? $data['guru_foto'] : NULL));
		$this->db->bind('guru_jenjang', $data['guru_jenjang']);
		$this->db->bind('guru_jenjang_pendidikan', $data['guru_jenjang_pendidikan']);
		$this->db->bind('guru_uid', $data['guru_uid']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function update($data) {
		$query = "
			UPDATE ".$this->table." SET
			guru_nip=:guru_nip, 
			guru_nama=:guru_nama, 
			guru_tmp_lahir=:guru_tmp_lahir, 
			guru_tgl_lahir=:guru_tgl_lahir, 
			guru_jenis_kelamin=:guru_jenis_kelamin, 
			guru_agama=:guru_agama, 
			guru_alamat=:guru_alamat, 
			guru_nohp=:guru_nohp, 
			guru_foto=:guru_foto, 
			guru_jenjang=:guru_jenjang, 
			guru_jenjang_pendidikan=:guru_jenjang_pendidikan, 
			guru_uid=:guru_uid
			WHERE guru_id=:guru_id
		";
		$this->db->query($query);
		$this->db->bind('guru_nip', $data['guru_nip']);
		$this->db->bind('guru_nama', $data['guru_nama']);
		$this->db->bind('guru_tmp_lahir', $data['guru_tmp_lahir']);
		$this->db->bind('guru_tgl_lahir', $data['guru_tgl_lahir']);
		$this->db->bind('guru_jenis_kelamin', $data['guru_jenis_kelamin']);
		$this->db->bind('guru_agama', $data['guru_agama']);
		$this->db->bind('guru_alamat', $data['guru_alamat']);
		$this->db->bind('guru_nohp', $data['guru_nohp']);
		$this->db->bind('guru_foto', $data['guru_foto']);
		$this->db->bind('guru_jenjang', $data['guru_jenjang']);
		$this->db->bind('guru_jenjang_pendidikan', $data['guru_jenjang_pendidikan']);
		$this->db->bind('guru_uid', $data['guru_uid']);
		$this->db->bind('guru_id', $data['guru_id']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function check_profile($uid) {
		$this->db->query('SELECT * FROM ' . $this->table . ' WHERE guru_uid=:guru_uid');
		$this->db->bind('guru_uid', $uid);

		return $this->db->row();
	}
}