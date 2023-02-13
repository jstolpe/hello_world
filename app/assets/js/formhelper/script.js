var formHelper = ( function() {
	var formHelper = function( args ) {
		var self = this;

		self.formClassPrefix = 'formClassPrefix' in args ? args.formClassPrefix + '-' : '';
		self.inputClassIdentifier = self.formClassPrefix + ( 'inputClassIdentifier' in args ? args.inputClassIdentifier : 'fh' );
		self.inputErrorClassIdentifier = self.formClassPrefix + ( 'inputErrorClassIdentifier' in args ? args.inputErrorClassIdentifier : 'fhe' );

		self.inputErrorClass = 'inputErrorClass' in args ? args.inputErrorClass : 'input-default-error';

		self.minPasswordLength = 'minPasswordLength' in args ? args.minPasswordLength : 8;

		self.formElements = {};

		var inputElements = document.getElementsByClassName( self.inputClassIdentifier );

		for ( var i = 0; i < inputElements.length; i++ ) {
			var elementObject = {
				column: inputElements[i].getAttribute( 'data-column' ),
				check: inputElements[i].getAttribute( 'data-check' ) || false,
				matches: inputElements[i].getAttribute( 'data-matches' ) || false,
				className: self.inputClassIdentifier + Object.keys( self.formElements ).length
			};

			inputElements[i].classList.add( elementObject.className );

			self.formElements[elementObject.column] = elementObject;
		}
	}

	formHelper.prototype.validate = function() {
		var self = this;

		self.formIsValid = true;

		for ( const key in self.formElements ) {
			var domElement = document.getElementsByClassName( self.formElements[key].className )[0];

			self.formElements[key].value = domElement.value;

			self.formElements[key].isValid = self.validateInput( self.formElements[key] );
			
			self.formElements[key].message = domElement.getAttribute( 'data-message' );
		
			self.updateUiFormElement( self.formElements[key] );

			if ( !self.formElements[key].isValid ) {
				self.formIsValid = false;
			}
		}

		console.log(self);
		return self.formIsValid;
	}

	formHelper.prototype.updateUiFormElement = function( formElement ) {
		var self = this;

		var domElement = document.getElementsByClassName( formElement.className )[0];
	
		var domElementMessage;

		for ( var i = 0; i < domElement.parentNode.children.length; i++ ) {
			if ( domElement.parentNode.children[i].classList.contains( self.inputErrorClassIdentifier ) ) {
				domElementMessage = domElement.parentNode.children[i];
			}	
		}

		if ( formElement.isValid ) {
			domElement.classList.remove( self.inputErrorClass );
		} else {
			domElement.classList.add( self.inputErrorClass );
		}

		if ( domElementMessage && !formElement.isValid ) {
			domElementMessage.innerHTML = formElement.message;
		}

		domElementMessage.style.display = formElement.isValid ? 'none' : 'block';
	}

	formHelper.prototype.validateInput = function( formElement ) {
		var self = this;

		if ( 'email' == formElement.check ) {
			return isValidEmail( formElement.value.trim() );
		} else if ( 'username' == formElement.check ) {
			return isValidUsername( formElement.value.trim() );
		} else if ( 'name' == formElement.check ) {
			return isName( formElement.value.trim() );
		} else if ( 'password' == formElement.check ) {
			return isValidPassword( formElement.value, self.minPasswordLength );
		} else if ( 'confirm_password' == formElement.check ) {
			return isValidConfirmPassword( formElement.value, self.getFormElementValue( formElement.matches ), self.minPasswordLength );
		} else {
			return true;
		}
	}

	formHelper.prototype.getFormElementValue = function( inKey ) {
		var self = this;

		for ( const currentKey in self.formElements ) {
			if ( inKey == currentKey ) {
				return self.formElements[currentKey].value;
			}
		}

		return '';
	}

	var isValidConfirmPassword = function( confirmPassword, password, minLength ) {
		return isValidPassword( password, minLength ) && confirmPassword == password;
	}

	var isValidPassword = function( password, minLength ) {
		return password.length >= minLength;
	}

	var isName = function( name ) {
		return '' != name;
	}

	var isValidUsername = function( userName ) {
		var regex = /^[0-9a-zA-Z]{4,}$/;

		return regex.test( String( userName ).toLowerCase() );
	}

	var isValidEmail = function( email ) {
		var regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		return regex.test( String( email ).toLowerCase() );
	}

	return formHelper;
} )();