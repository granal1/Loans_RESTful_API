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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->foreignId('dealership_id');

            $table->string('name', 256);
            $table->string('key', 64)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('employees', function($table)
        {
            $table->foreign('dealership_id')->references('id')->on('dealerships')->onupdate('cascade')->ondelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['dealership_id']);
            $table->dropSoftDeletes();
        });

        Schema::dropIfExists('employees');
    }
};
