<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');			
			$table->string('username',11);			
			$table->string('email')->unique();
			$table->string('mobile_no',14)->unique();
			$table->string('password');
			$table->rememberToken();
			$table->integer('role');
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
		//
		Schema::table('users', function(Blueprint $table)
		{
			Schema::dropIfExists("users");
		});
	}

}
