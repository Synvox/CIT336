<?php nav(); ?>
	<div class="hero-unit">
		<div class="container">
			<h1 <?= PageController::keyAttr('title') ?> class="animated fadeInLeft list-delay"><?= $GLOBALS['page']->title ?></h1>
			<p <?= PageController::keyAttr('subtitle') ?> class="animated fadeInRight list-delay"> <?= $GLOBALS['page']->subtitle ?></p>
		</div>
	</div>
</header>

<div class="container">
	<article id="page-body" class="animated fadeIn" <?= PageController::keyAttr('body',true) ?>>
  <?= nl2br($GLOBALS['page']->body) ?>  
  </article>
  <?php comments(); ?>
  <?php footer(); ?>
</div>

<script type="text/javascript">
	var page = <?php
		if (User::current() != null && (User::current()->id == $GLOBALS['page']->author || User::current()->role == 0))
			print(json_encode($GLOBALS['page']));
		else
			print("null");
	?>;
</script>