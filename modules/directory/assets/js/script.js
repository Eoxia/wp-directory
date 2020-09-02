jQuery( document ).ready(function() {
	var $grid = jQuery('.wp-directory').masonry({
		itemSelector    : '.wpd-item',
		columnWidth     : '.wpd-grid-sizer',
		percentPosition : true,
	});

	/* Hide all content of annuaire elements */
	jQuery( '.wp-directory .wpd-item .wpd-container' ).slideUp( 0, function(){ jQuery( $grid ).masonry( 'layout' ) } );

	/* Show the first item of the list */
	jQuery( '.wp-directory .wpd-item:first .wpd-container' ).slideDown( 0, function(){ jQuery( $grid ).masonry( 'layout' ) } );

	/* Show the annuaire clicked */
	jQuery( '.wp-directory .wpd-item .wpd-header' ).click(function() {
		wpdOpenAnnuaire( jQuery( this ).closest( '.wpd-item' ), $grid );
	});

	jQuery( '.wpd-directory-search .wpd-content' ).on( 'keyup', function () {
		wpdSearchAnnuaire( jQuery(this), $grid );
	});

	/* Hide or show the placeholder */
	jQuery( '.wpd-directory-search .wpd-content' ).on( 'click', function() {
		wpdRemovePlaceholder( jQuery(this) );
	});
	jQuery( '.wpd-directory-search .wpd-content' ).on( 'blur', function() {
		wpdTogglePlaceholder( jQuery(this) );
	});
	jQuery( '.wpd-directory-search .wpd-content' ).on( 'keyup', function() {
		wpdTogglePlaceholder( jQuery(this) );
	});
});

/**
 * Open and Close the annuaire element
 *
 * @method wpdOpenAnnuaire
 * @param  Object element annuaire element.
 * @return void
 */
function wpdOpenAnnuaire( element, $grid ) {
	if ( element === undefined || element.length === 0 ) return;
	if ( $grid === undefined || $grid.length === 0 ) return;

	if ( jQuery( element ).hasClass( 'active' ) ) return;

	jQuery( '.wp-directory .wpd-item' ).removeClass( 'active' );
	jQuery( element ).addClass( 'active' );

	jQuery( '.wp-directory' ).find('.wpd-container').slideUp( 'fast' );
	jQuery( element ).find('.wpd-container').slideDown( 'fast', function(){ jQuery( $grid ).masonry( 'layout' ) } );
}

/**
 * Dynamic search
 *
 * @method wpdSearchAnnuaire
 * @param  Object search area
 * @return void
 */
function wpdSearchAnnuaire( searchElement, $grid ) {
	if ( searchElement === undefined || searchElement.length === 0 ) return;
	if ( $grid === undefined || $grid.length === 0 ) return;

	var searchText = searchElement.text();
	searchText = searchText.toLowerCase();
	searchText = wpdRemoveDiacritics(searchText.replace(/\s+/g, ''));

	jQuery( '.wp-directory' ).find( '.wpd-item' ).each(function(key, element) {
		var annuaireTitle = jQuery( element ).find( '.wpd-header' ).text();
		var annuaireContact = jQuery( element ).find( '.wpd-contact' ).text();

		if ( wpdSortingAnnuaire( searchText, annuaireTitle, jQuery( element ) ) || wpdSortingAnnuaire( searchText, annuaireContact, jQuery( element ) ) ) {
			jQuery( this ).show('fast', function(){ jQuery( $grid ).masonry( 'layout' ) });
		} else {
			jQuery( this ).hide('fast', function(){ jQuery( $grid ).masonry( 'layout' ) });
		}
	});
}

/**
 * Search in Annuaire according to element
 *
 * @method wpdSearchAnnuaireInTitle
 * @param  String text of the searchbar
 * @param  String text of the current element
 * @param  Object current element
 * @return boolean
 */
function wpdSortingAnnuaire( searchText, elementText, element ) {
	if ( elementText === undefined || elementText.length === 0 ) return;
	if ( element === undefined || element.length === 0 ) return;

	var isShowing = (wpdRemoveDiacritics((elementText.toLowerCase()).replace(/\s+/g, ''))).indexOf(searchText) !== -1;
	if ( isShowing ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Remove accent on search elements
 *
 * @method wpdRemoveDiacritics
 * @param  Object element to replace
 * @return output
 */
function wpdRemoveDiacritics( input ) {
	var output = '';
	var normalized = input.normalize( 'NFD' );
	var i = 0;
	var j = 0;

	while ( i < input.length ) {
		output += normalized[j];

		j += ( input[i] == normalized[j] ) ? 1 : 2;
		i++;
	}

	return output;
};

/**
 * Remove the placeholder no matter what
 *
 * @method wpdRemovePlaceholder
 * @param  Object search element
 * @return void
 */
function wpdRemovePlaceholder( element ) {
	if ( element === undefined || element.length === 0 ) return;

	var place = jQuery( element ).parent().find('.wpd-placeholder');
	place.removeClass( 'active' );
}

/**
 * Toggle the placeholder according the search content
 *
 * @method wpdTogglePlaceholder
 * @param  Object search element
 * @return void
 */
function wpdTogglePlaceholder( element ) {
	if ( element === undefined || element.length === 0 ) return;

	var place = jQuery( element ).parent().find('.wpd-placeholder');
	if ( jQuery( element ).text() == undefined || jQuery( element ).text().length == 0 ) {
		place.addClass( 'active' );
	} else {
		place.removeClass( 'active' );
	}
}
