/**
 * Handle global site javascript functionality.
 *
 * @author Justin Stolpe
 */
var helloWorld = {
	/**
     * Base url for the site.
     *
     * @var string
     */
    baseUrl : '',

    /**
     * Url to the assets/images folder.
     *
     * @var string
     */
    assetsImagesUrl : '',

	/**
     * Initialize global javascript functionality.
     *
     * @param object params
     *     str baseUrl base url for the website
     *     str assetsImagesUrl base url for the assets
     * @return void
     */
	initialize : function( params ) {
		// save baseUrl to object
        this.baseUrl = params.baseUrl;

        // save path to assets/images
        this.assetsImagesUrl = params.assetsImagesUrl;

		// setup javascript for users menu
		this.setupUserMenu();
	},

	/**
     * Make ajax call.
     *
     * @param object params
     * @return void
     */
	ajax : function( params ) {
		// create new xml http request object
        var request = new XMLHttpRequest(); 

        // initialize params
        var sendParams = '';

        for ( const property in params.data ) { // loop over params
            // add params to be sent
            sendParams += property + '=' + encodeURIComponent( params.data[property] ) + '&';
        }

        // open request
        request.open( params.type, params.url, true );

        // set headers
        request.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );

        request.onreadystatechange = function () { // set response listener
            if ( request.readyState === 4 && request.status === 200 ) { // 4 means done and 200 is good status
                // success send json payload
                params.success( JSON.parse( request.responseText ) );
            }
        };

        // send the request
        request.send( sendParams );
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