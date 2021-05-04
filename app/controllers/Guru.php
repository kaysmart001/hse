<?php

class Guru extends Controller {

	public function index() {

		$this->view('dashboard/v_header');
		$this->view('dashboard/v_footer');
	}
}