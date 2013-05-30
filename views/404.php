<?php nav(); ?>
	<div class="hero-unit">
		<div class="container">
			<h1>404!</h1>
			<p>You're Lost!</p>
		</div>
	</div>
</header>

<div class="container">
	<div id="page-body" <?= PageController::keyAttr('body',true) ?>>
  Congrats! 
  </div>
  
  <?php footer(); ?>
</div>

<script type="text/javascript">
	var page = <?= json_encode($GLOBALS['page']) ?>||{id:-1};
</script>