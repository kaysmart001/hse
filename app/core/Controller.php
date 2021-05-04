<?php

class Controller {

	public function model($model) {
		require_once 'app/models/' . $model . '.php';
		return new $model;
	}

	public function input_post($index) {
		return isset($_POST[$index]);
	}
  
	public function view($view, $data = []) {
		require_once 'app/views/' . $view . '.php';
	}
}