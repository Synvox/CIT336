<?php

class CommentController extends Controller
{	
	function post() {
		$page = $_POST['page'];
		$body = $_POST['body'];
		Comment::create(User::current()->id, $page, $body);
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit;
	}
}