/**
 * Handle javascript functionality for the loader.
 *
 * @author Justin Stolpe
 */
var loaderHelper = ( function() {

    /**
     * Constructor function.
     *
     * @param object args
     *     str loaderClassPrefix (optional|defaults to '') prefix for when more than one loader on page.
     *     str loaderHtml (optional|defaults to 'loading...') custom loader html.
     * @return object
     */
    var loaderHelper = function( args ) {
        // get self
        var self = this;

        // set form class prefix
        self.loaderClassPrefix = 'loaderClassPrefix' in args ? args.loaderClassPrefix + '-' : '';

        // set loader html
        self.loaderHtml = 'loaderHtml' in args ? args.loaderHtml : '<h1>Loading...</h1>';

        // create our overlay div
        var loaderOverlayDiv = document.createElement( 'div' );

        // add classes to our div
        loaderOverlayDiv.classList.add( 'loader-overlay', self.loaderClassPrefix + 'loader-overlay' );

        // add the element to the body
        document.body.appendChild( loaderOverlayDiv );

        // create loader container
        var loaderContainerDiv = document.createElement( 'div' );

        // add classes to our div
        loaderContainerDiv.classList.add( 'loader-container', self.loaderClassPrefix + 'loader-container' );

        // create the loader div
        var loaderDiv = document.createElement( 'div' );

        // add class to loader div
        loaderDiv.classList.add( 'loader' );

        // set the loader html
        loaderDiv.innerHTML = self.loaderHtml;

        // add the loader to the loader container div
        loaderContainerDiv.appendChild( loaderDiv );

        // add the loader container to the body
        document.body.appendChild( loaderContainerDiv );
    }

    /**
     * Show the loader.
     *
     * @return void
     */
    loaderHelper.prototype.show = function () {
        // get self
        var self = this;

        // show overlay and container
        document.getElementsByClassName( self.loaderClassPrefix + 'loader-overlay' )[0].style.display = 'block';
        document.getElementsByClassName( self.loaderClassPrefix + 'loader-container' )[0].style.display = 'block';
    }

    /**
     * Hide the loader.
     *
     * @return void
     */
    loaderHelper.prototype.hide = function () {
        // get self
        var self = this;

        // hide overlay and container
        document.getElementsByClassName( self.loaderClassPrefix + 'loader-overlay' )[0].style.display = 'none';
        document.getElementsByClassName( self.loaderClassPrefix + 'loader-container' )[0].style.display = 'none';
    }

    // return our object
    return loaderHelper;
} )();