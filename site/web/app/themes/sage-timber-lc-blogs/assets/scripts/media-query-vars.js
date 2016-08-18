(function($, viewport){
    $(document).ready(function() {

    	function DetectViewport(){

			if(viewport.is('xs')) {
	            console.log( "viewport is xs" );
	        }
	 
	        if(viewport.is('sm')) {
	            console.log( "viewport is sm" );
	        }
	 
	        if(viewport.is('md')) {
	            console.log( "viewport is md" );
	        }

	 
	        if(viewport.is('lg')) {
	            console.log( "viewport is lg" );
	        }


    	}
    	
    	new DetectViewport();


        // Execute code each time window size changes 
        $(window).resize(
            viewport.changed(function() {

		        new DetectViewport();

            })
        );
    });
})(jQuery, ResponsiveBootstrapToolkit);