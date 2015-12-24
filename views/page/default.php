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
  <?= nl2br($GLOBALS['page']->html) ?>
  </article>
  <?php comments(); ?>
  <?php footer(); ?>
</div>

<script type="text/javascript">
  var user = <?php
		if (User::current()!=null)
			print(json_encode(User::current()));
		else
			print("null");
	?>;
	var page = <?php
		if (PageController::canEdit())
			print(json_encode($GLOBALS['page']));
		else
			print("null");
	?>;
</script>
