<!DOCTYPE html>
<html>
	<head>
		<!-- html title -->
		<title>
			<?php echo $html_title; ?>
		</title>

		<!-- meta -->
		<meta name="viewport" content="width=device-width,user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

		<!-- pwa: android/ios tell device site is mobile capable -->
		<meta name="mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-capable" content="yes" />

		<!-- pwa: android/ios site name -->
		<meta name="application-name" content="<?php echo SITE_DISPLAY_NAME; ?>" />
		<meta name="apple-mobile-web-app-title" content="<?php echo SITE_DISPLAY_NAME; ?>" />

		<!-- pwa: site manifest with more json settings -->
		<link rel="manifest" href="<?php echo BASE_URL_ASSETS; ?>manifest.json" />
		
		<!-- pwa: ios enable fullscreen mode  -->
		<meta name="apple-touch-fullscreen" content="yes">

		<!-- pwa: ios app icon  -->
		<link rel="apple-touch-icon-precomposed" href="<?php echo BASE_URL_ASSETS_IMAGES; ?>logo192x192.png" />

		<!-- pwa: ios app url  -->
		<meta name="msapplication-starturl" content="<?php echo HREF_BASE_URL; ?>" />

		<!-- pwa: ios app splash screen image must be exact dimensions of device targeted -->
		<meta rel="apple-touch-startup-image" sizes="1179x2556" href="<?php echo BASE_URL_ASSETS_IMAGES; ?>apple_splash_1179x2556.png">

		<!-- favicon -->
		<link rel="shortcut icon" href="<?php echo BASE_URL_ASSETS; ?>images/favicon.ico" />

		<!-- template specific css -->
		<link href="<?php echo BASE_URL_ASSETS; ?>css/templates/default/styles.css" rel="stylesheet" type="text/css" />

		<!-- template specific js -->
		<script src="<?php echo BASE_URL_ASSETS; ?>js/templates/default/script.js"></script>

		<!-- html page specific head html -->
		<?php echo $html_head; ?>
	</head>
	<body>
		<!-- html page specific body html -->
		<?php echo $html_body; ?>
	</body>
</html>