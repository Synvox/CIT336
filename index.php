<?php
	$indexEntry = true;
	require_once('app.php');
	$app = new App();
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?= App::attr('site','title'); ?></title>
        <meta name="description" content="<?= htmlspecialchars(App::attr('site','description')); ?>">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="<?= $relativePath ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= $relativePath ?>assets/css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="<?= $relativePath ?>assets/css/animate.min.css">
        <link rel="stylesheet" href="<?= $relativePath ?>assets/css/helpers.css">
        <link rel="stylesheet" href="<?= $relativePath ?>assets/css/main.css">
        <script src="<?= $relativePath ?>assets/mixins/modernizr.min.js"></script>
        <?php
        	if (PageController::canEdit()) {
	        	?><link rel="stylesheet" href="<?= $relativePath ?>assets/css/admin.css"><?php
        	}
        ?>
    </head>
    <body class="smooth smooth-fast">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <?php
	        $app->render();
        ?>

    		<?php
    			// include clientside templates if there is an author
					if (PageController::canEdit() && $handle = opendir('assets/templates')) {
				    while (false !== ($file = readdir($handle))) {
				    	if (stristr($file,".ejs")){
								?><script id="ejs-<?= str_replace(".ejs","",$file); ?>" type="text/x-ejs-template"><?=
									file_get_contents("assets/templates/$file");
								?></script><?php
							}
				    }
				    closedir($handle);
					}
				?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/mixins/jquery.min.js"><\/script>')</script>
        <script src="<?= $relativePath ?>assets/js/bootstrap.min.js"></script>
        <script src="<?= $relativePath ?>assets/js/plugins.js"></script>
        <script src="<?= $relativePath ?>assets/js/main.js"></script>
        <?php
        	if (PageController::canEdit()) {
	        	?>
					    <script type="text/javascript" src="<?= $relativePath ?>assets/js/ejs.js"></script>
					    <script type="text/javascript">
						    var relativePath = "<?= $relativePath ?>";
					    </script>
					    <script type="text/javascript" src="<?= $relativePath ?>assets/js/admin.js"></script>
	        	<?php
        	}
        ?>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
