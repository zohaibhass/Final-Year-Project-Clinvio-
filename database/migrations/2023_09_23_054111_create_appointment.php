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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id  ('Apt_id');
            $table->unsignedBigInteger('Doctor_id');
            $table->unsignedBigInteger('Pat_id');
            $table->foreign('Doctor_id')->references('Doctor_id')->on('doctors')->onDelete('cascade');
            $table->foreign('Pat_id')->references('Pat_id')->on('patients')->onDelete('cascade');
            $table->date('Date');
            $table->time('Time_start');
            $table->time('Time_end');
            $table->string('description',500);
            $table->string('status',10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment');
    }
};
