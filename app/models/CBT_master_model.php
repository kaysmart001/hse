<?php

class CBT_master_model {
	private $table_topik = 'tb_topik';
	private $table_soal = 'tb_soal';
	private $table_jawaban = 'tb_jawaban';
	private $table_ujian = 'tb_ujian';
	private $table_ujian_soal = 'tb_ujian_soal';
	private $table_ujian_users = 'tb_ujian_users';
	private $table_ujian_group = 'tb_ujian_group';
	private $table_kelas = 'tb_kelas';
	private $table_siswa = 'tb_siswa';
	private $db;

	public function __construct() {
		$this->db = new Model;
	}

	/* Master Topik */
	public function get_topik($by = NULL, $single = FALSE) {
		$this->db->query(
			'SELECT topik_id, topik_judul, topik_deskripsi, topik_status, topik_pembuat FROM ' . 
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

		$query = $this->db->result();
		foreach ($query as $key => $value) {
			$query[$key]['total_soal'] = $this->get_tsoal($value['topik_id'])->total_soal;
		}

		return $query;
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
			'SELECT soal_id, topik_judul, soal_topik, soal_detail, soal_tipe, soal_pembuat, soal_gambar, COUNT(jawaban_id) as total_jawaban FROM ' . 
			$this->table_soal . 
			' INNER JOIN ' . $this->table_topik . ' ON topik_id = soal_topik ' .
			' LEFT JOIN ' . $this->table_jawaban . ' ON jawaban_soal = soal_id' .
			(!is_null($by) ? " WHERE " . $by[0] . '=:' . $by[0] : "") . 
			' GROUP BY soal_id ' .
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
		$query = 'INSERT INTO ' . $this->table_soal . ' (soal_topik, soal_detail, soal_tipe, soal_pembuat, soal_gambar) VALUES (:soal_topik, :soal_detail, :soal_tipe, :soal_pembuat, :soal_gambar)';
		$this->db->query($query);
		$this->db->bind('soal_topik', $data['soal_topik']);
		$this->db->bind('soal_detail', ($data['soal_detail'] != '' ? $data['soal_detail'] : ''));
		$this->db->bind('soal_tipe', $data['soal_tipe']);
		$this->db->bind('soal_pembuat', $_SESSION['id']);
		$this->db->bind('soal_gambar', $data['soal_gambar']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function update_soal($data) {
		$query = 'UPDATE ' . $this->table_soal . ' SET soal_topik=:soal_topik, soal_detail=:soal_detail, soal_tipe=:soal_tipe, soal_gambar=:soal_gambar WHERE soal_id=:soal_id';
		$this->db->query($query);
		$this->db->bind('soal_topik', $data['soal_topik']);
		$this->db->bind('soal_detail', ($data['soal_detail'] != '' ? $data['soal_detail'] : ''));
		$this->db->bind('soal_tipe', $data['soal_tipe']);
		$this->db->bind('soal_gambar', $data['soal_gambar']);
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
	public function get_jawaban($by = NULL, $in = NULL, $single = FALSE) {
		$this->db->query(
			'SELECT * FROM ' . 
			$this->table_jawaban . 
			(!is_null($by) ? " WHERE " . $by[0] . '=:' . $by[0] : "") . 
			(!is_null($in) ? " WHERE jawaban_soal IN " . '('.$in.')' : "") . 
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

	function get_soal_hasil_ujian($users_id) {
		$this->db->query(
        	'SELECT * FROM ' .
        	$this->table_ujian_soal .
        	' INNER JOIN ' . $this->table_soal . ' ON soal_id = us_soal' .
        	' INNER JOIN ' . $this->table_ujian_users . ' ON users_id = us_users' .
        	' WHERE users_id=:users_id' .
        	' ORDER BY us_order ASC '
	    );
	    if (!is_null($users_id)) {
	    	$this->db->bind('users_id', $users_id);
	    }

	    return $this->db->result();
	}
	function get_datatable_soal($start, $rows, $column, $filled, $users_id) {
		$this->db->query(
        	'SELECT * FROM ' .
        	$this->table_ujian_soal .
        	' INNER JOIN ' . $this->table_soal . ' ON soal_id = us_soal' .
        	' WHERE (' . $column . ' LIKE "%' . $filled . '%" AND us_users = "' . $users_id . '")' .
        	' ORDER BY us_order ASC ' .
        	' LIMIT ' . $rows
	    );

	    return $this->db->result();
	}
	function get_datatable_count($column, $filled, $users_id) {
        $this->db->query(
        	'SELECT COUNT(*) AS result FROM ' .
        	$this->table_ujian_soal .
        	' INNER JOIN ' . $this->table_soal . ' ON soal_id = us_soal' .
        	' WHERE (' . $column . ' LIKE "%' . $filled . '%" AND us_users = "' . $users_id . '")' .
        	' ORDER BY us_order ASC '
	    );

	    return $this->db->result();
    }
    function get_all_hasil_ujian_siswa($ujian_id = NULL, $ujian_pembuat = NULL) {
    	$this->db->query(
        	'SELECT 
        	ujian_id,
        	users_id,
			siswa_nama,
			SUM(CASE 
			WHEN us_nilai > 0 THEN 1
			ELSE 0
			END) AS nilai,
			SUM(CASE 
			WHEN us_komentar IS NULL AND us_jawaban_teks IS NOT NULL THEN 1
			ELSE 0
			END) AS belum_dikoreksi,
			COUNT(us_id) AS soal,
			users_tgl_pengerjaan,
			users_status FROM ' .
        	$this->table_ujian .
        	' INNER JOIN ' . $this->table_ujian_users . ' ON users_ujian = ujian_id' .
        	' INNER JOIN ' . $this->table_ujian_group . ' ON group_ujian = ujian_id' .
        	' INNER JOIN ' . $this->table_kelas . ' ON kelas_id = group_kelas' .
        	' INNER JOIN ' . $this->table_siswa . ' ON siswa_id = users_siswa' .
        	' INNER JOIN ' . $this->table_ujian_soal . ' ON us_users = users_id' .
        	(!is_null($ujian_id) ? " WHERE " . $ujian_id[0] . '=:' . $ujian_id[0] : "") . 
        	(!is_null($ujian_pembuat) ? " AND " . $ujian_pembuat[0] . '=:' . $ujian_pembuat[0] : "") . 
        	' GROUP BY users_id ORDER BY users_id DESC '
	    );

	    if (!is_null($ujian_id)) {
			$this->db->bind($ujian_id[0], $ujian_id[1]);
		}

		if (!is_null($ujian_pembuat)) {
			$this->db->bind($ujian_pembuat[0], $ujian_pembuat[1]);
		}

	    return $this->db->result();
    }

    private function get_tsoal($topik_id) {
    	$this->db->query("SELECT COUNT(*) AS total_soal FROM " . $this->table_soal . " WHERE soal_topik=:soal_topik");
    	$this->db->bind('soal_topik', $topik_id);
    	return $this->db->row();
    }

}