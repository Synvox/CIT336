<?php

// Must only access through index.php
if (!isset($indexEntry) || !$indexEntry) {
	header("HTTP/1.1 403 Forbidden");
	exit;
}
$path = "/";
if (isset($_SERVER['PATH_INFO'])) {
	$path = $_SERVER['PATH_INFO'];
}

$urlArr = explode('/', trim($path, '/'));

$relativePath = "/CIT/";
$currentPage = null;
$errors = array();

function __autoload($classname) {
	foreach (array('controllers', 'models') as $key => $directory) {
		$path = "$directory/$classname.php";
		if (file_exists($path)) {
			require_once($path);
			return;
		}
	}
}

require_once('htmlUtils.php');
require_once('Markdown.php');

$pdo = NULL;

function query($sql, array $params = null) {
	global $pdo;
	$stmt = $pdo->prepare($sql);
	$stmt->execute($params);
	return $stmt;
}

class App {

	var $viewPath;

	function __construct() {
		global $pdo, $urlArr;

		session_start();
		$pdo = new PDO("mysql:host=localhost;dbname=CIT_DB", 'root', 'root');

		$controllerName = $urlArr[0];

		if ($controllerName === "" || is_numeric($controllerName))
			$controllerName = "home";

		$rawControllerName = $controllerName;
		$controllerName .= "Controller";

		if (file_exists("controllers/$controllerName.php")) {
			$controller = new $controllerName($urlArr);
			$action = "index";

			if (array_key_exists(1,$urlArr) && !is_numeric($urlArr[1]))
				$action = $urlArr[1];
				
			$id = null;
			if (array_key_exists(2,$urlArr) && !is_numeric($urlArr[2]))
				$id = $urlArr[2];

			$this->viewPath = call_user_func_array(array($controller, $action), array($id));
		} else if (file_exists("views/$rawControllerName.php")) {
				$this->viewPath = "views/$rawControllerName.php";
		} else {
			$action = $urlArr[0];
			$controller = new PageController();
			$this->viewPath = $controller->render($action);
		}
	}

	function render() {
		require_once($this->viewPath);
	}

	static function attr($kind, $key, $value=NULL) {
		$obj = json_decode(file_get_contents("config/$kind.json"), true);
		if ($value !== null) {
			$obj[$key] == $value;
			file_put_contents("config/$kind.json", json_encode($obj));
		} else {
			return $obj[$key];
		}
	}
}
