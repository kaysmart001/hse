<?php

class Dashboard extends Controller {

	public function __construct() {
		if (!isset($_SESSION['login'])) { header('Location: ' . base_url()); }
		if ($_SESSION['role'] != 1) { header('Location: ' . base_url()); }
	}

	public function index() {
		$this->view('dashboard/v_header');
		$this->view('dashboard/v_dashboard');
		$this->view('dashboard/v_footer');
	}
}