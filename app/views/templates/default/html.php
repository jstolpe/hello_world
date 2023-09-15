<!DOCTYPE html>
<html>
	<head>
		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-2Y6WPWS7HV"></script>
		<script>
			// GA CODE
		  	window.dataLayer = window.dataLayer || [];
		  	function gtag(){dataLayer.push(arguments);}
		  	gtag('js', new Date());
		  	gtag('config', 'G-2Y6WPWS7HV');
		</script>

		<!-- site ga js -->
		<script src="<?php echo BASE_URL_ASSETS; ?>js/ga/script.js"></script>


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

		<!-- font awesome -->
		<link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>css/fontawesome/css/fontawesome.css" />
		<link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>css/fontawesome/css/regular.css" />
		<link rel="stylesheet" href="<?php echo BASE_URL_ASSETS; ?>css/fontawesome/css/solid.css" />

		<!-- template specific css -->
		<link href="<?php echo BASE_URL_ASSETS; ?>css/templates/default/styles.css" rel="stylesheet" type="text/css" />
		
		<!-- template specific js -->
		<script src="<?php echo BASE_URL_ASSETS; ?>js/loader/script.js"></script>
		<script src="<?php echo BASE_URL_ASSETS; ?>js/templates/default/script.js"></script>

		<script>
			var helloWorldLoader;

			document.addEventListener( 'DOMContentLoaded', function() { // document is ready
				// initalize global template javascript
				helloWorld.initialize( {
					baseUrl: '<?php echo HREF_BASE_URL; ?>',
					assetsImagesUrl: '<?php echo BASE_URL_ASSETS_IMAGES; ?>'
				} );

				helloWorldLoader = new loaderHelper( {
					loaderClassPrefix: 'helloworld',
					loaderHtml: '<img src="' + helloWorld.assetsImagesUrl + 'logo50x50.png" />'
				} );

				// initialize ga object
				gaHelper.initialize();
			} );
		</script>

		<!-- html page specific head html -->
		<?php echo $html_head; ?>
	</head>
	<body>

		<!-- fixed header -->
		<div class="header-container">
			<div class="header-container-inner">

				<!-- header logo -->
				<a href="<?php echo HREF_BASE_URL; ?>" class="ga-href" data-ga-name="href_header_logo" data-ga-label="header">
					<div class="header-logo">
						<img src="<?php echo BASE_URL_ASSETS; ?>images/logo50x50.png" />
						Hello World
					</div>
				</a>

				<!-- header user menu -->
				<div class="header-user-menu-container">
					
					<!-- header menu bars icon -->
					<span class="user-menu-bars fa-solid fa-bars ga-icon" data-ga-name="icon_header_user_menu" data-ga-label="header">

					</span>

					<!-- users menu list -->
					<div class="user-menu-container hide">
						<div class="user-menu-container-inner">
							<div class="user-menu">

								<!-- users menu item -->
								<a href="<?php echo HREF_BASE_URL; ?>" class="ga-href" data-ga-name="href_user_menu_log_in" data-ga-label="log_in">
									<div class="user-menu-item">
										<div class="user-menu-item-text">
											Log In
										</div>
										<div class="user-menu-item-icon">
											<span class="fa-solid fa-sign-in">

											</span>
										</div>
									</div>
								</a>

								<!-- users menu item -->
								<a href="<?php echo HREF_BASE_URL; ?>signup" class="ga-href" data-ga-name="href_user_menu_sign_up" data-ga-label="sign_up">
									<div class="user-menu-item last">
										<div class="user-menu-item-text">
											Sign Up
										</div>
										<div class="user-menu-item-icon">
											<span class="fa-solid fa-user-plus">

											</span>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- users menu overlay -->
			<div class="user-menu-overlay">

			</div>
		</div>

		<!-- html page specific body html -->
		<div class="body-container">
			<?php echo $html_body; ?>
		</div>
	</body>
</html>