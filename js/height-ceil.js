jQuery(document).ready(function($){
    $(window).load(function () {
        //$('.woocommerce-loop-product__title').responsiveEqualHeightGrid();  
    
        var ceilheight = 0;
        var tempheight = 0;
        function get_ceiling_height($elems) {
            
            $elems.each(function () {
                $cur_elem = $(this);
                
                //console.log ( $cur_elem.height() );
                
                if(tempheight == 0) { // no temp height yet set the first elem as max height
                    tempheight = $cur_elem.outerHeight();                    
                } else { // do the test
                
                    if($cur_elem.height() >= tempheight ) {
                        tempheight = $cur_elem.outerHeight();                    
                    } else {
                        tempheight = tempheight;
                    }
                    
                }
            });
            
            return tempheight;
        }
		
		function set_equal_height_resize_funct($elem) {                
			$elem.outerHeight('auto'); //set the default height before setting the even height
			
			clearTimeout(window.resizedFinished);
			window.resizedFinished = setTimeout(function(){
				//console.log('Resized finished.');
				
				//get max height for item
				var $the_ceil_height = get_ceiling_height($elem);

				//console.log( $the_ceil_height + " +" );
				// all elem height
				$elem.outerHeight($the_ceil_height);
			}, 250);
		}
        
        
        $(window).bind('resize load', syncHeights);
        syncHeights();
        
        function syncHeights() {
            if($(window).width() >= 768) {
				
				set_equal_height_resize_funct($('.woocommerce-loop-product__title'));
                
            } else {
                $('.woocommerce-loop-product__title').outerHeight('auto'); //set the default height when its not mobile view / flex                
            }
            
        }
        
        
    });
});