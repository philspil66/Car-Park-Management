
var $ = require('jquery');

var height_normalise = {

	all:function(elems){

		// TO DO: will normalise heights of all elems

	},

	children_by_parent:function(parent_elem, child_elem){

		// normalise heights of all child elems under a specific parent elem

		var max_height = 0;

		// get the max height
		$(parent_elem).each(function(i){

			$(this).find(child_elem).each(function(){
				if( $(this).height() > max_height ){
					max_height = $(this).height();
				}
			});

			$(this).find(child_elem).each(function(){
				$(this).height(max_height);
			});

			max_height = 0; 

		});

	}

}

module.exports = height_normalise;