/**
 * Handle javascript functionality for the form validation.
 *
 * @author Justin Stolpe
 */
var formHelper = ( function() {
	/**
     * Constructor function.
     *
     * @param object args
     *     str formClassPrefix (optional|defaults to '') prefix to group elements by if more than one form on page.
     *     str inputClassIdentifier (optional|defaults to 'fh') identifier for input elements in the form.
     *     str inputErrorClassIdentifier (optional|defaults to 'fh') identifier for input message elements in the form.
     *     str inputErrorClass (optional|defaults to 'input-default-error') error class to apply to inputs if input is not valid.
     *     int minPasswordLength (optional|defaults to 8) minimum length for password inputs.
     */
	var formHelper = function( args ) {
		var self = this;

		// set form class prefix
		self.formClassPrefix = 'formClassPrefix' in args ? args.formClassPrefix + '-' : '';
		
		// set class identifier for all elements
		self.inputClassIdentifier = self.formClassPrefix + ( 'inputClassIdentifier' in args ? args.inputClassIdentifier : 'fh' );
		self.inputErrorClassIdentifier = self.formClassPrefix + ( 'inputErrorClassIdentifier' in args ? args.inputErrorClassIdentifier : 'fhe' );

		// set error classes
		self.inputErrorClass = 'inputErrorClass' in args ? args.inputErrorClass : 'input-default-error';

		// set password minlenth
		self.minPasswordLength = 'minPasswordLength' in args ? args.minPasswordLength : 8;

		// store form elements
		self.formElements = {};

		// get elements with class name
		var inputElements = document.getElementsByClassName( self.inputClassIdentifier );

		for ( var i = 0; i < inputElements.length; i++ ) { // loop over input elements
			var elementObject = { // create object for each element
				column: inputElements[i].getAttribute( 'data-column' ),
				check: inputElements[i].getAttribute( 'data-check' ) || false,
				matches: inputElements[i].getAttribute( 'data-matches' ) || false,
				className: self.inputClassIdentifier + Object.keys( self.formElements ).length
			};

			// add unique class to dom element
			inputElements[i].classList.add( elementObject.className );

			// push the element onto the array
			self.formElements[elementObject.column] = elementObject;
		}
	}

	/**
     * Get the entire form helper.
     *
     * @return string
     */
	formHelper.prototype.getPostData = function() {
		// get self
		var self = this;

		// return json for post
		return JSON.stringify( self );
	}

	/**
     * Update the form helper with server data.
     *
     * @return string
     */
	formHelper.prototype.validateResponseData = function( data ) {
		// get self
		var self = this;

		// set form is valid from repsonse data
		self.formIsValid = data.formData.formIsValid;

		// set form elements from response data
		self.formElements = data.formData.formElements;

		// validate data from server
		return self.validate( 'server' );
	}

	/**
     * Validate form inputs.
     *
     * @param string from either validating from the front end or the server
     * @return boolean
     */
	formHelper.prototype.validate = function( from ) {
		// get self
		var self = this;

		// assume true if only frontend check
		self.formIsValid = 'frontend' == from ? true : self.formIsValid;

		for ( const key in self.formElements ) { // loop over form elements
			// get element by unique class name
			var domElement = document.getElementsByClassName( self.formElements[key].className )[0];

			// get form value from front end
			self.formElements[key].value = 'frontend' == from ? domElement.value : self.formElements[key].value;

			// get form is valid from front
			self.formElements[key].isValid = 'frontend' == from ? self.validateInput( self.formElements[key] ) : self.formElements[key].isValid;
			
			// get form value from front end
			self.formElements[key].message = 'frontend' == from ? domElement.getAttribute( 'data-message' ) : self.formElements[key].message;
			self.formElements[key].message = self.formElements[key].isValid ? '' : self.formElements[key].message;
			
			// update ui for form element
			self.updateUiFormElement( self.formElements[key] );

			if ( !self.formElements[key].isValid ) { // form element is invalid
				// mark the form invalid
				self.formIsValid = false;
			}
		}

		// return form valid status
		return self.formIsValid;
	}

	/**
     * Update UI form element.
     *
     * @param object formElement element to update on the UI
     * @return void
     */
	formHelper.prototype.updateUiFormElement = function( formElement ) {
		// get self
		var self = this;

		// get element by unique class name
		var domElement = document.getElementsByClassName( formElement.className )[0];
		
		// element message element
		var domElementMessage;

		for ( var i = 0; i < domElement.parentNode.children.length; i++ ) { // loop over children
			if ( domElement.parentNode.children[i].classList.contains( self.inputErrorClassIdentifier ) ) { // found message child
				domElementMessage = domElement.parentNode.children[i];
			}	
		}

		if ( formElement.isValid ) { // input is valid
			// remove error class
			domElement.classList.remove( self.inputErrorClass );
		} else { // input is not valid
			// add error class
			domElement.classList.add( self.inputErrorClass );
		}

		if ( domElementMessage && !formElement.isValid ) { // we have an error message dom element
			// add message to dom element
			domElementMessage.innerHTML = formElement.message;
			
			domElementMessage.style.display = formElement.isValid ? 'none' : 'block';
		}
	}

	/**
     * Validate a form element.
     *
     * @param object formElement element to validate.
     * @return boolean
     */
	formHelper.prototype.validateInput = function( formElement ) {
		// get self
		var self = this;

		if ( 'email' == formElement.check ) { // checking an email input
			return isValidEmail( formElement.value.trim() );
		} else if ( 'username' == formElement.check ) { // checking a username
			return isValidUsername( formElement.value.trim() );
		} else if ( 'name' == formElement.check ) { // check name
			return isName( formElement.value.trim() );
		} else if ( 'password' == formElement.check ) { // check password
			return isValidPassword( formElement.value, self.minPasswordLength );
		} else if ( 'confirm_password' == formElement.check ) { // check confirm password
			return isValidConfirmPassword( formElement.value, self.getFormElementValue( formElement.matches ), self.minPasswordLength );
		} else { // all good
			return true;
		}
	}

	/**
     * Get value from forme elements object.
     *
     * @param string inKey column to get value for.
     * @return string
     */
	formHelper.prototype.getFormElementValue = function( inKey ) {
		// get self
		var self = this;

		for ( const currentKey in self.formElements ) { // loop over form elements
			if ( inKey == currentKey ) { // found key we are looking for
				// return valid
				return self.formElements[currentKey].value;
			}
		}

		// key not found return blank
		return '';
	}

	/**
     * Check if confirm password is valid.
     *
     * @param string confirmPassword confirm password value to check.
     * @param string password value to check.
     * @param integer minLength length to check against password.
     * @return boolean
     */
	var isValidConfirmPassword = function( confirmPassword, password, minLength ) {
		// return if the confirm password matches the password
		return isValidPassword( password, minLength ) && confirmPassword == password;
	}

	/**
     * Check if password is valid.
     *
     * @param string password value to check.
     * @param integer minLength length to check against password.
     * @return boolean
     */
	var isValidPassword = function( password, minLength ) {
		// return false if password is not valid
		return password.length >= minLength;
	}

	/**
     * Check if name is valid.
     *
     * @param string name value to check.
     * @return boolean
     */
	var isName = function( name ) {
		// return false if invalid name
		return '' != name;
	}

	/**
     * Check if username is valid.
     *
     * @param string username value to check.
     * @return boolean
     */
	var isValidUsername = function( userName ) {
		// regex for username validation
		var regex = /^[0-9a-zA-Z]{4,}$/;

		// return true/false from regex test
		return regex.test( String( userName ).toLowerCase() );
	}

	/**
     * Check if email is valid.
     *
     * @param string email value to check.
     * @return boolean
     */
	var isValidEmail = function( email ) {
		// regex for email validation
		var regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		// return true/false from regex test
		return regex.test( String( email ).toLowerCase() );
	}

	// return our object
	return formHelper;
} )();