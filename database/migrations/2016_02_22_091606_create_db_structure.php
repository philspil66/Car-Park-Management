<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDbStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue');
            $table->longText('payload');
            $table->tinyInteger('attempts')->unsigned();
            $table->tinyInteger('reserved')->unsigned();
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
            $table->index(['queue', 'reserved', 'reserved_at']);
        });
 
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->integer('address_id')->unsigned()->nullable();
            $table->integer('language_id')->unsigned()->default(1);
            $table->string('firstname', 255)->nullable();
            $table->string('lastname', 255)->nullable();
            $table->string('password', 100);
            $table->string('telephone', 20)->nullable();
            $table->string('email', 255);
            $table->enum('type', array('guest', 'registered'))->default('guest');
            $table->string('checked_in', 1);
            $table->enum('status', array('active', 'inactive'))->default('inactive');
            $table->timestamps();
            $table->rememberToken()->nullable();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamps();
        });

        Schema::create('roles_lang', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('language_id')->unsigned()->default(1);
            $table->integer('role_id')->unsigned();
            $table->string('name', 45);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('address1', 255);
            $table->string('address2', 255)->nullable();
            $table->string('town', 100)->nullable();
            $table->string('postcode', 20)->nullable();
            $table->string('county', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->enum('status', array('active', 'inactive'))->default('active'); 
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->string('order_ref', 45)->nullable();
            $table->string('transaction_ref', 100)->nullable();
            $table->string('status', 20)->nullable();
            $table->string('type', 20)->nullable();
            $table->integer('orig_order_id')->unsigned()->nullable();           
            $table->timestamps();
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('single_ticket_id')->unsigned()->nullable();
            $table->integer('multi_ticket_id')->unsigned()->nullable();
            $table->integer('price_paid');
            $table->integer('coupon_id')->unsigned()->nullable();
            $table->integer('plate_id')->unsigned()->nullable();          
            $table->string('checked_in', 1)->default(0);
            $table->string('status', 20);           
            $table->string('guid', 100);
            $table->timestamps();
        });      

        Schema::create('plates', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('guest_id')->unsigned()->nullable();
            $table->string('plate_number', 45);
            $table->timestamps();
        });

        Schema::create('pin_lists', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('name', 255);
            $table->timestamps();
        });

        Schema::create('pin_list_guests', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('pin_list_id')->unsigned();
            $table->integer('guest_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('guests', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('email', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('guest_lists', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('spaces')->unsigned();            
            $table->timestamps();
        });

        Schema::create('guest_list_guests', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('guest_list_id')->unsigned();
            $table->integer('guest_id')->unsigned();
            $table->string('email_sent', 1)->default(0);
            $table->dateTime('date_sent')->nullable();
            $table->string('checked_in', 1)->default(0);
            $table->string('guid', 100);
            $table->timestamps();
        });

        Schema::create('multi_tickets', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('multi_ticket_group_id')->unsigned();
            $table->integer('car_park_id')->unsigned();
            $table->integer('price');
            $table->integer('spaces')->default(0);
            $table->integer('used')->default(0);
            $table->enum('status', array('online', 'offline', 'private'))->default('offline');
            $table->timestamps();
        });

        Schema::create('multi_ticket_events', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->integer('multi_ticket_group_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('multi_tickets_group', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->enum('status', array('online', 'offline', 'private'))->default('offline');
            $table->timestamps();
        });

        Schema::create('multi_tickets_group_lang', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('language_id')->unsigned()->default(1);
            $table->integer('multi_ticket_group_id')->unsigned();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->timestamps();
        });
        
         Schema::create('single_tickets', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('price');
            $table->timestamps();
        });       

        Schema::create('languages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('code', 10);
            $table->string('name', 45);
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('team1_id')->unsigned()->nullable();
            $table->integer('team2_id')->unsigned()->nullable();
            $table->date('date');
            $table->time('time');
            $table->enum('featured', array('true', 'false'))->default('false');
            $table->enum('status', array('active', 'inactive', 'cancelled'))->default('inactive');
            $table->integer('orig_event_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('events_lang', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('language_id')->unsigned()->default(1);
            $table->integer('event_id')->unsigned();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('type', 32);
            $table->string('slug', 255);
            $table->timestamps();
        });

        Schema::create('categories_lang', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->integer('car_park_id')->unsigned();
            $table->integer('allocated')->nullable();
            $table->integer('price')->nullable();
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->enum('status', array('online', 'offline', 'private', 'disabled'))->default('online');
            $table->timestamps();
        });

        Schema::create('car_parks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('capacity')->nullable();
            $table->string('lat', 45)->nullable();
            $table->string('long', 45)->nullable();
            $table->string('sku', 100)->nullable();
            $table->integer('priority')->nullable();
            $table->enum('featured', array('true', 'false'))->default('false');
            $table->timestamps();
        });

        Schema::create('car_parks_lang', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('language_id')->unsigned()->default(1);
            $table->integer('car_park_id')->unsigned();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->text('directions')->nullable();
            $table->timestamps();
        });
        
        Schema::create('car_park_owners', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('car_park_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('teams', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->binary('logo')->nullable();
            $table->enum('status', array('active', 'inactive'))->default('active');
            $table->timestamps();
        });

        Schema::create('teams_lang', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('language_id')->unsigned()->default(1);
            $table->integer('team_id')->unsigned();
            $table->string('name', 255);
            $table->timestamps();
        });
        
        Schema::create('coupons', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('code', 32);
            $table->text('description')->nullable();            
            $table->integer('allowed_usage');
            $table->date('valid_from_date');
            $table->date('valid_to_date');
            $table->integer('allocated');
            $table->integer('value');
            $table->enum('usage', array('Percentage', 'Amount'))->default('Percentage');            
            $table->timestamps();
        });
        
        Schema::create('coupons_allocated', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('coupon_id')->unsigned();
            $table->integer('single_ticket_id')->unsigned();
            $table->integer('multi_ticket_id')->unsigned();
            $table->timestamps();
        });   
        
        Schema::create('wastages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('wastage_reason_id')->unsigned();
            $table->integer('spaces');
            $table->text('notes')->nullable();
            $table->timestamps();
        }); 

        Schema::create('wastage_reasons', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamps();
        });
        
        Schema::create('wastage_reasons_lang', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('language_id')->unsigned()->default(1);
            $table->integer('wastage_reason_id')->unsigned();
            $table->string('description', 255);
            $table->timestamps();
        }); 
        
        Schema::create('notifications', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('level')->default(null);
            $table->integer('type')->default(null);
            $table->integer('user_id')->unsigned();
            $table->integer('id1')->unsigned()->nullable();
            $table->integer('id2')->unsigned()->nullable();
            $table->text('value')->nullable();
            $table->enum('status', array('active', 'inactive'))->default('active');
            $table->timestamps();
        });
        
        Schema::create('audits', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->enum('type', array('Change', 'Add', 'Delete'))->default('Change');
            $table->string('target', 128);
            $table->text('value')->nullable();
            $table->timestamps();
        });        
        
        
        // INDEXES & FOREIGN KEYS
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->unique('email');
        });

        Schema::table('addresses', function(Blueprint $table) {
            $table->index('postcode');
        });

        Schema::table('orders', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->unique('order_ref');
            $table->index('transaction_ref');
        });

        Schema::table('order_details', function(Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->index('single_ticket_id');
            $table->index('multi_ticket_id');  
            $table->index('plate_id');
        });

        Schema::table('plates', function(Blueprint $table) {
            $table->index('user_id');
            $table->index('guest_id');
            $table->index('plate_number');
        });

        Schema::table('pin_lists', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        Schema::table('pin_list_guests', function(Blueprint $table) {
            $table->foreign('pin_list_id')->references('id')->on('pin_lists')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        Schema::table('guest_lists', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        Schema::table('guest_list_guests', function(Blueprint $table) {
            $table->foreign('guest_list_id')->references('id')->on('guest_lists')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        Schema::table('roles_lang', function(Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        Schema::table('multi_tickets', function(Blueprint $table) {
            $table->foreign('car_park_id')->references('id')->on('car_parks')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('multi_ticket_group_id')->references('id')->on('multi_tickets_group')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        Schema::table('multi_tickets_group', function(Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        Schema::table('multi_tickets_group_lang', function(Blueprint $table) {
            $table->foreign('multi_ticket_group_id')->references('id')->on('multi_tickets_group')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
        
        Schema::table('multi_ticket_events', function(Blueprint $table) {
            $table->foreign('event_id')->references('id')->on('events')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('multi_ticket_group_id')->references('id')->on('multi_tickets')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        }); 
        
        Schema::table('single_tickets', function(Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });        

        Schema::table('events', function(Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->index('featured');
        });

        Schema::table('events_lang', function(Blueprint $table) {
            $table->foreign('event_id')->references('id')->on('events')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        Schema::table('products', function(Blueprint $table) {
            $table->foreign('event_id')->references('id')->on('events')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('car_park_id')->references('id')->on('car_parks')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    
        Schema::table('categories_lang', function(Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        Schema::table('teams', function(Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        Schema::table('teams_lang', function(Blueprint $table) {
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        Schema::table('car_parks_lang', function(Blueprint $table) {
            $table->foreign('car_park_id')->references('id')->on('car_parks')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
        
        Schema::table('notifications', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        }); 
        
        Schema::table('car_park_owners', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('car_park_id')->references('id')->on('car_parks')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        }); 

        Schema::table('coupons_allocated', function(Blueprint $table) {
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->index('multi_ticket_id');
            $table->index('single_ticket_id');
        });  
        
        Schema::table('wastages', function(Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('wastage_reason_id')->references('id')->on('wastage_reasons')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
        
        Schema::table('wastage_reasons_lang', function(Blueprint $table) {
            $table->foreign('wastage_reason_id')->references('id')->on('wastage_reasons')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Indexes & Foreign keys
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('users_role_id_foreign');
        });       

        Schema::table('orders', function(Blueprint $table) {
            $table->dropForeign('orders_user_id_foreign');
            $table->dropForeign('orders_address_id_foreign');
        });

        Schema::table('order_details', function(Blueprint $table) {
            $table->dropForeign('order_details_order_id_foreign');
        });

        Schema::table('plates', function(Blueprint $table) {
        });

        Schema::table('pin_lists', function(Blueprint $table) {
            $table->dropForeign('pin_lists_user_id_foreign');
        });

        Schema::table('pin_list_guests', function(Blueprint $table) {
            $table->dropForeign('pin_list_guests_pin_list_id_foreign');
            $table->dropForeign('pin_list_guests_guest_id_foreign');
        });      

        Schema::table('guest_lists', function(Blueprint $table) {
            $table->dropForeign('guest_lists_user_id_foreign');
            $table->dropForeign('guest_lists_product_id_foreign');
        });

        Schema::table('guest_list_guests', function(Blueprint $table) {
            $table->dropForeign('guest_list_guests_guest_list_id_foreign');
            $table->dropForeign('guest_list_guests_guest_id_foreign');
        });

        Schema::table('roles_lang', function(Blueprint $table) {
            $table->dropForeign('roles_lang_role_id_foreign');
            $table->dropForeign('roles_lang_language_id_foreign');
        });      


        Schema::table('multi_tickets', function(Blueprint $table) {
            $table->dropForeign('multi_tickets_car_park_id_foreign');
            $table->dropForeign('multi_tickets_multi_ticket_group_id_foreign');
        });

        Schema::table('multi_ticket_events', function(Blueprint $table) {
            $table->dropForeign('multi_ticket_events_event_id_foreign');
            $table->dropForeign('multi_ticket_events_multi_ticket_group_id_foreign');
        });

        Schema::table('multi_tickets_group', function(Blueprint $table) {
            $table->dropForeign('multi_tickets_group_category_id_foreign');
        });

        Schema::table('multi_tickets_group_lang', function(Blueprint $table) {
            $table->dropForeign('multi_tickets_group_lang_multi_tickets_group_id_foreign');
            $table->dropForeign('multi_tickets_group_lang_language_id_foreign');
        });

        Schema::table('events', function(Blueprint $table) {
            $table->dropForeign('events_category_id_foreign');
        });

        Schema::table('events_lang', function(Blueprint $table) {
            $table->dropForeign('events_lang_event_id_foreign');
            $table->dropForeign('events_lang_language_id_foreign');
        });

        Schema::table('products', function(Blueprint $table) {
            $table->dropForeign('products_event_id_foreign');
            $table->dropForeign('products_car_park_id_foreign');
        });

        Schema::table('categories_lang', function(Blueprint $table) {
            $table->dropForeign('categories_lang_category_id_foreign');
            $table->dropForeign('categories_lang_language_id_foreign');
        });

        Schema::table('teams', function(Blueprint $table) {
            $table->dropForeign('teams_category_id_foreign');
        });
            
        Schema::table('teams_lang', function(Blueprint $table) {
            $table->dropForeign('teams_lang_team_id_foreign');
            $table->dropForeign('teams_lang_language_id_foreign');
        });

        Schema::table('car_parks_lang', function(Blueprint $table) {
            $table->dropForeign('car_parks_lang_car_park_id_foreign');
            $table->dropForeign('car_parks_lang_language_id_foreign');
        });
        
        Schema::table('notifications', function(Blueprint $table) {
            $table->dropForeign('notificatios_user_id_foreign');
        });      
        
        Schema::table('car_park_owners', function(Blueprint $table) {
            $table->dropForeign('car_park_owners_user_id_foreign');
            $table->dropForeign('car_park_owners_car_park_id_foreign');
        });       
        
        Schema::table('coupons_allocated', function(Blueprint $table) {
            $table->dropForeign('coupons_allocated_coupon_id_foreign');
        });
        
        Schema::table('wastages', function(Blueprint $table) {
            $table->dropForeign('wastages_product_id_foreign');
            $table->dropForeign('wastages_wastage_reason_id_foreign');
        }); 
        

        Schema::table('wastage_reasons_lang', function(Blueprint $table) {
            $table->dropForeign('wastage_reasons_lang_wastage_reason_id_foreign');
            $table->dropForeign('wastage_reasons_lang_language_id_foreign');
        }); 

        Schema::drop('jobs');
        Schema::drop('users');
        Schema::drop('roles');
        Schema::drop('roles_lang');
        Schema::drop('addresses');
        Schema::drop('orders');
        Schema::drop('order_details');
        Schema::drop('plates');
        Schema::drop('pin_lists');
        Schema::drop('pin_list_guests');
        Schema::drop('guests');
        Schema::drop('guest_lists');
        Schema::drop('guest_list_guests');
        Schema::drop('multi_tickets');
        Schema::drop('multi_ticket_events');
        Schema::drop('multi_tickets_group');
        Schema::drop('multi_tickets_group_lang');
        Schema::drop('languages');
        Schema::drop('events');
        Schema::drop('events_lang');
        Schema::drop('categories');
        Schema::drop('categories_lang');
        Schema::drop('products');
        Schema::drop('car_park_owners');
        Schema::drop('car_parks');
        Schema::drop('car_parks_lang');
        Schema::drop('teams');
        Schema::drop('teams_lang');
        Schema::drop('notifications');
        Schema::drop('audits');
        Schema::drop('wastages');
        Schema::drop('wastage_reasons');
        Schema::drop('wastage_reasons_lang');
    }
}

