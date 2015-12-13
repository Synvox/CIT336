<?php

class User
{
	var $id;
	var $name;
	var $email;
	private $password;
	var $role;
	var $isAdmin;

	function __construct($id=-1, $name="", $email="", $password="", $role=0) {
		$this->id = $id;
		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
		$this->role = $role;
		$this->isAdmin = $role > 0;
		$currentUserCache = 0;
	}

	static function find($id) {
		$stmt = query("SELECT id, name, email, password, role FROM Users WHERE id=?", array($id));
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
		$user = $stmt->fetch();
	  return $user;
	}

	static function login($email, $password) {
		$stmt = query("SELECT id, name, email, password, role FROM Users WHERE email=?", array($email));
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
		$user = $stmt->fetch();
		if (crypt($password, $user->password) === $user->password) {
			$_SESSION['userID'] = $user->id;
		  return $user;
		} else {
			return null;
		}
	}

	static function create($name, $email, $password) {
		$password = crypt($password);
		$stmt = query("INSERT INTO Users (name, email, password, role) VALUES (?,?,?,2)", array($name, $email, $password));
	}

	/*
	 * Returns a cached version of the user if possible.
	 */
	static function current() {
		static $userCache = null;
		if (isset($_SESSION['userID'])) {
			if ($userCache != null)
				return $userCache;
			$userCache = User::find($_SESSION['userID']);
			return $userCache;
		} else return null;
	}
}
