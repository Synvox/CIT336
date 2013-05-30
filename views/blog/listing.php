<?php nav(); ?>
	<div class="hero-unit">
		<div class="container">
			<h1>Blog</h1>
			<p>Because Blogging can be Fun</p>
		</div>
	</div>
</header>

<div class="container">
  <?php foreach($GLOBALS['pages'] as $i => $page) { ?>
  <div class="blog-tile animated fadeInLeft list-delay">
	  <a href="<?= $relativePath.$page->id.'/'.$page->title; ?>"><h2><?= $page->title ?></h2></a>
	  <p><?= $page->subtitle ?></p>
  </div>
  <?php } ?>
  <?php footer(); ?>
</div>

<script type="text/javascript">
	var page = null;
</script>