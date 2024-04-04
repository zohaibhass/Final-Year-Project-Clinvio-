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
        Schema::create('certifications', function (Blueprint $table) {
            $table->bigInteger('certi_id');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('Doctor_id')->on('doctors')->onDelete('cascade');
            $table->string('name',150);
            $table->string('organization',150);
            $table->date('completion_date');
            $table->string('certi_description',500);
            $table->boolean('status')->default(false);
            $table->primary('certi_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};
