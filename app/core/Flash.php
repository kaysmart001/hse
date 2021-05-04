<?php

class Flash {

	public static function flasher($message, $action, $type) {
		$_SESSION['flash'] = [
			'message' => $message,
			'action' => $action,
			'type' => $type
		];
	}

	public static function flash_message() {
		if (isset($_SESSION['flash'])) {
			echo '<div class="alert alert-' . $_SESSION['flash']['type'] . ' alert-dismissible" role="alert">
				  <strong>' . $_SESSION['flash']['message'] . '</strong> ' . $_SESSION['flash']['action'] . '
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>';

			unset($_SESSION['flash']);
		}
	}
}