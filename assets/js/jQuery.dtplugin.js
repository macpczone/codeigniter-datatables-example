/**
 * Zepernick jQuery plugins 
 */

(function($) {
	
	$.fn.dataTableSearch = function(delay) {
		//console.log("data table search plugin...");
		
		var dt = this;
		
		this.find("thead input").on( 'keyup', function (event) {
		 	
		 	
		 	getInput = function() {
		 		return $(event.target);
		 	};
		 	
		 	$z.delay(delay, function() {
		 		var td = getInput().closest("td");
		 		var index = td.index();
		 		//console.log("index is " + index);
		 		dt.DataTable()
			        .columns(index)
			        .search(getInput().val())
			        .draw();
		 	});
		 	
		    
		});
		
		
		return this;
		
	};
	
	
	function delay(){
	  var timer = 0;
	  return function(ms, callback){
	    clearTimeout (timer);
	    timer = setTimeout(callback, ms);
	  };
	};
	
})(jQuery);