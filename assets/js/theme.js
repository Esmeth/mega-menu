(function($) {

    /**
     * Smart Menu
     */
    function initSmartmenu() {
        var $primaryMenu = $( '.sm.sm-simple' );

        $primaryMenu.smartmenus( {
            hideTimeout: 50,
            subMenusSubOffsetX: 0,
            subMenusSubOffsetY: - 17
        } );

        // Add animation for sub menu.
        $primaryMenu.on( {
            'show.smapi': function( e, menu ) {
                $( menu ).removeClass( 'hide-menu' ).addClass( 'show-menu' );
            },
            'hide.smapi': function( e, menu ) {
                $( menu ).removeClass( 'show-menu' ).addClass( 'hide-menu' );
            }
        } ).on( 'animationend webkitAnimationEnd oanimationend MSAnimationEnd', 'ul', function( e ) {
            $( this ).removeClass( 'show-menu hide-menu' );
            e.stopPropagation();
        } );
    }

    initSmartmenu();

})(jQuery);