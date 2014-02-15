<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('status_id');
			$table->integer('branch_id');
			$table->integer('user_id');
			$table->string('rma_number', 255)->unique();
			$table->string('item');
			$table->text('serial_number')->nullable();
			$table->string('pa_fv')->nullable();
			$table->text('client');
			$table->text('client_phone');
			$table->string('ext_service')->nullable();
			$table->decimal('price_netto', 6, 2)->default(0.00);
			$table->string('description');
			$table->string('diagnose')->nullable();
			$table->string('comments')->nullable();
			$table->text('accesories')->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
