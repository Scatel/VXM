<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php bloginfo('name'); ?> <?php bloginfo('description'); ?></title>

	<meta charset="utf-8"/>
	<meta name="description" content="<?php bloginfo('description'); ?>" /></title>
	<link rel="shortcut icon" href="<?php echo home_url(); ?>/favicon.ico" />
	<link rel="icon" href="<?php echo home_url(); ?>/favicon.ico" type="image/x-icon" />
	<meta name="viewport" content="width=device-width; initial-scale=0.9; maximum-scale=1.0; user-scalable=0;" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<style type="text/css">
		html,body,div,span,object,iframe,h1,h2,h3,h4,h5,h6,p,img,strong,b,i,ol,ul,li,fieldset,form,label,canvas {border:0; outline:0; font-size:100%; vertical-align:baseline; background:transparent; margin:0; padding:0; }
		body { line-height:1; }
		a { font-size:100%; vertical-align:baseline; background:transparent; margin:0; padding:0; }

		/* Main */
		html, * {font-family: 'Open Sans',helvetica,arial,sans-serif;font-size:13px;}
		body {
			width:100%;
			height:100%;
			background: #fff;
			color:#202020;
		}
		a{color:#333;}
		a:hover{color:#222; text-decoration: none;}
		#main-container {width:100%;max-height:100%;}
		#content {width:136px;height:136px;top:50%;left:50%;position:absolute;margin-left:-68px;margin-top:-68px;}
		.wbox{text-align: center;margin-top:20px;}
	</style>

	<script>
		/*(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-64721281-1', 'auto');
		ga('send', 'pageview');*/
	</script>

</head>

<body class="login">

<div id="main-container">
	<div id="content">
		<img src="<?php home_url(); ?>/assets/vxm-logo-03.svg" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
		<div class="wbox">
			<?php echo $this->mamo_template_tag_message(); ?><br />
			<?php echo $this->mamo_template_tag_login_logout(); ?>
		</div>
	</div>
</div>

</body>
</html>