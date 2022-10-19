(function($){
    "use strict";
    //Get all the Lazyload Images
    let lazyloadImages = document.querySelectorAll('.lazyload');
    
    var lazyloadObserver = new IntersectionObserver(
        function (lazyloadEntries, observer) {
            lazyloadEntries.forEach(function (lazyloadEntry){
                
                //Check if Image is visible
                if (lazyloadEntry.isIntersecting) {
                    let image = lazyloadEntry.target;
                    let $image = $(image);
                    
                    //Check if its already loaded
                    if (!$image.hasClass('lazyloaded')) {
                        let src = $image.attr("data-src");
                        
                        //Change the src of the Image
                        $image.attr("src", src).addClass("lazyloaded");
                    }
                }
            });                                  
        }
    );
    
    //Start the Observer for every Image
    lazyloadImages.forEach(function(image) {
	   lazyloadObserver.observe(image);
    });
})(jQuery);