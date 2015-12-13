<?php

class Comment
{
	var $id;
	var $author;
	var $page;
	var $timestamp;
	var $body;

	function __construct($id=-1, $author=-1, $page="", $timestamp="", $body="") {
		$this->id = $id;
		$this->author = $author;
		$this->page = $page;
		$this->timestamp = $timestamp;
		$this->body = $body;
	}

	static function find($id) {
		if (!is_numeric($id)) return null;
		$stmt = query("SELECT * FROM Comments WHERE id=?", array($id));
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Comment');
		$comment = $stmt->fetch();
	  return $comment;
	}

	static function findAll() {
		$stmt = query("SELECT * FROM Comments ORDER BY id DESC");
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Comment');
		$comments = $stmt->fetchAll();
	  return $comments;
	}

	static function findComments($page) {
		$stmt = query("SELECT * FROM Comments WHERE page=? ORDER BY id DESC", array($page));
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Comment');
		$comments = $stmt->fetchAll();
	  return $comments;
	}

	static function update($id, $field, $value){
		$field = mysql_real_escape_string($field);
		$stmt = query("UPDATE Comments SET $field=? WHERE id=?", array($value,$id));
	}

	static function create($author, $page, $body){
		trigger_error("CALLED");
		query("INSERT INTO Comments (author, page, body) VALUES (?,?,?)",array($author, $page, $body));
		$stmt = query("SELECT * FROM Comments ORDER BY id DESC LIMIT 1");
		$stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Comment');
		$comment = $stmt->fetch();
	  return $comment;
	}

	static function destroy($id){
		$stmt = query("DELETE FROM Comments WHERE id=?", array($id));
	}
}
