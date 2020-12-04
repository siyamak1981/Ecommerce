<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('phone')->nullable();
            $table->string('email')->unique();
            $table->string('category')->nullable();
            $table->string('coupon')->nullable();
            $table->string('other')->nullable();
            $table->string('product')->nullable();
            $table->string('blog')->nullable();
            $table->string('order')->nullable();
            $table->string('brand')->nullable();
            $table->string('report')->nullable();
            $table->string('role')->nullable();
            $table->string('return')->nullable();
            $table->string('contact')->nullable();
            $table->string('comment')->nullable();
            $table->string('setting')->nullable();
            $table->string('stock')->nullable();
            $table->integer('type')->default(1);
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
