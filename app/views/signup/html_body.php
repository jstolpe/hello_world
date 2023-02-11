<!-- section container -->
<div class="section-container">

	<!-- heading -->
	<h1 class="section-title">
		Sign Up
	</h1>

	<!-- form rows -->
	<div class="section-row">
		<input type="text" placeholder="email" class="input-default" />
		<div class="input-error-message">
			Email invalid or already registered.
		</div>
	</div>
	<div class="section-row">
		<input type="text" placeholder="username" class="input-default" />
		<div class="input-error-message">
			Username invalid or taken. Min length 4. Alphanumeric only.
		</div>
	</div>
	<div class="section-row">
		<input type="text" placeholder="first name" class="input-default" />
		<div class="input-error-message">
			Invalid name.
		</div>
	</div>
	<div class="section-row">
		<input type="text" placeholder="last name" class="input-default" />
		<div class="input-error-message">
			Invalid name.
		</div>
	</div>
	<div class="section-row">
		<input type="password" placeholder="password" class="input-default" />
		<div class="input-error-message">
			Passwords don't match and or are not 8 characters long.
		</div>
	</div>
	<div class="section-row">
		<input type="password" placeholder="confirm password" class="input-default" />
		<div class="input-error-message">
			Passwords don't match and or are not 8 characters long.
		</div>
	</div>

	<!-- form actions -->
	<div class="section-row">
		<div class="default-button space-blue button-signup">
			Sign Up
		</div>
	</div>
	<div class="section-or">
		- OR -
	</div>
	<div class="section-row">
		<a href="<?php echo HREF_BASE_URL; ?>" class="ga-href" data-ga-name="href_log_in_sign_up" data-ga-label="log_in">
			<div class="default-button space-blue">
				Log In
			</div>
		</a>
	</div>

</div>