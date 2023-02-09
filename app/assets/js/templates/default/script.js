/**
 * Handle global site javascript functionality.
 *
 * @author Justin Stolpe
 */
var helloWorld = {
	/**
     * Initialize global javascript functionality.
     *
     * @return void
     */
	initialize : function() {
		// setup javascript for users menu
		this.setupUserMenu();
	},

	/**
     * Setup the users menu.
     *
     * @return void
     */
	setupUserMenu : function() {
		// get obj self for inside event
		var self = this;

		document.getElementsByClassName( 'user-menu-bars' )[0].addEventListener( 'click' ,function ( event ) { // on click of menu icon
			// stop bubble up
			event.stopPropagation();

			// toggle menu
			self.usersMenuToggle();
		} );

		window.addEventListener( 'click', function( event ) { // window click event listener
			// stop bubble up
			event.stopPropagation();

			// get menu container
			var userMenuContainerElement = document.getElementsByClassName( 'user-menu-container' )[0];

			if ( !userMenuContainerElement.classList.contains( 'hide' ) ) { // menu visible
				if ( !userMenuContainerElement.contains( event.target ) && userMenuContainerElement.offsetParent ) { // check for closes clicked
					// toggle menu
					self.usersMenuToggle();
				}
			}
		} );
	},

	/**
     * Users menu clicked.
     *
     * @return void
     */
	usersMenuToggle : function() {
		// get menu container
		var userMenuContainerElement = document.getElementsByClassName( 'user-menu-container' )[0];

		// toggle menu container
		userMenuContainerElement.classList.toggle( 'hide' );

		if ( userMenuContainerElement.offsetParent ) { // menu is visible
			// show menu overlay
			document.getElementsByClassName( 'user-menu-overlay' )[0].style.display = 'block';

			// set bars to white
			document.getElementsByClassName( 'user-menu-bars' )[0].style.color = '#ffffff';
		} else { // menu not visible
			// remove white bars highlight color
			document.getElementsByClassName( 'user-menu-bars' )[0].style.color = '';

			// hide the menu overlay
			document.getElementsByClassName( 'user-menu-overlay' )[0].style.display = 'none';
		}
	}
}