/*
 * Zepernick JS Commons library
 */
var $z = (function($z) {
	
	//empty object to assign custom functions / properties to
	$z.fn = {};
	
	//set a timeout delay that clears itself if it fires in succession before the timeout
	//is reached.  Useful when 
	$z.delay = (function(){
	  var timer = 0;
	  return function(ms, callback){
	    clearTimeout (timer);
	    timer = setTimeout(callback, ms);
	  };
	})();
	
	
	//handles the security for ajax calls
	$z.ajax = function(jQueryOpts) {
		//store the success function specified on the call
		var userSuccess = jQueryOpts.hasOwnProperty("success") === false ?
			function(){}  :
				jQueryOpts.success;
			
		//replace the success function
		jQueryOpts.success = function(data, status, xhr) {
			//TODO check the header to make sure we did not get denied access or were not 
			//logged in
			
			userSuccess(data, status, xhr);
		};		
		
		
		
		return jQuery.ajax(jQueryOpts);
	};
	
	$z.select2Init = function(element, callback) {
		var val = element.val().split("|");
		if (val.length === 2) {
			callback({
				id: val[0],
	        	text: val[1]
	       });
		}
		
		
	};
	
	$z.setToggle = function(eles) {
		$z._toggleEles = eles;
	};
	
	$z.toggle = function() {
		if($z._toggleEles !== undefined) {
			$z._toggleEles.slideToggle(300, "swing");
		}
	};
	
	
	return $z;
	
})(window.$z || {});
