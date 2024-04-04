<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id('Doctor_id')->unsigned();

            $table->string('Name',50);
            $table->unsignedBigInteger('dept_id');
            $table->foreign('dept_id')->references('dept_id')->on('departments');
            $table->string('Email',50)->unique();
            $table->string('Password',100);
            $table->string('Phone',30);
            $table->string('Profile_picture',100);
            $table->string('Gender',30)->nullable();
            $table->integer('Age')->nullable();
            $table->string('city',50);
            $table->string('state',50);
            $table->string('country',50);
            $table->string('Description',500);
            $table->string('adress',300)->nullable();
            $table->string('tags',100)->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
