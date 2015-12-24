<?php

function nav(){
	global $urlArr, $relativePath;
	$here = $urlArr[0];
	$navlinks = Page::navLinks();
	?>
<div id="page">
	<header>
		<div class="container">
			<nav class="navbar">
			  <div class="navbar-inner">
			    <div class="container">
			      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="brand" href="<?= $relativePath; ?>"><?= App::attr('site','title'); ?></a>
			      <div class="nav-collapse collapse pull-right">
			        <ul class="nav">
			        	<?php
				        	foreach($navlinks as $link) {
			        	?>
			          <li<?php if ($here === $link->id) {?> class="active"<?php } ?>><a href="<?= $relativePath.$link->id.'/'.$link->title; ?>"><?= $link->title; ?></a></li>
			        	<?php
				        	}
			        	?>
			        	<?php if (App::attr('site', 'blog')) {?>
			        	<li<?php if ($here === "blog") {?> class="active"<?php } ?>><a href="<?= $relativePath.'blog' ?>">Blog</a></li>
			        	<?php } ?>
			        </ul>
			      </div>
			    </div>
			  </div>
			</nav>
		</div>
	<?php
}

function footer(){
	?>
	</div>
  <hr>

  <footer class="container">
     <p><a href="<?= '/user' ?><?= (User::current() == null)?"":"/logout" ?>">
        <?= (User::current() == null)?"Log In":"Log Out" ?>
      </a> &bull; &copy; <?= App::attr('site','company'); ?> 2013 </p> 
  </footer>
	<?php	
}

function errors(){
	global $errors;
	foreach($errors as $error) {
		?>
<div class="alert alert-error">
	<h4>Woops!</h4>
	<?= $error ?>
</div>
		<?php 
	}
}

function comments() {
	global $relativePath;
	if (User::current() != null) {
		?>
<form method="post" action="<?= $relativePath ?>comment/post" class="form-horizontal comment-form">
  <textarea name="body"></textarea>
  <input type="hidden" name="page" value="<?= $GLOBALS['page']->id ?>"
  <br/><br/><br/>
  <input type="submit" class="btn btn-primary pull-right"/>
</form>
		<?php
	}
	$comments = Comment::findComments($GLOBALS['page']->id);
	foreach($comments as $comment) {
	?>
<div class="comment animated fadeInUp list-delay">
	<div class="comment-body">
		<?= $comment->body; ?>
	</div>
	<div class="comment-author">
		<?= User::find($comment->author)->name; ?>		
	</div>
</div>
	<?php
	}
}