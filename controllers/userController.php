<?php

class UserController extends Controller
{
	function index($params) {
		global $relativePath, $errors;
		if (isset($_POST['email']) && isset($_POST['password'])) {
			$error = false;
			if ($_POST['email'] == "") {
				$error = true;
				array_push($errors, "You must enter an email.");
			}
			if ($_POST['password'] == "") {
				$error = true;
				array_push($errors, "You must enter a password.");
			}
			if ($error) {
				return parent::view('user/index');
			}
			if (array_key_exists('create', $_POST) && $_POST['create'] == true) {
				User::create($_POST['name'], $_POST['email'], $_POST['password']);
			}
			$user = User::login($_POST['email'], $_POST['password']);
			if ($user !== null)
				header("location: $relativePath");
			else {
				array_push($errors, "Email and Password combination not found.");
				return parent::view('user/index');
			}
		} else
			return parent::view('user/index');
	}

	function create($params) {
		global $relativePath, $errors;
		if (isset($_POST['email']) && isset($_POST['password'])) {
			$error = false;
			if ($_POST['email'] == "") {
				$error = true;
				array_push($errors, "You must enter an email.");
			}
			if ($_POST['password'] == "") {
				$error = true;
				array_push($errors, "You must enter a password.");
			}
			if ($error) {
				return parent::view('user/index');
			}
			User::create($_POST['name'], $_POST['email'], $_POST['password']);
			$user = User::login($_POST['email'], $_POST['password']);
			header("location: $relativePath");
		} else
			return parent::view('user/create');
	}

	function logout(){
		global $relativePath;
		session_destroy();
		header("location: $relativePath");
		exit;
	}
}
