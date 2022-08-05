
(function(){

	// add postcode lookup functionality ( getaddress.io )
	$('#postcode-lookup').getAddress({

	    api_key: 'vrw-_TyIPE2_zBSD_8Q2cg3862',
	    output_fields:{
	        line_1: '#address1',
	        line_2: '#address2',
	        line_3: '#address3',	// DEV NOTE: line_3 is needed for lookup, this field is not on the form though
	        post_town: '#town',
	        county: '#county',
	        postcode: '#postcode'
	    },                                                                                                              
	    onLookupSuccess: function(data){

	   	},
	    onLookupError: function(){
	    	
	   	},
	    onAddressSelected: function(elem,index){
	    	$("#opc_dropdown").hide();
	    	$('.js-show-address-fields').hide();
	    	$(".checkout-address-details").show();
	    }

	});

	// keydown event (when enter key is pressed trigger button click)
	$("#postcode-lookup input#opc_input").on("keydown", function(e) {

		var key = e.keyCode ? e.keyCode : e.which;

		return "13" == key ? ($("#opc_button").click(), !1) : void 0;

    });

	// for showing address fields if user wants to manually enter
    $('.js-show-address-fields a').on('click', function(e){

    	$(".checkout-address-details").show();
    	$('.js-show-address-fields').hide();
    	e.preventDefault();

    });

}());

