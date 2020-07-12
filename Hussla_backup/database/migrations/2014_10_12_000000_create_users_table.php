<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hussla_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->bigInteger('phone');
            $table->string('businessname');
            $table->string('businessinfo');
            $table->bigInteger('businessphone');
            $table->string('businessaddress');
            $table->string('specialize');
            $table->string('businessmotto');
            $table->string('state');
            $table->string('area');
            $table->string('password');
            $table->rememberToken();
            $table->string('usingFreeSubscription');
            $table->string('usingPaidSubscription');
            $table->string('isEligible');
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
        Schema::dropIfExists('users');
    }
}
