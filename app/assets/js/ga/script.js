/**
 * Handle global site ga javascript functionality.
 *
 * @author Justin Stolpe
 */
var gaHelper = {
	/**
     * Initizlize our ga object.
     *
     * @return void
     */
	initialize : function() {
		// setup href clicks
		this.setupEventListeners( 'ga-href', 'href_click' );

		// setup icon clicks
		this.setupEventListeners( 'ga-icon', 'icon_click' );
	},

	/**
     * Send event to google analytcis.
     *
     * @param string name event name that shows up in ga.
     * @param string label event label.
     * @param integer value event value.
     * @return void
     */
	buttonClick : function( name, label, value ) {
		this.fireEvent( name, 'button_click', label, 'undefined' == typeof value ? 0 : value );
	},

	/**
     * Send event to google analytcis.
     *
     * @param string name event name that shows up in ga.
     * @param string category event category.
     * @param string label event label.
     * @param integer value event value.
     * @return void
     */
	fireEvent : function( name, category, label, value ) {
		gtag( 'event', name, {
			'event_category': category,
			'event_label': label,
			'value': value,
			'hello': 'world'
		} );
	},

	/**
     * Setup event click listeners.
     * 
     * @param string className class name of elements.
     * @param string category event category.
     * @return void
     */
	setupEventListeners : function( className, category ) {
		var self = this;

		var elements = document.getElementsByClassName( className );

		for ( var i = 0; i < elements.length; i++ ) {
			elements[i].addEventListener( 'click', function() {
				self.fireEvent( this.getAttribute( 'data-ga-name' ), category, this.getAttribute( 'data-ga-label' ), 0 );
			} );
		}
	}
}