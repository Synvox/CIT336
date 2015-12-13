<?php nav(); ?>
	<div class="hero-unit">
		<div class="container">
			<h1>Welcome Back!</h1>
			<p>We Missed You!</p>
		</div>
	</div>
</header>

<div class="container">
	<div id="page-body">
		<?php errors(); ?>

		<form class="form-horizontal" method="post" action="/user">
		  <div class="control-group">
		    <label class="control-label" for="inputEmail">Email</label>
		    <div class="controls">
		      <input type="text" id="inputEmail" placeholder="Email" name="email">
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="inputPassword">Password</label>
		    <div class="controls">
		      <input type="password" id="inputPassword" placeholder="Password" name="password">
		    </div>
		  </div>
		  <div class="control-group">
		    <div class="controls">
		      <button type="submit" class="btn btn-primary">Sign in</button>
		      <a href="user/create" class="btn">Join Us!</a>
		    </div>
		  </div>
		</form>
  </div>

  <?php footer(); ?>
</div>

<script type="text/javascript">
	var page = null;
</script>
