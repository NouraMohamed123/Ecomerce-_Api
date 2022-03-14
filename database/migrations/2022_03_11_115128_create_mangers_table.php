<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMangersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mangers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('xyz');
            $table->string('email',90)->unique();
            $table->string('phone',20)->unique();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('photo')->nullable();
            $table->enum('gender',['male','female']);
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
        Schema::dropIfExists('mangers');
    }
}
