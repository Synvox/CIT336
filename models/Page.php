<?php

class Page
{
	var $id;
	var $author;
	var $title;
	var $subtitle;
	var $body;
	var $nav;
	var $landing;

	function __construct($id=-1, $author=-1, $title="", $subtitle="", $body="", $nav = false, $landing = false) {
		$this->id = $id;
		$this->author = $author;
		$this->title = $title;
		$this->subtitle = $subtitle;
		$this->body = $body;
		$this->nav = $nav;
		$this->landing = $landing;
	}

	static function find($id) {
		if (!is_numeric($id)) return null;
		$stmt = query("SELECT * FROM Pages WHERE id=?", array($id));
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Page'); 
		$page = $stmt->fetch();
	  return $page;
	}

	static function findAll() {
		$stmt = query("SELECT * FROM Pages ORDER BY id DESC");
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Page'); 
		$pages = $stmt->fetchAll();
	  return $pages;
	}

	static function findPosts() {
		$stmt = query("SELECT * FROM Pages WHERE landing=0 AND nav=0 ORDER BY id DESC");
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Page'); 
		$pages = $stmt->fetchAll();
	  return $pages;
	}

	static function navLinks() {
		$stmt = query("SELECT * FROM Pages WHERE nav=1");
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Page'); 
		$pages = $stmt->fetchAll();
	  return $pages;
	}

	static function getLanding() {
		$stmt = query("SELECT * FROM `Pages` WHERE `landing`=1 LIMIT 1");
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Page'); 
		$page = $stmt->fetch();
	  return $page;
	}

	static function update($id, $field, $value){
		$field = addslashes($field);
		$stmt = query("UPDATE Pages SET $field=? WHERE id=?", array($value,$id));
	}

	static function create($author, $title, $subtitle, $body){
		query("INSERT INTO Pages (author, title, subtitle, body) VALUES (?,?,?,?)",array($author, $title, $subtitle, $body));
		$stmt = query("SELECT * FROM Pages ORDER BY id DESC LIMIT 1");
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Page');
		$page = $stmt->fetch();
	  return $page;
	}

	static function destroy($id){
		$stmt = query("DELETE FROM Pages WHERE id=?", array($id));
	}
}
