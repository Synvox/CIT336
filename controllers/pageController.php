<?php

class PageController extends Controller
{
	function render($action) {
		$page = null;

		if ($action === "") {
			// Handle Index
			$page = Page::getLanding();
		} else {
			$page = Page::find($action);
		}

    $page->html = Markdown::defaultTransform($page->body);
    
		if ($page !== null) {
			$GLOBALS['page'] = $page;
			return parent::view('page/default');
		} else return parent::view('404');
	}

	static function canEdit($page = null) {
		if ($page == null && isset($GLOBALS['page'])) {
			$page = $GLOBALS['page'];
		}

		if ($page == null) return false;

    // if page and user
		// and
		// user is author
		//   or user is admin
		$result = ((isset($page) && User::current() != null)
						&& (User::current()->id == $page->author
						    || User::current()->isAdmin()));

		return $result;
	}

	static function keyAttr($key, $markdown = 0) {
		// Assertion
		if (PageController::canEdit())
			return 'data-page-key="'.$GLOBALS['page']->id.'|'.$key.'|'.$markdown.'"';
		else
			return '';
	}

	function update() {
		global $relativePath;
		$page = Page::find($_POST['id']);
		if (PageController::canEdit($page)){
			$id = $_POST['id'];
			$field = $_POST['key'];
			$value = $_POST['value'];
			Page::update($id, $field, $value);
		} else {
			trigger_error("Bad Update");
		}
		header('Location: ' . $relativePath.$page->id);
		exit;
	}

	function create() {
		global $relativePath;
		$page = Page::create(User::current()->id, "Untitled", "Untitled Again", "Body");
		header('Location: ' . $relativePath.$page->id);
		exit;
	}

	function destroy($id) {
		global $relativePath;
		Page::destroy($id);
		header('Location: ' . $relativePath);
	}
}
