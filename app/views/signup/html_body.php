<!-- section container -->
<div class="section-container">

	<!-- heading -->
	<h1 class="section-title">
		Sign Up
	</h1>

	<!-- form rows -->
	<div class="section-row">
		<input type="text" placeholder="email" class="input-default signup-fh" data-column="email" data-check="email" data-message="Email invalid or already registered." />
		<div class="input-error-message signup-fhe">
			
		</div>
	</div>
	<div class="section-row">
		<input type="text" placeholder="username" class="input-default signup-fh" data-column="username" data-check="username" data-message="Username invalid or taken. Min length 4. Alphanumeric only." />
		<div class="input-error-message signup-fhe">
			
		</div>
	</div>
	<div class="section-row">
		<input type="text" placeholder="first name" class="input-default signup-fh" data-column="first_name" data-check="name" data-message="Invalid name." />
		<div class="input-error-message signup-fhe">
			
		</div>
	</div>
	<div class="section-row">
		<input type="text" placeholder="last name" class="input-default signup-fh" data-column="last_name" data-check="name" data-message="Invalid name." />
		<div class="input-error-message signup-fhe">
			
		</div>
	</div>
	<div class="section-row">
		<input type="password" placeholder="password" class="input-default signup-fh" data-column="password" data-check="password" data-message="Passwords don't match and or are not 8 characters long." />
		<div class="input-error-message signup-fhe">
			
		</div>
	</div>
	<div class="section-row">
		<input type="password" placeholder="confirm password" class="input-default signup-fh" data-column="confirm_password" data-check="confirm_password" data-message="Passwords don't match and or are not 8 characters long." data-matches="password" />
		<div class="input-error-message signup-fhe">
			
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
		<a href="<?php echo HREF_BASE_URL; ?>login" class="ga-href" data-ga-name="href_log_in_sign_up" data-ga-label="log_in">
			<div class="default-button space-blue">
				Log In
			</div>
		</a>
	</div>

</div>