<?php

class BlogController extends Controller
{	
	function index() {
		$pages = Page::findPosts();
		$GLOBALS['pages'] = $pages;
		return parent::view('blog/listing');
	}
}