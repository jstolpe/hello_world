<!-- section container -->
<div class="section-container">

	<!-- heading -->
	<h1 class="section-title">
		Log In
	</h1>

	<!-- form rows -->
	<div class="section-row">
		<input type="text" placeholder="email" class="input-default login-fh" data-column="email" data-check="email" />
	</div>
	<div class="section-row">
		<input type="password" placeholder="password" class="input-default login-fh" data-column="password" data-check="password" />
	</div>

	<!-- form actions -->
	<div class="section-row">
		<div class="default-button space-blue button-login">
			Log In
		</div>
	</div>
	<div class="section-or">
		- OR -
	</div>
	<div class="section-row">
		<a href="<?php echo HREF_BASE_URL; ?>signup" class="ga-href" data-ga-name="href_sign_up_log_in" data-ga-label="sign_up">
			<div class="default-button space-blue">
				Sign Up
			</div>
		</a>
	</div>
</div>