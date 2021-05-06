<?php

class Dashboard extends Controller {

	public function __construct() {
		if (!isset($_SESSION['login'])) { header('Location: ' . base_url()); }
		if ($_SESSION['role'] != 1) { header('Location: ' . base_url()); }
	}

	public function index() {
		$data['user'] = count($this->model('User_model')->get_all());
		$data['jadwal'] = count($this->model('Jadwal_model')->get());
		$data['absen'] = count($this->model('Absensi_model')->get());
		$data['guru'] = count($this->model('Guru_model')->get());

		$this->view('dashboard/v_header');
		$this->view('dashboard/v_dashboard', $data);
		$this->view('dashboard/v_footer');
	}
}