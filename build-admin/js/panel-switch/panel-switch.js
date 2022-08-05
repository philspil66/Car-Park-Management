
var $ = require('jquery');

var panel_switch = {

	init:function(){ 

		$(document).on('click','.js-panel-switch',function(e){

			var parent_elem 	= $(this).data('parent-elem');
			var hidden_panels	= $(this).data('hidden-panels');
			var visible_panels	= $(this).data('visible-panels');
			
			// hide panels
			for(var i=0;i<hidden_panels.length;i++){
				$(this).parents(parent_elem).find(hidden_panels[i]).hide();
			}

			// show visible panels
			for(var i=0;i<visible_panels.length;i++){
				$(this).parents(parent_elem).find(visible_panels[i]).show();
			}

			e.preventDefault();
		});

	}

}

module.exports = panel_switch;