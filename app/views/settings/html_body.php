<!-- section container -->
<div class="section-container">
	<!-- heading -->
	<h1 class="section-title">
		Settings
	</h1>
	<div class="section-row">
		<input type="text" placeholder="email" class="input-default settings-fh" data-column="email" data-check="email" data-message="Email invalid or already registered." value="<?php echo $this->escapeHtml( $user_info['email'] ); ?>" />
		<div class="input-error-message settings-fhe">
			
		</div>
	</div>
	<div class="section-row">
		<input type="text" placeholder="username" class="input-default settings-fh" data-column="username" data-check="username" data-message="Username invalid or taken. Min length 4. Alphanumeric only." value="<?php echo $this->escapeHtml( $user_info['username'] ); ?>" />
		<div class="input-error-message settings-fhe">
			
		</div>
	</div>
	<div class="section-row">
		<input type="text" placeholder="first name" class="input-default settings-fh" data-column="first_name" data-check="name" data-message="Invalid name." value="<?php echo $this->escapeHtml( $user_info['first_name'] ); ?>" />
		<div class="input-error-message settings-fhe">
			
		</div>
	</div>
	<div class="section-row">
		<input type="text" placeholder="last name" class="input-default settings-fh" data-column="last_name" data-check="name" data-message="Invalid name." value="<?php echo $this->escapeHtml( $user_info['last_name'] ); ?>" />
		<div class="input-error-message settings-fhe">
			
		</div>
	</div>
	<div class="section-row">
		<input type="checkbox" id="change_password" class="change-password settings-fh" data-column="change_password" />
		<label for="change_password" class="default-label">
			Change Password
		</label>
	</div>
	<div class="change-password-container">
		<div class="section-row">
			<input type="password" placeholder="password" class="input-default settings-fh" data-column="password" data-message="Passwords don't match and or are not 8 characters long." />
			<div class="input-error-message settings-fhe">
				
			</div>
		</div>
		<div class="section-row">
			<input type="password" placeholder="confirm password" class="input-default settings-fh" data-column="confirm_password" data-message="Passwords don't match and or are not 8 characters long." data-matches="password" />
			<div class="input-error-message settings-fhe">
				
			</div>
		</div>
	</div>

	<!-- form actions -->
	<div class="section-row">
		<div class="default-button space-blue button-update">
			Update
		</div>
	</div>
</div>