<?php nav(); ?>
	<div class="hero-unit">
		<div class="container">
			<h1>Join Us!</h1>
			<p>It only takes a second</p>
		</div>
	</div>
</header>

<div class="container">
	<div id="page-body">
		<?php errors(); ?>
		<form class="form-horizontal" method="post" action="">
			<input type="hidden" name="create" value="true"/>
		  <div class="control-group">
		    <label class="control-label" for="inputEmail">Name</label>
		    <div class="controls">
		      <input type="text" id="inputName" placeholder="Name" name="name">
		    </div>
		  </div>
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
		      <button type="submit" class="btn">Sign in</button>
		    </div>
		  </div>
		</form>
  </div>
  
  <?php footer(); ?>
</div>

<script type="text/javascript">
	var page = null;
</script>
