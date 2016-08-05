/* jshint ignore:start */
define(['jquery', 'core/log'], function($, log) {

    "use strict"; // jshint ;_;

    log.debug('Shoelace anti gravity AMD initialised');

    return {
        init: function(data) {
        $('.' + data.toggleclass).click(function(e){
        e.preventDefault() ;
		var undockimg =  $('img[alt="すべてをアンドックする"]');

		if(undockimg.length>0 && undockimg.is(':visible')){
		   undockimg.trigger('click');
		}else{
		 var delay=1;
		   $('.block_navigation .moveto.customcommand.requiresjs, .block_settings .moveto.customcommand.requiresjs').each(function(){
				  var that = this;
				   setTimeout(function(){$(that).trigger('click');},delay);
				   delay +=500;
				 }//end of function
			  )//end of each
		}//end of if

		});
	}//end of init
 }//end of return
});
/* jshint ignore:end */
