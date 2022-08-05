var $ = require('jquery');

var multi_tickets = {

	init:function(){

		$('#multi_tickets_group_filter').on('change', function(){

			var $filter = $(this).val();

			if( $filter == 'all' || $filter == '' ){
				$('.multi--ticket--group').show();
			}
			else{
				$('.multi--ticket--group').hide();
				$('.multi--ticket--group.' + $filter).show();
			}

		});

	}

}

module.exports = multi_tickets;