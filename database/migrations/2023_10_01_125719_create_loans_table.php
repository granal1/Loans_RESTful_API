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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('dealership_id');
            $table->foreignId('employee_id');

            $table->decimal('amount', 10, 2);
            $table->smallInteger('months');
            $table->decimal('interest', 3, 2);
            $table->text('reason');

            $table->foreignId('status_id')->nullable();
            $table->foreignId('bank_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('loans', function ($table) {
            $table->foreign('dealership_id')->references('id')->on('dealerships')->onupdate('cascade')->ondelete('no action');
            $table->foreign('employee_id')->references('id')->on('employees')->onupdate('cascade')->ondelete('no action');
            $table->foreign('status_id')->references('id')->on('statuses')->onupdate('cascade')->ondelete('no action');
            $table->foreign('bank_id')->references('id')->on('banks')->onupdate('cascade')->ondelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropForeign(['dealership_id']);
            $table->dropForeign(['employee_id']);
            $table->dropForeign(['status_id']);
            $table->dropForeign(['bank_id']);
        });

        Schema::dropIfExists('loans');
    }
};
