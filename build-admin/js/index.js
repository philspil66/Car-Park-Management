// required files for application

var menu 						= require('./menu/menu.js');
var confirm						= require('./popup/confirm.js');
var message 					= require('./popup/message.js');
var button_dropdown				= require('./button-dropdown/button-dropdown.js');
var panel_switch				= require('./panel-switch/panel-switch.js');
var event_create_edit 			= require('./events/event-create-edit.js');
var event_carparks 				= require('./events/event-carparks.js');
var multi_tickets 				= require('./multi-tickets/multi-tickets.js');

var Chart 						= require('chartjs');
var Mustache					= require('mustache');
var MaskedInput					= require('jquery-masked-input');
var DataTables 					= require('datatables.net')(window, $);

var datatable_orders			= require('./datatable/orders.js');
var datatable_users				= require('./datatable/users.js');
var datatable_categories		= require('./datatable/categories.js');
var datatable_carparks			= require('./datatable/carparks.js');
var datatable_teams				= require('./datatable/teams.js');
var datatable_wastage_reasons	= require('./datatable/wastage-reasons.js');

$(document).ready(function(){

	menu.init();
	confirm.init();
	message.init();
	button_dropdown.init();
	panel_switch.init();
	event_create_edit.init();  
	event_carparks.init();
	multi_tickets.init();
	datatable_orders.init();
	datatable_users.init();
	datatable_categories.init();
	datatable_carparks.init();
	datatable_teams.init();
	datatable_wastage_reasons.init();
	
});